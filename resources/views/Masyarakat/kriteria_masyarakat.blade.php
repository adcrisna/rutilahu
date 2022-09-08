@extends('layouts.masyarakat')
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home_masyarakat') }}"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="active">Kriteria</li>
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
                <h3 class="box-title">Kriteria Persyaratan</h3> &nbsp;
                <p style="color:red;"> *Setelah diupload data tidak dapat dirubah</p>
                <div class="box-tools pull-right">
                        <a href="{{ route('home_masyarakat') }}"><button class="btn btn-xs btn-warning"><i class="fa fa-sign-out"> Kembali</i></button></a>
                </div>
          </div>
          <div class="box-body table-responsive">
          @if(empty($kriteria))
            <form action="{{ route('simpan_kriteria') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="hidden" name="id" readonly class="form-control" value="{{ $id }}" readonly>
                    <input type="hidden" name="nik" readonly class="form-control" value="{{ $nik }}" readonly>
                    <input type="hidden" name="nama" readonly class="form-control" value="{{ $nama }}" readonly>
                </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">*Foto Pondasi</label>
                                <input type="file" name="foto_pondasi" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">*Foto Kontruksi Atap</label>
                                <input type="file" name="foto_kontruksi_atap" class="form-control" required>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">*Foto Pencahayaan</label>
                                <input type="file" name="foto_pencahayaan" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">*Foto Penghawaan</label>
                                <input type="file" name="foto_penghawaan" class="form-control" required>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">*Foto Sanitasi</label>
                                <input type="file" name="foto_sanitasi" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label style="color:red;">*Foto Sumber Air Minum</label>
                                    <input type="file" name="foto_air_bersih" class="form-control" required>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                <label style="color:red;">*Foto Luas Rumah</label>
                                    <input type="file" name="foto_luas_rumah" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                <label style="color:red;">*Foto Penutup Atap Rumah</label>
                                    <input type="file" name="foto_penutup_atap" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                <label style="color:red;">*Foto Kondisi Dinding Rumah</label>
                                    <input type="file" name="foto_kondisi_dinding" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                <label style="color:red;">*Foto Kondisi Lantai Rumah</label>
                                    <input type="file" name="foto_kondisi_lantai" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2 col-xs-offset-5">
                                <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Setelah di upload, data tidak dapat dirubah. Apakah anda yakin ?')">Simpan</button>
                            </div>
                        </div>
                    </form>
                    @elseif(!empty($kriteria))
                    <div class="row">
                    <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">Kondisi Lantai</label>
                            <p><img width="300px" height="300px" src="{{ asset('uploads/'.$kriteria->kondisi_lantai) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">Pondasi</label>
                            <p><img width="300px" height="300px" src="{{ asset('uploads/'.$kriteria->pondasi) }}"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">Kontruksi Atap</label>
                            <p><img width="300px" height="300px" src="{{ asset('uploads/'.$kriteria->kontruksi_atap) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">Pencahayaan</label>
                            <p><img width="300px" height="300px" src="{{ asset('uploads/'.$kriteria->pencahayaan) }}"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">Penghawaan</label>
                            <p><img width="300px" height="300px" src="{{ asset('uploads/'.$kriteria->penghawaan) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">Sanitasi</label>
                            <p><img width="300px" height="300px" src="{{ asset('uploads/'.$kriteria->sanitasi) }}"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">Sumber Air Bersih</label>
                            <p><img width="300px" height="300px" src="{{ asset('uploads/'.$kriteria->air_bersih) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">Luas Rumah</label>
                            <p><img width="300px" height="300px" src="{{ asset('uploads/'.$kriteria->luas_rumah) }}"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">Penutup Atap</label>
                            <p><img width="300px" height="300px" src="{{ asset('uploads/'.$kriteria->penutup_atap) }}"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label style="color:red;">Kondisi Dinding</label>
                            <p><img width="300px" height="300px" src="{{ asset('uploads/'.$kriteria->kondisi_dinding) }}"></p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
         </div>    
        </div>
    </div>
</section>
@endsection

@section('javascript')

@endsection