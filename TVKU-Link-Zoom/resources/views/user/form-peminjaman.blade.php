<!-- form-peminjaman.blade.php -->
@extends('layout.user')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Peminjaman Link Zoom</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Form Peminjaman Link Zoom</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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

            <form action="{{ route('user.peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Peminjaman Link Zoom</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="judul_meeting">Judul Meeting</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="judul_meeting" name="judul_meeting" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_peminjaman">Waktu Peminjaman</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>
                                        <input type="datetime-local" class="form-control" id="waktu_peminjaman" name="waktu_peminjaman" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tujuan_penggunaan">Tujuan Penggunaan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="tujuan_penggunaan" name="tujuan_penggunaan" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="permintaan_tambahan">Permintaan Tambahan (opsional)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <textarea class="form-control" id="permintaan_tambahan" name="permintaan_tambahan"></textarea>
                                    </div>
                                </div>
                                <!-- Hidden field to store user name -->
                                <input type="hidden" name="nama_peminjam" value="{{ Auth::user()->name }}">
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Kirim Peminjaman</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
            </form>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
