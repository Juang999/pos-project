@extends('layouts.dashboard')

@section('dashboard', 'create Transaction')

@section('content')

 <div class="card">
    <div class="card-header">
      Buat Transaksi Pengeluaran
    </div>


    <div class="card-body">
        <form method="POST" action="/super-admin/storeTransaction">
            <div class="mb-3">
                <label for="Keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="Keterangan" name="keterangan" value="{{ $trans->keterangan }}">
                @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ $trans->jumlah }}">
                @error('jumlah')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
            <label for="total" class="form-label">Jumlah Pengeluaran</label>
              <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{ $trans->pengeluaran }}">
                @error('total')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <center>
                <div>
                    <button type="submit" class="btn btn-primary" style="margin-bottom: 15px">Submit</button>
                </div>
            </center>
            @csrf
          </form>
          <center>
              <form action="/super-admin/deleteTransaction/{{ $trans->id }}" method="post">
                  <button type="submit" class="btn btn-danger">Hapus</button>
                  @method('delete')
                  @csrf
                </form>
            <a href="/super-admin/transaction" class="btn btn-dark" style="margin-top: 13px">Kembali</a>
        </center>
    </div>
  </div>

@endsection
