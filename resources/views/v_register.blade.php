
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Register</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{asset('template/')}}/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template/')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('template/')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template/')}}/dist/css/adminlte.min.css">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <h1>Panji Saraswati</h1>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silakan Register Akun</p>

        <div class="error" style="width: 100%; text-align:center; margin-bottom: 20px;" id="response-error"></div>

        <div style="width: 100%; margin-bottom: 10px;">
          <input name="name" class="form-control" placeholder="Name" onkeyup="handleChangeName(this)">
          <div class="error" id="error-name"></div>
        </div>

        <div style="width: 100%; margin-bottom: 10px;">
          <input type="email" name="email" class="form-control" placeholder="Email" onkeyup="handleChangeEmail(this)">
          <div class="error" id="error-email"></div>
        </div>

        <div style="width: 100%; margin-bottom: 10px;">
          <input type="password" name="password" class="form-control" placeholder="Password" onkeyup="handleChangePassword(this)">
          <div class="error" id="error-password"></div>
        </div>

        <div style="width: 100%; margin-bottom: 10px;">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" onkeyup="handleChangePassword2(this)">
          <div class="error" id="error-password2"></div>
        </div>
          <!-- /.col -->
          <div class="">
            <button class="btn btn-primary btn-block" onclick="handleRegister()">Register</button>
          </div>
          <!-- /.col -->
        </div>

      <!-- /.social-auth-links -->
      <p class="text-center" style="margin-bottom: 20px;">
        <a href="{{ route('login') }}" class="text-center">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('template/')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('template/')}}/dist/js/adminlte.min.js"></script>
</body>

@include('js/javascript')
<script type="text/javascript">
  let name = {value: "", error: false};
  let email = {value: "", error: false};
  let password = {value: "", error: false};
  let password2 = {value: "", error: false};

  $(document).on('keyup',function(e) {
      if(e.which == 13) {
          handleRegister();
      }
  });

  function handleChangeName(e) {
    name.value = $(e).val();
    name.error = false;

    $('#error-name').html("");
  }

  function handleChangeEmail(e) {
    email.value = $(e).val();
    email.error = false;

    $('#error-email').html("");
  }

  function handleChangePassword(e) {
    password.value = $(e).val();
    password.error = false;

    $('#error-password').html("");
  }

  function handleChangePassword2(e) {
    password2.value = $(e).val();
    password2.error = false;

    $('#error-password2').html("");
  }

  function handleRegister() {
    const elName = $('#error-name');
    const elEmail = $('#error-email');
    const elPassword = $('#error-password');
    const elPassword2 = $('#error-password2');

    if (name.value.length === 0) {
      elName.html("Nama tidak boleh kosong");
      name.error = true;
    } else if (name.value.length < 6) {
      elName.html("Nama harus minimal 6 karakter");
      name.error = true;
    }
    
    if (email.value.length === 0) {
      elEmail.html("Email tidak boleh kosong");
      email.error = true;
    } else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)) {
      elEmail.html("");
      email.error = false;
    } else {
      elEmail.html("Email tidak valid");
      email.error = true;
    }

    if (password.value.length === 0) {
      elPassword.html("Password tidak boleh kosong");
      password.error = true;
    } else if (password.value.length < 8) {
      elPassword.html("Password minimal 8 karakter");
      password.error = true;
    }

    if (password2.value.length === 0) {
      elPassword2.html("Konfirm password tidak boleh kosong");
      password2.error = true;
    } else if (password.value === password2.value) {
      elPassword2.html("");
      password2.error = false;
    } else {
      elPassword2.html("Konfirm password harus sama dengan password");
      password2.error = true;
    }

    if (name.error === false && email.error === false && password.error === false && password2.error === false) {
      storeData();
    }

  }

  function storeData() {
    const formData = new FormData();
    formData.append('name', name.value);
    formData.append('email', email.value);
    formData.append('password', password.value);
    formData.append('password_confirmation', password2.value);

    $.ajax({
      type: "POST",
      url: '/register',
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: formData,
      contentType: false,
      processData: false,
      success: function(result) {
        window.location.href = "/home";
      },
      error: function(error) {
        $('#response-error').html("Email sudah terpakai");
      }
    });
  }

</script>
</html>