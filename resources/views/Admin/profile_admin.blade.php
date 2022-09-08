@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home_admin') }}"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="active">Profile</li>
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
                <h3 class="box-title">Profile <b>{{ $profile->nama_user }}</b></h3>
                <div class="box-tools pull-right">
                        <a href="{{ route('home_admin') }}"><button class="btn btn-xs btn-warning"><i class="fa fa-sign-out"> Kembali</i></button></a>
                </div>
          </div>
          <div class="box-body table-responsive">
            <form action="{{ route('update_admin') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="hidden" name="id" readonly class="form-control" value="{{ $profile->id }}" readonly>
          </div>
            <div class="form-group has-feedback">
                <label>Nomor Induk Kependudukan</label>
                <input type="text" name="nik" class="form-control" value="{{ $profile->nik }}" readonly>
            </div>
            <div class="form-group has-feedback">
                <label>Nama :</label>
                <input type="text" name="nama" class="form-control" value="{{ $profile->nama_user }}" required>
            </div>
            <div class="form-group has-feedback">
                <label>Password Baru :</label>
                <input type="password" name="password" class="form-control" placeholder="Masukan Password Baru..">
            </div>
            <div class="form-group has-feedback">
                <label>No. Handphone/WhatsApp :</label>
                <input type="text" name="no_hp" class="form-control" value="{{ $profile->no_hp }}" required>
            </div>
            <div class="row">
        <div class="col-md-4">
          <div class="form-group has-feedback">
            <label>Kecamatan</label>
            <select class="form-control" name="kecamatan" id="kecamatan">
              @foreach($kec as $key => $value)
              <option>Pilih</option>
              <option value="{{ $value->kecamatan_id }}" <?php if ($value->kecamatan_id == $profile->kecamatan_id) {
                echo "selected";
              } ?>>{{ $value->nama_kecamatan }}</option>
              @endforeach
            </select>
            <span class="form-control-feedback"></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group has-feedback">
            <label>Kelurahan</label>
            <select class="form-control" name="kelurahan" id="kelurahan">
              @foreach($kel as $key => $value)
              <option value="{{ $value->kelurahan_id }}" <?php if ($value->kelurahan_id == $profile->kelurahan_id) {
                echo "selected";
              } ?>>{{ $value->nama_kelurahan }}</option>
              @endforeach
            </select>
            <span class="form-control-feedback"></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group has-feedback">
            <label>Detail Alamat :</label>
           <textarea name="alamat" class="form-control" rows="3" cols="20" maxlength="200" required> {{ $profile->alamat }}</textarea>
            <span class="glyphicon glyphicon-home form-control-feedback"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback">
                <label>Foto {{ $profile->nama_user }} :</label>
                <p><img width="250px" height="200px" src="{{ asset('uploads/'.$profile->foto_user) }}"></p>
                <label>Ubah Foto :</label>
                <input type="hidden" name="foto_user_lama" class="form-control" value="{{ $profile->foto_user }}">
                <input type="file" name="foto_user_baru" class="form-control">
            </div>
          </div>
        </div>
          <div class="row">
            <div class="col-xs-3 col-xs-offset-5">
              <button type="submit" class="btn btn-sm btn-primary">Update</button>
            </div>
          </div>
        </form>
          </div>
         </div>    
      </div>
    </div>
    <br/>
  </section>
@endsection

@section('javascript')

<script>
 $(function(){
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

      $('#kecamatan').on('change', function(){
          $.ajax({
            url: '{{ route('kelur') }}',
            method: 'POST',
            data: {kecamatan_id: $(this).val()},
            success: function (response) {
                $('#kelurahan').empty();

                $.each(response, function (kelurahan_id, nama_kelurahan) {
                    $('#kelurahan').append(new Option(nama_kelurahan, kelurahan_id))
                })
            }
        })
      });
  });
</script>
@endsection