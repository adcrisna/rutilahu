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
use App\Models\Hasil;
use Redirect;
use Illuminate\Support\Facades\DB;
use Fpdf;

class HasilPenilaianController extends Controller
{
    public function index()
    {
        $data['title'] = "Hasil Penilaian";
        $data['id'] = Auth::User()->id;
        $data['nik'] = Auth::User()->nik;
        $data['nama'] = Auth::User()->nama_user;
        $data['nilai'] = Nilai::join('users','nilai.id','=','users.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')->get();
        return view('Admin/hasil_penilaian',$data);
    }
    public function detailNilai(Request $request)
    {
        $data['title'] = "Detail Penilaian";
        $data['id'] = Auth::User()->id;
        $data['nik'] = Auth::User()->nik;
        $data['nama'] = Auth::User()->nama_user;
        $data['nilai'] = Nilai::join('users','nilai.id','=','users.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')
        ->where('nilai_id','=',$request->nilai_id)->first();
        return view('Admin/detail_hasil_penilaian',$data);
    }
    public function hapusNilai(Request $request)
    {
        $nilai = Nilai::where('nilai_id','=',$request->nilai_id);
		$query_nilai = $nilai->first();

        $user = $query_nilai->id;

        $status=array(
            'status_seleksi'=> "Proses Penilaian Persyaratan"
        );

        User::where('id','=',$user->id)->update($status);

        $nilai->delete();
	        \Session::flash('msg_hapus','Data Nilai Berhasil Dihapus!');
			return \Redirect::route('data_nilai');
    }
    public function pilihPenerima()
    {
        $sunyaragi = Nilai::join('users','nilai.id','=','users.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')
        ->where('nama_kelurahan','=','Sunyaragi')->orderByDesc('total_nilai')->limit(2)->get();

        foreach ($sunyaragi as $key => $value) {
            $cek = Hasil::where('id','=',$value->id)->first();
            if (empty($cek->id)) {
                $hasil=array(
                    'id'=>$value->id,
                    'nilai_penerima'=>$value->total_nilai
                );
                Hasil::insert($hasil);
                $status=array(
                    'status_seleksi'=> "Penerima Bantuan"
                );
        
                User::where('id','=',$value->id)->update($status);
            }else{
                \Session::flash('msg_gagal','Anda Sudah Memilih Penerima Bantuan!!');
                return \Redirect::back();
            }
        }

        $karyamulya = Nilai::join('users','nilai.id','=','users.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')
        ->where('nama_kelurahan','=','Karyamulya')->orderByDesc('total_nilai')->limit(2)->get();

        foreach ($karyamulya as $key => $value) {
            $cek = Hasil::where('id','=',$value->id)->first();
            if (empty($cek->id)) {
                $hasil=array(
                    'id'=>$value->id,
                    'nilai_penerima'=>$value->total_nilai
                );
                Hasil::insert($hasil);
                $status=array(
                    'status_seleksi'=> "Penerima Bantuan"
                );
        
                User::where('id','=',$value->id)->update($status);
            }else{
                \Session::flash('msg_gagal','Anda Sudah Memilih Penerima Bantuan!!');
                return \Redirect::back();
            }
        }

        $drajat = Nilai::join('users','nilai.id','=','users.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')
        ->where('nama_kelurahan','=','drajat')->orderByDesc('total_nilai')->limit(2)->get();

        foreach ($drajat as $key => $value) {
            $cek = Hasil::where('id','=',$value->id)->first();
            if (empty($cek->id)) {
                $hasil=array(
                    'id'=>$value->id,
                    'nilai_penerima'=>$value->total_nilai
                );
                Hasil::insert($hasil);
                $status=array(
                    'status_seleksi'=> "Penerima Bantuan"
                );
        
                User::where('id','=',$value->id)->update($status);
            }else{
                \Session::flash('msg_gagal','Anda Sudah Memilih Penerima Bantuan!!');
                return \Redirect::back();
            }
        }
        
        //ini dibawah
        $cek_status = User::where('status_seleksi','=','Sudah Dinilai')->get();
        foreach ($cek_status as $key => $value) {
            $status=array(
                'status_seleksi'=> "Bukan Penerima Bantuan"
            );
    
            User::where('id','=',$value->id)->update($status);
        }
        
        $jmlhSunyaragi = count($sunyaragi);
        $jmlhDrajat = count($drajat);
        $jmlhKaryamulya = count($karyamulya);
        $totalPenerima = $jmlhDrajat+$jmlhKaryamulya+$jmlhSunyaragi;
        //ini paling bawah
        \Session::flash('msg_sukses','Berhasil, Total Penerima Berjumlah '.$totalPenerima);
            return \Redirect::back();
    }

    public function penerimaBantuan()
    {
        $data['title'] = "Hasil Penilaian";
        $data['id'] = Auth::User()->id;
        $data['nik'] = Auth::User()->nik;
        $data['nama'] = Auth::User()->nama_user;
        $data['penerima'] = Hasil::join('users','hasil.id','=','users.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')->get();
        return view('Admin/penerima_bantuan',$data);
    }
    public function hapusSemuaNilai()
    {
        Nilai::truncate();
        \Session::flash('msg_gagal','Berhasil Menghapus Semua Data Hasil!');
        return \Redirect::back();
    }
    public function hapusPenerima()
    {
        Hasil::truncate();
        \Session::flash('msg_gagal','Berhasil Menghapus Semua Data Hasil!');
        return \Redirect::back();
    }
    public function beritaAcara()
    {
        $penerima = Hasil::join('users','hasil.id','=','users.id')
        ->join('kelurahan','users.kelurahan_id','=','kelurahan.kelurahan_id')
        ->join('kecamatan','kelurahan.kecamatan_id','=','kecamatan.kecamatan_id')->get();

        $nama = Auth::User()->nama_user;

        $pdf = new fPdf('P','mm');
		$pdf::SetAutoPageBreak(true);
		$pdf::SetTitle("Berita Acara Penerima Bantuan");
		$pdf::addPage('L','A4');
		$pdf::image( asset('logo-dprkp.png'), $pdf::getX()+4, 3, 40 , 30,'PNG');
		$pdf::setX(85);
		$pdf::SetFont('Helvetica','B','13');
		$pdf::cell(135,6,"Berita Acara Penerima Bantuan",0,2,'C');
		$pdf::SetFont('Helvetica','B','13');
		$pdf::cell(135,6,"Dinas Perumahan Rakyat dan Kawasan Pemukiman",0,2,'C');
		$pdf::SetFont('Helvetica','','10');
		$pdf::cell(135,6,"Jl. Kesambi No. 202, Drajat, Kec. Kesambi, Kota Cirebon, Jawa Barat, 45133",0,2,'C');
		$pdf::SetFont('Helvetica','B','12');
		$pdf::cell(135,6,"",0,2,'C');
		$pdf::line(10,($pdf::getY()+3),287,($pdf::getY()+3));
		$pdf::ln();

		$pdf::SetFont('Helvetica','','11');
		$pdf::cell(15,6,'',0,0,'');
		$pdf::cell(60,6,'Berdasarkan seleksi penerimaan bantuan Rutilahu yang telah dilakukan maka terpilihkan masyarakat yang layak mendapatkan bantuan, berikut data',0,0,'');
		$pdf::ln();
        $pdf::SetFont('Helvetica','','11');
		$pdf::cell(30,6,'penerima bantuan Rutilahu tahun 2022 :',0,0,'');
		$pdf::cell(60,6,'',0,0,'');
		$pdf::ln();
		$pdf::ln();
		$pdf::SetFont('Helvetica','B','11');
        $pdf::cell(50,6,'Periode',1,0,'C');
		$pdf::cell(40,6,'Nomor Induk',1,0,'C');
		$pdf::cell(60,6,'Nama Lengkap',1,0,'C');
		$pdf::cell(31,6,'No. HP',1,0,'C');
        $pdf::cell(30,6,'Kelurahan',1,0,'C');
        $pdf::cell(30,6,'Kecamatan',1,0,'C');
        $pdf::cell(36,6,'Status',1,0,'C');
		$pdf::SetFont('Helvetica','','11');
		$pdf::ln();


			foreach ($penerima as $key => $value) {
                $pdf::cell(50,6,date('Y-m-d',strtotime($value->created_at)),1,0,'C');
				$pdf::cell(40,6,$value->nik,1,0,'C');
				$pdf::cell(60,6,$value->nama_user,1,0,'C');
				$pdf::cell(31,6,$value->no_hp,1,0,'C');
                $pdf::cell(30,6,$value->nama_kelurahan,1,0,'C');
                $pdf::cell(30,6,$value->nama_kecamatan,1,0,'C');
                $pdf::cell(36,6,$value->status_seleksi,1,0,'C');
                $pdf::ln();
			}
			$pdf::ln();
			$pdf::ln();
			$pdf::cell(40,6,'',0,0,'');
			$pdf::cell(60,6,'',0,0,'');
			$pdf::cell(31,6,'',0,0,'');
            $pdf::cell(50,6,'',0,0,'');
            $pdf::cell(30,6,'',0,0,'');
            $pdf::cell(25,6,'',0,0,'');
			$pdf::cell(30,6,"Cirebon, ".date('d-M-Y'),0,0,'');
			$pdf::ln();
            $pdf::ln();
			$pdf::cell(40,6,'',0,0,'');
			$pdf::cell(60,6,'',0,0,'');
			$pdf::cell(31,6,'',0,0,'');
            $pdf::cell(50,6,'',0,0,'');
            $pdf::cell(30,6,'',0,0,'');
            $pdf::cell(20,6,'',0,0,'');
            $pdf::cell(30,6,"Kepala Bagian Pemukiman",0,0,'');
            $pdf::ln();
			$pdf::ln();
			$pdf::ln();
			$pdf::ln();
			$pdf::ln();
			$pdf::cell(40,6,'',0,0,'');
			$pdf::cell(60,6,'',0,0,'');
			$pdf::cell(31,6,'',0,0,'');
            $pdf::cell(50,6,'',0,0,'');
            $pdf::cell(30,6,'',0,0,'');
            $pdf::cell(25,6,'',0,0,'');
            $pdf::cell(30,6,"Muhamad Ade Crisna",0,0,'');
		$pdf::Output(0);
		exit;
    }
    
}
