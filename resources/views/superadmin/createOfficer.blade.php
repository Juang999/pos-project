@extends('layouts.dashboard')

@section('dashboard', 'Registrasi')

@section('content')
@if (session('status'))
<div class="alert alert-danger">
    {{ session('status') }}
</div>
@endif
<div class="card">
    <div class="card-header">
      Registrasi
    </div>
    <div class="card-body">
        <form method="POST" action="/super-admin/storeOfficer">
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                @error('name')
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
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password Confirmation</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="custom-select @error('role') is-invalid @enderror" id="role" name="role">
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <option selected>Open this select menu</option>
                    <option value="2">Kasir</option>
                    <option value="3">Staf</option>
                    <option value="4">Leader</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            @csrf
        </form>
    </div>
  </div>
@endsection
