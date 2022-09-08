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

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function daftar(){
        $data['kec'] = Kecamatan::get();
        return view('daftar',$data);
    }
    public function kelurahan(Request $request){
        $kel = Kelurahan::where('kecamatan_id','=',$request->kecamatan_id)->pluck('nama_kelurahan', 'kelurahan_id');
        return response()->json($kel);
    }
    public function prosesLogin(Request $request){

    	if (Auth::attempt(['nik'=>$request->nik,'password'=>$request->password]))
        {
            if ((Auth::user()->level == "1")&&(Auth::user()->status_user == "Aktif")) 
            {
                return \Redirect()->to('/admin/home');
            }
            else if ((Auth::user()->level == "2")&&(Auth::user()->status_user == "Aktif"))
            {
                 return \Redirect()->to('/pemukiman/home');
            }
            else if ((Auth::user()->level == "3")&&(Auth::user()->status_user == "Aktif"))
            {
                return \Redirect()->to('/masyarakat/home');
            }else{
                \Session::flash('msg_login','Akun Belum Aktif!');
            return \Redirect::back();
            }
        }else{
            \Session::flash('msg_login','NIK Atau Password Salah!!');
            return \Redirect::back();
        }
    }

    public function prosesDaftar(Request $request){
       
        $na = DB::table('users')->where('nik','=',$request->nik)->first();
        if (!$na) {
            if (!empty($request->foto_user && $request->foto_ktp && $request->foto_kk && $request->foto_serti_tanah)) {
                $namafoto = $request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extention = $request->file('foto_user')->extension();
                $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                $destination = base_path() .'/public/uploads';
                $request->file('foto_user')->move($destination,$photo);
                
            $user = User::create([
                    'nama_user'=> $request->nama,
                    'nik' => $request->nik,
                    'password'=> bcrypt($request->password),
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                    'penghasilan'=> $request->penghasilan,
                    'kelurahan_id'=> $request->kelurahan,
                    'foto_user'=> $photo,
                    'level'=>3,
                    'status_user' => "Belum Aktif",
                    'status_seleksi' => "Belum Aktif",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                $namafotoktp = "KTP"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentionktp = $request->file('foto_ktp')->extension();
                $photoktp = sprintf('%s.%0.8s', $namafotoktp, $extentionktp);
                $destinationktp = base_path() .'/public/uploads';
                $request->file('foto_ktp')->move($destinationktp,$photoktp);

                $namafotokk = "KK"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentionkk = $request->file('foto_kk')->extension();
                $photokk = sprintf('%s.%0.8s', $namafotokk, $extentionkk);
                $destinationkk = base_path() .'/public/uploads';
                $request->file('foto_kk')->move($destinationkk,$photokk);

                $namafotoserti = "Sertifikat"." ".$request->nama." ". $request->nik." ".date("Y-m-d H-i-s");
                $extentionserti = $request->file('foto_serti_tanah')->extension();
                $photoserti = sprintf('%s.%0.8s', $namafotoserti, $extentionserti);
                $destinationserti = base_path() .'/public/uploads';
                $request->file('foto_serti_tanah')->move($destinationserti,$photoserti);

                $data=array(
                    'id'=>$user->id,
                    'ktp'=>$photoktp,
                    'kartu_keluarga'=>$photokk,
                    'sertifikat_tanah'=>$photoserti
                );
                Dokumen::insert($data);
                \Session::flash('msg_daftar','Registrasi berhasil!! Silahkan tunggu 1x24 jam akan ada pemberitahuan melalui WhatsApp/SMS');
                return \Redirect::route('index');
            }else{
                \Session::flash('msg_gagal_daftar','Masukan Foto!!');
            return \Redirect::route('daftar');
            }
        }else{
            \Session::flash('msg_gagal_daftar','NIK sudah terdaftar!!');
            return \Redirect::route('daftar');
        }
    }
}
?>