<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return $users;
    }
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'biography' => $request->biography,
        ]);
        return $user;
    }
    public function delete(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        if($user)
        {
            if($user->delete())
            {
                return ['status' => 'success'];
            }
            else{
                return ['status' => 'failed'];
            }
        }
        else{
            return ['status'=> 'failed'];
        }
    }
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $users = User::where('name' , 'LIKE' , "%".$keyword."%")->get();
        return $users;
    }
}