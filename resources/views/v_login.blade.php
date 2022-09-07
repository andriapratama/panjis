
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Log in</title>

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
      <p class="login-box-msg">Silakan Login</p>

      <div class="error" id="response-error" style="width: 100%; text-align: center; margin-bottom: 10px;"></div>

        <div style="width: 100%; margin-bottom: 10px;">
          <input type="email" name="email" class="form-control" placeholder="Email" onkeyup="handleEmail(this)">
          <div class="error" id="error-email"></div>
        </div>
        <div style="width: 100%; margin-bottom: 10px;">
          <input type="password" name="password" class="form-control" placeholder="Password" onkeyup="handlePassword(this)">
          <div class="error" id="error-password"></div>
        </div>
          <!-- /.col -->
          <div class="">
            <button class="btn btn-primary btn-block" onclick="handleLogin()">Masuk</button>
          </div>
          <!-- /.col -->
        </div>

      <p class="text-center" style="margin-bottom: 20px;">
        <a href="{{ route('register') }}" class="text-center">Register</a>
      </p>
      <!-- /.social-auth-links -->
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
  let email = {value: "", error: false};
  let password = {value: "", error: false};

  $(document).on('keyup',function(e) {
      if(e.which == 13) {
          handleLogin();
      }
  });

  function handleEmail(e) {
    email.value = $(e).val();
    email.error = false;

    $('#error-email').html("");
  }

  function handlePassword(e) {
    password.value = $(e).val();
    password.error = false;

    $('#error-password').html("");
  }

  function handleLogin() {
    const elEmail = $('#error-email');
    const elPassword = $('#error-password');

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

    if (email.error === false && password.error === false) {
      postData();
    }
  }

  function postData() {
    const formData = new FormData();
    formData.append('email', email.value);
    formData.append('password', password.value);

    $.ajax({
      type: "POST",
      url: '/login',
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
        $('#response-error').html(error.responseJSON.message);
      }
    });
  }
</script>
</html>