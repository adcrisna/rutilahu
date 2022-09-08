<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Redirect;
use App\Models\Dokumen;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CalonPenerimaController extends Controller
{
    public function index()
    {
        $data['title'] = "Data Calon Penerima Bantuan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama;
        $data['calon'] = User::join('dokumen','users.id','=','dokumen.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')
        ->where('status_user','=','Belum Aktif')->where('level','=',3)->get();
        return view('Admin/data_calon_penerima',$data);
    }
    public function detailCalon(Request $request)
    {
        $data['title'] = "Detail Calon Penerima Bantuan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama;
        $data['detail_calon'] = User::join('dokumen','users.id','=','dokumen.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')
        ->where('users.id','=',$request->id)->first();
        return view('Admin/detail_calon_penerima',$data);
    }
    public function hapusCalon(Request $request)
    {
        $dokumen = Dokumen::where('id','=',$request->id);
		$query_dok = $dokumen->first();
			if(\File::exists(public_path('uploads/'.$query_dok->ktp))
            &&\File::exists(public_path('uploads/'.$query_dok->kartu_keluarga))
            &&\File::exists(public_path('uploads/'.$query_dok->sertifikat_tanah))){
				\File::delete(public_path('uploads/'.$query_dok->ktp));
                \File::delete(public_path('uploads/'.$query_dok->kartu_keluarga));
                \File::delete(public_path('uploads/'.$query_dok->sertifikat_tanah));
			}else{
				\Session::flash('msg_gagal_hapus','Foto Dokumen Gagal Dihapus!');
			return \Redirect::back();
			}
		$dokumen->delete();

        $user = User::where('id','=',$request->id);
		$query_user = $user->first();
			if(\File::exists(public_path('uploads/'.$query_user->foto_user))){
				\File::delete(public_path('uploads/'.$query_user->foto_user));
			}else{
				\Session::flash('msg_gagal_hapus','Foto User Gagal Dihapus!');
			return \Redirect::back();
			}
			$user->delete();
	        \Session::flash('msg_hapus','Data Calon Penerima Berhasil Dihapus!');
			return \Redirect::route('data_calon');
    }
    public function setujuiCalon(Request $request)
    {
        $data=array(
            'status_user'=> "Aktif",
            'status_seleksi'=> "Belum Upload Dokumen"
        );

        User::where('id','=',$request->id)->update($data);
        \Session::flash('msg_aktif','Berhasil menyetujui calon penerima bantuan!');
        return \Redirect::route('data_calon');
    }
}
