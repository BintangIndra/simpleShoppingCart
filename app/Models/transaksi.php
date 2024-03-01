<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\master_data;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    protected $fillable = [
        'id',
        'idTransaksi',
        'master_data_id',
        'jumlah',
    ];

    public function master_data()
    {
        return $this->belongsTo(master_data::class);
    }
}
