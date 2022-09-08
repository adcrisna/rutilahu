<!DOCTYPE html>
<html>
<head><link rel="shortcut icon" href="trustme.png" type="image/x-icon" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Register</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/morris/morris.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/font-awesome.min.css') }}">
</head>
<body class="hold-transition register-page">
  <div class="container">
    <div class="register-logo">
    <a href="#"><b>Dinas Perumahan Rakyat dan Kawasan Pemukiman</b> <BR/> Kota Cirebon</a>
  </div>
<div class="row">
  <div class="col-md-1">
    
  </div>
  <div class="col-md-10">
  <div class="register-box-body">
        @if(\Session::has('msg_gagal_daftar'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_gagal_daftar')}}
            </div></h5>
            @endif
    <h3 class="login-box-msg"><b>Daftar Calon Penerima Bantuan Ritulahu</b></h3>

    <form action="{{ route('prosesDaftar') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <input type="text" name="nik" class="form-control" placeholder="Nomor Induk Kependudukan" required>
            <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group has-feedback">
            <input type="number" name="no_hp" class="form-control" placeholder="No Telepon/WhatsApp" required>
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group has-feedback">
            <select name="penghasilan" id="penghasilan" class="form-control" required>
              <option value="">Pilih Penghasilan</option>
              <option value="Lebih dari 5.000.000">Lebih dari 5.000.000</option>
              <option value="3.000.000 sampai 5.000.000">3.000.000 sampai 5.000.000</option>
              <option value="1.500.000 sampai 3.000.000">1.500.000 sampai 3.000.000</option>
              <option value="Kurang dari 1.500.000">Kurang dari 1.500.000 </option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label style="color:red;" >*Foto Wajah</label>
            <input type="file" name="foto_user" class="form-control" placeholder="Foto User" required>
            <span class="glyphicon glyphicon-picture form-control-feedback"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label style="color:red;" >*Foto KTP</label>
            <input type="file" name="foto_ktp" class="form-control" placeholder="Foto KTP" required>
            <span class="glyphicon glyphicon-picture form-control-feedback"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label style="color:red;" >*Foto Kartu Keluarga</label>
            <input type="file" name="foto_kk" class="form-control" placeholder="Foto KK" required>
            <span class="glyphicon glyphicon-picture form-control-feedback"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label style="color:red;" >*Foto Setrifikat Tanah</label>
            <input type="file" name="foto_serti_tanah" class="form-control" placeholder="Foto Sertfikas Tanah" required>
            <span class="glyphicon glyphicon-picture form-control-feedback"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group has-feedback">
            <label>Kecamatan</label>
            <select class="form-control" name="kecamatan" id="kecamatan" required>
              <option value="">Pilih</option>
              @foreach($kec as $key => $value)
              <option value="{{ $value->kecamatan_id }}">{{ $value->nama_kecamatan }}</option>
              @endforeach
            </select>
            <span class="form-control-feedback"></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group has-feedback">
            <label>Kelurahan</label>
            <select class="form-control" name="kelurahan" id="kelurahan" required>
              <option>Pilih</option>
            </select>
            <span class="form-control-feedback"></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group has-feedback">
            <label>Detail Alamat :</label>
           <textarea name="alamat" class="form-control" rows="5" cols="20" maxlength="200" required> </textarea>
            <span class="glyphicon glyphicon-home form-control-feedback"></span>
          </div>
        </div>
      </div>
      <br/>
      <div class="row">
        <div class="col-md-5">
          <div class="checkbox icheck">
            
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br/>
        <div class="social-auth-links text-center">
          <p> </p>
        <a href="{{ route('index') }}" class="text-center">Login</a>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/raphael/raphael-min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });

</script>
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
</body>
</html>