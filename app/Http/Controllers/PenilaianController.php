<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Dokumen;
use App\Models\Kriteria;
use App\Models\Nilai;
use Redirect;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function index()
    {
        $data['title'] = "Data Penilaian";
        $data['id'] = Auth::User()->id;
        $data['nik'] = Auth::User()->nik;
        $data['nama'] = Auth::User()->nama_user;
        $data['kriteria'] = Kriteria::join('users','kriteria.id','=','users.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')
        ->where('users.status_seleksi','=','Proses Penilaian Persyaratan')->get();
        return view('Admin/data_penilaian',$data);
    }
    public function detailPenilaian(Request $request)
    {
        $data['title'] = "Detail Penilaian";
        $data['id'] = Auth::User()->id;
        $data['nik'] = Auth::User()->nik;
        $data['nama'] = Auth::User()->nama_user;
        $data['detail_penilaian'] = Kriteria::join('users','kriteria.id','=','users.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')
        ->where('kriteria.id','=',$request->id)->first();
        return view('Admin/detail_penilaian',$data);
    }
    public function simpanPenilaian(Request $request)
    {
       if (!empty($request->pondasi && $request->kontruksi_atap && $request->pencahayaan && $request->penghawaan && $request->sanitasi && $request->air_bersih && $request->luas_rumah && $request->penutup_atap && $request->kondisi_dinding && $request->kondisi_lantai)) {
        $pondasi = $request->pondasi ;
        $kontruksiAtap = $request->kontruksi_atap;
        $sanitasi = $request->sanitasi;
        $pencahayaan = $request->pencahayaan;
        $penghawaan = $request->penghawaan;
        $airBersih = $request->air_bersih;
        $luasRumah = $request->luas_rumah;
        $penutupAtap = $request->penutup_atap;
        $kondisiDinding = $request->kondisi_dinding;
        $kondisiLantai = $request->kondisi_lantai;
    
        $min = 1;
        $max = 4;
    
        $subPondasi = ($pondasi-$min)/3;
        $subKontruksiAtap = ($kontruksiAtap-$min)/2;
        $subPencahayaan = ($pencahayaan-$min)/3;
        $subPenghawaan = ($penghawaan-$min)/3;
        $subSanitasi = ($sanitasi-$min)/2;
        $subAirBersih = ($airBersih-$min)/3;
        $subLuasRumah = ($luasRumah-$min)/2;
        $subPenutupAtap = ($penutupAtap-$min)/3;
        $subKondisiDinding = ($kondisiDinding-$min)/3;
        $subKondisiLantai = ($kondisiLantai-$min)/3;
    
        $nilaiPondasi = $subPondasi * 0.1;
        $nilaiKontruksiAtap = $subKontruksiAtap * 0.2;
        $nilaiPencahayaan = $subPencahayaan * 0.1;
        $nilaiPenghawaan = $subPenghawaan * 0.1;
        $nilaiSanitasi = $subSanitasi * 0.1;
        $nilaiAirBersih = $subAirBersih * 0.1;
        $nilaiLuasRumah = $subLuasRumah * 0.15;
        $nilaiPenutupAtap = $subPenutupAtap * 0.05;
        $nilaiKondisiDinding = $subKondisiDinding * 0.05;
        $nilaiKondisiLantai = $subKondisiLantai * 0.05;

        $totalNilai = $nilaiPondasi+$nilaiKontruksiAtap+$nilaiPencahayaan+$nilaiPenghawaan+$nilaiLuasRumah+$nilaiSanitasi+$nilaiAirBersih+$nilaiPenutupAtap+$nilaiKondisiDinding+$nilaiKondisiLantai;
       
        $data=array(
            'id' => $request->id,
            'nilai_pondasi' => $nilaiPondasi,
            'nilai_kontruksi_atap' => $nilaiKontruksiAtap,
            'nilai_pencahayaan' => $nilaiPencahayaan,
            'nilai_penghawaan' => $nilaiPenghawaan,
            'nilai_sanitasi' => $nilaiSanitasi,
            'nilai_air_bersih' => $nilaiAirBersih,
            'nilai_luas_rumah' => $nilaiLuasRumah,
            'nilai_penutup_atap' => $nilaiPenutupAtap,
            'nilai_kondisi_dinding' => $nilaiKondisiDinding,
            'nilai_kondisi_lantai' => $nilaiKondisiLantai,
            'total_nilai' => $totalNilai
        );
        Nilai::insert($data);
        
        $status=array(
            'status_seleksi'=> "Sudah Dinilai"
        );

        User::where('id','=',$request->id)->update($status);
        \Session::flash('msg_sukses','Berhasil Memberikan Penilaian!!');
        return \Redirect::route('data_penilaian');
    }else{
            \Session::flash('msg_gagal','Masukan Semua Penilaian Kriteria!!');
            return \Redirect::back();
       }
    }
}
