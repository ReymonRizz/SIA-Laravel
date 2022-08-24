@extends('master')
@section('judul', 'Form Data Karyawan')
@section('content')
    <form action="{{ $action != 'karyawan.store' ? url($action) : route($action) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $action != 'karyawan.store' ? $karyawan->id : '' }}">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Karyawan</label>
                <input type="text" style="width:600px" class="form-control" name="nama"
                    value="{{ $action != 'karyawan.store' ? $karyawan->nama : '' }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Kelamin</label>
                <input type="text" style="width:600px" class="form-control" name="jenis_kelamin"
                    value="{{ $action != 'karyawan.store' ? $karyawan->jenis_kelamin : '' }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Masuk</label>
                <input type="text" style="width:600px" class="form-control" name="tgl_masuk"
                    value="{{ $action != 'karyawan.store' ? $karyawan->nama : '' }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jabatan</label>
                <input type="text" style="width:600px" class="form-control" name="jabatan"
                    value="{{ $action != 'karyawan.store' ? $karyawan->jabatan : '' }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">No Telephone</label>
                <input type="text" style="width:600px" class="form-control" name="telepon"
                    value="{{ $action != 'karyawan.store' ? $karyawan->telepon : '' }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Alamat</label>
                <input type="text" style="width:600px" class="form-control" name="alamat"
                    value="{{ $action != 'karyawan.store' ? $karyawan->alamat : '' }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Status</label>
                <input type="text" style="width:600px" class="form-control" name="status"
                    value="{{ $action != 'karyawan.store' ? $karyawan->alamat : '' }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Foto</label>

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" style="width:600px" for="exampleInputFile">Choose file</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <input type="submit" class="btn btn-success" value="{{ $action != 'karyawan.store' ? 'Update' : 'Simpan' }}">
        </div>
    </form>

@endsection
