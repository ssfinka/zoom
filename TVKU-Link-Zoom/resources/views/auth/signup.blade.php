<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TVKU | Sign Up</title>

    <!-- Google Font: Inter -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:wght@400;600&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap --> 
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style --> 
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #d4d4d4;
            font-family: 'Inter', sans-serif;
        }
        .register-box {
            width: 560px;
            height: auto;
            margin: 0 auto;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            border-bottom: none;
            box-shadow: none;
        }
        .login-title {
            font-weight: 600;
            color: #1849A9;
            font-size: 18px;
            text-align: left;
            margin: 10px 0;
        }
        .login-subtitle {
            color: #667085;
            font-size: 14px;
            text-align: left;
            margin-bottom: 20px;
        }
        .card-body {
            padding: 20px;
        }
        .input-group {
            position: relative;
            margin-bottom: 16px;
        }
        .input-group label {
            font-family: 'Inter', sans-serif;
            color: #667085;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }
        .input-group .form-control {
            border-color: #ccc;
            font-size: 16px;
            color: #667085;
            padding-left: 40px; /* Add space for the icon */
            border-radius: 4px;
        }
        .input-group .form-control::placeholder {
            color: #667085;
            font-size: 16px;
        }
        .input-group .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }
        .input-group .input-icon {
            position: absolute;
            left: 12px; /* Adjusted for consistent spacing */
            top: 50%;
            transform: translateY(-50%);
            color: #1849A9;
            font-size: 20px;
            pointer-events: none;
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
        .text-center a {
            color: #1849A9;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head> 
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ route('signup')}}" class="h1">
        <img src="{{ asset('images/TVKU.png') }}" alt="TVKU Logo" width="130" height="76" class="custom-logo">
      </a>
    </div>
    <div class="card-body">
      <p class="login-title">Halaman Daftar</p>
      <p class="login-subtitle">Masukan data-data yang diperlukan dengan benar!</p>

      <form action="{{ route('signup-proses') }}" method="post">
        @csrf
        <div class="input-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" class="form-control" placeholder="Full name" required>
          <span class="input-icon fas fa-user"></span>
        </div>
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="input-group">
          <label for="role">Role</label>
          <select id="role" name="role" class="form-control" required>
            <option value="">Select Role</option>
            <option value="staff">Staff TVKU</option>
            <option value="tamu">Tamu</option>
            <option value="pembicara">Pembicara</option>
          </select>
          <span class="input-icon fas fa-user-tag"></span>
        </div>
        @error('role')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
          <span class="input-icon fas fa-envelope"></span>
        </div>
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
          <span class="input-icon fas fa-lock"></span>
        </div>
        @error('password')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="input-group">
          <label for="password_confirmation">Retype Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Retype password" required>
          <span class="input-icon fas fa-lock"></span>
        </div>
        @error('password_confirmation')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
        </div>
      </form>

      <p class="text-center">
        <a href="{{ route('login') }}">I already have a membership</a>
      </p>
    </div>
  </div>
</div>
<!-- /.register-box -->

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
</body>
</html>
