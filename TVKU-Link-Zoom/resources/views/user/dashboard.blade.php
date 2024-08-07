@extends('layout.user')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Link Zoom yang Dipinjam</h3>
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
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Link Zoom</th>
                                        <th>Waktu Peminjaman</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peminjaman as $key => $pinjam)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $pinjam->link_zoom }}</td>
                                        <td>{{ $pinjam->waktu_peminjaman }}</td>
                                        <td>
                                            <button class="btn btn-{{ $pinjam->status == 'Dipinjam' ? 'success' : ($pinjam->status == 'Ditolak' ? 'danger' : 'warning') }}">
                                                {{ $pinjam->status }}
                                            </button>
                                        </td>
                                        <td>
                                            @if ($pinjam->status == 'Dipinjam')
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#selesaiModal{{ $pinjam->id }}"><i class="fas fa-check"></i> Selesai</button>
                                            @else
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal{{ $pinjam->id }}"><i class="fas fa-eye"></i> Lihat Detail</button>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Modal Selesai -->
                                    <div class="modal fade" id="selesaiModal{{ $pinjam->id }}" tabindex="-1" role="dialog" aria-labelledby="selesaiModalLabel{{ $pinjam->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('user.peminjaman.selesai', $pinjam->id) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="selesaiModalLabel{{ $pinjam->id }}">Konfirmasi Selesai</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah kamu yakin ingin menandai peminjaman Zoom ini sebagai selesai?</p>
                                                        <div class="form-group">
                                                            <label for="feedback">Tanggapan dan Saran</label>
                                                            <textarea name="feedback" id="feedback" class="form-control" rows="5" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Selesai</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Lihat Detail -->
                                    <div class="modal fade" id="detailModal{{ $pinjam->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $pinjam->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailModalLabel{{ $pinjam->id }}">Detail Peminjaman</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Link Zoom: {{ $pinjam->link_zoom }}</p>
                                                    <p>Waktu Peminjaman: {{ $pinjam->waktu_peminjaman }}</p>
                                                    <p>Status: {{ $pinjam->status }}</p>
                                                    <p>Feedback: {{ $pinjam->feedback }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection