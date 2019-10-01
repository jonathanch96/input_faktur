<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MataUang extends Model
{
    protected $table = 'mata_uang';
    public $timestamps =false;
    protected $fillable = [
        'kode_mata_uang',
        'nama_mata_uang',
   	];
   
}
