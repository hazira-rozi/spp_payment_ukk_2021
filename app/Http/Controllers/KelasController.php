<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class KelasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data_kelas = Kelas::latest()->paginate('10');
        return view('kelas.index', [
            "data_kelas" => $data_kelas,
            "title" => "Data Kelas",
            "sitemap" => 'Kelas',
        ])->with ('i', (request()->input('page',1)-1)*10);
    }

    public function create(){
        return view('kelas.create', [
            "title" => "Tambah Kelas", "sitemap" => 'Kelas']);
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_kelas'            => 'required|unique:kelas',
            'kompetensi_keahlian'   => 'required',
        ];

     

        $messages = [
            'nama_kelas.unique'             => 'Kelas telah terdaftar',
            'nama_kelas.required'           => 'Kelas wajib diisi',
            'kompetensi_keahlian.required'  => 'Kompetensi Keahlian wajib diisi',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $input = $request->all();
        $kelas = new Kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->kompetensi_keahlian = $request->kompetensi_keahlian;
        
        $simpan = $kelas->save();

        return redirect()->route('kelas.create')->with('success',' Data telah ditambahkan!');
    }

    public function show($id)
    {
        $kelas = Kelas::find($id);
        return view('kelas.show', [
            "kelas" => $kelas,
            "title" => "Lihat Data Kelas",
            "sitemap" => "Kelas"
        ]);
    }

    public function edit($id)
    {
        $kelas = Kelas::find($id);
        //tambah code 
        
        return view('kelas.edit', [
            "kelas" => $kelas,
            "title" => "Edit Data Kelas",
            "sitemap" => "Kelas"
        ]);
    }

    public function update(Request $request, $id)
    {
        $data_validasi=$request->validate([
            "nama_kelas"   => 'required',
            "kompetensi_keahlian"  => 'required',
        ]);

        $kelas = Kelas::find($id);
        $kelas->update($data_validasi);
        return redirect()->route('kelas.index', [
            "title" => "Data Kelas",
            "sitemap" =>"Kelas"
        ])->with('success', 'Data berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);

        

        $kelas->delete();

        return redirect()->route('kelas.index', [
            "title" => "Data Kelas",
            "sitemap" => "Kelas"
        ])->with('success', 'Data berhasil dihapus');
    }
}
