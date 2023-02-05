<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SPP;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SPPController extends Controller
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
        $data_spp = SPP::latest()->paginate('10');
        return view('spp.index', [
            "data_spp" => $data_spp,
            "title" => "Data SPP",
            "sitemap" => 'SPP',
        ])->with ('i', (request()->input('page',1)-1)*10);
    }

    public function create(){
        return view('spp.create', [
            "title" => "Tambah SPP", "sitemap" => 'SPP']);
    }

    public function store(Request $request)
    {
        $rules = [
            'tahun'            => 'required|unique:spp|digits:4',
            'nominal'          => 'required|digits_between:1,11',
        ];

     

        $messages = [
            'tahun.unique'             => 'Tahun SPP telah terdaftar',
            'tahun.required'           => 'Tahun SPP wajib diisi',
            'nominal.required'         => 'Nominal wajib diisi',
            
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $input = $request->all();
        $spp = new SPP;
        $spp->tahun = $request->tahun;
        $spp->nominal = $request->nominal;
        
        $simpan = $spp->save();

        return redirect()->route('spp.index')->with('success',' Data telah ditambahkan!');
    }

    public function show($id)
    {
        $spp = SPP::find($id);
        return view('spp.show', [
            "spp" => $spp,
            "title" => "Lihat Data SPP",
            "sitemap" => "SPP"
        ]);
    }

    public function edit($id)
    {
        $spp = SPP::find($id);
        //tambah code 
        
        return view('SPP.edit', [
            "spp" => $spp,
            "title" => "Edit Data SPP",
            "sitemap" => "SPP"
        ]);
    }

    public function update(Request $request, $id)
    {
        $data_validasi=$request->validate([
            'tahun'            => 'required|unique:spp|digits:4',
            'nominal'          => 'required|digits_between:1,11',
        ]);

        $spp = SPP::find($id);
        $spp->update($data_validasi);
        return redirect()->route('spp.index', [
            "title" => "Data SPP",
            "sitemap" =>"SPP"
        ])->with('success', 'Data berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $spp = SPP::find($id);

        

        $spp->delete();

        return redirect()->route('spp.index', [
            "title" => "Data SPP",
            "sitemap" => "SPP"
        ])->with('success', 'Data berhasil dihapus');
    }
}
