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
            "data_siswa" => $data_siswa,
            "data_spp" => $data_spp,
            "title" => "Data Pembayaran",
            "sitemap" => 'Pembayaran',

        ])->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {

        $user = Auth::user();
        $email = $user->email;
        $data_spp = SPP::all();
        $data_siswa = Student::all();
        $data_petugas = Staff::where('email', $email)->first();
        $petugas_id = $data_petugas->id;
        $data_kelas = Kelas::all();

        return view('pembayaran.create', [
            "title" => "Tambah Data Pembayaran", "sitemap" => 'Pembayaran',
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
        $pembayaran = Pembayaran::find($id);

        $data_petugas = Staff::where('id', $pembayaran->id_petugas)->first();
        $data_siswa = Student::where('nisn', $pembayaran->nisn)->first();
        $data_spp = SPP::where('id', $pembayaran->id_spp)->first();
        $data_kelas = Kelas::where('id', $data_siswa->id_kelas)->first();

        $nama_petugas = $data_petugas->nama;
        $nama_siswa = $data_siswa->nama;
        $tahun_spp = $data_spp->tahun;
        $nama_kelas = $data_kelas->nama_kelas;



        return view('pembayaran.show', [
            "pembayaran" => $pembayaran,
            "petugas" => $nama_petugas,
            "nama_siswa" => $nama_siswa,
            "tahun_spp" => $tahun_spp,
            "nama_kelas" => $nama_kelas,
            "title" => "Lihat Data SPP",
            "sitemap" => "SPP"
        ]);
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::find($id);
        $data_petugas = Staff::where('id', $pembayaran->id)->first();
        $data_siswa = Student::where('nisn', $pembayaran->nisn)->first();
        $data_spp = SPP::where('id', $pembayaran->id_spp)->first();
        $data_kelas = Kelas::where('id', $data_siswa->id_kelas)->first();

        $nama_petugas = $data_petugas->nama;
        $nama_siswa = $data_siswa->nama;
        $tahun_spp = $data_spp->tahun;
        $nama_kelas = $data_kelas->nama_kelas;
        //tambah code 

        return view('pembayaran.edit', [
            "pembayaran" => $pembayaran,
            "petugas" => $nama_petugas,
            "nama_siswa" => $nama_siswa,
            "tahun_spp" => $tahun_spp,
            "nama_kelas" => $nama_kelas,
            "title" => "Edit Data SPP",
            "sitemap" => "SPP"
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'bulan_dibayar'             => 'required',
            'tanggal_bayar'           => 'required',
            'jumlah_bayar'              => 'required',

        ];

        $messages = [
            'bulan_dibayar.required'    => 'Bulan dibayar tidak boleh kosong',
            'tanggal_bayar.required'  => 'Tanggal pembayaran tidak boleh kosong',
            'jumlah_bayar.required'     => 'Jumlah pembayaran tidak boleh kosong',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data_pembayaran = [
            "nisn"          => $request->nisn,
            "id_petugas"    => $request->id_petugas,
            "tanggal_bayar" => $request->tanggal_bayar,
            "bulan_dibayar" => $request->bulan_dibayar,
            "tahun_dibayar" => $request->tahun_spp,
            "id_spp"        => $request->id_spp,
            "jumlah_bayar"  => $request->jumlah_bayar,

        ];

        $pembayaran = Pembayaran::find($id);
        $pembayaran->update($data_pembayaran);
        return redirect()->route('pembayaran.index')->with('success', 'Data berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Data berhasil dihapus');
    }

    public function getSiswa(Request $request)
    {
        $siswa = DB::table('student')
            ->where('id_kelas', $request->id_kelas)
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

        return response()->json($noisn);
    }

    public function paymentHistory()
    {
        // dd("true");

        $data_kelas = Kelas::all();

        return view('pembayaran.student_history', [
            "title" => "History Pembayaran", "sitemap" => 'Pembayaran',
            "data_pembayaran" => null,

            "data_kelas"  => $data_kelas,


        ]);
    }

    public function getPembayaran(Request $request)
    {
        // dd($request->id_siswa);
        $rules = [
            'id_siswa'          => 'required',
        ];

        $messages = [
            'id_siswa.required'    => 'Pilih data siswa terlebih dahulu',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }


        $data_kelas = Kelas::all();
        $data_siswa = Student::all();
        $data_pembayaran = DB::table('pembayaran')
            ->where('nisn', $request->nisn)->paginate('10');
        $data_spp = SPP::all();
        $card = DB::table('student')
            ->where('nisn', $request->nisn)->first();

        return view('pembayaran.student_history', [
            "title" => "History Pembayaran", "sitemap" => 'Pembayaran',
            "data_pembayaran" => $data_pembayaran,
            "data_kelas"  => $data_kelas,
            "data_siswa"  => $data_siswa,
            "data_spp"  => $data_spp,
            "card_title" => $card,


        ])->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function history()
    {
        $user = Auth::user();
        $email = $user->email;
        $data_siswa = Student::where('email', $email)->first();
        $nisn = $data_siswa->nisn;
        $data_pembayaran = DB::table('pembayaran')
            ->where('nisn', $nisn)->paginate('10');
        $data_spp = SPP::all();
        $card = $data_siswa->nama;


        return view('student.history', [
            "title" => "History Pembayaran", "sitemap" => 'Pembayaran',
            "data_pembayaran" => $data_pembayaran,
            "data_siswa"  => $data_siswa,
            "data_spp"  => $data_spp,
            "card_title" => $card,


        ])->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function report(){
        $data_spp = SPP::all();
        // $data_kelas = Kelas::all();
        
        return view('pembayaran.report', [
            "title" => "Laporan Tahunan", "sitemap" => 'Pembayaran',
            //add 
            "data_spp"  => $data_spp,
            "data_pembayaran" => null,
            // "data_kelas" => $data_kelas,
           
        ]);
    }

    public function show_report(Request $request){
        // dd($request->id_spp);
        $rules = [
            'id_spp'          => 'required',
        ];

        $messages = [
            'id_spp.required'    => 'Tahun SPP tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }


        $data_kelas = Kelas::all();
        $data_siswa = Student::all();
        $data_pembayaran = DB::table('pembayaran')
            ->where('id_spp', $request->id_spp)
            ->paginate('10');
        $data_spp = SPP::all();
        $tahun_lap = DB::table('pembayaran')
            ->where('id_spp', $request->id_spp)->first();
        
        $tahun = $tahun_lap->tahun;
        return view('pembayaran.show_report', [
            "title" => "Laporan Pembayaran", "sitemap" => 'Pembayaran',
            "data_pembayaran" => $data_pembayaran,
            "data_kelas"  => $data_kelas,
            "data_siswa"  => $data_siswa,
            "data_spp"  => $data_spp,
            "tahun_laporan" => $tahun,


        ])->with('i', (request()->input('page', 1) - 1) * 10);
    }
}
