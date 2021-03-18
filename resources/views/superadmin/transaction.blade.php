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

<center>
    <div class="card" style="width: 18rem;">
        <form action="" method="get">
            <fieldset disabled="disabled">
                <label for="Pemasukkan">Pemasukkan:</label>
                <input type="text" name="pemasukkan" id="Pemasukkan" style="margin-bottom: 20px" value="{{ $debit }}"><br>
                <label for="pengeluaran">Pengeluaran:</label>
                <input type="text" name="pengeluaran" id="Pengeluaran" style="margin-bottom: 40px" value="{{ $credit }}"><br>
                <label for="pengeluaran"><h4>Total:</h4></label><br>
                <input type="textarea" name="pengeluaran" id="Pengeluaran" style="margin-bottom: 20px" value="{{ $saldo->saldo }}"><br>
            </fieldset>
            @csrf
        </form>
    </div>
</center>

<div class="card-body" style="margin-bottom: 50px">
    <h3 style="margin-left: 20px">Pengeluaran</h3>
    <a href="/super-admin/createTransaction" class="btn btn-primary" style="margin-bottom: 15px">Buat Data Pengeluaran</a>
    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>No.</th>
        <th>Penganggung Jawab</th>
        <th>Keterangan</th>
        <th>Jumlah</th>
        <th>Total Pengeluaran</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
    @foreach ($output as $output)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $output->user->name }}</td>
            <td>{{ $output->keterangan }}</td>
            <td>{{ $output->jumlah }}</td>
            <td>{{ $output->pengeluaran }}</td>
            <td>
                <a href="/super-admin/showTransaction/{{ $output->id }}" class="btn btn-primary">Detail</a>
            </td>
        </tr>
    @endforeach
</tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

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
        @foreach ($penjualan as $penjualan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $penjualan->pj }}</td>
                <td>{{ $penjualan->member_id }}</td>
                <td>{{ $penjualan->barang_id }}</td>
                <td>3</td>
                <td>2000</td>
            </tr>
        @endforeach
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
        @foreach ($pembelian as $pembelian)
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $pembelian->pj->name }}</td>
              <td>{{ $pembelian->barang_id->nama_barang }}</td>
              <td>{{ $pembelian->jumlah }}</td>
              <td>{{ $pembelian->harga }}</td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
@endsection
