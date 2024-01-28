<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Picture;
use App\Models\User;
use HTMLPurifier;
use HTMLPurifier_Config;
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
        $request->validate([
            'pictureId' => 'required|numeric|exists:pictures,id',
            'commentBody' => 'required|string'
        ]);

        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.AllowedElements', 'a,i,b,p,div,strong,h1,h2,h3,h4,h5,ol,ul,li,br');
        $config->set('HTML.AllowedAttributes', 'href,title,target,name');
        $config->set('HTML.Attr.Name.UseCDATA', true);
        $config->set('AutoFormat.RemoveEmpty.RemoveNbsp', true);
        $config->set('Attr.AllowedFrameTargets', ['_blank']);
        $config->set('AutoFormat.RemoveEmpty', true);
        $purifier = new HTMLPurifier($config);
        $sanitizedBody = $purifier->purify($request->commentBody);

        $newComment = new Comment();
        $newComment->user_id = Auth::user()->id;
        $newComment->picture_id = $request->pictureId;
        $newComment->body = $sanitizedBody;
        $newComment->save();
        return back();
    }

    public function pictureUploadPost(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $pictureName = time() . Auth::user()->id . '.' . $request->picture->extension();

        if (isset($request->useAsBanner) && (bool) ($request->useAsBanner) === true) {
            User::find(Auth::user()->id)->update(['profile_banner' => $pictureName]);
        }

        $request->picture->storeAs('public/user_pictures', $pictureName);

        $picture = new Picture();
        $picture->user_id = Auth::user()->id;
        $picture->filename = $pictureName;
        $picture->save();

        return back()
            ->with('success', 'You have successfully uploaded a picture.')
            ->with('image', $pictureName);
    }
}
