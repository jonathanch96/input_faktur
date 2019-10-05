<?php

namespace App\Exports;

use App\Model\Inventory;
use App\Model\DataPembelian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Excel;

class DataPembelianExport implements FromCollection,WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$data_inventory = Inventory::all();
    	$data_pembelian = DataPembelian::groupBy("no_pib")->get();
    	$data_excel=array();
    	$header1=array("");
    	$header2=array("");
    	$header3=array("Nama Item");
    	foreach ($data_pembelian as $key => $dp) {
    		array_push($header1, $dp->no_pib);
            array_push($header1, "");
    		array_push($header2, \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(date_create($dp->tgl_pib)));
            array_push($header2, "");
            array_push($header3, "Qty");
    		array_push($header3, "Harga (".$dp->getMataUang->kode_mata_uang.")");
    	}

    	array_push($data_excel, $header1);
    	array_push($data_excel, $header2);
    	array_push($data_excel, $header3);
    	foreach ($data_inventory as $key => $di) {
    		$temp_data = array($di->nama_barang);
    		$count=0;
    		foreach ($data_pembelian as $key => $dp) {
    			$temp_data_pembelian = DataPembelian::where('no_pib',"=",$dp->no_pib)->where('item_id',"=",$di->id)->get();
    			if(!$temp_data_pembelian->isEmpty()){
    				$count=0;
                    $harga=0;
    				foreach ($temp_data_pembelian as $key => $tdp) {
                        $count+=$tdp->qty;
    					$harga=$tdp->harga_beli;
    				}
                    array_push($temp_data, $count);
    				array_push($temp_data, $harga);
    			}else{
                    array_push($temp_data, 0);
    				array_push($temp_data, 0);

    			}
    		}
			array_push($data_excel, $temp_data);

    	}



    	$data_excel = collect($data_excel)->map(function($inner_child){
   		 return (Object) $inner_child;
		});
        return $data_excel;
    }
}
