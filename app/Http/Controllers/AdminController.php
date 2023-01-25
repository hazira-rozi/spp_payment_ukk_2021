<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    $user = Auth::user();
    return view('admin.home', compact('user'));

}
