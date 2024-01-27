<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Support\Facades\Route;

class WebController extends Controller
{
    function home() {
        $pictures = Picture::getLatestPictures();
        return view('welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'pictures'  => $pictures
        ]);
    }
}
