@extends('layouts.admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('home_admin') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Data Penilaian</li>
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
                <h3 class="box-title">Data Penilaian Kriteria</h3>
                <div class="box-tools pull-right">
                  
                </div>
              </div>
              <div class="box-body table-responsive">
                 <table class="table table-bordered table-striped" id="data-penerima">
            <thead>
              <tr>
                <th width="100px">Foto</th>
                <th width="150">Nama Lengakp</th>
                <th width="90">NIK</th>
                <th width="70">No. HP</th>
                <th width="120">Alamat</th>
                <th width="80">Kelurahan</th>
                <th width="80">Kecamatan</th>
                <th width="70">Kota</th>
                <th>Aksi</th>
              </tr>
            </thead>
              <tbody>
                 @foreach($kriteria as $key => $value)
                    <tr>
                      <td><img width="100px" height="120px" src="{{ asset('uploads/'.$value->foto_user) }}"></td>
                      <td>{{ $value->nama_user }}</td>
                      <td>{{ $value->nik }}</td>
                      <td>{{ $value->no_hp }}</td>
                      <td>{{ $value->alamat }}</td>
                      <td>{{ $value->nama_kelurahan }}</td>
                      <td>{{ $value->nama_kecamatan }}</td>
                      <td>{{ $value->nama_kota }}</td>
                      <td>
                        <a href="{{ route('detail_penilaian',$value->id) }}"><button class="btn btn-xs btn-primary">&nbsp;<i class="fa fa-eye"> &nbsp;</i>Penilaian</button></a> &nbsp;
                      </td>
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