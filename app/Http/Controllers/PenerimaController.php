<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Redirect;
use App\Models\Dokumen;
use App\Models\Kriteria;
use App\Models\Nilai;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Hasil;

class PenerimaController extends Controller
{
    public function index()
    {
        $data['title'] = "Data Penerima Bantuan";
        $data['id'] = Auth::User()->id;
        $data['nama'] = Auth::User()->nama;
        $data['penerima'] = User::join('dokumen','users.id','=','dokumen.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')
        ->where('status_user','=','Aktif')->where('level','=',3)->get();
        return view('Admin/data_penerima',$data);
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
        return view('Admin/detail_penerima',$data);
    }
    public function hapusPenerima(Request $request)
    {
        $dokumen = Dokumen::where('id','=',$request->id);
        $kriteria = Kriteria::where('id','=',$request->id);

        $nilai = Nilai::where('id','=',$request->id);
        $query_nilai = $nilai->first();
        $nilai->delete();

        $hasil = Hasil::where('id','=',$request->id);
        $query_hasil = $hasil->first();
        $hasil->delete();

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

        $query_kriteria = $kriteria->first();
			if(\File::exists(public_path('uploads/'.$query_kriteria->pondasi))
            &&\File::exists(public_path('uploads/'.$query_kriteria->kontruksi_atap))
            &&\File::exists(public_path('uploads/'.$query_kriteria->pencahayaan))
            &&\File::exists(public_path('uploads/'.$query_kriteria->penghawaan))
            &&\File::exists(public_path('uploads/'.$query_kriteria->sanitasi))
            &&\File::exists(public_path('uploads/'.$query_kriteria->air_bersih))
            &&\File::exists(public_path('uploads/'.$query_kriteria->luas_rumah))
            &&\File::exists(public_path('uploads/'.$query_kriteria->penutup_atap))
            &&\File::exists(public_path('uploads/'.$query_kriteria->kondisi_dinding))
            &&\File::exists(public_path('uploads/'.$query_kriteria->kondisi_lantai))
            ){
				\File::delete(public_path('uploads/'.$query_kriteria->pondasi));
                \File::delete(public_path('uploads/'.$query_kriteria->kontruksi_atap));
                \File::delete(public_path('uploads/'.$query_kriteria->penghawaan));
                \File::delete(public_path('uploads/'.$query_kriteria->sanitasi));
                \File::delete(public_path('uploads/'.$query_kriteria->air_bersih));
                \File::delete(public_path('uploads/'.$query_kriteria->luas_rumah));
                \File::delete(public_path('uploads/'.$query_kriteria->pencahayaan));
                \File::delete(public_path('uploads/'.$query_kriteria->penutup_atap));
                \File::delete(public_path('uploads/'.$query_kriteria->kondisi_dinding));
                \File::delete(public_path('uploads/'.$query_kriteria->kondisi_lantai));
			}else{
				\Session::flash('msg_gagal_hapus','Foto Dokumen Gagal Dihapus!');
			return \Redirect::back();
			}
		$kriteria->delete();

        $user = User::where('id','=',$request->id);
		$query_user = $user->first();
			if(\File::exists(public_path('uploads/'.$query_user->foto_user))){
				\File::delete(public_path('uploads/'.$query_user->foto_user));
			}else{
				\Session::flash('msg_gagal_hapus','Foto User Gagal Dihapus!');
			return \Redirect::back();
			}
			$user->delete();
	        \Session::flash('msg_hapus','Data Penerima Berhasil Dihapus!');
			return \Redirect::route('data_penerima');
    }
}
