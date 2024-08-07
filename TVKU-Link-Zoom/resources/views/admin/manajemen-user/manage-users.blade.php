@extends('layout.admin')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Pengguna</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Pengguna</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="col-sm-12 d-flex">
                    <a href="{{ route('admin.create-user') }}" class="btn btn-primary custom-button" style="margin-top: 10px; margin-right: 15px;">Tambah Pengguna</a>
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
                            <h3 class="card-title">Daftar Pengguna</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-tools mb-3 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                <form id="filter-form" action="{{ route('admin.manage-users') }}" method="GET" class="d-flex">
                                    <select id="role-filter" name="role" class="form-control custom-button mr-2" style="width: 200px;" onchange="this.form.submit()">
                                        <option value="">All Roles</option>
                                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff TVKU</option>
                                        <option value="tamu" {{ request('role') == 'tamu' ? 'selected' : '' }}>Tamu</option>
                                    </select>
                                </form>
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
                                    <div class="input-group input-group-sm custom-button" style="width: 250px;">
                                        <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table id="user-table" class="table table-hover text-nowrap" style="border: 1px solid #DEE2E6;">
                                <thead>
                                    <tr>
                                        <th style="width: 5%; border: 1px solid #DEE2E6; text-align: center">No</th>
                                        <th style="border: 1px solid #DEE2E6; text-align: center">Nama</th>
                                        <th style="border: 1px solid #DEE2E6; text-align: center">Email</th>
                                        <th style="width: 15%; border: 1px solid #DEE2E6; text-align: center">Peran</th>
                                        <th style="width: 100px; border: 1px solid #DEE2E6; text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $key => $user)
                                    <tr @if($loop->even) style="background-color: #f2f2f2;" @endif>
                                        <td style="border: 1px solid #DEE2E6; text-align: center;">{{ $key + 1 }}</td>
                                        <td style="border: 1px solid #DEE2E6;">{{ $user->name }}</td>
                                        <td style="border: 1px solid #DEE2E6;">{{ $user->email }}</td>
                                        <td style="border: 1px solid #DEE2E6; text-align: center;">
                                            @if($user->role == 'admin')
                                            Admin
                                            @elseif($user->role == 'staff')
                                            Staff TVKU
                                            @else
                                            Tamu
                                            @endif
                                        </td>
                                        <td style="border: 1px solid #DEE2E6; text-align: center;">
                                            <a href="{{ route('admin.show-user', $user->id) }}" class="btn btn-action btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.edit-user', $user->id) }}" class="btn btn-action btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <button type="button" class="btn btn-action btn-sm" data-toggle="modal" data-target="#modal-hapus{{ $user->id }}"><i class="fas fa-trash"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modal-hapus{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel{{ $user->id }}">Konfirmasi Hapus Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus pengguna ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
        </div>
    </section>
    <!-- /.content -->
</div>

<script>
    document.getElementById('sort-button').addEventListener('click', function() {
        let table = document.getElementById('user-table').getElementsByTagName('tbody')[0];
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

    #user-table tbody tr:nth-child(even) {
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
        justify-content: space-between;
    }
</style>
@endsection
