<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\DataPembelian;
use App\Model\Inventory;
use App\Model\MataUang;
use Illuminate\Support\Facades\Input;
use Excel;
use App\Exports\DataPembelianExport;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showView()
    {
        $mata_uang = MataUang::orderBy("kode_mata_uang")->get();
        return view('home',[
            "mata_uang"=>$mata_uang,
        ]);
    }
    public function doAddNewDataPembelian(Request $request){
        $this->validate($request,[
            "nama_barang"=>"required",
            "qty"=>"required",
            "kode_mata_uang"=>"required",
            "harga_beli"=>"required|between:0,99.99",
            "tgl_pib"=>"required|date_format:m/d/Y",
            "no_pib"=>"required",
        ],[
            "nama_barang.required"=>"Nama Barang Tidak Boleh Kosong",
            "qty.required"=>"Qty Tidak Boleh Kosong",
            "kode_mata_uang.required"=>"Kode Mata Uang Tidak Boleh Kosong",
            "harga_beli.required"=>"Harga Beli Tidak Boleh Kosong",
            "harga_beli.between"=>"Format Harga Beli Salah",
            "tgl_pib.required"=>"Nama Barang Tidak Boleh Kosong",
            'tgl_pib.date_format'=>'Format Tanggal Salah (ex : 01/31/2018)',
            "no_pib.required"=>"Nama Barang Tidak Boleh Kosong",
        ]);
        $date = explode("/",$request->tgl_pib);
        $month = $date[0];
        $day = $date[1];
        $year = $date[2];
        $input_date = $year."-".$month."-".$day;
        $data_barang = Inventory::find($request->nama_barang);
        $data_matauang = MataUang::find($request->kode_mata_uang);
        DataPembelian::create([
            'tgl_pib'=>$input_date,
            'no_pib'=>$request->no_pib,
            'item_id'=>$data_barang->id,
            'item_name'=>$data_barang->nama_barang,
            'qty'=>$request->qty,
            'id_mata_uang'=>$data_matauang->id,
            'kode_mata_uang'=>$data_matauang->kode_mata_uang,
            'harga_beli'=>str_replace(",", ".", $request->harga_beli),
        ]);
        return redirect(url('home'))->with('status','Berhasil Menambah Data Item '.$request->item_name)->withInput(Input::except(['nama_barang','qty','kode_mata_uang','harga_beli']));;
    }
    public function doExportData(Request $request){
        ini_set('max_execution_time', -1); // unlimited
        return Excel::download(new DataPembelianExport($request->year), date("Y-m(M)-d H:i")."_Data_pembelian".'.xlsx');
        
    }
    public function doEditDataPembelian(Request $request,$id){
        $this->validate($request,[
            "nama_barang"=>"required",
            "qty"=>"required",
            "kode_mata_uang"=>"required",
            "harga_beli"=>"required|between:0,99.99",
            "tgl_pib"=>"required|date_format:m/d/Y",
            "no_pib"=>"required",
        ],[
            "nama_barang.required"=>"Nama Barang Tidak Boleh Kosong",
            "qty.required"=>"Qty Tidak Boleh Kosong",
            "kode_mata_uang.required"=>"Kode Mata Uang Tidak Boleh Kosong",
            "harga_beli.required"=>"Harga Beli Tidak Boleh Kosong",
            "harga_beli.between"=>"Format Harga Beli Salah",
            "tgl_pib.required"=>"Nama Barang Tidak Boleh Kosong",
            'tgl_pib.date_format'=>'Format Tanggal Salah (ex : 01/31/2018)',
            "no_pib.required"=>"Nama Barang Tidak Boleh Kosong",
        ]);
        $date = explode("/",$request->tgl_pib);
        $month = $date[0];
        $day = $date[1];
        $year = $date[2];
        $input_date = $year."-".$month."-".$day;
        $data_barang = Inventory::find($request->nama_barang);
        $data_matauang = MataUang::find($request->kode_mata_uang);
        $data_pembelian = DataPembelian::find($id);
         $data_pembelian->update([
            'tgl_pib'=>$input_date,
            'no_pib'=>$request->no_pib,
            'item_id'=>$data_barang->id,
            'item_name'=>$data_barang->nama_barang,
            'qty'=>$request->qty,
            'id_mata_uang'=>$data_matauang->id,
            'kode_mata_uang'=>$data_matauang->kode_mata_uang,
            'harga_beli'=>str_replace(",", ".", $request->harga_beli),
        ]);
        return redirect(url('home'))->with('status','Berhasil Edit Data Item '.$request->item_name)->withInput(Input::except(['nama_barang','qty','kode_mata_uang','harga_beli']));
    }
    public function doDeleteDataPembelian(Request $request){
        DataPembelian::find($request->pembelian_id)->delete();
        return redirect(url('home'))->with('status','Berhasil Menghapus Data');

    }
}
