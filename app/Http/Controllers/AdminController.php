<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Hasil;
use Redirect;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $data['title'] = "Home Admin";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $calon = User::where('status_user','=','Aktif')->where('level','!=','1')->where('level','!=','2')->get();
        $penerima =  Hasil::get();
        $data['penerima'] = count($penerima);
        $data['calon'] = count($calon);
        return view('Admin/admin_home',$data);
    }
    function logout(){
        Auth::logout();
        return \Redirect::to('/');
    }
    public function dataProfile()
    {
        $data['title'] = "Profile Admin";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama_user;
        $data['kec'] = Kecamatan::get();
        $data['kel'] = Kelurahan::get();
        $data['profile'] = User::where('id','=',Auth::User()->id)->first();
        return view('Admin/profile_admin',$data);
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
