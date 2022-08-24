@extends('master')
@section('judul', 'Tambah Pembelian')
@section('content')
<div class="row">

    <div class="col-md-6">
        <form id="form_pembelian">
            @csrf
            <input type="hidden" name="no_faktur" value="{{$faktur}}" />
            <h1>Form Pembelian</h1>
            <div class="form-group">
                <label>Nama Barang</label>
                <select class="form-control" id="select_brg" name="barang">
                    <option disabled selected>-- Pilih Barang --</option>
                    @foreach($barang as $brg)
                    <option value="{{$brg['id_barang']}}">{{$brg['nama_barang']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>Stok Barang :</label>
                    <input class="form-control" readonly id="stok_barang" name="stok_barang" />
                </div>
                <div class="form-group col-sm-6">
                    <label>Harga Pembelian :</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp.</div>
                        </div>
                        <input class="form-control" readonly id="harga_beli" name="harga_beli" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>Jumlah :</label>
                    <input class="form-control" name="jumlah_stok" />
                </div>
                <div class="form-group col-sm-6">
                    <label>Harga Sekarang :</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp.</div>
                        </div>
                        <input class="form-control price" name="harga_sekarang" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <input class="btn btn-primary btn-sm" value="Tambah" type="submit" />
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <input class="btn btn-warning btn-sm" value="Reset" type="reset" />
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-sm-7">
        <h1>Detail Pembelian</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="row_result">
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="card">
            <div class="card-header">
                Pembayaran
            </div>
            <div class="card-body">
                <b>Total Belanja Rp.<span id="total_harga"></span></b><br /><input class="btn btn-primary" value="+ Proses" id="btn_modal" data-target='#proses_mdl' data-toggle='modal' type="button" />
            </div>
        </div>
    </div>
    <div class="modal fade" id="proses_mdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Tambah Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal Pembelian</label>
                        <input type="date" name="tgl_pembelian" class="form-control" id="tgl_pembelian" />
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="keterangan" />
                    </div>
                    <div class="form-group">
                        <label>Dibeli Dari</label>
                        <select name="dibeli_dari" class="form-control" id="dibeli_dari">
                            <option value="">-- Pilih --</option>
                            @foreach($supplier as $supp)
                            <option value="{{$supp->nama}}">{{$supp->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis" id="inlineRadio1" value="Tunai" checked>
                            <label class="form-check-label" for="inlineRadio1">Tunai</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis" id="inlineRadio2" value="Kredit">
                            <label class="form-check-label" for="inlineRadio2">Kredit</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Total Belanja :</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="text" class="form-control" id="total_harga_mdl" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-5">
                                <label>Uang Diterima :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input type="text" class="form-control price" id="uang_diterima_format" />
                                    <input type="hidden" id="uang_diterima" />
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label>Kembalian :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input type="text" class="form-control" id="kembalian_format" readonly />
                                    <input type="hidden" id="kembalian" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="proses_btn">Proses</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $('#select_brg').change(function(ev) {
        ev.preventDefault()

        $.ajax({
            url: '/barang/getData/' + $(this).val(),
            type: 'GET',
            cache: false,
            success: function(res) {
                // let data = JSON.parse(res)
                $('#stok_barang').val(res.jumlah_stok)
                $('#harga_beli').val(formatNumber(res.harga_beli))
            }
        })
    })
    var count = 0;
    var total_harga = 0;
    var total_disc = 0;
    var total_jual = 0;

    var data_array = [];
    $('#total_harga').text(total_harga)
    $('#form_pembelian').submit(function(ev) {
        ev.preventDefault();
        $.ajax({
            url: "{{url('/pembelian/barang/add')}}",
            type: 'POST',
            data: $(this).serialize(),
            cache: false,
            success: function(data) {
                var html = "";
                count += 1;
                total_harga += parseInt(data[0].harga) * parseInt(data[0].jlh_barang)
                html += '<tr>';
                html += '<td>' + count + '</td>';
                html += '<td>' + data[0].nama + '</td>';
                html += '<td>' + data[0].jlh_barang + '</td>';
                html += '<td>' + data[0].harga_format + '</td>';
                html += '<td>' + data[0].total_harga_format + '</td>';
                html += '<td>&nbsp;</td>';
                html += '</tr>';
                let obj = {
                    "barang": data[0].barang,
                    "jumlah": data[0].jlh_barang,
                    "harga": data[0].harga,
                    "no_faktur": data[0].no_faktur
                }
                $('#row_result').append(html)
                $('#total_harga').text(formatNumber(total_harga))
                $('#total_harga_mdl').val(formatNumber(total_harga))
                data_array.push(obj)
            }
        })
    })
    var jenis = "Tunai";
    $('input[type="radio"]').change(function() {
        jenis = $(this).val()
    })
    var uang_diterima = 0;
    $('#uang_diterima_format').blur(function(ev) {
        ev.preventDefault();
        uang_diterima = $('#uang_diterima_format').val()
        let kembalian = 0;
        uang_diterima = uang_diterima.toString().replace(/\./g, '')
        total_harga = total_harga.toString().replace(".", '')

        kembalian = parseInt(uang_diterima) - parseInt(total_harga);
        $('#kembalian_format').val(formatNumber(kembalian))
    })
    $('#proses_btn').click(function(ev) {
        ev.preventDefault();
        $.ajax({
            url: "{{url('/pembelian/barang/proses')}}",
            type: 'POST',
            data: {
                "tgl_pembelian": $('#tgl_pembelian').val(),
                "keterangan": $('#keterangan').val(),
                "supplier": $('#dibeli_dari').val(),
                "cara_beli": jenis,
                "data_pembelian": data_array,
                "_token": "{{csrf_token()}}"
            },
            cache: false,
            success: function(res) {
                if (res == 200) {
                    window.location = '/pembelian'
                    // swal.Fire({
                    //     icon: 'success',
                    //     title: 'Proses Pembelian',
                    //     text: "Pembelian Berhasil di Proses"
                    // }).then((result) => {
                    //     window.location = '/pembelian'
                    // })
                }
            },

        })
    })
</script>
@endsection