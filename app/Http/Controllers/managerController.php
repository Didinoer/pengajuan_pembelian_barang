<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class managerController extends Controller
{
    public function listpengajuanofficer(Request $request){
        $keyword = $request -> keyword;

        $data = transaksi::with((['transaksi_item','User']))-> where('kode_pengajuan', 'LIKE' , '%'.$keyword.'%')-> paginate(10);

        return view('listpengajuan2' , ['data' => $data] );
    }

    public function prosesmanager(Request $request){
        $data = transaksi::where('kode_pengajuan', $request -> kode)->firstOrFail();
        if($request -> status == 'diterima'){
        $data['status_from_manager'] = $request->status;
        $status  = $data -> save();
        if ($status) {
            FacadesSession::flash('status-approve','oke');
            FacadesSession::flash('message-approve','berhasil diapprove!');
        }} else{
            // dd($request->penolakan);
            $data['status_from_manager'] = $request->status;
            $data['alasan_penolakan_manager'] = $request -> alasan;
            $status  = $data -> save();
            if ($status) {
                FacadesSession::flash('status-reject','oke');
                FacadesSession::flash('message-reject','berhasil direject');
        }}
    
        return redirect('/list-pengajuan-officer');
        
    }
    public function detailfotomanager($id){
        $data = transaksi::findOrFail($id);
        return view('detail_foto_manager', ['data' => $data]);
    
}

}