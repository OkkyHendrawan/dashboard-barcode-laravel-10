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
                <h1 class="h3 mb-2 text-gray-800">Daftar Tiket</h1>
                <p class="mb-4">Daftar lengkap tiket</p>
                @include('auth.message')

                <!-- Form Pencarian -->
                <form action="{{ route('page.tiket.search') }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control" name="search_nama_wisata" placeholder="Cari berdasarkan nama wisata..." value="{{ request('search_nama_wisata') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control" name="search_harga_tiket" placeholder="Cari berdasarkan harga tiket..." value="{{ request('search_harga_tiket') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                            <a href="{{ route('page.tiket.list') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Data Tiket</h6>
                        <div>
                            <a href="{{ route('page.tiket.form_create') }}" class="btn btn-primary btn-sm">Tambah</a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Cetak
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('page.tiket.export', ['type' => 'pdf']) }}">Cetak PDF</a>
                                    <a class="dropdown-item" href="{{ route('page.tiket.export', ['type' => 'excel']) }}">Cetak Excel</a>
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
                                        <th>Gambar Wisata</th>
                                        <th>Nama Wisata</th>
                                        <th>Harga Tiket</th>
                                        <th>Di Buat</th>
                                        <th>Di Perbarui</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tiket as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('gambar-wisata/' . $value->gambar) }}"
                                                alt="Gambar Tiket" class="img-thumbnail" style="max-width: 100px;"></td>
                                            <td>{{ $value->nama_wisata }}</td>
                                            <td>Rp {{ number_format($value->harga_tiket, 2, ',', '.') }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ $value->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('page.tiket.edit', $value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#previewModal{{ $value->id }}">Preview</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $value->id }}">Delete</button>

                                                <!-- Modal Preview -->
                                                <div class="modal fade" id="previewModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel{{ $value->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="previewModalLabel{{ $value->id }}">Detail Tiket</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset('gambar-wisata/' . $value->gambar) }}" alt="Gambar Tiket" class="img-fluid mb-3 d-block mx-auto">
                                                                <ul class="list-group">
                                                                    <li class="list-group-item"><strong>Nama Wisata:</strong> {{ $value->nama_wisata }}</li>
                                                                    <li class="list-group-item"><strong>Harga Tiket:</strong> {{ $value->harga_tiket }}</li>
                                                                    <li class="list-group-item"><strong>Dibuat Pada:</strong> {{ $value->created_at }}</li>
                                                                    <li class="list-group-item"><strong>Diperbarui Pada:</strong> {{ $value->updated_at }}</li>
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
                                                                    <li class="list-group-item"><strong>Nama Wisata:</strong> {{ $value->nama_wisata }}</li>
                                                                    <li class="list-group-item"><strong>Harga Tiket:</strong> {{ $value->harga_tiket }}</li>
                                                                </ul>
                                                                <p>Apakah Anda yakin ingin menghapus Tiket ini?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('page.tiket.softDeleteTiket', ['id' => $value->id]) }}" method="POST" class="d-inline">
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
                                {{ $tiket->links('pagination::bootstrap-5') }}
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
