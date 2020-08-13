<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\User;

class UserController extends Controller
{
    public function index($id = null)
    {
        $user_id = ($id) ? $id : Auth::id();
        $data = Comment::getComments($user_id, 5);
        $user = User::findOrFail($user_id);
        return view('home', ['data' => $data, 'count' => Comment::getCount($user_id), 'user' => $user]);
    }

    public function all($id = null)
    {
        $users = User::inRandomOrder()->get();
        return view('welcome', ['users' => $users]);
    }
}
