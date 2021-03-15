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

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="card-body" style="margin-bottom: 50px">
    <h3 style="margin-left: 20px">Barang</h3>
    <table id="example2" class="table table-bordered table-hover">
        <thead>
      <tr>
          <th>No.</th>
        <th>Nama Barang</th>
        <th>Barcode</th>
        <th>kategori</th>
        <th>Supplier</th>
        <th>Jumlah</th>
        <th>Harga Jual</th>
        <th>Harga Beli</th>
        <th>Hapus</th>
        <th>Edit</th>
      </tr>
    </thead>
      <tbody>
        @foreach ($barang as $barang)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $barang->nama_barang }}</td>
            <td>{{ $barang->barcode }}</td>
            <td>{{ $barang->kategori->kategori }}</td>
            <td>{{ $barang->supplier->supplier }}</td>
            <td>{{ $barang->jumlah }}</td>
            <td>{{ $barang->harga_beli }}</td>
            <td>{{ $barang->harga_jual }}</td>
            <td>
                <form action="/super-admin/staf/delete/{{ $barang->id }}" method="post">
                    <button class="btn btn-danger">Hapus</button>
                    @method('delete')
                    @csrf
                </form>
            </td>
            <td>
                <a href="/super-admin/edit/{{ $barang->id }}" class="btn btn-primary">Edit</a>
            </td>
          </tr>
        @endforeach
</tbody>
</table>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="margin-top: 10px">
    Tambah Barang
  </button>

  <!-- startModal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/super-admin/store" method="POST">
        <div class="modal-body">
                <div class="form-group">
                  <label>Nama Barang</label>
                  <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" placeholder="Nama Barang">
                   @error('nama_barang')
                   <div class="invalid-feedback">{{ $message }}</div>
                   @enderror
                </div>
                <div class="form-group">
                  <label>Supplier</label>
                  <select class="form-control custom-select @error('supplier_id') is-invalid @enderror" name="supplier_id">
                    <option value="">pilih Supplier</option>
                    @foreach ($supplier as $item)
                        <option value="{{ $item->id }}">{{ $item->supplier }}</option>
                    @endforeach
                </select>
                  @error('supplier_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control custom-select @error('kategori_id') is-invalid @enderror" name="kategori_id">
                        <option value="">pilih kategori</option>
                        @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                        @endforeach
                    </select>
                        @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label>harga Beli</label>
                    <input class="form-control @error('harga_beli') is-invalid @enderror" name="harga_beli" placeholder="1.500">
                  @error('harga_beli')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="text" class="form-control @error('harga_jual') is-invalid @enderror" name="harga_jual" placeholder="2.000">
                  @error('harga_jual')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save data</button>
            </div>
            @csrf
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /.card-body -->
</div>
{{-- endModal --}}


<div class="card-body" style="margin-bottom: 50px">
    <h3 style="margin-left: 20px">Supplier</h3>
    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>No.</th>
        <th>Nama Supplier</th>
        <th>Alamat</th>
        <th>Nomor Telepon</th>
        <th>Hapus</th>
        <th>Edit</th>
      </tr>
      </thead>
      <tbody>
          @foreach ($supplier as $supplier)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $supplier->supplier }}</td>
                  <td>{{ $supplier->alamat }}</td>
                  <td>{{ $supplier->nomor_telepon }}</td>
                  <td>
                      <form action="#" method="post">
                          <button class="btn btn-danger">Delete</button>
                          @method('delete')
                          @csrf
                      </form>
                  </td>
                  <td>
                        <button class="btn btn-primary">Edit</button>
                  </td>
                </tr>
        @endforeach
      </tbody>
    </table>
<a href="#" class="btn btn-success" style="margin-top: 10px">Tambah Supplier</a>
  </div>
  <!-- /.card-body -->
</div>

<div class="card-body" style="margin-bottom: 50px">
    <h3 style="margin-left: 20px">Kategori</h3>
    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>No.</th>
        <th>Kategori</th>
        <th>Hapus</th>
        <th>Edit</th>
      </tr>
      </thead>
      <tbody>
          @foreach ($kategori as $kategori)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kategori->kategori }}</td>
                <td>
                    <form action="#" method="post">
                        <button class="btn btn-danger">Hapus</button>
                        @method('delete')
                        @csrf
                    </form>
                </td>
                <td>
                    <form action="#" method="post">
                        <button class="btn btn-primary">Edit</button>
                        @method('patch')
                        @csrf
                    </form>
                </td>
                </tr>
          @endforeach
      </tbody>
    </table>
<a href="#" class="btn btn-success" style="margin-top: 10px">Tambah Kategori</a>
  </div>
  <!-- /.card-body -->
</div>

<div class="card-body">
    <h3 style="margin-left: 20px">Riwayat Pembelian</h3>
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
            @foreach ($riwayat as $riwayat)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $riwayat->user ->name }}</td>
                <td>{{ $riwayat->barang->nama_barang }}</td>
                <td>{{ $riwayat->jumlah }}</td>
                <td>{{ $riwayat->harga }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="#" class="btn btn-success" style="margin-top: 10px">Beli Barang</a>
</div>
<!-- /.card-body -->
</div>
@endsection
