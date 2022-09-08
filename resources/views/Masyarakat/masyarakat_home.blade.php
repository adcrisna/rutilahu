@extends('layouts.masyarakat')
@section('css')

@endsection

@section('content')
      <section class="content-header">
        <h1>
          Selamat Datang
          <small>{{ $nama }}</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ route('home_masyarakat') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        @if(\Session::has('msg_buat_pesanan'))
           <h5> <div class="alert alert-success">
              {{ \Session::get('msg_buat_pesanan')}}
            </div></h5>
            @endif
          @if(\Session::has('msg_cancel_pemesanan'))
           <h5> <div class="alert alert-success">
              {{ \Session::get('msg_cancel_pemesanan')}}
            </div></h5>
            @endif
          <div class="col-md-12">
            <div class="box box-widget">
              <div class="box-header with-border">
                <div class="user-block">
                <img class="img-circle img-bordered-sm" src="{{ asset('logo-dprkp.png') }}" alt="User Image">
                  <span class="username"><a href="{{ route('home_masyarakat') }}">Informasi</a></span>
                  <span class="description">Admin, Dinas Perumahan Rakyat Dan Kawasan Pemukiman</span>
                </div>
                <!-- /.user-block -->
                <div class="box-tools"> 
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <!-- post text -->
                 @if($status == "Belum Upload Dokumen")
                <center><h4 style="color: yellow;">Segera Lakukan Upload Dokumen Persyaratan, Pada Menu Persyaratan</h4><br/></center>
                @elseif ($status == "Proses Penilaian Persyaratan")
                <center><h4 style="color: black;">Berkas Yang Anda Upload Sedang Dalam Proses Penilaian , Silahkan Tunggu Informasi Selanjutnya</h4><br/></center>
                @elseif ($status == "Sudah Dinilai")
                <center><h4 style="color: green;">Persyaratan Anda Sudah Dinilai, Silahkan Tunggu Informasi Selanjutnya</h4><br/></center>
                @elseif ($status == "Penerima Bantuan")
                <center><h4 style="color: blue;">Selamat, Anda Telah Dinyatakan Sebagai Penerima Bantuan Rutilahu</h4><br/></center>
                @elseif ($status == "Bukan Penerima Bantuan")
                <center><h4 style="color: red;">Maaf, Anda Belum Memenuhi Syarat Sebagai Penerima Bantuan Rutilahu</h4><br/></center>
                @endif
              </div>
              <!-- /.box-footer -->
            </div>
          </div>
      </section>
      <!-- /.content -->
 @endsection

@section('javascript')

@endsection
