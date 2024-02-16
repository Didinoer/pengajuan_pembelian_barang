@extends('layouts.mainlayout')


{{-- untuk judul --}}
@section('title','form pengajuan barang')

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


<div class="mt-5 col-8 m-auto">

    <h2>finance page</h2>
    <h2>tabel pengajuan pembelian barang </h2>
    <form action="/prosesformajuan" method="post" enctype="multipart/form-data">
        @csrf
    <div id="items-container">  
    </div>
    <div>
        <button type="button" class="btn btn-primary" id="add-item">Tambah Item Lain</button>
    </div>
    <div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </div>
</form>

<script>
    document.getElementById('add-item').addEventListener('click', function() {
        var container = document.getElementById('items-container');
        var div = document.createElement('div');
        div.classList.add('form-group');
        div.innerHTML = `
            <label for="items">Barang</label>
            <select name="items[]" class="form-control">
                @foreach($data as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                @endforeach
            </select>
            <input type="number" name="quantities[]" class="form-control" placeholder="Jumlah">
        `;
        container.appendChild(div);
    });
</script>

   
    
@endsection