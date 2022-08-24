@extends('master')
@section('judul', 'Stok Barang')
@section('content')
    <div>
        <div class="row">
            <a href="/stok-barang" class="btn btn-dark  m-2">Data Barang</a>
            <a href="/jasa" class="btn btn-dark m-2">Data Jasa</a>
        </div>
        <br />
        <a href="/stok-barang/add" class="btn btn-primary my-2"><i class="fa fa-plus"></i> Tambah Persediaan Barang</a>
        <div class="table-responsive">

            <table class="table table-bordered" id="data_barang">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Stok</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th style="width:35%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $key => $brg)
                        <tr>
                            <td>{{ $brg->kode_barang }}</td>
                            <td>{{ $brg->nama_barang }}</td>
                            <td>{{ $brg->jumlah_stok }}</td>
                            <td>Rp.{{ number_format($brg->harga_beli, 0) }}</td>
                            <td>Rp.{{ number_format($brg->harga_jual, 0) }}</td>
                            <td style="text-align: center;">
                                <a href="{{ url('barang/detail/' . $brg->id_barang) }}" class="btn btn-success m-1"><i
                                        class="fa fa-search"></i> Detail Persediaan</a>
                                <a href="{{ url('barang/edit/' . $brg->id_barang) }}" class="btn btn-warning m-1"><i
                                        class="fa fa-edit"></i> Edit Persediaan</a>

                                <a href="{{ url('barang/delete/' . $brg->id_barang) }}" class="btn btn-danger m-1"><i
                                        class="fa fa-trash"></i> Hapus Persediaan</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $("#data_barang").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
