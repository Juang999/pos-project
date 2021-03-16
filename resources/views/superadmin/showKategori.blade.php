@extends('layouts.dashboard')

@section('dashboard', 'Edit kategori')

@section('content')

<div class="card">
    <div class="card-header">
      Edit Kategori
    </div>
    <div class="card-body">
        <form method="POST" action="/super-admin/editKategori/{{ $kategori->id }}">
            <div class="form-group">
              <label for="kategori">Kategori</label>
              <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" value="{{ $kategori->kategori }}">
            @error('kategori')
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
