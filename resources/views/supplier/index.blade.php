@extends('master')
@section('judul', 'Data Supplier')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')
    <a href="{{ url('supplier/create') }}" class="btn btn-primary">Tambah</a>
    <hr />
    <table id="data_supplier" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="width:30px">No</th>
                <th style="width:60px">Nama</th>
                <th style="width:60px">Alamat</th>
                <th style="width:60px">Jenis Barang</th>
                <th style="width:60px">telepon</th>
                <th style="width:20%; text-align: center;">Aksi</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($supplier as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->alamat }}</td>
                    <td>{{ $value->jenis_barang }}</td>
                    <td>{{ $value->telepon }}</td>
                    <td style="text-align: center;">
                        <a href="{{ url('supplier/' . $value->id . '/edit') }}" class="btn btn-warning m-1"><i
                                class="fa fa-edit"></i> Edit Data</a>
                        <a href="{{ url('supplier/delete/' . $value->id) }}" class="btn btn-danger m-1"><i
                                class="fa fa-trash"></i> Hapus Data</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('js')

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $("#data_supplier").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
