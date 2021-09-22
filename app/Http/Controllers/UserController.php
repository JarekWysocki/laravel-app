<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Carbon\Carbon;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('index', compact('users'));
    }
    public function addTime(Request $request)
    {
        
        $date = Carbon::now();
       User::where('id', '=', $request['id'])
       ->update(['updated_at' => $date]);
       
    }
    public function avalibity() {
        $date = Carbon::now();
        $date->modify('-5 seconds');
        $formatted_date = $date->format('Y-m-d H:i:s');
       $users = User::select('id')
       ->where('updated_at','>=',$formatted_date)->get();
       return $users;
    }
}
