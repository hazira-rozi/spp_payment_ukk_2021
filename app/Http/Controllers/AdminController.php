<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.index' ,[
            "title" => "Beranda", "sitemap" => 'Petugas'],compact('user')
        );
    }


}
