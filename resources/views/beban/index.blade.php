@extends('master')
@section('judul', 'Data Beban')
@section('content')
    <button class="btn btn-primary my-2" data-toggle="modal" data-target="#addBebanModal">+ Beban</button>
    <div class="table-responsive">
        <table class="table table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Beban</th>
                    <th>Tanggal Beban</th>
                    <th>Serba Serbi</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                @endphp
                @foreach ($beban as $data)
                    @php
                        $no++;
                    @endphp
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $data->kode_beban }}</td>
                        <td>{{ $data->tgl_beban }}</td>
                        <td>{{ $data->serba_serbi }}</td>
                        <td>Rp. {{ $data->nominal ? number_format($data->nominal, 0, ',', '.') : 0 }}</td>
                        <td>{{ $data->keterangan }}</td>
                        <td><button class="btn btn-primary" onclick="editBeban('{{ $data }}')"><i
                                    class="fas fa-edit"></i></button>&nbsp;<button class="btn btn-danger"
                                onclick="deleteBeban('{{ $data->id }}')"><i class="fas fa-trash"></i></button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- modal Add Beban -->
    <div class="modal fade" id="addBebanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Beban</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/data-beban/add" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Beban</label>
                            <input type="date" class="form-control" name="tgl_beban" required />
                        </div>
                        <div class="form-group">
                            <label>Serba Serbi</label>
                            <select name="serba_serbi" class="form-control" required>
                                <option value="" selected disabled>Pilih Serba Serbi</option>
                                @foreach ($akun as $data)
                                    <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nominal</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" class="form-control price" id="nominal_format" />
                                <input type="hidden" id="nominal" name="nominal" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal Edit Beban -->
    <div class="modal fade" id="editBebanMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Beban</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/data-beban/edit" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id_beban" />
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Beban</label>
                            <input type="date" class="form-control" name="tgl_beban" id="tgl_beban" required />
                        </div>
                        <div class="form-group">
                            <label>Serba Serbi</label>
                            <select name="serba_serbi" class="form-control" required id="serba_serbi">
                                <option value="" selected disabled>Pilih Serba Serbi</option>
                                @foreach ($akun as $data)
                                    <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nominal</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" class="form-control price" name="nominal_format"
                                    id="nominal_format_edit" />
                                <input type="hidden" name="nominal_edit" id="nominal_edit" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#nominal_format').change(function() {
            let nominal = $(this).val()

            nominal = nominal.toString().replace(/\./g, '')
            $('#nominal').val(nominal)
        })
        $('#nominal_format_edit').change(function() {
            let nominal = $(this).val()

            nominal = nominal.toString().replace(/\./g, '')
            $('#nominal_edit').val(nominal)
        })

        function deleteBeban(id) {

            swal.fire({
                icon: 'warning',
                title: 'Hapus Beban',
                text: "Anda Yakin Hapus Beban Ini ?",
                showCancelButton: true,
                confirmButtonText: 'Yes',
                confirmButtonColor: "#dc3545"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/data-beban/delete/' + id,
                        type: 'GET',
                        cache: false,
                        success: function(res) {
                            if (res == 200) {

                                swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Hapus Beban',
                                }).then((result) => {
                                    location.reload()
                                });
                            }
                        }
                    })
                }
            })
        }

        function editBeban(d) {
            let data = JSON.parse(d)
            $('#id_beban').val(data.id)
            $('#tgl_beban').val(data.tgl_beban)
            $('#serba_serbi').val(data.serba_serbi)
            $('#nominal_format_edit').val(formatNumber(data.nominal))
            $('#nominal_edit').val(data.nominal)
            $('#keterangan').val(data.keterangan)
            $('#editBebanMdl').modal('show')
        }
    </script>
@endsection
