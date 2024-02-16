<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\transaksi;
use App\Models\transaksi_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class officerController extends Controller
{
    public function formajuan(){

        $data = barang::all();
        return view('formajuanbarang', ['data' => $data]);

    }
       public function listpengajuan(Request $request){

        $keyword = $request -> keyword;

        $data = transaksi::with((['transaksi_item','User']))-> where('kode_pengajuan', 'LIKE' , '%'.$keyword.'%')-> paginate(10);

        return view('listpengajuan' , ['data' => $data] );

    }


    public function prosesformajuan(Request $request){
        
       
        $request->validate([
            'items' => 'required|array|min:1', 
            'quantities' => 'required|array|min:1',
            'quantities.*' => 'required|numeric|min:1', 
        ]);

        $aray = array_unique($request->items);
        
       
        if (count($aray) < count($request->quantities)) {
            return '<script>
            if (confirm("input item tidak boleh duplikat dalam 1 pengajuan")) {
                window.location.href = "/input-pengajuan-barang";
            }
                </script>';
        }else{
                
            $lastCode = transaksi::max('kode_pengajuan');
            $newCode = $lastCode ? str_pad((int)$lastCode + 1, 3, '0', STR_PAD_LEFT) : '001';

            $transaksi = new transaksi;
            $transaksi -> kode_pengajuan = $newCode;
            $transaksi -> user_id = 1;
            $transaksi -> save();

            

            for ($i = 0; $i < count($request -> items); $i++) {
                $barang = barang::where('id',$request->items[$i])->firstOrFail();
                $Transaksi_item = new transaksi_item;
                $Transaksi_item->id_transaksi = transaksi::max('id');
                $Transaksi_item->id_item = $request->items[$i];
                $Transaksi_item->nama_barang = $barang -> nama_barang;
                $Transaksi_item->harga = $barang -> harga;
                $Transaksi_item->quantity= $request ->quantities[$i];

                $Transaksi_item->save();
            }

            $lastidtransaksi= transaksi::max('id');
            $transaksiitemlast = transaksi_item::where('id_transaksi',$lastidtransaksi)->get();
            $total = 0;
            for ($i = 0; $i < count($transaksiitemlast); $i++) {
                $total = $total + $transaksiitemlast[$i]['harga']*$transaksiitemlast[$i]['quantity'];
                }
            $transaksitotalhargaupdate = transaksi::latest()->first();
            $transaksitotalhargaupdate -> total_harga = $total;
            $status = $transaksitotalhargaupdate ->save ();

            if ($status) {
                FacadesSession::flash('status-success','oke');
                FacadesSession::flash('message-success','pembelian barang berhasil diajukan');
        }

        return redirect('/list-pengajuan');
            
        }

    }


    
}
