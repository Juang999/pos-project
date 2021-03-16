@extends('layouts.dashboard')

@section('dashboard', 'Registrasi')

@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('danger') }}
</div>
@endif
<div class="card">
    <div class="card-header">
      Registrasi
    </div>
    <div class="card-body">
        <form>
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="nomor_telepon">nomor telepon</label>
                <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="custom-select" id="role" name="role">
                    <option selected>Open this select menu</option>
                    <option value="1">Member</option>
                    <option value="2">Kasir</option>
                    <option value="3">Staf</option>
                    <option value="4">Leader</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
  </div>
@endsection
