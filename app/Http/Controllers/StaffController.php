<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        
        return view('staff.create', [
            "title" => "Tambah Data Petugas", "sitemap" => 'Petugas',
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'email'       => 'required|email|unique:users',
            'nama_petugas'        => 'required',
            'role'        => 'required',
        ];

        $messages = [
            'nama_petugas.required'     => 'Nama Petugas tidak boleh kosong',
            'email.required'            => 'Email Petugas tidak boleh kosong',
            'email.email'               => 'Format Email tidak valid',
            'email.unique'              => 'Email Telah terdaftar',
            'role.required'             => 'Harus ada level pengguna',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data_staff = [
            "nama_petugas"          => $request->nama_petugas,
            "email"         => $request->email,
           
        ];

        Staff::create($data_staff);

        $default_pass = str::random(8);
        $data_user = [
            "email"         => $request->email, 
            "name"          => $request->nama_petugas,
            "default_pass"  => $default_pass,
            "password"      => Hash::make($default_pass),
            "role"          => "staff"
        ];
        
        User::create($data_user);

        return redirect()->route('staff.index')->with('success', ' Data telah ditambahkan!');
    }

    public function show($id)
    {
        $siswa = Staff::find($id);
        return view('staff.show', [
            "staff" => $siswa,
            "title" => "Lihat Data Staff",
            "sitemap" => "Staff"
        ]);
    }

    public function edit($id)
    {
        $data_staff = Staff::find($id);
       
        return view('staff.edit', [
            "staff" => $data_staff,
            "title" => "Edit Data Petugas",
            "sitemap" => "Petugas",
          
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nama_petugas'  => 'required',
            'email'         => 'required|email|unique:student,email,' . $id,
            
        ];

        $messages = [
            'nama_petugas.required'     => 'Nama Siswa tidak boleh kosong',
            'email.required'            => 'Email Siswa tidak boleh kosong',
            'email.email'               => 'Format Email tidak valid',
            'email.email'               => 'Email telah terdaftar',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data_staff = [
            "nama_petugas"          => $request->nama_petugas,
            "email"         => $request->email,
        ];

        $staff = Staff::find($id);
        $staff->update($data_staff);
        return redirect()->route('staff.index')->with('success', 'Data berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $staff = Staff::find($id);
        $email = $staff->email;
        DB::table('users')->where('email',$email)->delete();
        // dd($user->email);
        $staff->delete();
        // $user->delete();

        return redirect()->route('staff.index', [
            "title" => "Data Staff",
            "sitemap" => "Staff"
        ])->with('success', 'Data berhasil dihapus');
    }
}
