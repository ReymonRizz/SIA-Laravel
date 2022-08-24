

<table class="table table-bordered" id="datatable">
    <thead>
        <tr>
            <th rowspan="2" class="text-center">Tanggal</th>
            <th rowspan="2" class="text-center">Faktur</th>
            <th rowspan="2" class="text-center">Keterangan</th>

            <th colspan="3" class="text-center">Debit</th>
            <th colspan="4" class="text-center">Kredit</th>
        </tr>
        <tr>
            <th class="text-center">Kas</th>
            <!-- <th class="text-center">Potongan Penjualan</th> -->
            <th class="text-center">HPP</th>
            <th class="text-center">Beban Jasa</th>
            <!--  -->

            <th class="text-center">Penjualan</th>
            <th class="text-center">Pendapatan Jasa</th>
            <th class="text-center">Piutang Usaha</th>
            <th class="text-center">Persediaan</th>
        </tr>
    </thead>
    <tbody>
        @php

        @endphp
        @foreach($data as $dt)
        @php
        $kas = 0;
        $potongan_penjualan = 0;
        $hpp =$dt->harga_beli * $dt->jlh;
        $beban_jasa = 0;
        $penjualan = 0;
        $pendapatan_jasa = 0;
        $piutang_usaha = 0;
        $persediaan = $hpp;
        if($dt->cara_jual=='Tunai'){
            $penjualan = $dt->nominal * $dt->jlh;
        }
      
        $kas+=$penjualan;
        @endphp
        <tr>
            <td>{{$dt->tgl}}</td>
            <td>{{$dt->kode}}</td>
            <td>{{$dt->ket}}</td>
            <td>Rp.{{number_format($kas)}}</td>
            <!-- <td>Rp.{{number_format($potongan_penjualan)}}</td> -->
            <td>Rp.{{number_format($hpp)}}</td>
            <td>Rp.{{number_format($beban_jasa)}}</td>
            <td>Rp.{{number_format($penjualan)}}</td>
            <td>Rp.{{number_format($pendapatan_jasa)}}</td>
            <td>Rp.{{number_format($piutang_usaha)}}</td>
            <td>Rp.{{number_format($persediaan)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>