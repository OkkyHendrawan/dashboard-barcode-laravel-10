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
                <h1 class="h3 mb-2 text-gray-800">Edit Tiket</h1>
                <p class="mb-4">Edit informasi tiket wisata.</p>
                @include('auth.message')
                <!-- Form -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('page.tiket.update', $tiket->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_wisata">Nama Wisata</label>
                                <input type="text" class="form-control" id="nama_wisata" name="nama_wisata" value="{{ $tiket->nama_wisata }}" placeholder="Nama Wisata" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_tiket">Harga Tiket</label>
                                <input type="text" class="form-control" id="harga_tiket" name="harga_tiket" value="{{ $tiket->harga_tiket }}" placeholder="Harga Tiket (format: 1000000.00)" required>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar Wisata</label>
                                <input type="file" class="form-control-file" id="gambar" name="gambar">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                            </div>
                            @if($tiket->gambar)
                                <div class="form-group">
                                    <label>Gambar Saat Ini</label><br>
                                    <img src="{{ asset('gambar-wisata/' . $tiket->gambar) }}" alt="Gambar Tiket" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
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
