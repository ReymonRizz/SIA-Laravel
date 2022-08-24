@extends('master')
@section('judul', 'Form Data Supplier')
@section('content')
    <form action="{{ $action != 'supplier.store' ? url($action) : route($action) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $action != 'supplier.store' ? $supplier->id : '' }}">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" style="width:600px" class="form-control" name="nama"
                    value="{{ $action != 'supplier.store' ? $supplier->nama : '' }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Alamat</label>
                <input type="text" style="width:600px" class="form-control" name="alamat"
                    value="{{ $action != 'supplier.store' ? $supplier->alamat : '' }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Jenis Barang</label>
                <input type="text" style="width:600px" class="form-control" name="jenis_barang"
                    value="{{ $action != 'supplier.store' ? $supplier->jenis_barang : '' }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Telephone</label>
                <input type="text" style="width:600px" class="form-control" name="telepon"
                    value="{{ $action != 'supplier.store' ? $supplier->telepon : '' }}">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <input type="submit" class="btn btn-success" value="{{ $action != 'supplier.store' ? 'Update' : 'Simpan' }}">
        </div>
    </form>

@endsection
