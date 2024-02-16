@extends('layouts.mainlayout')


{{-- untuk judul --}}
@section('title','officer page')

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
@if (Session::has('status-success'))
<div class="alert alert-success">
    {{ session('message-success') }}
</div>
@endif
<div class="mt-5 col-12 m-auto">
    <div class="container">
        <h2>officer page</h2>
        <h2>tabel pengajuan pembelian barang </h2>

        <form action="" method="get">
            <div class="input-group mb-3 mt-5">
              <input type="text" name="keyword" class="form-control" placeholder="masukan kode pengajuan">
              <div class="input-group-append">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </div>
            </div>
          </form>

        <a class="btn btn-primary " href="/input-pengajuan-barang">+ tambah pengajuan barang</a>
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
                        <td>{{ $transaksi->kode_pengajuan }}</td>
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
                                <div class="alert alert-success" role="alert">
                                    <p>finance: {{$transaksi ->status_from_manager}} </p>
                                    <p>pengajuan pembelian barang sukses</p>
                                </div>
                                </div>
                                @else
                                <div class="alert alert-primary" role="alert">
                                    <p>finance: {{$transaksi ->status_from_manager}} </p>
                                    <p>pembelian barang sedang diproses</p>
                                </div>
                                @endif
                            @elseif($transaksi ->status_from_manager == 'diterima' && $transaksi ->status_from_finance == 'ditolak')
                             <div class="alert alert-danger" role="alert">
                            <p>Finance : {{$transaksi ->status_from_finance}} </p>
                            <p>alasan : {{$transaksi ->alasan_penolakan_finance}} </p>
                            </div> 
                            @elseif($transaksi->status_from_manager == 'diterima')
                            <div class="alert alert-primary" role="alert">
                                <p>manager: {{$transaksi ->status_from_manager}} </p>
                                <p>sedang proses pengajuan ke bagian finance</p>
                            </div>
                             @else
                             <div class="alert alert-primary" role="alert">
                                <p>proses pengajuan ke manager belum dilakukan tindakan</p>
                            </div>               
                           @endif 
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{$data ->withQueryString() -> links()}}
        </div>
    </div>
</div>


   
@endsection