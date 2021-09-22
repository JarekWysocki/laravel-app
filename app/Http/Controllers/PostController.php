<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
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
    
    public function addPost(Request $request) {
        $request->validate([
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
        if ($request['post']) {
    if ($request->file('image')) {
        $file_extention = $request->file('image')->getClientOriginalExtension();
        $file_name = time().rand(99,999).'image_post.'.$file_extention;
        $file_path = $request->file('image')->move(public_path().'/imagesOfPosts',$file_name);
        Post::create([
            'whois' => $request['whois'],
            'post' => $request['post'],
            'imgpost' => $file_name
        ]);
    }
    else {
        Post::create([
            'whois' => $request['whois'],
            'post' => $request['post'],
            'imgpost' => ''
        ]);
    }
}
if($request['value']) {
$rows = Post::select('id')->get();
$count = $rows->count();
if ($request['value'] != $count) {
    $amount = $count - $request['value'];
    $posts = Post::join('users', 'posts.whois', '=', 'users.id')
    ->select('posts.post', 'posts.imgpost', 'posts.created_at', 'users.name', 'users.image', 'posts.id')
    ->orderBy('posts.id', 'desc')
    ->limit($amount)
    ->get();
    return $posts;
}
}
}
}