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
    @php
    $data = $akun;
    $total_aset_lancar = $akun[0]->saldo_awal + $akun[1]->saldo_awal + $akun[2]->saldo_awal;
    $total_aset = $akun[3]->saldo_awal - $akun[4]->saldo_awal;
    $total_aktiva = $total_aset_lancar + $total_aset;
    $penjualan = $akun[9]->saldo_awal;
    $hpp = $akun[11]->saldo_awal;
    $pendapatan = $akun[10]->saldo_awal;
    $laba_kotor = $penjualan - $hpp + $pendapatan ;
    $total_beban =0;
    foreach($akun as $dt){
    if(strpos($dt->nama_akun,"Beban") !== false){
    $nominal = $dt->saldo_awal;
    $total_beban += $nominal;
    }
    }
    $laba_rugi = $laba_kotor - $total_beban;
    $modal = $laba_rugi + $data[7]->saldo_awal;

    $total_passiva =$akun[5]->saldo_awal + $akun[6]->saldo_awal + $modal;
    @endphp
    <h1 class="text-center">Neraca Saldo 31 Desember {{$tahun}}</h1>
    <div class="">
        <div class="row justify-content-between col-sm-11 mx-auto">
            <div class=" p-2" style="width: 49%;position:relative;height:390px;">
                <div class="text-center font-weight-bold">
                    Aktiva
                </div>
                <div>
                    <label>Aktiva Lancar</label>
                    <div class="pl-3">
                        <div class="row">
                            <div class="col-sm-5">
                                <span>Kas</span>
                            </div>
                            <div class="">
                                <span>Rp. {{number_format($akun[0]->saldo_awal)}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <span>Piutang Usaha</span>
                            </div>
                            <div class="">
                                <span>Rp. {{number_format($akun[1]->saldo_awal)}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <span>Persediaan</span>
                            </div>
                            <div class="">
                                <span>Rp. {{'('.number_format(abs($akun[2]->saldo_awal)).')'}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-8">
                            <label>Total Aset Lancar</label>
                        </div>
                        <div class="pl-2">
                            <label>Rp. {{number_format($total_aset_lancar)}}</label>
                        </div>
                    </div>
                    <div class="mt-3"></div>
                    <label>Aktiva Tetap</label>
                    <div class="pl-3">
                        <div class="row">
                            <div class="col-sm-5">
                                <span>Peralatan</span>
                            </div>
                            <div class="">
                                <span>Rp. {{number_format($akun[3]->saldo_awal)}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <span>Akumulasi Penyusutan Peralatan</span>
                            </div>
                            <div class="">
                                <span>Rp. ({{number_format(abs($akun[4]->saldo_awal))}})</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-8">
                        <label>Total Aset Tetap</label>
                    </div>
                    <div class="pl-2">
                        <label>Rp. {{number_format($total_aset)}}</label>
                    </div>
                </div>

                <div class="row mt-2 pl-2" style="position: absolute;bottom :0;right:0;left:0;">
                    <div class="col-sm-8">
                        <label>Total Aset</label>
                    </div>
                    <div class="pl-2">
                        <label>Rp. {{number_format($total_aktiva)}}</label>
                    </div>
                </div>
            </div>
            <div style="border: 2px solid #eee;width:1%;border-radius:60px;">&nbsp;</div>
            <!-- <div style="border:2px solid black;height:100%;width:15px;position:relative;min-height:100%"></div> -->
            <div class=" p-2" style="width:49%;position:relative;">
                <div class="text-center  font-weight-bold">
                    Passiva
                </div>
                <div>
                    <label>Utang Lancar</label>
                    <div class="pl-3">
                        <div class="row">
                            <div class="col-sm-5">
                                <span>Utang Usaha</span>
                            </div>
                            <div class="">
                                <span>Rp. {{number_format($data[5]->saldo_awal)}}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-5">
                                <span>Utang Biaya</span>
                            </div>
                            <div class="">
                                <span>Rp. {{number_format($data[6]->saldo_awal)}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-5">
                            <label>Modal Pemilik</label>
                        </div>
                        <div class="pl-2">
                            <label>Rp. ({{number_format(abs($modal))}})</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 pl-2" style="position: absolute;bottom :0;right:0;left:0;">
                    <div class="col-sm-5">
                        <label>Jumlah Passive</label>
                    </div>
                    <div class="pl-2 col-sm-5">
                        <label>Rp. {{number_format($total_passiva)}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>