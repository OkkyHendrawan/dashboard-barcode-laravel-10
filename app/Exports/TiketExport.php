<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TiketExport implements FromCollection, WithHeadings, WithMapping
{
    protected $tiket;

    public function __construct($tiket)
    {
        $this->tiket = $tiket;
    }

    public function collection()
    {
        return $this->tiket;
    }

    public function headings(): array
    {
        return [
            'No',
            'Gambar Wisata',
            'Nama Wisata',
            'Harga Tiket',
            'Dibuat Pada',
            'Diperbarui Pada'
        ];
    }

    public function map($tiket): array
    {
        return [
            $tiket->id,
            asset('gambar-wisata/' . $tiket->gambar),
            $tiket->nama_wisata,
            'Rp ' . number_format($tiket->harga_tiket, 2, ',', '.'),
            $tiket->created_at->format('d-m-Y'),
            $tiket->updated_at->format('d-m-Y')
        ];
    }
}
