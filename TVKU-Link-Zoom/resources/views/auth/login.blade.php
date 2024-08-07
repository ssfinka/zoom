<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TVKU | Masuk</title>

    <!-- Font Google: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap --> 
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Tema style --> 
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <!-- CSS Kustom -->
    <style>
        body {
            background-color: #d4d4d4;
        }
        .login-box {
            width: 560px;
            height: auto; /* Ubah ke auto untuk menyesuaikan tinggi konten */
            padding: 20px; /* Tambahkan padding untuk ruang tambahan */
        }
        .card {
            border: none !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
        }
        .card-header {
            border-bottom: none !important;
            box-shadow: none !important;
        }
        .login-title, .login-subtitle, .account-text, .btn-primary, .form-control {
            font-family: 'Inter', sans-serif;
        }
        .login-title {
            font-weight: 600;
            color: #1849A9;
            font-size: 18px;
            text-align: left;
            margin: 10px 0;
        }
        .login-subtitle, .account-text, .form-control::placeholder {
            color: #667085;
            font-size: 14px;
        }
        .input-group {
            margin-bottom: 16px;
        }
        .input-group label {
            font-family: 'Inter', sans-serif;
            color: #667085;
            font-size: 14px;
            margin-bottom: 4px;
            display: block;
        }
        .input-group .form-control {
            border-color: #ccc;
            font-size: 16px;
            color: #667085;
            padding-left: 40px;
            border-radius: 4px;
            box-sizing: border-box; /* Pastikan padding tidak mempengaruhi lebar */
        }
        .input-group .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #1849A9;
            font-size: 20px;
            pointer-events: none;
        }
        .input-group .input-wrapper {
            position: relative;
        }
        .btn-primary {
            background-color: #1849A9;
            border-color: #1849A9;
            width: 100%;
            display: block;
            text-align: center;
            font-size: 16px;
            color: white;
            padding: 10px;
            border-radius: 4px;
            margin-top: 16px;
        }
        .btn-primary:hover {
            background-color: #163a7e;
            border-color: #163a7e;
        }
        .account-text {
            text-align: center;
            margin-top: 16px;
        }
        .account-text a {
            color: #1849A9;
            font-weight: 600;
            text-decoration: none;
        }
        .account-text a:hover {
            text-decoration: underline;
        }
        .input-wrapper .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #1849A9;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head> 
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ route('login')}}" class="h1">
        <img src="{{ asset('images/TVKU.png') }}" alt="Logo TVKU" width="130" height="76" class="custom-logo">
      </a>
    </div>
    <div class="card-body">
      <p class="login-title">Halaman Login</p>
      <p class="login-subtitle">Masukkan email dan password yang sudah terdaftar!</p>

      <form action="{{ route('login-proses')}}" method="post">
        @csrf
        <div class="input-group">
          <label for="email">Email</label>
          <div class="input-wrapper">
            <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email anda">
            <span class="input-icon fas fa-envelope"></span>
          </div>
        </div>
        @error('email')
            <small>{{ $message }}</small>
        @enderror
        <div class="input-group">
          <label for="password">Password</label>
          <div class="input-wrapper">
            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password">
            <span class="input-icon fas fa-lock"></span>
            <span class="toggle-password fas fa-eye" onclick="togglePassword()"></span>
          </div>
        </div>
        @error('password')
            <small>{{ $message }}</small>
        @enderror
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Masuk</button>
          </div>
        </div>
      </form>

      <p class="account-text">
        Belum memiliki akun? Silakan daftar
      </p>
      <p class="account-text">
        <a href="{{ route('signup') }}" class="login-title">Buat Akun</a>
      </p>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if($message = Session::get('success'))
<script>
    Swal.fire('{{ $message }}');
</script>
@endif

@if($message = Session::get('failed'))
<script>
    Swal.fire('{{ $message }}');
</script>
@endif

<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const toggleIcon = document.querySelector('.toggle-password');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
</body>
</html>
