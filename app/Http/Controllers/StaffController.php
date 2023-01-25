<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    $user = Auth::user();
    return view('staff.home', compact('user'));

}
