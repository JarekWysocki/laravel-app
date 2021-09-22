<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::join('users', 'posts.whois', '=', 'users.id')
        ->select('posts.post', 'posts.imgpost', 'posts.created_at', 'users.name', 'users.image', 'posts.id')
        ->orderBy('posts.id', 'desc')
        ->get();
        return view('home', compact('posts'));
    }
   
}
