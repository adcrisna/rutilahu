@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home_admin') }}"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="active">Penilaian</li>
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
                <h3 class="box-title">Penilaian Kriteria Persyaratan {{ $detail_penilaian->nama }}</h3>
                <div class="box-tools pull-right">
                        <a href="{{ route('data_penilaian') }}"><button class="btn btn-xs btn-warning"><i class="fa fa-sign-out"> Kembali</i></button></a>
                </div>
            </div>
        <div class="box-body table-responsive">
            <form action="{{ route('simpan_penilaian') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="hidden" name="id" readonly class="form-control" value="{{ $detail_penilaian->id }}" readonly>
                    <input type="hidden" name="nik" readonly class="form-control" value="{{ $detail_penilaian->nik }}" readonly>
                    <input type="hidden" name="nama" readonly class="form-control" value="{{ $detail_penilaian->nama }}" readonly>
                </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Foto Pondasi Rumah</label>
                                <p><img width="300px" height="300px" src="{{ asset('uploads/'.$detail_penilaian->pondasi) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Penilaian Pondasi Rumah</label>
                                <select name="pondasi" id="pondasi" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="1">Kondisi Baik</option>
                                    <option value="2">Rusak Ringan</option>
                                    <option value="3">Rusak Sedang/Sebagian</option>
                                    <option value="4">Rusak Berat/Seluruhnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Foto Kontruksi Atap</label>
                                <p><img width="300px" height="300px" src="{{ asset('uploads/'.$detail_penilaian->kontruksi_atap) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Penilaian Kontruksi Atap</label>
                                <select name="kontruksi_atap" id="kontruksi_atap" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="1">Besi</option>
                                    <option value="2">Kayu</option>
                                    <option value="3">Bambu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Foto Pencahayaan Rumah</label>
                                <p><img width="300px" height="300px" src="{{ asset('uploads/'.$detail_penilaian->pencahayaan) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Penilaian Pencahayaan</label>
                                <select name="pencahayaan" id="pencahayaan" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="1">Kondisi Baik</option>
                                    <option value="2">Rusak Ringan</option>
                                    <option value="3">Rusak Sedang/Sebagian</option>
                                    <option value="4">Rusak Berat/Seluruhnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Foto Penghawaan</label>
                                <p><img width="300px" height="300px" src="{{ asset('uploads/'.$detail_penilaian->penghawaan) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Penilaian Penghawaan</label>
                                <select name="penghawaan" id="penghawaan" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="1">Kondisi Baik</option>
                                    <option value="2">Rusak Ringan</option>
                                    <option value="3">Rusak Sedang/Sebagian</option>
                                    <option value="4">Rusak Berat/Seluruhnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Foto Sanitasi</label>
                                <p><img width="300px" height="300px" src="{{ asset('uploads/'.$detail_penilaian->sanitasi) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Penilaian Sanitasi</label>
                                <select name="sanitasi" id="sanitasi" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="1">Milik Sendiri</option>
                                    <option value="2">MCK</option>
                                    <option value="3">Tidak Ada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Foto Kondisi Air Bersih</label>
                                <p><img width="300px" height="300px" src="{{ asset('uploads/'.$detail_penilaian->air_bersih) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Penilaian Kondisi Air Bersih</label>
                                <select name="air_bersih" id="air_bersih" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="1">PDAM</option>
                                    <option value="2">Sanyo</option>
                                    <option value="3">Sumur</option>
                                    <option value="3">Tidak Ada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Foto Luas Rumah</label>
                                <p><img width="300px" height="300px" src="{{ asset('uploads/'.$detail_penilaian->luas_rumah) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Penilaian Luas Rumah</label>
                                <select name="luas_rumah" id="luas_rumah" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="1">> 12 Meter Persegi</option>
                                    <option value="2">< 12 Meter Persegi</option>
                                    <option value="3">< 9 Meter Persegi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Foto Penutup Atap</label>
                                <p><img width="300px" height="300px" src="{{ asset('uploads/'.$detail_penilaian->penutup_atap) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Penilaian Penutup Atap</label>
                                <select name="penutup_atap" id="penutup_atap" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="1">Genteng</option>
                                    <option value="2">Baja Ringan</option>
                                    <option value="3">Asbes</option>
                                    <option value="4">Seng</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Foto Kondisi Dinding</label>
                                <p><img width="300px" height="300px" src="{{ asset('uploads/'.$detail_penilaian->kondisi_dinding) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Penilaian Kondisi Dinding</label>
                                <select name="kondisi_dinding" id="kondisi_dinding" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="1">Kondisi Baik</option>
                                    <option value="2">Rusak Ringan</option>
                                    <option value="3">Rusak Sedang/Sebagian</option>
                                    <option value="4">Rusak Berat/Seluruhnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Foto Kondisi Lantai</label>
                                <p><img width="300px" height="300px" src="{{ asset('uploads/'.$detail_penilaian->kondisi_lantai) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Penilaian Kondisi Lantai</label>
                                <select name="kondisi_lantai" id="kondisi_lantai" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="1">Kondisi Baik</option>
                                    <option value="2">Rusak Ringan</option>
                                    <option value="3">Rusak Sedang/Sebagian</option>
                                    <option value="4">Rusak Berat/Seluruhnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-xs-offset-5">
                            <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('apakah anda yakin ?')">Simpan</button>
                        </div>
                    </div>
            </form>
        </div>
        </div>
         </div>    
        </div>
    </div>
</section>
@endsection

@section('javascript')

@endsection