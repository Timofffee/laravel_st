<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    // static public function newComment($req) {
    //     DB::table('comments')
    //         ->insert([
    //             'subject' => $req->input('subject'),
    //             'message' => $req->input('message'),
    //             'owner' => Auth::id(),
    //             'user_id' => ($req->has('user_id')) ? $req->input('user_id') : Auth::id(),
    //             'parent_id' => ($req->has('parent_id')) ? $req->input('parent_id') : null
    //         ]);
    // }
    
    static public function getComments($id, $count = -1, $offset = 0) {
        $q = DB::table('comments')
            ->select(DB::raw('comments.*, users.name as username'))
            ->leftJoin('users', 'comments.owner', '=', 'users.id');
        $d = $q->where([
                ['comments.user_id', '=', $id],
                ['comments.parent_id', '=', null]
            ]);
        if ($offset > 0) {
            $d = $d->skip($offset);
        }

        if ($count >= 0) {
            $d = $d->take($count);
        }
        $data = $d->orderBy('created_at', 'desc')->get();
        foreach ($data as $i => $comment) {
            $comment->childs = DB::table('comments')
                ->select(DB::raw('comments.*, users.name as username'))
                ->leftJoin('users', 'comments.owner', '=', 'users.id')
                ->where('parent_id', '=', $comment->id)
                ->orderBy('created_at', 'desc')->get();
        }
        return $data;
    }

    static public function deleteComment($id) {
        $cc = DB::table('comments')
            ->where('parent_id', '=', $id)
            ->count();

        $q = DB::table('comments')
            ->where('id', '=', $id)
            ->where(function ($query) {
                $query->where('owner', '=', Auth::id())
                      ->orWhere('user_id', '=', Auth::id());
            });
        $p = $q->get()[0];
        if ($cc != 0) {
            $q->update(['deleted' => true]);
        } else {
            $q->delete();
            if (DB::table('comments')
                ->where('parent_id', '=', $p->parent_id)
                ->count() == 0) 
            {
                DB::table('comments')
                    ->where('id', '=', $p->parent_id)
                    ->where('deleted', '=', DB::raw(1))
                    ->delete();
            }

            
        }

        
    }

    static public function getCount($id) {
        return DB::table('comments')
            ->where([
                ['user_id', '=', $id],
                ['parent_id', '=', null]
            ])
            ->count();
    }
}
