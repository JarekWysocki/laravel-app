<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;

class LikeController extends Controller
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
    
    public function giveLike(Request $request) {
        if ($request['myId'] && $request['idPost']) {
        $likes = Like::where([
            ['who_like_id', '=', $request['myId']],
            ['post_id', '=', $request['idPost']]
            ])
            ->get();
            if (count($likes) == 0) {
                Like::create([
                    'who_like_id' => $request['myId'],
                    'post_id' => $request['idPost']
                ]);
            };
        }
        if ($request['idPost']) {
            $wholikes = Like::select('name')
            ->join('users', 'likes.who_like_id', '=', 'users.id')
            ->where('post_id', $request['idPost'])
            ->get();
            return $wholikes;
        }
}
public function checkLike(Request $request) {
    $likes = Like::select('post_id')
    ->get();
    return($likes);
}
}