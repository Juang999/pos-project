@extends('layouts.dashboard')

@section('dashboard', 'Edit Barang')

@section('content')

<center>
    <div class="card">
        <h5 class="card-header">Edit Data Barang</h5>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}">
                </div>
                <label>Supplier</label>
                <select class="custom-select">
                    <option selected>{{ $barang->supplier->supplier }}</option>
                    @foreach ($supplier as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->supplier }}</option>
                    @endforeach
                  </select>
                <label style="margin-top: 15px">Kategori</label>
                <select class="custom-select">
                    <option selected>{{ $barang->kategori->kategori }}</option>
                    @foreach ($kategori as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                    @endforeach
                  </select>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 15px">Submit</button>
                @method('patch')
                @csrf
            </form>
        </div>
      </div>
</center>

@endsection
