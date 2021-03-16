@extends('layouts.dashboard')

@section('dashboard', 'Edit Supplier')

@section('content')

<div class="card">
    <div class="card-header">
      Edit Suppiler
    </div>
    <div class="card-body">
      <form method="post" action="/super-admin/editSupplier/{{ $supplier->id }}">
        <div class="form-group">
          <label for="supplier">Email address</label>
          <input type="text" class="form-control @error('supplier') is-invalid @enderror" id="supplier" name="supplier" value="{{ $supplier->supplier }}">
        @error('supplier')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ $supplier->alamat }}">
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        </div>
          <div class="form-group">
            <label for="nomor_telepon">Email address</label>
            <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{ $supplier->nomor_telepon }}">
        @error('nomor_telepon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        @method('patch')
        @csrf
      </form>
      <a href="/super-admin/staf/" class="btn btn-dark" style="margin-top: 13px">Kembali</a>
    </div>
  </div>

@endsection
