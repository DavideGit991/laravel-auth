<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class ImageController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth');
     }

    public function upload(Request $req)
    {

        $req->validate([
               'iconUser'=> 'required|image|max:2048'
         ]);
        $user=Auth::user();

        $this->deleteFile();

        $image= $req ->file ('iconUser');

        $ext= $image->getClientOriginalExtension();
        $nameimg=rand(100000,999999) . '_' . time();
        $fullname=$nameimg . '.' . $ext;

        $image->storeAs('avatar',$fullname,'public');

        $user=Auth::user();
        $user->avatar_name = $fullname;
        $user->save();

        return redirect()->back();


    }

    //serve per eliminare il campo del nome file nel Db
    public function deleteDb()
    {
        $this->deleteFile();
        $user=Auth::user();
        if($user->avatar_name){
            $user->avatar_name = null;
            $user->save();
        };
        return redirect()->back();
    }

        //serve per eliminare i file nella cartella di riferimento in storage
    private function deleteFile(){

        $user=Auth::user();
        $filename=$user->avatar_name;

        $file= storage_path('app/public/avatar/'. $filename);
        File::delete($file);


    }
}
