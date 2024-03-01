<?php

namespace App\Repositories;

use App\Models\Transaksi;

class TransaksiRepository implements TransaksiRepositoryInterface
{
    protected $Transaksi;

    public function __construct(Transaksi $Transaksi)
    {
        $this->Transaksi = $Transaksi;
    }

    public function all()
    {
        return $this->Transaksi->all();
    }

    public function findById($id)
    {
        return $this->Transaksi->where('idTransaksi',$id)->get();
    }

    public function update(array $data)
    {
        $transaksi = $this->Transaksi->findOrFail($data['id']);
        $transaksi->update($data);
        return $transaksi;
    }

    public function delete(int $id)
    {
        $transaksi = $this->Transaksi->findOrFail($id);
        $transaksi->delete();
        return $transaksi;
    }

    public function getTotal(array $data)
    {

        $transaksi = $this->Transaksi->where('idTransaksi',$data['idTransaksi'])->get();
        $total = 0;
        switch ($data['diskon']) {
            case 'FA111':
                foreach($transaksi as $val){
                    $total += $val->jumlah * $val->master_data->harga;
                }
                $total = $total - ($total/10);
                break;

            case 'FA222':
                foreach($transaksi as $val){
                    if ($val->master_data->kode == 'FA4532') {
                        $total += ($val->jumlah * $val->master_data->harga) - 50000;
                    }else{
                        $total += $val->jumlah * $val->master_data->harga;
                    }
                }
                break;

            case 'FA333':
                foreach($transaksi as $val){
                    if ($val->master_data->harga >= 400000) {
                        $total += ($val->jumlah * $val->master_data->harga) - ($val->jumlah *  ($val->master_data->harga * 0.06));
                    }else{
                        $total += $val->jumlah * $val->master_data->harga;
                    }
                }
                break;
            
            case 'FA444':
                foreach($transaksi as $val){
                    $total += $val->jumlah * $val->master_data->harga;
                }
                
                if ($val->created_at->format('N') == 2
                    && $created_at->format('H:i') >= '13:00' 
                    && $created_at->format('H:i') <= '15:00') {
                        $total = $total - ($total * 0.05);
                    }
                break;
                
            default:
                foreach($transaksi as $val){
                    $total += $val->jumlah * $val->master_data->harga;
                }
                break;
        }

        return $total;
    }
}