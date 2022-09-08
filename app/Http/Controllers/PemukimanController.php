<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Redirect;
use App\Models\Dokumen;
use App\Models\Hasil;
use App\Models\Nilai;
use App\Models\Kriteria;
use Fpdf;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PemukimanController extends Controller
{
    public function index(){
        $data['title'] = "Home Pemukiman";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama;
        $calon = User::where('status_user','=','Aktif')->where('level','!=','1')->where('level','!=','2')->get();
        $penerima =  Hasil::get();
        $data['penerima'] = count($penerima);
        $data['calon'] = count($calon);
        return view('Pemukiman/pemukiman_home',$data);
    }
    function logout(){
        Auth::logout();
        return \Redirect::to('/');
    }
    public function dataPenerima()
    {
        $data['title'] = "Data Penerima Bantuan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama;
        $data['penerima'] = User::join('dokumen','users.id','=','dokumen.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')
        ->where('status_user','=','Aktif')->where('level','=',3)->get();
        return view('Pemukiman/data_penerima',$data);
    }
    public function detailPenerima(Request $request)
    {
        $data['title'] = "Detail Penerima Bantuan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama;
        $data['detail_penerima'] = User::join('dokumen','users.id','=','dokumen.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')
        ->where('users.id','=',$request->id)->first();
        return view('Pemukiman/detail_penerima',$data);
    }
    public function dataPenilaian()
    {
        $data['title'] = "Data Penilaian";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama;
        $data['nilai'] = Nilai::join('users','nilai.id','=','users.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')->get();
        return view('Pemukiman/penilaian_hasil',$data);
    }
    public function detailPenilaian(Request $request)
    {
        $data['title'] = "Detail Penerima Bantuan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama;
        $data['nilai'] = Nilai::join('users','nilai.id','=','users.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')
        ->where('nilai_id','=',$request->nilai_id)->first();
        return view('Pemukiman/detail_penilaian_hasil',$data);
    }
    public function dataHasil()
    {
        $data['title'] = "Hasil Penilaian";
        $data['id'] = Auth::User()->id;
        $data['nik'] = Auth::User()->nik;
        $data['nama'] = Auth::User()->nama_user;
        $data['penerima'] = Hasil::join('users','hasil.id','=','users.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')->get();
        return view('Pemukiman/data_penerima_bantuan',$data);
    }
    public function dataProfile()
    {
        $data['title'] = "Profile Admin";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['kec'] = Kecamatan::get();
        $data['kel'] = Kelurahan::get();
        $data['profile'] = User::where('id','=',Auth::User()->id)->first();
        return view('Pemukiman/profile_pemukiman',$data);
    }
    public function updateProfile(Request $request)
    {
        if (empty($request->password)) {
            if (empty($request->foto_user_baru)) {
                $data=array(
                    'nama_user'=>$request->nama,
                    'no_hp'=>$request->no_hp,
                    'kelurahan_id'=>$request->kelurahan,
                    'alamat'=>$request->alamat,
                );
                User::where('id','=',$request->id)->update($data);
                \Session::flash('msg_update','Data Diri Berhasil Diupdate!');
                return Redirect::back();
            }else{
                $namafoto = $request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extention = $request->file('foto_user_baru')->extension();
                $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                $destination = base_path() .'/public/uploads';
                $request->file('foto_user_baru')->move($destination,$photo);

                if(\File::exists(public_path('uploads/'.$request->foto_user_lama))){
                    \File::delete(public_path('uploads/'.$request->foto_user_lama));
                }else{
                    \Session::flash('msg_gagal','Foto User Gagal Dihapus!');
                return \Redirect::back();
                }

                $data=array(
                    'nama_user'=>$request->nama,
                    'no_hp'=>$request->no_hp,
                    'kelurahan_id'=>$request->kelurahan,
                    'alamat'=>$request->alamat,
                    'foto_user' =>$photo
                );
                User::where('id','=',$request->id)->update($data);
                \Session::flash('msg_update','Data Diri Berhasil Diupdate!');
                return Redirect::back();
            }
        }else{
            if (empty($request->foto_user_baru)) {
                $data=array(
                    'nama_user'=>$request->nama,
                    'no_hp'=>$request->no_hp,
                    'password'=>bcrypt($request->password),
                    'kelurahan_id'=>$request->kelurahan,
                    'alamat'=>$request->alamat,
                );
                User::where('id','=',$request->id)->update($data);
                \Session::flash('msg_update','Data Diri Dan Password Berhasil Diupdate!');
                return Redirect::back();
            }else{
                $namafoto = $request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extention = $request->file('foto_user_baru')->extension();
                $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                $destination = base_path() .'/public/uploads';
                $request->file('foto_user_baru')->move($destination,$photo);

                if(\File::exists(public_path('uploads/'.$request->foto_user_lama))){
                    \File::delete(public_path('uploads/'.$request->foto_user_lama));
                }else{
                    \Session::flash('msg_gagal','Foto User Gagal Dihapus!');
                return \Redirect::back();
                }

                $data=array(
                    'nama_user'=>$request->nama,
                    'no_hp'=>$request->no_hp,
                    'password'=>bcrypt($request->password),
                    'kelurahan_id'=>$request->kelurahan,
                    'alamat'=>$request->alamat,
                    'foto_user' =>$photo
                );
                User::where('id','=',$request->id)->update($data);
                \Session::flash('msg_update','Data Diri Berhasil Diupdate!');
                return Redirect::back();
            }
        }
    }
}
