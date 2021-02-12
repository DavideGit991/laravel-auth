<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class ImageController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function upload(Request $req)
    {

          $req->validate([
              'iconUser'=> 'required|file|size:2048'
         ]);

        $image= $req ->file ('iconUser');

        $ext= $image->getClientOriginalExtension();
        $nameimg=rand(100000,999999) . '_' . time();
        $fullname=$nameimg . '.' . $ext;

        $file = $image->storeAs('avatar',$fullname,'public');

        $user=Auth::user();
        $user->avatar_name = $fullname;
        $user->save();

        return redirect()->back();


    }
}
