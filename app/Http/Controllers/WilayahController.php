<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\User;
use Redirect;

class WilayahController extends Controller
{
    public function index(){
		$data['title'] = 'Data Kecamatan';
		$data['kecamatan'] = Kecamatan::get();
		$data['nama'] = Auth::User()->nama;
		$data['id'] = Auth::User()->id;
		return view('Admin/data_kecamatan',$data);
	}
    public function simpan_kecamatan(Request $request){
		$data=array(
			'nama_kecamatan'=>$request->nama_kec,
            'nama_kota'=> "Kota Cirebon"
		);
		Kecamatan::insert($data);
		\Session::flash('msg_simpan_kec','Data Kecamatan Berhasil Ditambah!');
		return Redirect::route('data_kecamatan');
	}
	public function hapus_kecamatan(Request $request){
		$data = Kecamatan::where('kecamatan_id','=',$request->id_kecamatan);
		$query = $data->first();
		$data->delete();
	      \Session::flash('msg_hapus_kec','Data Kecamatan Berhasil Dihapus!');
			return \Redirect::back();
	}
	public function edit_kecamatan(Request $request){
		$data=array(
			'nama_kecamatan'=>$request->nama_kec,
		);
		Kecamatan::where('kecamatan_id','=',$request->id_kec)->update($data);
		\Session::flash('msg_edit_kec','Data kecamatan Berhasil Diupdate!');
		return Redirect::back();
	}

    public function data_kelurahan(Request $request)
		{
			$data['kec'] = Kecamatan::where('kecamatan_id',$request->kecamatan_id)->first();
			$data['title'] = 'Data Kelurahan';
			$data['nama'] = Auth::User()->nama;
			$data['id'] = Auth::User()->id;
			$data['kel'] = Kelurahan::where('kelurahan.kecamatan_id',$request->kecamatan_id)
			->join('kecamatan','kecamatan.kecamatan_id','=','kelurahan.kecamatan_id')->get();
			return view('Admin/data_kelurahan',$data);
		}
		public function simpan_kelurahan(Request $request)
		{
			$kel = Kecamatan::where('kecamatan_id',$request->kecamatan_id)->first();

			$data=array(
				'nama_kelurahan'=>$request->nama_kel,
				'kecamatan_id'=>$request->id_keca,
			);
			Kelurahan::insert($data);
			\Session::flash('msg_simpan_kel','Data Kelurahan Berhasil Ditambah!');
			return Redirect::route('data_kelurahan',$data['kecamatan_id']);
		}
		public function hapus_kelurahan(Request $request)
		{
			$data = Kelurahan::where('kelurahan_id','=',$request->kelurahan_id);
			$query = $data->first();
			$data->delete();
	        \Session::flash('msg_hapus_kel','Data Kelurahan Berhasil Dihapus!');
				return \Redirect::back();
		}
		public function edit_kelurahan(Request $request)
		{
			$data=array(
				'kelurahan_id'=>$request->id_kel,
				'nama_kelurahan'=>$request->nama_kel,

			);
			Kelurahan::where('kelurahan_id','=',$request->id_kel)->update($data);
			\Session::flash('msg_edit_kel','Data kelurahan Berhasil Diupdate!');
			return Redirect::back();
		}
}
