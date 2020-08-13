<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\newCommentRequest;
use App\Comment;
use App\User;

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
        $comment->message = $req->input('message');
        $comment->owner = Auth::id();
        $comment->user_id = ($req->has('user_id')) ? $req->input('user_id') : Auth::id();
        $comment->parent_id = ($req->has('parent_id')) ? $req->input('parent_id') : null;

        $comment->save();
        
        return redirect()->back()->with('success', 'Comment has been successfully sent');
    }

    public function all($id = null) {
        $user_id = ($id) ? $id : Auth::id();
        $data = Comment::getUserComments($user_id);
        $user = User::findOrFail($user_id);
        return view('allComments', ['id' => $id, 'data' => $data, 'user' => $user]);
    }

    public function delete($id) {
        Comment::deleteComment($id);

        return redirect()->back();
    }

    public function reply($id) {
        return redirect()->back();
    }
}
