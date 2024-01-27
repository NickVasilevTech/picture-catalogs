<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function view(Request $request): View
    {
        if (isset($request->username)) {
            $user = User::whereUsername($request->username)->first();
        } else {
            $user = $request->user();
        }
        $pictures = Picture::getPicturesByUserId($user->id);
        $catalogs = Catalog::getCatalogsByUserId($user->id);
        $catalogThumbnails = [];
        foreach($catalogs as $catalog) {
            $catalog->thumbnail = Catalog::getThumbnailFilename($catalog->id);
        }
        return view('profile.view', [
            'username'   => $user->username,
            'name' => $user->name,
            'pictures' => $pictures,
            'catalogs' => $catalogs,
            // Setup a default black banner if no banner set
            'customBanner' => $user->profile_banner??''
        ]);
    }
}
