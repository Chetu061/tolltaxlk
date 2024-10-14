<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userindex(){
        $user=User::all();
        return view('backend.user.index',compact('user'));
    }
}
