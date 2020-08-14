<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    
    static public function getUserComments($id) {
        $comments = Comment::select(DB::raw('comments.*, users.name as username'))
            ->leftJoin('users', 'comments.owner', '=', 'users.id')
            ->where('owner', '=', $id)
            ->orderBy('created_at', 'desc')->get();
        $data = [];
        $parents = [];
        foreach ($comments as $i => $comment) {
            if ($comment->parent_id == null) {
                $parents[$comment->id] = $comment;
            }
        }
        $r = [];
        foreach ($comments as $i => $comment) {
            if ($comment->parent_id != null) {
                if (array_key_exists($comment->parent_id, $parents)) {
                    $comment->quote = $parents[$comment->parent_id];
                } else {
                    $comment->quote = Comment::select(DB::raw('comments.*, users.name as username'))
                        ->leftJoin('users', 'comments.owner', '=', 'users.id')
                        ->where('comments.id', '=', $comment->parent_id)
                        ->first();
                }
            } else {
                if ($comment->deleted) {
                    continue;
                }
                $comment->quote = null;
            }
            array_push($data, $comment);
        }
        return $data;
    }

    static public function getComments($id, $count = 100, $offset = 0) {
        $count = ($count < 0) ? 100 : $count;
        $d = Comment::select(DB::raw('comments.*, users.name as username'))
            ->leftJoin('users', 'comments.owner', '=', 'users.id')
            ->where([
                ['comments.user_id', '=', $id],
                ['comments.parent_id', '=', null]
            ])->take($count);
        if ($offset > 0) {
            $d = $d->skip($offset);
        }
        $data = $d->orderBy('created_at', 'desc')->get();
        foreach ($data as $i => $comment) {
            $comment->childs = Comment::select(DB::raw('comments.*, users.name as username'))
                ->leftJoin('users', 'comments.owner', '=', 'users.id')
                ->where('parent_id', '=', $comment->id)
                ->orderBy('created_at', 'desc')->get();
        }
        return $data;
    }

    static public function get($id) {
        $c = Comment::select(DB::raw('comments.*, users.name as username'))
            ->leftJoin('users', 'comments.owner', '=', 'users.id')
            ->where('comments.id', '=', $id)
            ->first();
        if ($c != null) {
            if ($c->parent_id != null) {
                
            }
            $c->childs = Comment::select(DB::raw('comments.*, users.name as username'))
                ->leftJoin('users', 'comments.owner', '=', 'users.id')
                ->where('parent_id', '=', $id)
                ->orderBy('created_at', 'desc')
                ->get();
                
            return $c;
        }
        return false;

    }

    static public function deleteComment($id) {

        $q = Comment::where('id', '=', $id)
            ->where(function ($query) {
                $query->where('owner', '=', Auth::id())
                      ->orWhere('user_id', '=', Auth::id());
            });
        $p = $q->first();
        if (!$p) {
            return;
        }

        if (Comment::where('parent_id', '=', $id)->count() == 0
        ) {
            $q->delete();
            if (Comment::where('parent_id', '=', $p->parent_id)->count() == 0) {
                Comment::where('id', '=', $p->parent_id)
                    ->where('deleted', '=', DB::raw(1))
                    ->delete();
            }
        } else {
            $q->update( ['deleted' => true] );
            
        }
    }

    static public function getCount($id) {
        return Comment::where([
                ['user_id', '=', $id],
                ['parent_id', '=', null]
            ])
            ->count();
    }
}
