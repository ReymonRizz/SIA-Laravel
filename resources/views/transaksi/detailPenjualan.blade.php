@extends('master')
@section('judul', 'Detail Penjualan')
@section('content')
<h2>Detail Penjualan {{$no_faktur}}</h2>
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
            @foreach($penjualan as $key=>$data)

            @php
            if($data->jasa !=0){
            $total += $data->jumlah * $data->harga_jasa;
            } else {
            $total += $data->jumlah * $data->harga_jual;
            }
            @endphp
            <tr>
                <td>{{$key+1}}</td>
                @if($data->jasa !=0)
                <td>{{$data->nama_jasa}}</td>
                @else
                <td>{{$data->nama_barang}}</td>

                @endif
                <td>{{$data->jumlah}}</td>

                @if($data->jasa !=0)
                <td>Rp.{{number_format($data->harga_jasa,0,',','.')}}</td>
                <td>Rp.{{number_format($data->jumlah * $data->harga_jasa,0,',','.')}}</td>
                @else
                <td>Rp.{{number_format($data->harga_jual,0,',','.')}}</td>
                <td>Rp.{{number_format($data->jumlah * $data->harga_jual,0,',','.')}}</td>

                @endif
            </tr>
            @endforeach
            <tr>
                <td colspan="3">&nbsp;</td>
                <td>Total Penjualan</td>
                <td>Rp{{number_format($total,0,',','.')}}</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection