<?php

namespace App\Http\Controllers;

use App\Models\pasien;
use App\Models\riwayat;
use App\Models\datapoli;
// use Barryvdh\DomPDF\PDF;
use App\Models\datadokter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\RiwayatExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function login(){
        return view('admin.login');
    }

    public function ceklogin(Request $request){
        $kredensial = $request->only('email','password');

        if(Auth::attempt($kredensial)) {
            $user = Auth::User();

            if($user->role !== 'admin'){
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Akses Admin'
                ]);
            }

            return redirect()->intended('/Dashboard');

        }
        return back()->withErrors([
            'email' => 'Email atau Password Salah'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('admin.login');
    }

    public function dashboard(request $request){

        $poli = datapoli::all();
        $utama = riwayat::with(['pasien', 'datadokter', 'datapoli'])->when($request->poli_id, function($query) use ($request){
            $query->where('poli_id', $request->poli_id);    
        })
        
        ->orderBy('created_at','desc')
        ->paginate(5);

        return view('admin.dashboard', compact('utama','poli'));
    }

    public function cetakdata(request $request,$id){
        $data = riwayat::with(['pasien','datadokter','datapoli'])->find($id);
        // $pasien = pasien::all();
        // $pdf = Pdf::loadView('admin.kunjungan', compact('data',), [], ['orientation' => 'landscape']);

        $pdf = Pdf::loadView('admin.kunjungan', compact('data'))->setPaper('a4','landscape');

        $file = 'Laporan_Pasien_'.Str::slug($data->pasien->nama).'.pdf';
        return $pdf->download($file);
    }


    public function cetakexcel(){
         return Excel::download(new RiwayatExport, 'Data_Pasien_Baru.xlsx');
    }

    public function datapasien(Request $request){

        $search = $request->input('cari');
        $pasien = pasien::when($search, function($query, $search){
            return $query->where('nik', 'like', '%' .$search. '%')
                         ->orWhere('nama','like', '%' .$search. '%');
        })  ->orderBy('created_at','desc')
            ->paginate(5);

        return view ('admin.datapasien', compact('pasien'));
    }

    public function tambahpasien(Request $request){
        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'nik' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|string|max:255',
            'foto' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        // proses gambar 
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $data['foto'] = $name; 
        }

        // Simpan data ke dalam tabel datapasien
        pasien::create($data);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('datapasien')->with('success', 'Data Pasien Berhasil Ditambahkan');
    }

    public function hapuspasien($id){
        $item = pasien::findOrFail($id);

        // hapus gambar
        if($item->foto){
            $imagePath = public_path('/images/'. $item->foto);
            if(File::exists($imagePath)){
                File::delete($imagePath);
            }
        }

        $item->delete();
        return redirect()->route('datapasien')->with('success', 'Data Berhasil Dihapus');
    }

    public function updatepasien(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'nik'           => 'required|integer',
            'nama'          => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required|string|max:255',
            'foto'          => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $datas = pasien::findOrFail($id);
        $data = $request->all();

        // proses gambar 
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $data['foto'] = $name;
            
            if ($datas->foto) {
                $oldImage = public_path('/images/' . $datas->foto);
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
        }else{
            $data['foto'] = $datas->foto;
        }

        $datas->update($data);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('datapasien')->with('success', 'Data Pasien Berhasil Di Ubah');
    }


    public function riwayatkunjungan(){
        $kunjungan = riwayat::with(['pasien','datadokter','datapoli'])
                    ->orderBy('created_at','desc')->paginate(5);
        $pasien = pasien::all();
        $dokter = datadokter::all();
        $poli = datapoli::all();

        return view ('admin.riwayatkunjungan',compact('kunjungan','pasien','dokter','poli'));
    }

    public function tambahkunjungan(Request $request){
        // dd($request->all()); 
        $validator = Validator::make($request->all(),[
            'pasien_id'     => 'required',
            'dokter_id'     => 'required',
            'poli_id'       => 'required',
            'tanggal'       => 'required',
            'diagnosa'      => 'required',
            'tindakan'      => 'required',
            'obat'          => 'nullable',
            'biaya'         => 'required',
            
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['pasien_id' ,'dokter_id','poli_id','tanggal','diagnosa','tindakan','obat','biaya']);

        riwayat::create($data);

        return redirect()->route('riwayatkunjungan')->with('success', 'Data Kunjungan Berhasil di Tambahkan');

    }

    public function updatekunjungan(Request $request, $id){
         $validator = Validator::make($request->all(),[
            'pasien_id'     => 'required',
            'dokter_id'     => 'required',
            'poli_id'       => 'required',
            'tanggal'       => 'required',
            'diagnosa'      => 'required',
            'tindakan'      => 'required',
            'obat'          => 'required',
            'biaya'         => 'required',
            
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $datas = riwayat::findOrFail($id);
        $data = $request->all();

        // riwayat::create($data);
        $datas->update($data);

        return redirect()->route('riwayatkunjungan')->with('success', 'Data Kunjungan Berhasil di Ubah');
    }

    public function hapuskunjungan(Request $request, $id){

        $datas = riwayat::findOrFail($id);

        $datas->delete();
    
        return redirect()->route('riwayatkunjungan')->with('success', 'Data kunjungan Berhasil Di Hapus');
    }
    
    public function datadokter(){

        $dokter = datadokter::with('datapoli')->get();
        $poli = datapoli::all();

        return view ('admin.datadokter', compact('dokter','poli'));
    }
    
    public function datapoli(){
        $poli = datapoli::all();

        return view ('admin.datapoli', compact('poli'));
    }

    public function tambahpoli(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'poli' => 'required',
            
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        datapoli::create($data);

        return redirect()->route('datapoli')->with('success', 'Data Poli Berhasil di Tambahkan');
        
    }

    public function updatepoli(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'poli'          => 'required',
           
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $datas = datapoli::findOrFail($id);
        $data = $request->all();

        $datas->update($data);
    
        return redirect()->route('datapoli')->with('success', 'Data Poli Berhasil Di Ubah');
    }

    public function hapuspoli(Request $request, $id){

      
        $datas = datapoli::findOrFail($id);
        // $data = $request->all();

        $datas->delete();
    
        return redirect()->route('datapoli')->with('success', 'Data Poli Berhasil Di Hapus');
    }


    public function tambahdokter(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'nama_dokter'   => 'required',
            'datapoli_id'   => 'required',
            'spesialis'     => 'nullable',
            
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['nama_dokter', 'datapoli_id', 'spesialis']);
        datadokter::create($data);

        // datadokter::create($data);

        return redirect()->route('datadokter')->with('success', 'Data Dokter Berhasil di Tambahkan');
        
    }

    public function updatedokter(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'nama_dokter'           => 'required',
            'datapoli_id'           => 'required',
            'spesialis'             => 'nullable',
           
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $datas = datadokter::findOrFail($id);
        $data = $request->all();

        $datas->update($data);
    
        return redirect()->route('datadokter')->with('success', 'Data Dokter Berhasil Di Ubah');
    }

    public function hapusdokter(Request $request, $id){

      
        $datas = datadokter::findOrFail($id);
        // $data = $request->all();

        $datas->delete();
    
        return redirect()->route('datadokter')->with('success', 'Data Dokter Berhasil Di Hapus');
    }


}
