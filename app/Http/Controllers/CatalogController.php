<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\CatalogsPicture;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CatalogController extends Controller
{
    public function view(Request $request) {
        $pictures = Catalog::getPicturesInCatalog($request->catalog['id'], true);
        $picArr = $pictures->all();

        return view('welcome', [
            'pictures'  => $pictures,
            'catalog' => [
                'banner' => (count($pictures) > 0) ? end($picArr)->filename : '',
                'name' => $request->catalog['name'],
                'authorName' => 'by ' . $request->catalog['authorName']
            ]
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $catalog = new Catalog();
        $catalog->user_id = Auth::user()->id;
        $catalog->name = $request->name;
        $catalog->save();
        $catalog->puctures = null;
        Session::push('user_catalogs', $catalog);
        return back();
    }

    public function addPictureToCatalog(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'catalog_id' => 'required|numeric|exists:catalogs,id',
            'picture_id' => 'required|numeric|exists:pictures,id',
        ]);

        if ($validator->fails()) {
            return response()->json([ 'success' => false, 'errors' => $validator->errors() ], 422);
        }
        $catalog = Catalog::find($request->catalog_id);
        $preexistingPictureInCatalog = $catalog->catalogPictures()->where('picture_id', $request->picture_id)->first();

        if ($catalog->user_id === Auth::user()->id && !isset($preexistingPictureInCatalog)) {
            try {
                $pictureCatalog = new CatalogsPicture();
                $pictureCatalog->picture_id = $request->picture_id;
                $pictureCatalog->catalog_id = $request->catalog_id;
                $pictureCatalog->save();

                $indexOfCatalog = array_search($request->catalog_id, array_column(Session::get('user_catalogs'), 'id'));
                $catalogInSession = Session::get('user_catalogs.' . $indexOfCatalog);
                $pictures = $catalogInSession->pictures;
                $pictures = $pictureCatalog->picture_id . ','. $pictures;
                $catalogInSession->pictures = $pictures;
                Session::put('user_catalogs.' . $indexOfCatalog, $catalogInSession);

                return response()
                ->json(['success' => true]);
            } catch(Exception $e) {
                return response()
                ->json(['success' => false]);
            }
        } else {
            return response()
                ->json(['success' => false]);
        }
    }
}
