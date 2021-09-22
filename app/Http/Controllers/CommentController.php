<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentController extends Controller
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
    
    public function addComment(Request $request) {
        if ($request['comment']) {
        Comment::create([
            'who_comment_id' => $request['whois'],
            'post_id' => $request['postId'],
            'comment' => $request['comment'],
        ]);
}
$comments = Comment::select('name', 'post_id', 'comment', 'image')
->join('users', 'comments.who_comment_id', '=', 'users.id')
->orderBy('comments.id', 'desc')
->limit($request['value'])
->get();
return $comments;
}
public function getComment() {
  $comment = Comment::select('post_id')
    ->get();
return $comment;
}
}