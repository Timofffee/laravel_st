<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\newCommentRequest;
use App\Comment;

class CommentController extends Controller
{
    //


    /**
     * Append a new comment on home page.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function new(newCommentRequest $req, $id = null)
    {
        $comment = new Comment;
        $comment->subject = $req->input('subject');
        $comment->theme = $req->input('theme');
        $comment->message = $req->input('message');
        $comment->owner = Auth::id();

        $comment->save();
        
        return redirect()->route('home')->with('success', 'Message has been successfully sent');
    }
}
