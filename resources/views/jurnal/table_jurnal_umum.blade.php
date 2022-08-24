<h1 class="text-center">Jurnal Umum <br /> <small>{{$bulan}} {{$tahun}}</small></h1>
<table class="table table-bordered" id="datatable">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>No. Faktur</th>
            <th>Nama Akun</th>
            <th>Debit</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        @php

        $total_debit = 0;
        $total_kredit = 0;
        @endphp

        @foreach($data as $dt)
        @for($i=0;$i < 2;$i++) @php $debit=0; $kredit=0; $akun=$dt->jenis;$debit_format = 0;$kredit_format = 0;
            if($dt->jenis =='Pembelian'){
            $akun = "Persediaan";
            }
            if($i % 2==0){
            if($akun == 'Penjualan'){
            $debit = $dt->nominal;
            $debit_format = "Rp ". number_format($debit);
            $kredit_format = "-";
            $total_debit += $debit;
            if($dt->cara_beli == 'Tunai'){
            if($dt->jenis=='Harga Pokok Penjualan'){

            $akun = "Persediaan";
            } else {

            $akun = "Kas";
            }
            }
            if($dt->cara_beli == 'Kredit'){
            $akun = "Hutang Usaha";
            }
            } else {
            if($dt->cara_beli == 'Tunai'){
            $jlh =1;
            if($dt->jlh > 0){
            $jlh = $dt->jlh;
            }
            $debit = $dt->nominal * $jlh;
            $debit_format = "Rp ". number_format($debit);
            $kredit_format = "-";
            $total_debit += $debit;

            } else {
            $jlh =1;
            if($dt->jlh > 0){
            $jlh = $dt->jlh;
            }
            $debit = $dt->nominal * $jlh;
            $debit_format = "Rp ". number_format($debit);
            $kredit_format = "-";
            $total_debit += $debit;
            if($dt->cara_beli == 'Tunai'){
            if($dt->jenis=='Harga Pokok Penjualan'){

            $akun = "Persediaan";
            } else {

            $akun = "Kas";
            }
            }
            if($dt->cara_beli == 'Kredit'){
            $akun = "Hutang Usaha";
            }

            }
            }
            } else {
            $jlh =1;
            if($dt->jlh > 0){
            $jlh = $dt->jlh;
            }
            if($akun=='Penjualan'){
            $kredit = $dt->nominal;
            $kredit_format = "Rp ". number_format($kredit);
            $debit_format = "-";
            $total_kredit += $kredit;
            } else {
            $jlh =1;
            if($dt->jlh > 0){
            $jlh = $dt->jlh;
            }
            if($dt->cara_beli == 'Tunai'){
            $kredit = $dt->nominal * $jlh;
            $kredit_format = "Rp ". number_format($kredit);
            $debit_format = "-";
            $total_kredit += $kredit;

            if($dt->cara_beli == 'Tunai'){
            if($dt->jenis=='Harga Pokok Penjualan'){

            $akun = "Persediaan";
            } else {

            $akun = "Kas";
            }
            }
            if($dt->cara_beli == 'Kredit'){
            $akun = "Hutang Usaha";
            }
            }else{

            $kredit = $dt->nominal;
            $kredit_format = "Rp ". number_format($kredit);
            $debit_format = "-";
            $total_kredit += $kredit;




            }
            }
            }
            @endphp
            <tr>
                <td>{{$dt->tgl}}</td>
                <td>{{$dt->kode}}</td>
                @php
                if($i % 2==0){
                @endphp
                <td>{{$akun}}</td>
                @php
                } else {
                @endphp
                <td class="pl-4">{{$akun}}</td>
                @php
                }
                @endphp

                <td>{{$debit_format}}</td>
                <td>{{$kredit_format}}</td>
            </tr>
            @endfor
            @endforeach
            <tr>
                <td colspan="3" class="text-right font-weight-bold">Total</td>
                <td class="text-right font-weight-bold">Rp {{number_format($total_debit)}}</td>
                <td class="text-right font-weight-bold">Rp {{number_format($total_kredit)}}</td>
            </tr>
    </tbody>
</table>