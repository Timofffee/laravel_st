<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
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
        $data = $d->get();
        foreach ($data as $i => $comment) {
            $comment->childs = $q->where('comments.parent_id', '=', $comment->id)
                ->get();
        }
        return $data;
    }
}
