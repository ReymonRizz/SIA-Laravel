@extends('master')
@section('judul', 'Penjualan')
@section('content')
    <a href="/penjualan/add" class="btn btn-primary my-2">+ Tambah Penjualan</a>
    <div class="table-responsive">
        <table class="table table-bordered" id="data_penjualan">
            <thead>
                <tr>
                    <th>No Faktur</th>
                    <th>Penanggung Jawab</th>
                    <th>Tanggal Jual</th>
                    <th>Cara Jual</th>
                    <th>Customer</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $data)
                    <tr onclick="window.location='penjualan/detail/{{ $data->no_faktur }}'">
                        <td>{{ $data->no_faktur }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->tgl_jual }}</td>
                        <td>{{ $data->cara_jual }}</td>
                        <td>{{ $data->customer }}</td>
                        <td>{{ $data->keterangan }}</td>
                        <td><button class="btn btn-primary"><i class="fas fa-search"></i></button></td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
@section('js')

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $("#data_penjualan").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
