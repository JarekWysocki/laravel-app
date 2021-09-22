<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;

class MessageController extends Controller
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
    
    public function addMessage(Request $request) {
       
        if ($request['message']) {
        Message::create([
            'message' => $request['message'],
            'fromUser' => $request['fromUser'],
            'toUser' => $request['toUser']
        ]);
}

Message::where([
    ['toUser', '=', $request['fromUser']],
    ['fromUser', '=', $request['toUser']]
    ])
->update(['is_readed' => 1]);

$messages = Message::select('message', 'fromUser')
->where([
    ['toUser', '=', $request['toUser']],
    ['fromUser', '=', $request['fromUser']]
])
->orwhere([
['toUser', '=', $request['fromUser']],
['fromUser', '=', $request['toUser']]
])
->orderBy('id', 'desc')
->get(); 
return($messages);
}
public function checkNewMessage(Request $request) {
    $messages = Message::select('fromUser')
    ->where([
        ['toUser', '=', $request['fromUser']],
        ['is_readed', '=', null]
    ])
    ->get(); 
    return($messages);
}
}