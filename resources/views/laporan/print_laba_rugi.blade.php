<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jurnal Penyesuaian</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
<h1 class="text-center">Laporan Laba Rugi <br /> <small>31 Desember {{$tahun}}</small></h1>
<table class="table table-borderless">

    <tbody>
        @php
        $penjualan = 0;
        $hpp =0;
        $laba_kotor = 0;

      
        $beban_gaji = 0 ;
        $beban_listrik = 0 ;
        $beban_penyusutan_peralatan = 0 ;
        $total_beban = 0;


        function currencyFormat($number){
        return number_format($number,0,',','.');
        }
        @endphp
       
        @foreach($data as $dt)
        @if($dt->kode_akun == 4102)
        @php
        $pendapatan = $dt->saldo_awal ?? 0;
        @endphp
        <tr>
            <td class="col-sm-5">Pendapatan</td>
            <td>Rp. {{currencyFormat($pendapatan)}}</td>
            <td></td>
        </tr>
        @endif
        @if($dt->kode_akun == 4101)
        @php
        $penjualan = $dt->saldo_awal ?? 0;

        @endphp
        <tr>
            <td class="col-sm-3">{{$dt->nama_akun}}</td>
            <td>Rp. {{currencyFormat($penjualan)}}</td>
            <td></td>
        </tr>
        @endif
        @if($dt->kode_akun == 5101)
        @php
        $hpp = $dt->saldo_awal ? $dt->saldo_awal : 0;
        @endphp
        <tr>
            <td>Harga Pokok Penjualan</td>
            <td>Rp. ({{currencyFormat($hpp)}})</td>
            <td></td>
        </tr>
        @endif
        @endforeach
        @php

        $laba_kotor = $penjualan - $hpp + $pendapatan ;
        @endphp

        <tr style="font-weight: bold;">
            <td style="padding-left:45px;">Total Penjualan</td>
            <td></td>
            <td>Rp. {{currencyFormat($laba_kotor)}}</td>
        </tr>
        <tr style="font-weight: bold;">
            <td colspan="3">Beban</td>
        </tr>
        @foreach($data as $dt)
        @if(strpos($dt->nama_akun,"Beban") !== false)
        @php
        $nominal = $dt->saldo_awal;
        $total_beban += $nominal;
        @endphp
        <tr>
            <td>{{$dt->nama_akun}}</td>
            <td>Rp. ({{currencyFormat($nominal)}})</td>
            <td></td>
        </tr>
        @endif
        @endforeach
        <!-- <tr>
            <td>Beban Gaji</td>
            <td>Rp. {{currencyFormat($beban_gaji)}}</td>
            <td></td>
        </tr>
        <tr>
            <td>Beban Utilitas</td>
            <td>Rp. {{currencyFormat($beban_listrik)}}</td>
            <td></td>
        </tr>
        <tr>
            <td>Beban Penyusutan Peralatan Toko</td>
            <td>Rp. {{currencyFormat($beban_penyusutan_peralatan)}}</td>
            <td></td>
        </tr> -->

        @php
        $laba_usaha = $laba_kotor - $total_beban;
        @endphp
        <tr style="font-weight: bold;">
            <td style="padding-left:45px;">Total Beban</td>
            <td></td>
            <td style="border-bottom: 1px solid black;">Rp. ({{currencyFormat($total_beban)}})</td>
        </tr>
        <tr style="font-weight: bold;">
            <td>Laba Usaha</td>
            <td></td>
            <td>Rp. {{currencyFormat($laba_usaha)}}</td>
        </tr>
    </tbody>
</table>
    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>