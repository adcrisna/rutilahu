@extends('layouts.admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('home_admin') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ route('data_calon') }}"></i>Data Calon Penerima</a></li>
        <li class="active">Detail Calon Penerima</li>
      </ol>
      <br/>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
        @if(\Session::has('msg_gagal_hapus'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_gagal_hapus')}}
            </div></h5>
            @endif
            <div class="box box-danger">
              <div class="box-header">
                    <h3 class="box-title">Detail Calon Penerima</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('data_calon') }}"><button class="btn btn-warning"><i class="fa fa-sign-out"> Kembali</i></button></a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Nama Masyarakat :</label>
                                <h4>{{ $detail_calon->nama_user }}</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Nomor Induk Kependudukan:</label>
                                <h4>{{ $detail_calon->nik }}</h4>
                            </div>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Nomor Handphone/WhatsApp:</label>
                                <h4>{{ $detail_calon->no_hp }}</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Alamat:</label>
                                <h4>{{ $detail_calon->alamat }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Kelurahan:</label>
                                <h4>{{ $detail_calon->nama_kelurahan }}</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Kecamatan:</label>
                                <h4>{{ $detail_calon->nama_kecamatan }}, {{ $detail_calon->nama_kota }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Penghasilan</label>
                                <h4>{{ $detail_calon->penghasilan }}</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Foto Masyarakat:</label>
                            <p><img width="250px" height="200px" src="{{ asset('uploads/'.$detail_calon->foto_user) }}"></p>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Foto KTP:</label>
                            <p><img width="250px" height="200px" src="{{ asset('uploads/'.$detail_calon->ktp) }}"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Foto Kartu Keluarga:</label>
                            <p><img width="250px" height="200px" src="{{ asset('uploads/'.$detail_calon->kartu_keluarga) }}"></p>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                            <label>Foto Sertifikat Tanah:</label>
                            <p><img width="250px" height="200px" src="{{ asset('uploads/'.$detail_calon->sertifikat_tanah) }}"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form">
                        <div class="col-md-12">
                        </div>
                    </div>
                    <div class="form">
                        <div class="col-md-12">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('setujui_calon',$detail_calon->id) }}"><button type="submit" class="btn btn-sm btn-primary btn-block btn-flat" onclick="return confirm('apakah anda yakin ingin menyetujui data ini ?')"><i class="fa fa-check"></i> Terima</button></a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('hapus_calon',$detail_calon->id) }}"><button type="submit" class="btn btn-sm btn-danger btn-block btn-flat" onclick="return confirm('apakah anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash"></i> Tolak</button></a>
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