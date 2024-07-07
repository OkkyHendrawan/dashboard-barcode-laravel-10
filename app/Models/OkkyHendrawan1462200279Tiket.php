<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OkkyHendrawan1462200279Tiket extends Model
{
    use HasFactory;
    protected $table = 'okky_hendrawan1462200279_tikets';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_wisata', 'harga_tiket', 'gambar'
    ];

    static public function getTiket()
    {
        return self::select('okky_hendrawan1462200279_tikets.*')
            ->where('okky_hendrawan1462200279_tikets.is_delete', 0)
            ->orderBy('id', 'desc')
            ->paginate(5);
    }


    static public function softDeleteTiket($id)
    {
        $tiket = self::find($id);

        if ($tiket) {
            $tiket->is_delete = 1;
            $tiket->save();
        }

        return $tiket;
    }

    public static function daftarTransaksi()
    {
        return self::where('is_delete', 0)->orderBy('nama_wisata', 'asc')->get();
    }

}
