@extends('layout.app')

@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <br>
        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Daftar Mahasiswa</h1>
                <p class="mb-4">Nothing interesting for me</p>

                @include('auth.message')

                <!-- Form Pencarian -->
                <form action="{{ route('page.home.search') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan nama...">
                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                        <a href="{{ route('page.home.list') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                        <div>
                            <a href="{{ route('page.home.form_create') }}" class="btn btn-primary btn-sm">Tambah</a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Cetak
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('page.home.export', ['type' => 'pdf']) }}">Cetak PDF</a>
                                    <a class="dropdown-item" href="{{ route('page.home.export', ['type' => 'excel']) }}">Cetak Excel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NBI</th>
                                        <th>Di Buat</th>
                                        <th>Di Perbarui</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($home as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->nama }}</td>
                                            <td>{{ $value->nbi }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ $value->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('page.home.edit', $value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#previewModal{{ $value->id }}">Preview</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $value->id }}">Delete</button>

                                                <!-- Modal Preview -->
                                                <div class="modal fade" id="previewModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel{{ $value->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="previewModalLabel{{ $value->id }}">Detail Mahasiswa</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul class="list-group">
                                                                    <li class="list-group-item"><strong>Nama Lengkap:</strong> {{ $value->nama }}</li>
                                                                    <li class="list-group-item"><strong>NBI:</strong> {{ $value->nbi }}</li>
                                                                    <li class="list-group-item"><strong>Dibuat Pada:</strong> {{ $value->created_at }}</li>
                                                                    <li class="list-group-item"><strong>Diperbarui Pada:</strong> {{ $value->updated_at }}</li>
                                                                    <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Hapus -->
                                                <div class="modal fade" id="deleteModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $value->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel{{ $value->id }}">Konfirmasi Hapus</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul class="list-group">
                                                                    <li class="list-group-item"><strong>NBI:</strong> {{ $value->nbi }}</li>
                                                                    <li class="list-group-item"><strong>Nama:</strong> {{ $value->nama }}</li>
                                                                </ul>
                                                                <p>Apakah Anda yakin ingin menghapus Mahasiswa ini?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('page.home.softDeleteHome', ['id' => $value->id]) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="clearfix">
                                {{ $home->links('pagination::bootstrap-5') }}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->
@endsection
