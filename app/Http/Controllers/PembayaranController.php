<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SPP;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class PembayaranController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        
        $data_pembayaran = Pembayaran::latest()->paginate('10');
        $data_siswa = Student::all();
        $data_spp = SPP::all();
        // $petugas_id = $data_petugas->id;
        return view('pembayaran.index', [
                
            "data_pembayaran" => $data_pembayaran,
            "data_siswa"=>$data_siswa,
            "data_spp"=>$data_spp,
            "title" => "Home",
            "sitemap" => 'Pembayaran',
         
        ])->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {

        $user = Auth::user();
        $email = $user->email;
        $data_spp = SPP::all();
        $data_siswa = Student::all();
        $data_petugas = Staff::where('email',$email) ->first();
        $petugas_id = $data_petugas->id;
        $data_kelas = Kelas::all();

        return view('pembayaran.create', [
            "title" => "Tambah Data Siswa", "sitemap" => 'Siswa',
            //add 
            "data_siswa" => $data_siswa,
            "data_spp"  => $data_spp,
            "data_kelas"  => $data_kelas,
            "petugas_id"  => $petugas_id,            

        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'nisn'          => 'required',
            'tanggal_bayar' => 'required',
            'bulan_dibayar' => 'required',
            'jumlah_bayar'  => 'required|digits_between:5,11',

        ];

        // dd($request->tanggal_bayar);
        $messages = [
            'nisn.required'             => 'NISN tidak boleh kosong',
            'tanggal_bayar.required'    => 'Tanggal pembayaran tidak boleh kosong',
            'tanggal_bayar.date'        => 'format tidak sesuai',
            'bulan_dibayar.required'    => 'Bulan dibayar tidak boleh kosong',
            'id_spp.required'           => 'Tahun SPP tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data_pembayaran = [
            "id_petugas"    => $request->id_petugas,
            "nisn"          => $request->nisn,
            "tanggal_bayar" => $request->tanggal_bayar,
            "bulan_dibayar" => $request->bulan_dibayar,
            "tahun_dibayar" => $request->tahun_spp,
            "id_spp"        => $request->id_spp,
            "jumlah_bayar"  => $request->jumlah_bayar,
        ];

        Pembayaran::create($data_pembayaran);
        

        return redirect()->route('pembayaran.index')->with('success', ' Data telah ditambahkan!');
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
            'email'         => 'required|email|unique:student,email,' . $id,
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
        $email = $siswa->email;
        DB::table('users')->where('email',$email)->delete();
        // dd($user->email);
        $siswa->delete();
        // $user->delete();

        return redirect()->route('pembayaran.index', [
            "title" => "Data Siswa",
            "sitemap" => "Siswa"
        ])->with('success', 'Data berhasil dihapus');
    }

    public function getSiswa(Request $request)
    {
        $siswa = DB::table('student')
        ->where('id_kelas', $request->id_kelas )
        ->get();

        
        if (count($siswa) > 0) {
            return response()->json($siswa);
        }
        
    }

    public function getNisn($id)
    {
        // $id = $request->id_siswa;
        $noisn = Student::find($id);
        $spp = SPP::find($noisn->id_spp);
        $noisn->tahunspp = $spp->tahun;
        // $nisn = DB::table('student')
        // ->where('id', $request->id_siswa )
        // ->get();

        // dd($nisn->nisn);
        
        
            return response()->json($noisn);
        
        
    }

}

