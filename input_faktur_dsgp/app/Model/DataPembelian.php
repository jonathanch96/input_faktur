<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DataPembelian extends Model
{
    protected $table = 'data_pembelian';
    public $timestamps =false;
    protected $fillable = [
        'tgl_pib',
        'no_pib',
        'item_id',
        'item_name',
        'qty',
        'id_mata_uang',
        'kode_mata_uang',
        'harga_beli',
   	];
    public function getMataUang(){
        return $this->hasOne("App\Model\MataUang","id","id_mata_uang");
    }
}
