<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Inventory;
use DB;
use Datatables;

class APIHandler extends Controller
{

	public function getInventory(){
		$data = DB::table('inventory');
		return datatables()
		->of($data)
		->editColumn('created_at', '{{date_format(date_create($created_at),"d F Y H:i:s")}}')
		->editColumn('updated_at', '{{date_format(date_create($updated_at),"d F Y H:i:s")}}')
		->toJson();
	}
	public function getDataPembelian(){
		$data = DB::table('data_pembelian');
		return datatables()
		->of($data)
		->addColumn('action', function ($dp) {
			return " <button type='button'
			data-toggle='modal'
			data-target='#insertModal'
			data-title='Edit Data Pembelian'
			data-link='".url('edit_data_pembelian')."/".$dp->id."'
			data-itemid='".$dp->item_id."'
			data-nopib='".$dp->no_pib."'
			data-qty='".$dp->qty."'
			data-matauang='".$dp->id_mata_uang."'
			data-hargabeli='".$dp->harga_beli."'
			data-tglpib='".date_format(date_create($dp->tgl_pib),'m/d/Y')."'
			data-btnsrc='edit'
			style='background-color: black;' class='btn btn-primary btn-sm'>
			Edit 
			</button>
			<button type='button'
			data-toggle='modal'
			data-target='#deleteModal'
			data-id='".$dp->id."'
			style='background-color: red;' class='btn btn-primary btn-sm'>
			Delete 
			</button>
			";
		})
		->toJson();
	}
	public function getItemsOption(Request $request){
		$data = array();
		$results = array();
		$temp_data = Inventory::all();
		foreach ($temp_data as $key => $td) {
			if(stripos($td['nama_barang'],$request->search??"")!==FALSE||$request->search==""){
				array_push($results, [
					'id'=>$td['id'],
					'text'=>$td['nama_barang'],
				]);
			}
		}
		usort($results, function($a, $b) {
			return $a['text']< $b['text'] ? 1 : -1;
		});
		$data = [
			'results'=>$results,
			'pagination'=>[
				'more'=>false,
			]
		];


		return json_encode($data);
	}
	public function getSingleItem($id){
		$data = array();
		$temp_data = Inventory::find($id);
		if($temp_data){
			$data = [
				'id'=>$id,
				'text'=>$temp_data->nama_barang
			];
		}
		return json_encode($data);
	}
}
