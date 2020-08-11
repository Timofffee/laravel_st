<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class UserController extends Controller
{
    public function index($id)
    {
        return view('home', ['data' => Comment::all()->where('owner', '=', $id)]);
    }

    
}
