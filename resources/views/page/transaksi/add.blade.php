@extends('layout.app')
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <br>
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Tambah Transaksi</h1>
                <p class="mb-4">Form untuk menambahkan transaksi baru.</p>
                @include('auth.message')
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Transaksi</h6>
                    </div>
                    <div class="card-body">
                        <form id="transaksiForm" action="{{ route('page.transaksi.proses_create') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="wisata_id">Nama Wisata</label>
                                <select class="form-control" id="wisata_id" name="wisata_id">
                                    @foreach($tiket as $t)
                                        <option value="{{ $t->id }}">{{ $t->nama_wisata }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga_tiket">Harga Tiket</label>
                                <input type="text" class="form-control" id="harga_tiket" name="harga_tiket" placeholder="Masukkan harga tiket">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" onclick="generateAndPrintNota()">Cetak Nota</button>
                        </form>
                        <svg id="barcode" style="display: none;"></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.0/JsBarcode.all.min.js"></script>
    <script>
        function generateAndPrintNota() {
            const form = document.getElementById('transaksiForm');
            const wisata = form.wisata_id.options[form.wisata_id.selectedIndex].text;
            const harga = form.harga_tiket.value;
            const barcodeValue = `${wisata}-${harga}`;

            JsBarcode("#barcode", barcodeValue, { format: "CODE128", displayValue: true, fontSize: 18 });

            setTimeout(() => {
                const barcodeSvg = document.getElementById('barcode').outerHTML;

                const printWindow = window.open('', '', 'height=600,width=800');
                printWindow.document.write('<html><head><title>Nota Transaksi</title>');
                printWindow.document.write('<style>body { font-family: Arial, sans-serif; } .nota { padding: 20px; border: 1px solid #ddd; margin-top: 20px; } .nota h2 { text-align: center; } .nota p { margin: 5px 0; } .nota .barcode { text-align: center; }</style>');
                printWindow.document.write('</head><body>');
                printWindow.document.write('<div class="nota">');
                printWindow.document.write('<h2>Nota Transaksi</h2>');
                printWindow.document.write('<p><strong>Nama Wisata:</strong> ' + wisata + '</p>');
                printWindow.document.write('<p><strong>Harga Tiket:</strong> Rp ' + new Intl.NumberFormat('id-ID', { minimumFractionDigits: 2 }).format(harga) + '</p>');
                printWindow.document.write('<div class="barcode">' + barcodeSvg + '</div>');
                printWindow.document.write('</div>');
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.onload = function() {
                    printWindow.print();
                };
            }, 500);
        }
    </script>
@endsection
