<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) { 
// true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
        }
        return view('login');
    }
  
    public function login(Request $request)
    {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];
  
        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
  
        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];
  
        Auth::attempt($data);
  
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
  
        } else { // false
  
            //Login Fail
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
  
    }
  
    public function showFormRegister()
    {
        return view('register',  [
            "title" => "Tambah Pengguna", "sitemap" => 'Pengguna']);
    }
  
    public function register(Request $request)
    {
        
        /* */
        $data_validasi= $request->validate([
            "name"              => "required",
            "email"             => "required|email",
            
        ]);

        $data_validasi['default_pass'] = Str::random(8);
        $data_validasi['password'] = Hash::make($data_validasi['default_pass']);
        $data_validasi['email_verified_a(t'] = \Carbon\Carbon::now();
        $user = User::create($data_validasi);
        if (!is_null($user)) {
            return redirect('login')->with("success", "Success! Registration completed");
        } else {
            return back()->with("error", "Alert! Failed to register");
        }
    }
  
    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
  
}