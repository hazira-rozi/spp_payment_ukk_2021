<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    $user = Auth::user();
    return view('student.home', compact('user'));

}
