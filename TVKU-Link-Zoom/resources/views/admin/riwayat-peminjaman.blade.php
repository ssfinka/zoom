@extends('layout.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Riwayat Peminjaman Zoom</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Riwayat Peminjaman</li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Peminjaman Zoom</h3>

                            <div class="card-tools">
                                <form action="" method="GET">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="search" class="form-control float-right" placeholder="Search" value="">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peminjam</th>
                                        <th>Waktu Zoom</th>
                                        <th>Nama Acara</th>
                                        <th>Permintaan Tambahan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayatPeminjaman as $key => $pinjam)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $pinjam->user->name }}</td>
                                        <td>{{ $pinjam->waktu_peminjaman }}</td>
                                        <td>{{ $pinjam->judul_meeting }}</td>
                                        <td>{{ $pinjam->permintaan_tambahan }}</td>
                                        <td>                                            
                                            @if($pinjam->status == 'disetujui')
                                                <button class="btn btn-success" disabled>Disetujui</button>
                                            @elseif($pinjam->status == 'ditolak')
                                                <button class="btn btn-danger" disabled>Ditolak</button>
                                            @else
                                                <button class="btn btn-warning" disabled>Menunggu</button>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.peminjaman.detail', $pinjam->id) }}" class="btn btn-info">Lihat Detail</a>
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
@endsection
