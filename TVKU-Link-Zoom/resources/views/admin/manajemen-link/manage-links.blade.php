@extends('layout.admin')

@section('title', 'Kelola Link Zoom')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Link Zoom</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Link Zoom</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="col-sm-12 d-flex">
                    <a href="{{ route('admin.create-links') }}" class="btn btn-primary custom-button" style="margin-top: 10px; margin-right: 15px;">Tambah Link Zoom</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Link Zoom</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-tools mb-3 d-flex align-items-center">
                                <form id="filter-form" action="{{ route('admin.manage-links') }}" method="GET" class="d-flex">
                                    <select id="status-filter" name="status" class="form-control custom-button mr-2" style="width: 200px;" onchange="this.form.submit()">
                                        <option value="">All Status</option>
                                        <option value="Tersedia" {{ request('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="Sedang dipinjam" {{ request('status') == 'Sedang dipinjam' ? 'selected' : '' }}>Sedang dipinjam</option>
                                    </select>
                                </form>
                                <button id="sort-button" class="btn btn-default btn-sm custom-button mr-2">
                                    <i class="fas fa-sort"></i> Ubah Urutan
                                </button>
                                <div class="btn-group">
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
                            <table id="zoom-table" class="table table-hover text-nowrap" style="border: 1px solid #DEE2E6;">
                                <thead>
                                    <tr>
                                        <th style="width: 40px; border: 1px solid #DEE2E6; text-align: center">No</th>
                                        <th style="width: 30%; border: 1px solid #DEE2E6; text-align: center">Link Zoom</th>
                                        <th style="width: 30%; border: 1px solid #DEE2E6; text-align: center">ID Meeting</th>
                                        <th style="width: 15%; border: 1px solid #DEE2E6; text-align: center">Status</th>
                                        <th style="width: 100px; border: 1px solid #DEE2E6; text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($links as $key => $link)
                                    <tr>
                                        <td style="border: 1px solid #DEE2E6; text-align: center;">{{ $key + 1 }}</td>
                                        <td style="border: 1px solid #DEE2E6;">{{ $link->link_zoom }}</td>
                                        <td style="border: 1px solid #DEE2E6;">{{ $link->meeting_id }}</td>
                                        <td style="border: 1px solid #DEE2E6; text-align: center">
                                            @if($link->status_peminjaman == 'Tersedia')
                                            <button class="btn btn-success btn-sm" disabled>Tersedia</button>
                                            @elseif($link->status_peminjaman == 'Sedang dipinjam')
                                            <button class="btn btn-warning btn-sm" disabled>Sedang dipinjam</button>
                                            @endif
                                        </td>
                                        <td style="border: 1px solid #DEE2E6; text-align: center;">
                                            <a href="{{ route('admin.show-link', $link->id) }}" class="btn btn-action btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.edit-link', $link->id) }}" class="btn btn-action btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <button type="button" class="btn btn-action btn-sm" data-toggle="modal" data-target="#modal-hapus{{ $link->id }}"><i class="fas fa-trash"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modal-hapus{{ $link->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $link->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel{{ $link->id }}">Konfirmasi Hapus Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah kamu yakin ingin menghapus link Zoom ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('admin.delete-link', $link->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.modal -->
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
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
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
</style>
@endsection