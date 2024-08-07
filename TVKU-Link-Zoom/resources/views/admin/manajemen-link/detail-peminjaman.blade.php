@extends('layout.admin')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Peminjaman Zoom</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Peminjaman</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Display Validation Errors -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detail Peminjaman</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Peminjam</label>
                                <input type="text" class="form-control" value="{{ $peminjaman->user->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Waktu Zoom</label>
                                <input type="text" class="form-control" value="{{ $peminjaman->waktu_peminjaman }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Acara</label>
                                <input type="text" class="form-control" value="{{ $peminjaman->judul_meeting }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Permintaan Tambahan</label>
                                <input type="text" class="form-control" value="{{ $peminjaman->permintaan_tambahan }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Link Zoom</label>
                                <input type="url" class="form-control" value="{{ $peminjaman->link_zoom }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>ID Meeting</label>
                                <input type="text" class="form-control" value="{{ $peminjaman->id_meeting }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" value="{{ $peminjaman->password }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Catatan Admin</label>
                                <input type="text" class="form-control" value="{{ $peminjaman->catatan_admin }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" value="{{ ucfirst($peminjaman->status) }}" readonly>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
        /* Lebar penuh */
        margin-top: 20px;
        /* Jarak atas dari elemen lain */
    }

    .btn-primary:hover {
        background-color: #0f3a7b;
        border-color: #0f3a7b;
    }
</style>
@endsection