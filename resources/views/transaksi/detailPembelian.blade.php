@extends('master')
@section('judul', 'Detail Pembelian')
@section('content')
<h2>Detail Pembelian {{$no_faktur}}</h2>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php

            $total = 0
            @endphp
            @foreach($pembelian as $key=>$data)
            @php
            $total += $data->jumlah * $data->harga_beli
            @endphp
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$data->nama_barang}}</td>
                <td>{{$data->jumlah}}</td>
                <td>Rp.{{number_format($data->harga_beli,0,',','.')}}</td>
                <td>Rp.{{number_format($data->jumlah * $data->harga_beli,0,',','.')}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3">&nbsp;</td>
                <td>Total Pembelian</td>
                <td>Rp{{number_format($total,0,',','.')}}</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection