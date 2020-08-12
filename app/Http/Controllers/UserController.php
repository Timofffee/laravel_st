<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class UserController extends Controller
{
    public function index($id = null)
    {
        $data = Comment::getCommets(($id) ? $id : Auth::id(), 5);
        return view('home', ['id' => $id, 'data' => $data]);
    }
}
