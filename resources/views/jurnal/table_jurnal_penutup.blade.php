<h1 class="text-center">Jurnal Penutup <br /> <small>{{$bulan}} {{$tahun}}</small></h1>
<table class="table table-bordered" id="datatable">
    <thead>
        <tr>
            <th colspan="2">Tanggal</th>
            <th>Keterangan</th>
            <th>Debit</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        @php
        $penjualan = $array_data[0];
        $beban = $array_data[1];
        $total_debit = 0;
        $total_kredit = 0;

        $ikhtisar_laba_rugi_beban =0;

        $penjualan_harga = $penjualan->data[0]->nominal;

        @endphp
        <tr>
            <td rowspan="{{count($penjualan->data)+1}}">Des</td>
            <td rowspan="{{count($penjualan->data)+1}}">31</td>
            <td>Penjualan</td>
            <td>Rp. {{number_format($penjualan->data[0]->nominal)}}</td>
            <td></td>
        </tr>
        <tr>

            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ikhtisar Laba/Rugi</td>
            <td></td>
            <td>Rp. {{number_format($penjualan->data[0]->nominal)}}</td>
        </tr>
        <tr>
            <td rowspan="{{count($beban->data)+1}}">Des</td>
            <td rowspan="{{count($beban->data)+1}}">31</td>
            <td>Ikhtisar Laba/Rugi</td>

            <td> @foreach($beban->data as $bbn)
                @php
                $ikhtisar_laba_rugi_beban +=$bbn->total;
                @endphp
                @endforeach
                Rp. {{number_format($ikhtisar_laba_rugi_beban)}}</td>
            <td></td>
        </tr>
        @foreach($beban->data as $bbn)
        <tr>

            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$bbn->ket}}</td>
            <td></td>
            <td>Rp. {{number_format($bbn->total)}}</td>
        </tr>
        @endforeach
        <tr>
        <td rowspan="2">Des</td>
            <td rowspan="2">31</td>
            <td>Ikhtisar Laba/Rugi</td>
            <td>Rp. @php $penjualan_harga -= $ikhtisar_laba_rugi_beban @endphp {{number_format($penjualan_harga)}}</td>
            <td></td>
        </tr>
        <tr>

            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Modal</td>
            <td></td>
            <td>Rp. {{number_format($penjualan_harga)}}</td>
        </tr>
    </tbody>
</table>