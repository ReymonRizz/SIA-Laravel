@extends('master')
@section('judul', 'Form Gaji Karyawan')
@section('content')
    <div>
        <h3>Form Pengaturan Gaji</h3>
        <table>
            <tr>
                <td class="col-sm-5">Nama</td>
                <td>{{ $karyawan->nama }}</td>
            </tr>
            <tr>
                <td class="col-sm-5">Jabatan</td>
                <td>{{ $karyawan->jabatan }}</td>
            </tr>
            <tr>
                <td class="col-sm-5">Gaji Pokok</td>
                <td>{{ $karyawan->gaji }}</td>
            </tr>
        </table>
        <div class="row align-items-center my-2">
            <div class="col-sm-4">
                <span>Kehadiran / Bulan</span>
            </div>
            <div class="col-sm-3">
                <span><input class="form-control" id="hari" type="number" max="31" maxlength="2" /></span>
            </div>
            <div class="col-sm-1">
                <span>=</span>
            </div>
            <div class="col-sm-4">
                <span> <input class="form-control" id="total_gaji_hari" type="number" max="31" maxlength="2" /></span>
            </div>
        </div>
        <div class="row align-items-center my-2">
            <div class="col-sm-4">
                <span>Bonus</span>
            </div>
            <div class="col-sm-3">
                <span><input class="form-control" id="bonus" type="number" max="31" maxlength="2" /></span>
            </div>

        </div>
        <div class="row align-items-center my-2">
            <div class="col-sm-4">
                <span>Biaya Peminjaman / DLL</span>
            </div>
            <div class="col-sm-3">
                <span><input class="form-control" id="biaya_pinjam" type="number" max="31" maxlength="2" /></span>
            </div>

        </div>
        <p class="text-right">*Bayaran Perhari = 50.000</p>
        <form action="{{ $action != 'karyawan.updateGaji' ? url($action) : route($action) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id" value=" {{ $karyawan->id }}">
            <div class="row align-items-center my-2">
                <div class="col-sm-4">
                    <span>Total Gaji Diterima</span>
                </div>
                <div class="col-sm-3">
                    <span><input class="form-control" id="total_gaji" name="total_gaji" value="{{ $karyawan->gaji }}"
                            readonly /></span>
                </div>
                <div class="col-sm-5 text-right">
                    <span><button type="submit" class="btn btn-success text-right">Selesai Atur Gaji</button></span>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('js')
    <script>
        var total_gaji = 0;
        $('#hari').blur(function(ev) {
            ev.preventDefault();
            let hari = parseInt($(this).val())
            let total = hari * 50000
            total_gaji = total;
            $('#total_gaji_hari').val(total)
            $('#total_gaji').val(total_gaji)
        })
        $('#bonus').blur(function(ev) {
            ev.preventDefault();
            let bonus = parseInt($(this).val())
            total_gaji += bonus;
            $('#total_gaji').val(total_gaji)
        })
        $('#biaya_pinjam').blur(function(ev) {
            ev.preventDefault();
            let pinjam = parseInt($(this).val())
            total_gaji -= pinjam;
            $('#total_gaji').val(total_gaji)
        })
    </script>
@endsection
