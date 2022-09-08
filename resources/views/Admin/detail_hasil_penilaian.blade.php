@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home_admin') }}"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="active">Detail Hasil Penilaian</li>
    </ol>
</section>
  <br/>
  <br/>
<section class="content">
            @if(\Session::has('msg_update'))
           <h5> <div class="alert alert-warning">
              {{ \Session::get('msg_update')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_gagal'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_gagal')}}
            </div></h5>
            @endif
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detail Hasil Penilaian Kriteria</h3>
                <div class="box-tools pull-right">
                        <a href="{{ route('data_nilai') }}"><button class="btn btn-xs btn-warning"><i class="fa fa-sign-out"> Kembali</i></button></a>
                </div>
            </div>
        <div class="box-body table-responsive">
                <div class="form-group has-feedback">
                    <input type="hidden" name="id" readonly class="form-control" value="{{ $nilai->id }}" readonly>
                    <input type="hidden" name="nik" readonly class="form-control" value="{{ $nilai->nik }}" readonly>
                    <input type="hidden" name="nama" readonly class="form-control" value="{{ $nilai->nama_user }}" readonly>
                </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Nama</label>
                                <p>{{ $nilai->nama_user }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Nomor Induk Kependudukan</label>
                                <p>{{ $nilai->nik }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Kelurahan </label>
                                <p>{{ $nilai->nama_kelurahan }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Nilai Pondasi</label>
                                <p>{{ $nilai->nilai_pondasi }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Nilai Kontruksi Atap</label>
                                <p>{{ $nilai->nilai_kontruksi_atap }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Nilai Pencahayaan</label>
                                <p>{{ $nilai->nilai_pencahayaan }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Nilai Penghawaan</label>
                                <p>{{ $nilai->nilai_penghawaan }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Nilai Sanitasi </label>
                                <p>{{ $nilai->nilai_sanitasi }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Nilai Kondisi Air Bersih </label>
                                <p>{{ $nilai->nilai_air_bersih }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Luas Rumah</label>
                                <p>{{ $nilai->nilai_luas_rumah }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Nilai Penutup Atap </label>
                                <p>{{ $nilai->nilai_penutup_atap }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Nilai Kondisi Dinding </label>
                                <p>{{ $nilai->nilai_kondisi_dinding }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Nilai Kondisi Lantai</label>
                                <p>{{ $nilai->nilai_kondisi_lantai}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Total Nilai</label>
                                <p>{{ $nilai->total_nilai}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-xs-offset-5">
                             <a href="{{ route('hapus_nilai',$nilai->nilai_id) }}"></a><button class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin ?')">Hapus</button>
                        </div>
                    </div>
        </div>
        </div>
         </div>    
        </div>
    </div>
</section>
@endsection

@section('javascript')

@endsection