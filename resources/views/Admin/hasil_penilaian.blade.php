@extends('layouts.admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('home_admin') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Data Hasil Penilaian</li>
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
                <h3 class="box-title">Data Hasil Penilaian</h3>
                <div class="box-tools pull-right">
                <a href="{{ route('pilih_penerima') }}"><button class="btn btn-xs btn-success" onclick="return confirm('apakah anda yakin ?')"> Pilih Penerima</button></a>
                <a href="{{ route('hapus_semua_nilai') }}" onclick="return confirm('apakah anda yakin ?')" ><button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus Semua Data Nilai</button></a>
              </div>
              </div>
              <div class="box-body table-responsive">
                 <table class="table table-bordered table-striped" id="data-nilai">
            <thead>
              <tr>
                <th>Nama</th>
                <th>NIK</th>
                <th>No. HP</th>
                <th>Alamat</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Kota</th>
                <th>Total Nilai</th>
                <th>Aksi</th>
              </tr>
            </thead>
              <tbody>
                 @foreach($nilai as $key => $value)
                    <tr>
                      <td>{{ $value->nama_user }}</td>
                      <td>{{ $value->nik }}</td>
                      <td>{{ $value->no_hp }}</td>
                      <td>{{ $value->alamat }}</td>
                      <td>{{ $value->nama_kelurahan }}</td>
                      <td>{{ $value->nama_kecamatan }}</td>
                      <td>{{ $value->nama_kota }}</td>
                      <td>{{ $value->total_nilai }}</td>
                      <td>
                      <a href="{{ route('detail_nilai',$value->nilai_id) }}"><button class="btn btn-xs btn-primary">&nbsp;<i class="fa fa-eye"> &nbsp;</i>Detail Hasil</button></a> &nbsp;
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
  var table = $('#data-nilai').DataTable();
</script>
@endsection