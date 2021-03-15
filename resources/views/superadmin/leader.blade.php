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
<center>
    <div class="card" style="width: 18rem;">
        <form action="" method="get">
            <fieldset disabled="disabled">
                <label for="Pemasukkan">Pemasukkan:</label>
                <input type="text" name="pemasukkan" id="Pemasukkan" style="margin-bottom: 20px" value="2000.000"><br>
                <label for="pengeluaran">Pengeluaran:</label>
                <input type="text" name="pengeluaran" id="Pengeluaran" style="margin-bottom: 40px" value="150.000">
                <input type="textarea" name="pengeluaran" id="Pengeluaran" style="margin-bottom: 20px" value="150.000">
            </fieldset>
            @csrf
        </form>
      </div>
</center>

<div class="card-body" style="margin-bottom: 50px">
    <h3 style="margin-left: 20px">Transaksi Penjualan</h3>
    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>No.</th>
        <th>Penanggung Jawab</th>
        <th>Member</th>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Harga</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>1</td>
        <td>Moscow666</td>
        <td>Juang</td>
        <td>Oreo</td>
        <td>3</td>
        <td>2000</td>
      </tr>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>


<div class="card-body" style="margin-bottom: 50px">
    <h3 style="margin-left: 20px">Transaksi Pembelian</h3>
    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>No.</th>
        <th>Penanggung Jawab</th>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Harga</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>1</td>
        <td>My Hero Salvador</td>
        <td>Oreo</td>
        <td>10</td>
        <td>1000</td>
      </tr>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
@endsection
