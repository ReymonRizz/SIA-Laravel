@extends('master')
@section('judul', 'Tambah Penjualan')
@section('content')
    <div class="row">
        <form id="add_form_jual_barang" class="col-md-6">
            @csrf
            <input type="hidden" name="no_faktur" value="{{ $faktur }}" />
            <div class="col-md-12">
                <h1>Form Penjualan Barang</h1>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <select class="form-control" id="select_brg" name="barang">
                        <option disabled selected>-- Pilih Barang --</option>
                        @foreach ($barang as $brg)
                            <option value="{{ $brg['id_barang'] }}">{{ $brg['nama_barang'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Stok Barang :</label>
                        <input class="form-control" readonly id="stok_barang" name="stok_barang" />
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Harga Jual :</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input class="form-control" readonly id="harga_jual_brg" name="harga_jual" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Jumlah :</label>
                        <input class="form-control" id="jlh_barang" name="jlh_barang" />
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="inlineFormInputGroup">Diskon Jual</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="text" class="form-control price" id="inlineFormInputGroup" placeholder=""
                                id="diskon_jual" name="diskon_jual">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <input class="btn btn-primary" value="Tambah" type="submit" />
                </div>
            </div>
        </form>
        <div class="col-md-6">

            <form id="add_form_jual_jasa">
                @csrf;
                <input type="hidden" name="no_faktur" value="{{ $faktur }}" />
                <h1>Form Penjualan Jasa</h1>
                <div class="form-group">
                    <label>Nama Jasa</label>
                    <select class="form-control" id="select_jasa" name="jasa">
                        <option disabled selected>-- Pilih Jasa --</option>
                        @foreach ($jasa as $js)
                            <option value="{{ $js['id_jasa'] }}">{{ $js['nama_jasa'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Harga Jasa :</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input class="form-control" readonly id="harga_jasa" name="harga_jasa" />
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Jumlah :</label>
                        <input class="form-control" id="jumlah_jasa" name="jumlah_jasa" />
                    </div>
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <input class="btn btn-primary" type="submit" value="Tambah" />
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <h1>Detail Penjualan Faktur {{ $faktur }}</h1>
            <div class="table-responsive" id="result_table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="row_result">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    Pembayaran
                </div>
                <div class="card-body">
                    <b>Total Harga Rp.<span id="total_harga"></span></b><br />
                    <b>Total Diskon Rp.<span id="total_diskon"></span></b><br />
                    <b>Total Belanja Rp.<span id="total_jual"></span></b><br />
                    <input class="btn btn-primary" value="+ Proses" id="btn_modal" data-target='#proses_mdl'
                        data-toggle='modal' type="button" />
                </div>
            </div>
        </div>
        <div class="modal fade" id="proses_mdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Form Penjualan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tgl. Jual</label>
                            <input type="date" name="tgl_jual" class="form-control" id="tgl_jual" />
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" id="keterangan" />
                        </div>
                        <div class="form-group">
                            <label>Customer</label>
                            <input type="text" name="customer" class="form-control" id="customer" />
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis" id="inlineRadio1" value="Tunai"
                                    checked>
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
        function formatNumber(number) {
            // var num = number.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })
            // console.log(num)

            return number.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");

        }
        $('#select_brg').change(function(ev) {
            ev.preventDefault()

            $.ajax({
                url: '/barang/getData/' + $(this).val(),
                type: 'GET',
                cache: false,
                success: function(res) {
                    // let data = JSON.parse(res)
                    $('#stok_barang').val(res.jumlah_stok)
                    $('#harga_jual_brg').val(formatNumber(res.harga_jual))
                }
            })
        })
        $('#select_jasa').change(function(ev) {
            ev.preventDefault()

            $.ajax({
                url: '/jasa/getData/' + $(this).val(),
                type: 'GET',
                cache: false,
                success: function(res) {
                    // let data = JSON.parse(res)
                    $('#harga_jasa').val(formatNumber(res.harga_jual))
                }
            })
        })
        var count = 0;
        var total_harga = 0;
        var total_disc = 0;
        var total_jual = 0;
        var data_array = [];
        $('#total_harga').text(total_harga)
        $('#total_diskon').text(total_disc)
        $('#total_jual').text(total_jual)
        $('#add_form_jual_barang').submit(function(ev) {
            ev.preventDefault();
            $.ajax({
                url: "{{ url('/penjualan/barang/add') }}",
                type: 'POST',
                data: $(this).serialize(),
                cache: false,
                success: function(data) {
                    var html = "";
                    count += 1;
                    total_harga += parseInt(data[0].harga) * parseInt(data[0].jlh_barang)
                    total_disc += parseInt(data[0].diskon)
                    total_jual += parseInt(data[0].total_harga)
                    html += '<tr>';
                    html += '<td>' + count + '</td>';
                    html += '<td>' + data[0].nama + '</td>';
                    html += '<td>' + data[0].jlh_barang + '</td>';
                    html += '<td>' + data[0].harga_format + '</td>';
                    html += '<td>' + data[0].diskon_format + '</td>';
                    html += '<td>' + data[0].total_harga_format + '</td>';
                    html += '<td>&nbsp;</td>';
                    html += '</tr>';
                    let obj = {
                        "barang": data[0].barang,
                        "jumlah": data[0].jlh_barang,
                        "harga": data[0].harga,
                        "diskon": data[0].diskon,
                        "total_harga": data[0].total_harga,
                        "no_faktur": data[0].no_faktur,
                        "stok_barang": data[0].stok_barang,
                        "jenis_jual": "Barang"
                    }
                    $('#row_result').append(html)
                    $('#total_harga').text(formatNumber(total_harga))
                    $('#total_diskon').text(formatNumber(total_disc))
                    $('#total_jual').text(formatNumber(total_jual))
                    $('#add_form_jual_barang').trigger('reset')
                    $('#total_harga_mdl').val(formatNumber(total_jual))
                    data_array.push(obj)
                }
            })
        })
        $('#add_form_jual_jasa').submit(function(ev) {
            ev.preventDefault();
            $.ajax({
                url: "{{ url('/penjualan/jasa/add') }}",
                type: 'POST',
                data: $(this).serialize(),
                cache: false,
                success: function(data) {
                    var html = "";
                    count += 1;
                    total_harga += parseInt(data[0].harga) * parseInt(data[0].jumlah)
                    total_disc += parseInt(data[0].diskon)
                    total_jual += parseInt(data[0].total_harga)
                    html += '<tr>';
                    html += '<td>' + count + '</td>';
                    html += '<td>' + data[0].nama + '</td>';
                    html += '<td>' + data[0].jumlah + '</td>';
                    html += '<td>' + data[0].harga_format + '</td>';
                    html += '<td>' + data[0].diskon_format + '</td>';
                    html += '<td>' + data[0].total_harga_format + '</td>';
                    html += '<td>&nbsp;</td>';
                    html += '</tr>';
                    $('#row_result').append(html)
                    $('#total_harga').text(formatNumber(total_harga))
                    $('#total_diskon').text(formatNumber(total_disc))
                    $('#total_jual').text(formatNumber(total_jual))
                    $('#total_harga_mdl').val(formatNumber(total_jual))
                    let obj = {
                        "jasa": data[0].jasa,
                        "jumlah": data[0].jumlah,
                        "harga": data[0].harga,
                        "diskon": data[0].diskon,
                        "total_harga": data[0].total_harga,
                        "no_faktur": data[0].no_faktur,
                        "jenis_jual": "Jasa"
                    }

                    $('#add_form_jual_jasa').trigger('reset')
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
            total_jual = total_jual.toString().replace(/\./g, '')
            kembalian = parseInt(uang_diterima) - parseInt(total_jual);
            $('#kembalian_format').val(formatNumber(kembalian))
        })
        $('#proses_btn').click(function(ev) {
            ev.preventDefault();
            $.ajax({
                url: "{{ url('/penjualan/proses') }}",
                type: 'POST',
                data: {
                    "tgl_jual": $('#tgl_jual').val(),
                    "keterangan": $('#keterangan').val(),
                    "customer": $('#customer').val(),
                    "cara_jual": jenis,
                    "data_penjualan": data_array,
                    "_token": "{{ csrf_token() }}"
                },
                cache: false,
                success: function(res) {
                    // console.log(res)
                    if (res == 200) {
                        window.location = '/penjualan'
                        // swal.Fire({
                        //     icon: 'success',
                        //     title: 'Proses Pembelian',
                        //     text: "Pembelian Berhasil di Proses"
                        // }).then((result) => {
                        //     window.location = '/pembelian'
                        // })
                    }
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                }

            })
        })
    </script>

@endsection
