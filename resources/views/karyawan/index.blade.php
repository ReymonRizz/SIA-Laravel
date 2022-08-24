@extends('master')
@section('judul', 'Data Karyawan')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')
    <a href="{{ url('karyawan/create') }}" class="btn btn-primary">Tambah</a>
    <hr />
    <table id="data_karyawan" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="col-sm-1">No</th>
                <th class="col-sm-2">Nama Karyawan</th>
                <th class="col-sm-2">Jabatan</th>
                <th class="col-sm-3">Gaji</th>
                <th style="text-align: center;" class="col-sm-7">Aksi</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($karyawans as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->jabatan }}</td>
                    <td>{{ number_format((int) $value->gaji), 0 }}</td>
                    <td style="text-align: center;">
                        <a href="{{ url('karyawan/gaji/' . $value->id) }}" class="btn btn-primary m-1"><i
                                class="fa fa-edit"></i> Atur Gaji Karyawan</a>
                        <a href="{{ url('karyawan/' . $value->id . '/edit') }}" class="btn btn-warning m-1"><i
                                class="fa fa-edit"></i> Edit Data</a>
                        <a href="{{ url('karyawan/delete/' . $value->id) }}" class="btn btn-danger m-1"><i
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
            $("#data_karyawan").DataTable({
                "responsive": true,
                "autoWidth": false,
                // bAutoWidth: false,
                // aoColumns: [{
                //     "sWidth": "20%",
                //     "aTargets": [0]
                //   }, {
                //     "sWidth": "5%",
                //     "aTargets": [1]
                //   },
                //   {
                //     "sWidth": "10%",
                //     "aTargets": [2]
                //   },
                //   {
                //     "sWidth": "5%",
                //     "aTargets": [3]
                //   },
                // ]
            });
        });
    </script>
@endsection
