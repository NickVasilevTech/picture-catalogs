<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Picture;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PictureController extends Controller
{

    public function view(Request $request)
    {
        $comments = Picture::getCommentsByPictureId($request->picture['id']);
        return view('pictures.view',[
            'picture' => $request->picture,
            'comments' => $comments
        ]);
    }

    public function leaveComment(Request $request)
    {
        $newComment = new Comment();
        $newComment->user_id = Auth::user()->id;
        $newComment->picture_id = $request->pictureId;
        $newComment->body = $request->commentBody;
        $newComment->save();
        return back();
    }

    // public function pictureUploadForm()
    // {
    //     return view('pictureUploadForm');
    // }

    public function pictureUploadPost(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $pictureName = time().'.'.$request->picture->extension();

        if (isset($request->useAsBanner) && (bool) ($request->useAsBanner) === true ) {
            User::find(Auth::user()->id)->update(['profile_banner' => $pictureName]);
        }

        $request->picture->storeAs('public/user_pictures', $pictureName);

        $picture = new Picture();
        $picture->user_id = Auth::user()->id;
        $picture->filename = $pictureName;
        $picture->save();

        return back()
            ->with('success','You have successfully uploaded a picture.')
            ->with('image',$pictureName);
    }
}
