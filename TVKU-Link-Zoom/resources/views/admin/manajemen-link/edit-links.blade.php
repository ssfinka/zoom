@extends('layout.admin')

@section('title', 'Edit Link Zoom')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Link</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Link</li>
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

            <form action="{{ route('admin.update-link', $link->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Edit Link Zoom</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="link_zoom">Link Zoom</label>
                                    <input type="text" class="form-control" id="link_zoom" name="link_zoom" value="{{ $link->link_zoom }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="meeting_id">ID Meeting</label>
                                    <input type="text" class="form-control" id="meeting_id" name="meeting_id" value="{{ $link->meeting_id }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password_code">Password</label>
                                    <input type="text" class="form-control" id="password_code" name="password_code" value="{{ $link->password_code }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="status_peminjaman">Status Peminjaman</label>
                                    <select class="form-control" id="status_peminjaman" name="status_peminjaman" required>
                                        <option value="Tersedia" {{ $link->status_peminjaman == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="Sedang dipinjam" {{ $link->status_peminjaman == 'Sedang dipinjam' ? 'selected' : '' }}>Sedang dipinjam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_peminjam">Nama Peminjam (opsional)</label>
                                    <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" value="{{ $link->nama_peminjam }}">
                                </div>
                                <div class="form-group">
                                    <label for="waktu_peminjaman">Waktu Peminjaman (opsional)</label>
                                    <input type="datetime-local" class="form-control" id="waktu_peminjaman" name="waktu_peminjaman" value="{{ $link->waktu_peminjaman ? date('Y-m-d\TH:i', strtotime($link->waktu_peminjaman)) : '' }}">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Edit Link Zoom</button>
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
        margin-top: -40px;
        /* Jarak atas dari elemen lain */
    }

    .btn-primary:hover {
        background-color: #0f3a7b;
        border-color: #0f3a7b;
    }
</style>
@endsection