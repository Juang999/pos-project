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
    <a href="/super-admin/leader" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Leader</p>
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

<div class="card-body" style="margin-bottom: 50px">
    <h3 style="margin-left: 20px">Pemimpin</h3>
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
      <tr>
        <td>1</td>
        <td>Bangkit Juang Raharjo</td>
        <td>081325507780</td>
        <td>juangraharjo03@gmail.com</td>
        <td>Pemimpin</td>
        <td><a href="#" class="btn btn-danger">Hapus</a></td>
        <td><a href="#" class="btn btn-primary">Edit</a></td>
      </tr>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>


<div class="card-body" style="margin-bottom: 50px">
    <h3 style="margin-left: 20px">Staf</h3>
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
      <tr>
        <td>1</td>
        <td>My Hero Salvador</td>
        <td>081325507780</td>
        <td>MyHeroSalvador@gmail.com</td>
        <td>Staf</td>
        <td><a href="#" class="btn btn-danger">Hapus</a></td>
        <td><a href="#" class="btn btn-primary">Edit</a></td>
      </tr>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<div class="card-body" style="margin-bottom: 50px">
    <h3 style="margin-left: 20px">Kategori</h3>
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
            <tr>
              <td>1</td>
              <td>Moscow666</td>
              <td>081325507780</td>
              <td>Moscow666@gmail.com</td>
              <td>Kasir</td>
              <td><a href="#" class="btn btn-danger">Hapus</a></td>
              <td><a href="#" class="btn btn-primary">Edit</a></td>
            </tr>
            </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
@endsection
