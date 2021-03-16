@extends('layouts.dashboard')

@section('dashboard', 'Tambah Supplier')

@section('content')

<div class="card">
    <h5 class="card-header">Tambah Supplier</h5>
    <div class="card-body">
        <form method="post" action="/super-admin/storeSupplier">
            <div class="form-group">
              <label for="supplier">Supplier</label>
              <input type="text" class="form-control @error('supplier') is-invalid @enderror" id="supplier" name="supplier">
              @error('supplier')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
                <label for="alamat">alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

            <div class="form-group">
                <label for="nomor_telepon">nomor telepon</label>
                <input type="number" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon">
                @error('nomor_telepon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

            @csrf
          </form>
          <a href="/super-admin/staf/" class="btn btn-dark" style="margin-top: 13px">Kembali</a>
    </div>
  </div>

@endsection
