@extends('layouts.admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('home_admin') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Penerima Bantuan</li>
      </ol>
      <br/>
    </section>
    <section class="content">
            @if(\Session::has('msg_sukses'))
           <h5> <div class="alert alert-info">
              {{ \Session::get('msg_sukses')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_gagal'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_gagal')}}
            </div></h5>
            @endif
    <div class="row">
      <div class="col-xs-12">
          <div class="box box-danger">
              <div class="box-header">
                <h3 class="box-title">Data Penerima Bantuan</h3>
                <div class="box-tools pull-right">
                <a href="{{ route('berita_acara') }}" target="_blank"><button class="btn btn-xs btn-success"><i class="fa fa-print"></i> Cetak Berita Acara</button></a>
                <a href="{{ route('hapus_semua_penerima') }}" onclick="return confirm('apakah anda yakin ?')" ><button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus Semua Data Penerima</button></a>
                </div>
              </div>
              <div class="box-body table-responsive">
                 <table class="table table-bordered table-striped" id="data-penerima">
            <thead>
              <tr>
                <th>Periode</th>
                <th width="100px">Foto</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>No. HP</th>
                <th>Alamat</th>
                <th>Kelurahan</th>
                <th>Status</th>
                <th>nilai_penerima</th>
              </tr>
            </thead>
              <tbody>
                 @foreach($penerima as $key => $value)
                    <tr>
                      <td>{{ date('Y-m-d',strtotime($value->created_at)) }}</td>
                      <td><img width="100px" height="120px" src="{{ asset('uploads/'.$value->foto_user) }}"></td>
                      <td>{{ $value->nama_user }}</td>
                      <td>{{ $value->nik }}</td>
                      <td>{{ $value->no_hp }}</td>
                      <td>{{ $value->alamat }}</td>
                      <td>{{ $value->nama_kelurahan }}</td>
                      <td>{{ $value->status_seleksi }}</td>
                      <td>{{ $value->nilai_penerima }}</td>
                    </tr>
                    @endforeach
              </tbody>
          </table>
           </div>
       </div>          
      </div>
    </div>
  </section>
@endsection

@section('javascript')
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  var table = $('#data-penerima').DataTable();
</script>
@endsection