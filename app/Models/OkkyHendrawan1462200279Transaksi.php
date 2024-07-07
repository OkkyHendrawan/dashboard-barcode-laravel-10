<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OkkyHendrawan1462200279Transaksi extends Model
{
    use HasFactory;
    protected $table = 'okky_hendrawan1462200279_transaksis';
    protected $primaryKey = 'id';

    protected $fillable = [
        'harga_tiket', 'wisata_id'
    ];

    static public function getTransaksi()
    {
        return self::select('okky_hendrawan1462200279_transaksis.*', 'okky_hendrawan1462200279_tikets.nama_wisata')
            ->join('okky_hendrawan1462200279_tikets', 'okky_hendrawan1462200279_transaksis.wisata_id', '=', 'okky_hendrawan1462200279_tikets.id')
            ->where('okky_hendrawan1462200279_transaksis.is_delete', 0)
            ->orderBy('okky_hendrawan1462200279_transaksis.id', 'desc')
            ->paginate(5);
    }


    static public function softDeleteTransaksi($id)
    {
        $transaksi = self::find($id);

        if ($transaksi) {
            $transaksi->is_delete = 1;
            $transaksi->save();
        }

        return $transaksi;
    }

    public function wisata()
    {
        return $this->belongsTo(OkkyHendrawan1462200279Tiket::class, 'wisata_id', 'id');
    }

}
