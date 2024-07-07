<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OkkyHendrawan1462200279Home extends Model
{
    use HasFactory;
    protected $table = 'okky_hendrawan1462200279_homes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nbi', 'nama'
    ];

    static public function getHome()
    {
        return self::select('okky_hendrawan1462200279_homes.*')
            ->where('okky_hendrawan1462200279_homes.is_delete', 0)
            ->orderBy('id', 'desc')
            ->paginate(5);
    }


    static public function softDeleteHome($id)
    {
        $home = self::find($id);

        if ($home) {
            $home->is_delete = 1;
            $home->save();
        }

        return $home;
    }

}
