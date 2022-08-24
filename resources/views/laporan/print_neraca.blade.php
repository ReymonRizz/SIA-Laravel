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
    <h1 class="text-center">Laporan Neraca <br /> <small>{{$bulan}} {{$tahun}}</small></h1>
    <table class="table table-bordered" id="datatable">
        <thead>
            <tr>
                <th>No.Akun</th>
                <th>Akun</th>
                <th>Debit</th>
                <th>Kredit</th>
            </tr>
        </thead>
        <tbody>
            @php

            $total_debit = 0;
            $total_kredit = 0;

            @endphp
            @foreach($akun as $akun)
            @php
            $debit = '';
            $kredit = '';

            if($akun->saldo_normal =='Debit'){
            $debit= "Rp ". number_format($akun->saldo_awal);
            $debit_int = $akun->saldo_awal;
            $total_debit += $debit_int;
            }
            if($akun->saldo_normal =='Kredit'){
            $kredit= "Rp ". number_format($akun->saldo_awal);
            $kredit_int = $akun->saldo_awal;
            $total_kredit += $kredit_int;
            }



            @endphp
            <tr>
                <td>{{$akun->kode_akun}}</td>
                <td>{{$akun->nama_akun}}</td>
                <td>{{$debit}}</td>
                <td>{{$kredit}}</td>
            </tr>

            @endforeach
            <tr class="font-weight-bold">
                <td colspan="2">Total</td>
                <td>Rp {{number_format($total_debit)}}</td>
                <td>Rp {{number_format($total_kredit)}}</td>
            </tr>
        </tbody>
    </table>
    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>