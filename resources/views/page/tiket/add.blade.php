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
                <h1 class="h3 mb-2 text-gray-800">Tambah Tiket</h1>
                <p class="mb-4">Tambahkan informasi tiket wisata baru.</p>
                @include('auth.message')
                <!-- Form -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('page.tiket.proses_create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_wisata">Nama Wisata</label>
                                <input type="text" class="form-control" id="nama_wisata" name="nama_wisata" placeholder="Nama Wisata" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_tiket">Harga Tiket</label>
                                <input type="text" class="form-control" id="harga_tiket" name="harga_tiket" placeholder="Harga Tiket (format: 1000000.00)" required>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar Wisata</label>
                                <input type="file" class="form-control-file" id="gambar" name="gambar">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('page.tiket.list') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
@endsection
