@extends('master')
@section('judul', 'Jasa')
@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

<div>
    <div class="row">
        <a href="/stok-barang" class="btn btn-dark  m-2">Data Barang</a>
        <a href="/jasa" class="btn btn-dark m-2">Data Jasa</a>
    </div>
    <br />
    <button data-toggle="modal" data-target="#add_jasa_mdl" class="btn btn-primary my-2"><i class="fa fa-plus"></i>
        Tambah Jasa </button>
    <div class="modal fade" id="add_jasa_mdl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jasa </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/jasa/store" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Jasa</label>
                            <input class="form-control" name="kode_jasa" />
                        </div>
                        <div class="form-group">
                            <label>Nama Jasa</label>
                            <input class="form-control" name="nama_jasa" />
                        </div>
                        <div class="form-group">
                            <label>Harga Jasa</label>
                            <input class="form-control" name="harga_jual" />
                        </div>
                        <div class="form-group">
                            <label>Keterangan Jasa</label>
                            <input class="form-control" name="keterangan" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive">

    <table class="table table-bordered" id="data_jasa">
        <thead>
            <tr>
                <th>Kode Jasa</th>
                <th>Nama Jasa</th>
                <th>Harga Jual</th>
                <th>Keterangan Jasa</th>
                <th style="width:20%; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jasa as $key => $value)
                <tr>
                    <td>{{ $value->kode_jasa }}</td>
                    <td>{{ $value->nama_jasa }}</td>
                    <td>Rp.{{ number_format($value->harga_jual, 0) }}</td>
                    <td>{{ $value->keterangan }}</td>
                    <td style=" text-align: center;">

                        <a href="{{ url('jasa/delete/' . $value->id_jasa) }}" class="btn btn-danger m-1"><i
                                class="fa fa-trash"></i> Hapus Jasa</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="edit_jasa_mdl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Jasa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/jasa/update" method="POST">
                    @csrf
                    <input type="hidden" value="" id="id_jasa_edit" name="id" />
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Jasa</label>
                            <input class="form-control" name="kode_jasa" id="kode_jasa_mdl" />
                        </div>
                        <div class="form-group">
                            <label>Nama Jasa</label>
                            <input class="form-control" name="nama_jasa" id="nama_jasa_mdl" />
                        </div>
                        <div class="form-group">
                            <label>Harga Jasa</label>
                            <input class="form-control" name="harga_jual" id="harga_jual_mdl" />
                        </div>
                        <div class="form-group">
                            <label>Keterangan Jasa</label>
                            <input class="form-control" name="keterangan" id="keterangan_mdl" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
@section('js')
<script>
    < script >
        <
        script src = "{{ asset('plugins/datatables/jquery.dataTables.min.js') }}" >
        <
        script src = "{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" >
        <
        script src = "{{ asset('plugins/datatables/jquery.dataTables.min.js') }}" >
        <
        script src = "{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" >
        <
        /> <script
    script src = "{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}" >
</script>

</script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function() {
        $("#data_jasa").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>


function editJasa(data) {
let get = JSON.parse(data)
$('#id_jasa_edit').val(get.id_jasa)
$('#kode_jasa_mdl').val(get.kode_jasa)
$('#nama_jasa_mdl').val(get.nama_jasa)
$('#harga_jual_mdl').val(get.harga_jual)
$('#keterangan_mdl').val(get.keterangan)
$('#edit_jasa_mdl').modal('show')
}
</script>

@endsection
