<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\CatalogsPicture;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
    function view(Request $request) {
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
        /*
        'username'   => $user->username,
            'name' => $user->name,
            'pictures' => $pictures,
            // Setup a default black banner if no banner set
            'customBanner' => $user->profile_banner??'',
            'catalogs' => []
            */
    }

    function create(Request $request) {
        $catalog = new Catalog();
        $catalog->user_id = Auth::user()->id;
        $catalog->name = $request->name;
        $catalog->save();

        return back();
    }

    function addPictureToCatalog(Request $request) {
        $catalog = Catalog::find($request->catalog_id);
        $preexistingPictureInCatalog = $catalog->catalogPictures()->where('picture_id', $request->picture_id)->first();
        if ($catalog->user_id === Auth::user()->id && !isset($preexistingPictureInCatalog)) {
            try {
                $pictureCatalog = new CatalogsPicture();
                $pictureCatalog->picture_id = $request->picture_id;
                $pictureCatalog->catalog_id = $request->catalog_id;
                $pictureCatalog->save();

                return response()
                ->json(['success' => true ]);
            } catch(Exception $e) {
                return response()
                ->json(['success' => false ]);
            }
        } else {
            return response()
                ->json(['success' => false ]);
        }
    }
}
