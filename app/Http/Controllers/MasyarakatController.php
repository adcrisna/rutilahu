<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Dokumen;
use App\Models\Kriteria;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Redirect;
use Illuminate\Support\Facades\DB;

class MasyarakatController extends Controller
{
    public function index(){
        $data['title'] = "Home Masyarakat";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['status'] = Auth::User()->status_seleksi;
        return view('Masyarakat/masyarakat_home',$data);
    }
    function logout(){
        Auth::logout();
        return \Redirect::to('/');
    }
    public function dataKriteria()
    {
        $data['title'] = "Kriteria";
        $data['id'] = Auth::User()->id;
        $data['nik'] = Auth::User()->nik;
        $data['nama'] = Auth::User()->nama_user;
        $data['kriteria'] = Kriteria::where('kriteria.id','=',Auth::User()->id)
        ->join('users','kriteria.id','=','users.id')->first();
        return view('Masyarakat/kriteria_masyarakat',$data);
    }
    public function insertKriteria(Request $request)
    {
        if (!empty($request->foto_kontruksi_atap && $request->foto_pondasi && $request->foto_pencahayaan && $request->foto_penghawaan && $request->foto_luas_rumah && $request->foto_sanitasi && $request->foto_air_bersih && $request->foto_penutup_atap && $request->foto_kondisi_dinding && $request->foto_kondisi_lantai)) {

                $namafotoatap = "Kontruksi Atap"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentionatap = $request->file('foto_kontruksi_atap')->extension();
                $photoatap = sprintf('%s.%0.8s', $namafotoatap, $extentionatap);
                $destinationatap = base_path() .'/public/uploads';
                $request->file('foto_kontruksi_atap')->move($destinationatap,$photoatap);

                $namafotopondasi = "Pondasi"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentionpondasi = $request->file('foto_pondasi')->extension();
                $photopondasi = sprintf('%s.%0.8s', $namafotopondasi, $extentionpondasi);
                $destinationpondasi = base_path() .'/public/uploads';
                $request->file('foto_pondasi')->move($destinationpondasi,$photopondasi);

                $namafotopencahayaan = "Pencahayaan"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentionpencahayaan = $request->file('foto_pencahayaan')->extension();
                $photopencahayaan = sprintf('%s.%0.8s', $namafotopencahayaan, $extentionpencahayaan);
                $destinationpencahayaan = base_path() .'/public/uploads';
                $request->file('foto_pencahayaan')->move($destinationpencahayaan,$photopencahayaan);

                $namafotopenghawaan = "Penghawaan"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentionpenghawaan = $request->file('foto_penghawaan')->extension();
                $photopenghawaan = sprintf('%s.%0.8s', $namafotopenghawaan, $extentionpenghawaan);
                $destinationpenghawaan = base_path() .'/public/uploads';
                $request->file('foto_penghawaan')->move($destinationpenghawaan,$photopenghawaan);

                $namafotosanitasi = "Sanitasi"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentionsanitasi = $request->file('foto_sanitasi')->extension();
                $photosanitasi = sprintf('%s.%0.8s', $namafotosanitasi, $extentionsanitasi);
                $destinationsanitasi = base_path() .'/public/uploads';
                $request->file('foto_sanitasi')->move($destinationsanitasi,$photosanitasi);

                $namafotoair = "Air Bersih"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentionair = $request->file('foto_air_bersih')->extension();
                $photoair = sprintf('%s.%0.8s', $namafotoair, $extentionair);
                $destinationair = base_path() .'/public/uploads';
                $request->file('foto_air_bersih')->move($destinationair,$photoair);

                $namafotoluasrumah = "Luas Rumah"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentionluasrumah = $request->file('foto_luas_rumah')->extension();
                $photoluasrumah = sprintf('%s.%0.8s', $namafotoluasrumah, $extentionluasrumah);
                $destinationluasrumah = base_path() .'/public/uploads';
                $request->file('foto_luas_rumah')->move($destinationluasrumah,$photoluasrumah);

                $namafotopenutup = "Penutup Atap"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentionpenutup = $request->file('foto_penutup_atap')->extension();
                $photopenutup = sprintf('%s.%0.8s', $namafotopenutup, $extentionpenutup);
                $destinationpenutup = base_path() .'/public/uploads';
                $request->file('foto_penutup_atap')->move($destinationpenutup,$photopenutup);

                $namafotodinding = "Kondisi Dinding"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentiondinding = $request->file('foto_kondisi_dinding')->extension();
                $photodinding = sprintf('%s.%0.8s', $namafotodinding, $extentiondinding);
                $destinationdinding = base_path() .'/public/uploads';
                $request->file('foto_kondisi_dinding')->move($destinationdinding,$photodinding);

                $namafotolantai = "Kondisi Lantai"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentionlantai = $request->file('foto_kondisi_lantai')->extension();
                $photolantai = sprintf('%s.%0.8s', $namafotolantai, $extentionlantai);
                $destinationlantai = base_path() .'/public/uploads';
                $request->file('foto_kondisi_lantai')->move($destinationlantai,$photolantai);

                $data=array(
                    'id' => $request->id,
                    'pondasi' => $photopondasi,
                    'kontruksi_atap' => $photoatap,
                    'pencahayaan' => $photopencahayaan,
                    'penghawaan' => $photopenghawaan,
                    'sanitasi' => $photosanitasi,
                    'air_bersih' => $photoair,
                    'luas_rumah' => $photoluasrumah,
                    'penutup_atap' => $photopenutup,
                    'kondisi_dinding' => $photodinding,
                    'kondisi_lantai' => $photolantai,
                );
                Kriteria::insert($data);
                
                $status=array(
                    'status_seleksi'=> "Proses Penilaian Persyaratan"
                );
        
                User::where('id','=',$request->id)->update($status);
                \Session::flash('msg_update','Data Kriteria Persyaratan Berhasil di Upload!!');
                return \Redirect::route('data_kriteria');
        }else{
            \Session::flash('msg_gagal','Masukan Semua Foto Kriteria Persyaratan!!');
            return \Redirect::route('data_kriteria');
        }
    }
    public function dataProfile()
    {
        $data['title'] = "Profile Masyarakat";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['kec'] = Kecamatan::get();
        $data['kel'] = Kelurahan::get();
        $data['profile'] = Dokumen::where('dokumen.id','=',Auth::User()->id)
        ->join('users','dokumen.id','=','users.id')->first();
        return view('Masyarakat/profile_masyarakat',$data);
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
