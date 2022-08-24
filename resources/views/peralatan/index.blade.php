@extends('master')
@section('judul', 'Data Peralatan')
@section('content')
    <button class="btn btn-primary my-2" data-toggle="modal" data-target="#addBebanModal">+ Aset</button>
    <div class="table-responsive">
        <table class="table table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Pembelian</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                    <th>Masa Manfaat</th>
                    <th>Penyusutan Per Bulan</th>
                    <th>Nilai Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                    function formatNumber($number)
                    {
                        return number_format($number, 0, ',', '.');
                    }
                    $today = \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d');
                    
                @endphp

                @foreach ($peralatan as $data)
                    @php
                        $date = \Carbon\Carbon::parse($data->tgl_aset);
                        $diff = $date->diffInMonths($today);
                        $no++;
                        $harga = $data->harga_aset ? $data->harga_aset : 0;
                        $jumlah_aset = $data->jumlah_aset ? $data->jumlah_aset : 0;
                        $total_harga = $data->harga_aset ? $harga * $jumlah_aset : 0;
                        $masa_manfaat = (int) $data->masa_manfaat * 12;
                        $penyusutan_per_bulan = (int) $total_harga / $masa_manfaat;
                        
                        $nilai_buku = $harga - $penyusutan_per_bulan * $diff;
                    @endphp
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $data->nama_aset }}</td>
                        <td>{{ $data->tgl_aset }}</td>
                        <td>{{ $data->jumlah_aset }}</td>
                        <td>Rp. {{ formatNumber($harga) }}</td>
                        <td>Rp. {{ formatNumber($total_harga) }}</td>
                        <td>{{ formatNumber($masa_manfaat) }} Bulan</td>
                        <td>Rp. {{ formatNumber($penyusutan_per_bulan) }}</td>
                        <td>Rp. {{ formatNumber($nilai_buku) }}</td>
                        <td><button class="btn btn-primary" onclick="editBeban('{{ $data }}')"><i
                                    class="fas fa-edit"></i></button>&nbsp;<button class="btn btn-danger"
                                onclick="deletPeralatan('{{ $data->id }}')"><i class="fas fa-trash"></i></button></td>
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
                <form action="/data-peralatan/add" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Aset</label>
                            <input type="text" class="form-control" name="nama_aset" />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Aset</label>
                            <input type="date" class="form-control" name="tgl_aset" required />
                        </div>
                        <div class="form-group">
                            <label>Jumlah Aset</label>
                            <input name="jumlah_aset" class="form-control" required />

                        </div>
                        <div class="form-group">
                            <label>Harga Aset</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" class="form-control price" id="nominal_format" />
                                <input type="hidden" id="nominal" name="nominal" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Masa Manfaat Aset</label>
                            <select type="text" class="form-control" name="masa_manfaat" />
                            <option value="3">3 Tahun</option>
                            <option value="5">5 Tahun</option>
                            <option value="10">10 Tahun</option>
                            </select>
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
    <div class="modal fade" id="editperalatanmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Beban</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/data-peralatan/edit" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id_peralatan" />
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Aset</label>
                            <input type="text" class="form-control" name="nama_aset" id="nama_aset_edit" />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Aset</label>
                            <input type="date" class="form-control" name="tgl_aset" required id="tgl_aset_edit" />
                        </div>
                        <div class="form-group">
                            <label>Jumlah Aset</label>
                            <input name="jumlah_aset" class="form-control" required id="jumlah_aset_edit" />

                        </div>
                        <div class="form-group">
                            <label>Harga Aset</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" class="form-control price" id="nominal_format_edit" />
                                <input type="hidden" id="nominal_edit" name="nominal" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Masa Manfaat Aset</label>
                            <select type="text" class="form-control" name="masa_manfaat" id="manfaat_edit" />
                            <option value="3">3 Tahun</option>
                            <option value="5">5 Tahun</option>
                            <option value="10">10 Tahun</option>
                            </select>
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

        function deletPeralatan(id) {

            swal.fire({
                icon: 'warning',
                title: 'Hapus Peralatan',
                text: "Anda Yakin Hapus Peralatan Ini ?",
                showCancelButton: true,
                confirmButtonText: 'Yes',
                confirmButtonColor: "#dc3545"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/data-peralatan/delete/' + id,
                        type: 'GET',
                        cache: false,
                        success: function(res) {
                            if (res == 200) {

                                swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Hapus Peralatan}',
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
            $('#id_peralatan').val(data.id)
            $('#nama_aset_edit').val(data.nama_aset)
            $('#tgl_aset_edit').val(data.tgl_aset)
            $('#nominal_format_edit').val(formatNumber(data.harga_aset))
            $('#nominal_edit').val(data.harga_aset)
            $('#jumlah_aset_edit').val(data.jumlah_aset)
            $('#masa_manfaat_edit').val(data.masa_manfaat)
            $('#editperalatanmdl').modal('show')
        }
    </script>
@endsection
