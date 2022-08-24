@extends('master')
@section('judul', 'Form Edit Data Barang')
@section('content')
    <form action="/barang/update" method="post">
        {{ csrf_field() }}
        <input type="hidden" value="{{ $barang['id_barang'] }}" name="id_barang" />
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Barang</label>
                <input type="text" style="width:600px" class="form-control" name="nama_barang"
                    value="{{ $barang['nama_barang'] }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jumlah Stok</label>
                <input type="number" style="width:600px" class="form-control" name="jumlah_stok"
                    value="{{ $barang['jumlah_stok'] }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Harga Beli</label>
                <input type="text" style="width:600px" class="form-control" name="harga_beli"
                    value="{{ $barang['harga_beli'] }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Harga Jual</label>
                <input type="text" style="width:600px" class="form-control" name="harga_jual"
                    value="{{ $barang['harga_jual'] }}">
            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <input type="submit" class="btn btn-success" value="submit">
        </div>
    </form>

@endsection
