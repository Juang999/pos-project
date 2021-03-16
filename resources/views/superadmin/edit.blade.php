@extends('layouts.dashboard')

@section('dashboard', 'Edit Barang')

@section('content')

<center>
    <div class="card">
        <h5 class="card-header">Edit Data Barang</h5>
        <div class="card-body">
            <form method="POST" action="{{ url('/super-admin/edit/'.$barang->id) }}">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}">
                </div>
                <label>Supplier</label>
                <select class="custom-select" name="supplier_id">
                    <option selected>{{ $barang->supplier->supplier }}</option>
                    @foreach ($supplier as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->supplier }}</option>
                    @endforeach
                  </select>
                <label style="margin-top: 15px">Kategori</label>
                <select class="custom-select" name="kategori_id">
                    <option selected>{{ $barang->kategori->kategori }}</option>
                    @foreach ($kategori as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                    @endforeach
                  </select>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $barang->jumlah }}">
                </div>
                <div class="form-group">
                    <label for="harga_beli">harga_beli</label>
                    <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{ $barang->harga_beli }}">
                </div>
                <div class="form-group">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ $barang->harga_jual }}">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 15px">Submit</button>
                @method('PATCH')
                @csrf
            </form>
            <a href="/super-admin/staf/" class="btn btn-dark" style="margin-top: 10px">Kembali</a>
        </div>
      </div>
</center>

@endsection
