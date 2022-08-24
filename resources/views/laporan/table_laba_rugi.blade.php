<h1 class="text-center">Laporan Laba Rugi <br /> <small>{{$bulan}} {{$tahun}}</small></h1>
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
        <tr>
            <td class="col-sm-5 font-weight-bold">Penjualan</td>
        </tr>
        @foreach($data as $dt)
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

        $laba_kotor = $penjualan - $hpp;
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