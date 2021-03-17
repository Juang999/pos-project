@extends('layouts.dashboard')

@section('dashboard', 'Edit Karyawan')

@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<div class="card">
    <div class="card-header">
      Registrasi
    </div>
    <div class="card-body">
        <form method="POST" action="/super-admin/editOfficer/{{ $officer->id }}">
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $officer->name }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nomor_telepon">nomor telepon</label>
                <input type="number" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{ $officer->nomor_telepon }}">
                @error('nomor_telepon')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $officer->email }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="custom-select @error('role') is-invalid @enderror" id="role" name="role">
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <option selected>
                        @if ($officer->role == 2)
                            kasir
                        @elseif ($officer->role == 3)
                            staf
                        @elseif ($officer->role == 4)
                            leader
                        @endif
                    </option>
                    <option value="2">Kasir</option>
                    <option value="3">Staf</option>
                    <option value="4">Leader</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            @method('patch')
            @csrf
        </form>
    </div>
  </div>
@endsection
