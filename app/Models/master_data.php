<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\transaksi;


class master_data extends Model
{
    use HasFactory;
    protected $table = 'master_data';

    protected $fillable = [
        'harga',
        'nama',
        'kode',
    ];

    public function getId(){
        return master_data::select('id')->groupBy('id')->get();
    }

    public function transaksi()
    {
        return $this->hasMany(transaksi::class);
    }
}
