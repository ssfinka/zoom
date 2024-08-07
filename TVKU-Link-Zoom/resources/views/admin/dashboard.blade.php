@extends('layout.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard Admin</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalPeminjamanDisetujui }}</h3>
                            <p>Total Peminjaman</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalLinkZoom }}</h3>
                            <p>Total Link Zoom Yang Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('admin.manage-links')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Daftar Peminjaman Zoom -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Peminjaman Link Zoom</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-tools mb-3 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <button id="sort-button" class="btn btn-default btn-sm custom-button mr-2">
                                        <i class="fas fa-sort"></i> Ubah Urutan
                                    </button>
                                    <div class="btn-group mr-2">
                                        <button type="button" class="btn btn-default btn-sm custom-button dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Ekspor Data
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Copy</a>
                                            <a class="dropdown-item" href="#">CSV</a>
                                            <a class="dropdown-item" href="#">Excel</a>
                                            <a class="dropdown-item" href="#">PDF</a>
                                            <a class="dropdown-item" href="#">Print</a>
                                        </div>
                                    </div>
                                </div>
                                <form action="" method="GET" class="d-flex ml-2">
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <input type="text" name="search" class="form-control float-right" placeholder="Search" value="">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-body table-responsive p-0">
                                <table id="zoom-table" class="table table-hover text-nowrap" style="border: 1px solid #DEE2E6;">
                                    <thead>
                                        <tr>
                                            <th style="width: 40px; border: 1px solid #DEE2E6; text-align: center">No</th>
                                            <th style="border: 1px solid #DEE2E6; text-align: center">Nama Peminjam</th>
                                            <th style="border: 1px solid #DEE2E6; text-align: center">Waktu Zoom</th>
                                            <th style="border: 1px solid #DEE2E6; text-align: center">Nama Acara</th>
                                            <th style="border: 1px solid #DEE2E6; text-align: center">Permintaan Tambahan</th>
                                            <th style="border: 1px solid #DEE2E6; text-align: center">Status</th>
                                            <th style="width: 100px; border: 1px solid #DEE2E6; text-align: center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($peminjaman as $key => $pinjam)
                                        <tr @if($key % 2 !=0) style="background-color: #F8F9F9;" @endif>
                                            <td style="border: 1px solid #DEE2E6; text-align: center;">{{ $key + 1 }}</td>
                                            <td style="border: 1px solid #DEE2E6;">{{ $pinjam->user->name }}</td>
                                            <td style="border: 1px solid #DEE2E6;">{{ $pinjam->waktu_peminjaman }}</td>
                                            <td style="border: 1px solid #DEE2E6;">{{ $pinjam->judul_meeting }}</td>
                                            <td style="border: 1px solid #DEE2E6;">{{ $pinjam->permintaan_tambahan }}</td>
                                            <td style="border: 1px solid #DEE2E6; text-align: center;">
                                                @if($pinjam->status == 'disetujui')
                                                <button class="btn btn-success btn-sm" disabled>Disetujui</button>
                                                @elseif($pinjam->status == 'ditolak')
                                                <button class="btn btn-danger btn-sm" disabled>Ditolak</button>
                                                @else
                                                <button class="btn btn-warning btn-sm" disabled>Menunggu</button>
                                                @endif
                                            </td>
                                            <td style="border: 1px solid #DEE2E6; text-align: center;">
                                                @if($pinjam->status == 'Menunggu Persetujuan')
                                                <form action="{{ route('admin.peminjaman.reject', $pinjam->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                                </form>
                                                <a href="{{ route('admin.peminjaman.approveForm', $pinjam->id) }}" class="btn btn-success btn-sm">Setujui</a>
                                                @else
                                                <a href="{{ route('admin.peminjaman.detail', $pinjam->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script>
    document.getElementById('sort-button').addEventListener('click', function() {
        let table = document.getElementById('zoom-table').getElementsByTagName('tbody')[0];
        let rows = Array.from(table.rows);
        let sortedRows = rows.reverse();
        table.innerHTML = '';
        sortedRows.forEach(row => table.appendChild(row));
    });
</script>

<style>
    .btn-action {
        background-color: transparent;
        color: #667085;
    }

    .btn-action i {
        padding: 2px;
    }

    #zoom-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .custom-button {
        height: calc(1.5em + 0.75rem + 2px);
        font-size: 1rem;
        line-height: 1.5;
    }

    .card-tools {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .card-tools form {
        margin-bottom: 0;
    }

    .card-tools .input-group-sm {
        width: auto;
    }

    .card-tools .input-group-sm .form-control {
        height: calc(1.5em + 0.75rem + 2px);
        font-size: 1rem;
        padding: 0.375rem 0.75rem;
    }

    .card-tools .input-group-sm .btn {
        height: calc(1.5em + 0.75rem + 2px);
        font-size: 1rem;
        padding: 0.375rem 0.75rem;
    }
</style>
@endsection