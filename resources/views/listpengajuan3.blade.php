@extends('layouts.mainlayout')


{{-- untuk judul --}}
@section('title','finance page')

{{-- template navbar, bootstrap dan body --}}
@yield('navbar')

{{-- section content adalah konten utama websitenya, berada dibawah navbar ,note: tidak perlu menggunakan tag body lagi--}}
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Session::has('status-approve'))
<div class="alert alert-success">
    {{ session('message-approve') }}
</div>
@elseif  (Session::has('status-reject'))
<div class="alert alert-danger">
    {{ session('message-reject') }}
</div>
@elseif  (Session::has('status-upload'))
<div class="alert alert-success">
    {{ session('message-upload') }}
</div>
@endif
<div class="mt-5 col-12 m-auto">
    <div class="container">
        <h2>finance page</h2>
        <h2>tabel pengajuan pembelian barang </h2>
        <form action="" method="get">
            <div class="input-group mb-3 mt-5">
              <input type="text" name="keyword" class="form-control" placeholder="masukan kode pengajuan">
              <div class="input-group-append">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </div>
            </div>
          </form>
        <table class="table">
            <thead>
                <tr>
                    <th>kode pengajuan</th>
                    <th>Nama Pengaju</th>
                    <th>Barang</th>
                    <th>Total Harga</th>
                    <th>tindakan</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach($data as $transaksi)
                    <tr>
                        <td>{{ $transaksi->kode_pengajuan}}</td>
                        <td>{{ $transaksi->user->name }}</td>
                        <td>
                            <ul>
                                @foreach($transaksi->transaksi_item as $detail)
                                <li>
                                    <p> 
                                        {{ $detail-> nama_barang  }} <br>
                                        ({{$detail->harga}}*{{$detail -> quantity}}  = {{ $detail->harga * $detail->quantity }}
                                        )
                                    </p>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            {{$transaksi->total_harga}}
                        </td>
                        <td>
                            @if($transaksi->status_from_manager == 'ditolak')
                            <div class="alert alert-danger" role="alert">
                                <p>manager: {{$transaksi ->status_from_manager}} </p>
                                <p>alasan : {{$transaksi ->alasan_penolakan_manager}} </p>
                            </div> 
                            @elseif($transaksi ->status_from_manager == 'diterima' && $transaksi ->status_from_finance == 'diterima')
                                @if($transaksi -> image !='')
                                <div> 
                                <a href="/detailfotofinance/{{$transaksi->id}}">
                                    <img src="{{asset('storage/img/'.$transaksi['image'])}}" alt="asdad" width="100px">
                                </a>
                                <div class="alert alert-success" role="alert">
                                    <p>finance: {{$transaksi ->status_from_manager}} </p>
                                    <p>pengajuan pembelian barang sukses</p>
                                </div>
                                </div>
                                @else
                                <a class="btn btn-primary " href="/uploadbuktitransferfinance/{{$transaksi['id']}}">upload bukti transfer</a>
                                @endif
                            @elseif($transaksi ->status_from_manager == 'diterima' && $transaksi ->status_from_finance == 'ditolak')
                             <div class="alert alert-danger" role="alert">
                            <p>Finance : {{$transaksi ->status_from_finance}} </p>
                            <p>alasan : {{$transaksi ->alasan_penolakan_finance}} </p>
                            </div> 
                            @elseif($transaksi->status_from_manager == 'diterima' && $transaksi ->status_from_finance == null)
                            <form action="/prosesfinance" method="post">
                                @csrf 
                                <input type="hidden" name="kode" value="{{$transaksi->kode_pengajuan}}">
                                <input type="hidden" name="status" value="diterima">
                                <button type="submit" id="acc" class="btn btn-success">accept</button>
                            </form>
                            <form action="/prosesfinance" method="post">
                                @csrf 
                                <button type="button" id="reject1" class="btn btn-danger" onclick="showTextField()">reject</button>
                                <div id="alasanPenolakan" style="display: none;" >
                                    <input type="text" name="alasan" placeholder="Alasan Penolakan">
                                </div>
                                <input type="hidden" name="kode" value="{{$transaksi->kode_pengajuan}}">
                                <input type="hidden" name="status" value="ditolak">
                                <button type="submit" id="reject2" style="display: none;" class="btn btn-danger">reject</button>
                            </form>
                           @endif 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <div>
        {{$data ->withQueryString() -> links()}}
    </div>
    </div>
</div>
<script>
    function showTextField() {
        // Mengubah display menjadi 'block' untuk menampilkan textfield
        document.getElementById('reject1').style.display = 'none';
        document.getElementById('acc').style.display = 'none';
        document.getElementById('alasanPenolakan').style.display = 'block';
        document.getElementById('reject2').style.display = 'block';
    }
</script>


   
    
@endsection