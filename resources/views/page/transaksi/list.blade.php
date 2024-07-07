@extends('layout.app')
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <br>
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Daftar Transaksi</h1>
                <p class="mb-4">Daftar lengkap transaksi tiket.</p>
                @include('auth.message')
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
                        <a href="{{ route('page.transaksi.form_create') }}" class="btn btn-primary btn-sm float-right">Tambah</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Wisata</th>
                                        <th>Harga Tiket</th>
                                        <th>Barcode</th>
                                        <th>Dibuat Pada</th>
                                        <th>Diperbarui Pada</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transaksi as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->wisata->nama_wisata }}</td>
                                            <td>Rp {{ number_format($value->harga_tiket, 2, ',', '.') }}</td>
                                            <td style="text-align: center;">
                                                @php
                                                    $serialNumber = $value->wisata->nama_wisata . '-' . $value->harga_tiket . '-' . $value->id;
                                                @endphp
                                                <img src="data:image/png;base64,{{ base64_encode((new \Picqer\Barcode\BarcodeGeneratorPNG())->getBarcode($serialNumber, \Picqer\Barcode\BarcodeGeneratorPNG::TYPE_CODE_128)) }}" alt="Barcode" style="max-width: 250px; height: auto;">
                                                <br>
                                                <span>{{ $serialNumber }}</span>
                                            </td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ $value->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('page.transaksi.edit', $value->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#previewModal{{ $value->id }}">Preview</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $value->id }}">Delete</button>
                                            </td>
                                        </tr>

                                        <!-- Modal Preview -->
                                        <div class="modal fade" id="previewModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel{{ $value->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="previewModalLabel{{ $value->id }}">Detail Transaksi</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="data:image/png;base64,{{ base64_encode((new \Picqer\Barcode\BarcodeGeneratorPNG())->getBarcode($serialNumber, \Picqer\Barcode\BarcodeGeneratorPNG::TYPE_CODE_128)) }}" alt="Barcode" class="img-fluid mb-3 d-block mx-auto" style="max-width: 450px; height: 100px;">
                                                        <ul class="list-group">
                                                            <li class="list-group-item"><strong>Nama Wisata:</strong> {{ $value->wisata->nama_wisata }}</li>
                                                            <li class="list-group-item"><strong>Harga Tiket:</strong> Rp {{ number_format($value->harga_tiket, 2, ',', '.') }}</li>
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
                                                            <li class="list-group-item"><strong>Nama Wisata:</strong> {{ $value->wisata->nama_wisata }}</li>
                                                            <li class="list-group-item"><strong>Harga Tiket:</strong> Rp {{ number_format($value->harga_tiket, 2, ',', '.') }}</li>
                                                        </ul>
                                                        <p>Apakah Anda yakin ingin menghapus Transaksi ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('page.transaksi.softDeleteTransaksi', $value->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="clearfix">
                                {{ $transaksi->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
