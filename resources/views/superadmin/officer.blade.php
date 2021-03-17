@extends('layouts.dashboard')

@section('dashboard', 'Super Admin')

@section('sidebar')
<li class="nav-item">
    <a href="/super-admin/staf" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Staf</p>
    </a>
</li>

<li class="nav-item">
    <a href="/super-admin/officer" class="nav-link">
      <i class="far fa-circle nav-icon"></i>
      <p>Officer</p>
    </a>
</li>

<li class="nav-item">
    <a href="/super-admin/transaction" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>transaction</p>
    </a>
</li>

<li class="nav-item">
    <a href="/super-admin/kasir" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Cashier</p>
    </a>
</li>

<li class="nav-item">
    <a href="/super-admin/attendance" class="nav-link">
      <i class="far fa-circle nav-icon"></i>
      <p>Attendance</p>
    </a>
</li>

<li class="nav-item">
    <a href="/super-admin/registration" class="nav-link">
      <i class="far fa-circle nav-icon"></i>
      <p>Officer Registration</p>
    </a>
</li>
@endsection

@section('content')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<div class="card-body" style="margin-bottom: 50px">
    <h3 style="margin-left: 20px">Pemimpin</h3>
    <a href="/super-admin/createOfficer" class="btn btn-success" style="margin-bottom: 13px">Daftarkan</a>
    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>No.</th>
        <th>Nama Lengkap</th>
        <th>Nomor Telepon</th>
        <th>Email</th>
        <th>role</th>
        <th>Hapus</th>
        <th>Edit</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($officer as $officer)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $officer->name }}</td>
          <td>{{ $officer->nomor_telepon }}</td>
          <td>{{ $officer->email }}</td>
          <td>
              @if ($officer->role == 1)
                    member
              @elseif ($officer->role == 2)
                    kasir
              @elseif ($officer->role == 3)
                    staff
              @elseif ($officer->role == 4)
                    leader
              @endif
          </td>
          <td>
              <form action="/super-admin/deleteOfficer/{{ $officer->id }}" method="post">
                  <button type="submit" class="btn btn-danger">Hapus</button>
                  @method('delete')
                  @csrf
              </form>
          </td>
          <td><a href="/super-admin/showOfficer/{{ $officer->id }}" class="btn btn-primary">Edit</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
  <!-- /.card-body -->

@endsection
