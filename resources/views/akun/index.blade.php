@extends('master')
@section('judul', 'Data Akun')
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')

<hr />
<table id="data_akun" class="table table-bordered table-striped dataTable dtr-inline" role="grid">
    <thead>
        <tr>

            <th style="width:30px">Kode Akun</th>
            <th style="width:60px">Nama Akun</th>
            <th style="width:60px">Saldo Normal</th>
            <th style="width:60px">Saldo Awal</th>
            <th style="width:20%; text-align: center;">Aksi</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($akun as $key => $value)
        <tr>

            <td>{{ $value->kode_akun }}</td>
            <td>{{ $value->nama_akun }}</td>
            <td>{{ $value->saldo_normal }}</td>
            <td>Rp.{{ number_format($value->saldo_awal, 0) }}</td>
            <td style="text-align: center;">
                <a href="javascript:void(0)" data-id='{{$value->id}}' data-saldo='{{$value->saldo_awal}}' class="btn btn-primary m-1 edit-row"><i class="fa fa-edit"></i> Edit Data</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="editMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/akun/update" method="POST">
                @csrf
                <input type="hidden" id="id_edit" name="id" value="" />
                <div class="modal-body">
                    <div class="form-group">
                        <label>Edit Akun</label>
                        <input type="text" name="saldo_awal" id="saldo_awal_edit" class="form-control price" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function() {
        $("#data_akun").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    $('.edit-row').click(function(ev) {
        // ev.preventDefault();
        let id = $(this).data('id');
        let saldo_awal = $(this).data('saldo')

        $('#saldo_awal_edit').val(saldo_awal)
        $('#id_edit').val(id)


        $('#editMdl').modal('show')
    })
</script>
@endsection