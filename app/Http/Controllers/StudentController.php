<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SPP;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $nama_kelas = Kelas::select('nama_kelas')->pluck('nama_kelas');
        $tahun_spp = SPP::select('tahun')->pluck('tahun');
        $data_siswa = Student::latest()->paginate('10');
        
        return view('siswa.index', [

            "data_siswa" => $data_siswa,
            "title" => "Home",
            "sitemap" => 'Siswa',
            "nama_kelas" => $nama_kelas,
            "tahun_spp"  => $tahun_spp
        ])->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $kelas_siswa = Kelas::all();
        $spp_siswa = SPP::all();

        return view('siswa.create', [
            "title" => "Tambah Data Siswa", "sitemap" => 'Siswa',
            //add 
            "kelas_siswa" => $kelas_siswa,
            "spp_siswa"  => $spp_siswa

        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'nisn'          => 'required|unique:student',
            'nis'           => 'required|unique:student',
            'nama'          => 'required',
            'id_kelas'      => 'required',
            'email'         => 'required|email',
            'alamat'        => 'required',
            'no_telp'       => 'required|digits_between:10,12',
            'id_spp'        => 'required',

        ];

        $messages = [
            'nisn.unique'               => 'NISN telah terdaftar',
            'nisn.required'             => 'NISN tidak boleh kosong',
            'nis.unique'                => 'NIS telah terdaftar',
            'nis.required'              => 'NIS tidak boleh kosong',
            'nama.required'             => 'Nama Siswa tidak boleh kosong',
            'id_kelas.required'          => 'Kelas tidak boleh kosong',
            'email.required'            => 'Email Siswa tidak boleh kosong',
            'email.email'               => 'Format Email tidak valid',
            'no_telp.required'          => 'Nomor telepon Siswa tidak boleh kosong',
            'alamat.required'           => 'Alamat Siswa tidak boleh kosong',
            'id_spp.required'          => 'Tahun SPP tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data_student = [
            "nisn"          => $request->nisn,
            "nis"           => $request->nis,
            "nama"          => $request->nama,
            "id_kelas"      => $request->id_kelas,
            "email"         => $request->email,
            "alamat"        => $request->alamat,
            "no_telp"       => "0".$request->no_telp,
            "id_spp"        => $request->id_spp,
        ];

        Student::create($data_student);
        $default_pass = str::random(8);
        $data_user = [
            "email"         => $request->email, 
            "name"          => $request->nama,
            "default_pass"  => $default_pass,
            "password"      => Hash::make($default_pass),
            "role"          => "student"
        ];
        
        User::create($data_user);

        return redirect()->route('siswa.index')->with('success', ' Data telah ditambahkan!');
    }

    public function show($id)
    {
        $siswa = Student::find($id);
        return view('siswa.show', [
            "siswa" => $siswa,
            "title" => "Lihat Data SPP",
            "sitemap" => "SPP"
        ]);
    }

    public function edit($id)
    {
        $siswa = Student::find($id);

        $kelas_siswa = Kelas::all();
        $spp_siswa = SPP::all();
        //tambah code 
        
        return view('siswa.edit', [
            "siswa" => $siswa,
            "title" => "Edit Data SPP",
            "sitemap" => "SPP",
            "kelas_siswa" => $kelas_siswa,
            "spp_siswa"  => $spp_siswa
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nisn'          => 'required|unique:student,nisn,' . $id,
            'nis'           => 'required|unique:student,nis,' . $id,
            'nama'          => 'required',
            'id_kelas'      => 'required',
            'email'         => 'required|email',
            'alamat'        => 'required',
            'no_telp'       => 'required|digits_between:10,12',
            'id_spp'        => 'required',

        ];

        $messages = [
            'nisn.unique'               => 'NISN telah terdaftar',
            'nisn.required'             => 'NISN tidak boleh kosong',
            'nis.unique'                => 'NIS telah terdaftar',
            'nis.required'              => 'NIS tidak boleh kosong',
            'nama.required'             => 'Nama Siswa tidak boleh kosong',
            'id_kelas.required'          => 'Kelas tidak boleh kosong',
            'email.required'            => 'Email Siswa tidak boleh kosong',
            'email.email'               => 'Format Email tidak valid',
            'no_telp.required'          => 'Nomor telepon Siswa tidak boleh kosong',
            'alamat.required'           => 'Alamat Siswa tidak boleh kosong',
            'id_spp.required'          => 'Tahun SPP tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data_student = [
            "nisn"          => $request->nisn,
            "nis"           => $request->nis,
            "nama"          => $request->nama,
            "id_kelas"      => $request->id_kelas,
            "email"         => $request->email,
            "alamat"        => $request->alamat,
            "no_telp"       => "0".$request->no_telp,
            "id_spp"        => $request->id_spp,
        ];

        $siswa = Student::find($id);
        $siswa->update($data_student);
        return redirect()->route('siswa.index')->with('success', 'Data berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $siswa = Student::find($id);



        $siswa->delete();

        return redirect()->route('siswa.index', [
            "title" => "Data SPP",
            "sitemap" => "SPP"
        ])->with('success', 'Data berhasil dihapus');
    }
}
