@extends('master')
@section('judul', 'Pembelian')
@section('content')
    <a href="/pembelian/add" class="btn btn-primary my-2">+ Tambah Pembelian</a>

    <div class="table-responsive">
        <table class="table table-bordered" id="data_pembelian">
            <thead>
                <tr>
                    <th>No Faktur</th>
                    <th>Penanggu Jawab</th>
                    <th>Tanggal Jual</th>
                    <th>Cara Beli</th>
                    <th>Supplier</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembelian as $data)
                    <tr onclick="window.location='pembelian/detail/{{ $data->no_faktur }}'">
                        <td>{{ $data->no_faktur }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->tgl_beli }}</td>
                        <td>{{ $data->cara_beli }}</td>
                        <td>{{ $data->supplier }}</td>
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
            $("#data_pembelian").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
