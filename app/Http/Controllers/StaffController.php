<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $data_staff = Staff::latest()->paginate('10');
        return view('staff.index', [
            "data_staff" => $data_staff,
            "title" => "Home",
            "sitemap" => 'Staff',
        ])->with('i', (request()->input('page', 1) - 1) * 10,  compact('user'));
        //


    }

    public function create()
    {
        return view('admin.create', [
            "title" => "Tambah Petugas", "sitemap" => 'Petugas',

        ]);
    }
    public function store(Request $request)

    {
        $data_validasi = $request->validate([
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',

            // 'password'              => 'required|confirmed'
        ]);

        // $messages = [
        //     'name.required'         => 'Nama Lengkap wajib diisi',
        //     'name.min'              => 'Nama lengkap minimal 3 karakter',
        //     'name.max'              => 'Nama lengkap maksimal 35 karakter',
        //     'email.required'        => 'Email wajib diisi',
        //     'email.email'           => 'Email tidak valid',
        //     'email.unique'          => 'Email sudah terdaftar',

        //     // 'password.required'     => 'Password wajib diisi',
        //     // 'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        // ];

        // $validator = Validator::make($request->all(), $rules, $messages);

        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput($request->all);

        $data_validasi['password'] = Hash::make($data_validasi['password']);
        $data_validasi['default_pass'] = ($data_validasi['email']);
        $data_validasi['role'] = "staff";
        $data_validasi['email_verified_at'] = \Carbon\Carbon::now();
        
        $user = User::create($data_validasi);
        // $staff = new Staff;
        // $staff->name = ucwords(strtolower($request->name));
        // $staff->email = strtolower($request->email);
        // Staff::create($staff->all);

        if (!is_null($user)) {
            return redirect(route('staff.index'))->with("success", "Success! Registration completed");
        } else {
            return back()->with("error", "Alert! Failed to register");
        }

    }


    public function complete_reg($id)
    {

    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
