<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';
    public $timestamps =false;
    protected $fillable = [
        'nama_barang',
   	];
   	public function getDataPembelian(){
       return $this->hasMany('App\Model\DataPembelian','item_id','id');
    }
}
