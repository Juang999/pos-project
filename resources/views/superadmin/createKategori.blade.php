@extends('layouts.dashboard')

@section('dashboard', 'Tambah Kategori')

@section('content')

<div class="card">
    <div class="card-header">
      Tambah kategori
    </div>
    <div class="card-body">
        <form method="POST" action="/super-admin/storeKategori">
            <div class="form-group">
              <label for="Kategori">Kategori</label>
              <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="Kategori" name="kategori">
              @error('kategori')
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
