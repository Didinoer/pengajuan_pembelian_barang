<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class financeController extends Controller
{
    public function listpengajuanmanager(Request $request){
        
        $keyword = $request -> keyword;
        $data = transaksi::with((['transaksi_item','User']))->where('status_from_manager','diterima')
                                                            -> Where('kode_pengajuan','LIKE' ,'%'.$keyword.'%')-> paginate(10);
                                                           

        return view('listpengajuan3' , ['data' => $data] );

    }

    public function prosesfinance(Request $request){
        $data = transaksi::where('kode_pengajuan', $request -> kode)->firstOrFail();
        if($request -> status == 'diterima'){
        $data['status_from_finance'] = $request->status;
        $status  = $data -> save();
        if ($status) {
            FacadesSession::flash('status-approve','oke');
            FacadesSession::flash('message-approve','berhasil diapprove!');
        }} else{
            // dd($request->penolakan);
            $data['status_from_finance'] = $request->status;
            $data['alasan_penolakan_finance'] = $request -> alasan;
            $status  = $data -> save();
            if ($status) {
                FacadesSession::flash('status-reject','oke');
                FacadesSession::flash('message-reject','berhasil direject');
        }}
    
        return redirect('/list-pengajuan-manager');
        
    }

    public function uploadbuktitransferfinance($id){
          
            $data = transaksi::findOrFail($id);
            return view('uploadfotoform', ['data' => $data]);
         
       
    }

    public function uploadbuktitransferfinanceproses(Request $request, $id){
      
        $data = transaksi::findOrFail($id);
        $request->validate([
            'image' => 'required|image|max:2048', // Maksimum 2MB
        ]);
        if($request -> file('image')){
            $ext = $request-> file('image') -> getClientOriginalExtension();
            $imgname = 'img'.now()->timestamp.'.'.$ext;
            $request -> file('image') -> storeAs('img', $imgname);
        }
        $data->image = $imgname;
        $status = $data -> save();

    if ($status) {
        FacadesSession::flash('status-upload','oke');
        FacadesSession::flash('message-upload','berhasil diupload');
    }

    return redirect('/list-pengajuan-manager');
     
   
}
    public function detailfotofinance($id){
            $data = transaksi::findOrFail($id);
            return view('detail_foto_finance', ['data' => $data]);
        
    }

}
