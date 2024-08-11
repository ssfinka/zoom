@extends('layout.admin')

@section('title', 'Formulir Persetujuan')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Persetujuan Peminjaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Form Persetujuan Peminjaman</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Persetujuan Peminjaman</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <form action="{{ route('admin.peminjaman.approve', $peminjaman->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Nama Peminjam</label>
                                    <input type="text" class="form-control" value="{{ $peminjaman->user->name }}" readonly>
                                    <input type="hidden" name="user_name" class="form-control" value="{{ $peminjaman->user->name }}">
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
                                    <select name="link_zoom_id" class="form-control" id="link_zoom" required>
                                        <option value="">Pilih Link Zoom</option>
                                        @foreach($links as $link)
                                        <option value="{{ $link->id }}" data-link="{{ $link->link_zoom }}" data-id="{{ $link->meeting_id }}" data-password="{{ $link->password_code }}">
                                            {{ $link->link_zoom }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>ID Meeting</label>
                                    <input type="text" name="id_meeting" id="id_meeting" class="form-control" required readonly>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" id="password" class="form-control" required readonly>
                                </div>
                                <div class="form-group">
                                    <label>Catatan Admin</label>
                                    <input type="text" name="catatan_admin" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Setujui</button>
                            </form>
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
    }

    .btn-primary:hover {
        background-color: #0f3a7b;
        border-color: #0f3a7b;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const linkSelect = document.getElementById('link_zoom');
        const idMeetingInput = document.getElementById('id_meeting');
        const passwordInput = document.getElementById('password');

        linkSelect.addEventListener('change', function() {
            const selectedOption = linkSelect.options[linkSelect.selectedIndex];
            idMeetingInput.value = selectedOption.getAttribute('data-id');
            passwordInput.value = selectedOption.getAttribute('data-password');
        });
    });
</script>
@endsection
