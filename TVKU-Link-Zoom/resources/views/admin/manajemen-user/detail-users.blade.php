@extends('layout.admin')

@section('title', 'Detail Pengguna')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Pengguna</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.manage-users') }}">Kelola Pengguna</a></li>
                        <li class="breadcrumb-item active">Detail Pengguna</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <!-- Display User Details -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Pengguna</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" value="{{ $user->password }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation" value="{{ $user->password_confirmation }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="role">Peran</label>
                                <input type="text" class="form-control" id="role" value="{{ $user->role }}" readonly>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ route('admin.manage-users') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .card.card-primary .card-header {
        background-color: #1849A9 !important;
        color: #ffffff !important;
    }

    .btn-primary {
        background-color: #1849A9;
        border-color: #1849A9;
        width: 100%;
        margin-top: 20px;
    }

    .btn-primary:hover {
        background-color: #0f3a7b;
        border-color: #0f3a7b;
    }
</style>
@endsection
