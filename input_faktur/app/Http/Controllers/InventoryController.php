<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Inventory;

class InventoryController extends Controller
{
    public function showView(){
    	$inventory_data = Inventory::orderBy("nama_barang")->get();
    	return view('inventory',[
    		"inventory_data"=>$inventory_data,
    	]);

    }
    public function doAddNewItem(Request $request){
    	$this->validate($request,[
    		"item_name"=>"required|unique:inventory,nama_barang"
    	],[
    		"item_name.required"=>"Nama Item Tidak Boleh Kosong",
    		"item_name.unique"=>"Nama Item Sudah Ada"
    	]);
    	Inventory::create([
    		'nama_barang'=>$request->item_name
    	]);
    	return redirect(url('inventory'))->with('status','Berhasil Menambah Data Item '.$request->item_name);

    }
}
