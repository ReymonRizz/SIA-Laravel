<table class="table table-bordered" id="datatable">
    <thead>
        <tr>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Keterangan</th>
            <th class="text-center">Kode</th>
            <th class="text-center">Debit</th>
            <th class="text-center">Kredit</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total_debit = 0;
        $total_kredit = 0;
        @endphp
        @foreach($data as $dt)
        @php
        $text = $dt->serba_serbi;
        $text2 =str_replace("Beban ","Akumulasi ",$text);


        $nominal1 = $dt->nominal;
        $nominal2 = $dt->nominal;

        $total_debit += $nominal1;
        $total_kredit += $nominal2;
        
        @endphp
      
        <tr>
            <td>{{$dt->tgl_beban}}</td>
            <td>{{$text}}</td>
            <td>{{$dt->kode_beban}}</td>
            <td>Rp {{number_format($nominal1)}}</td>
            <td></td>
        </tr>


        <tr>
            <td>{{$dt->tgl_beban}}</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$text2}}</td>
            <td>{{$dt->kode_beban}}</td>
            <td></td>
            <td>Rp {{number_format($nominal2)}}</td>
        </tr>


        @endforeach
        <tr class="font-weight-bold">
            <td colspan="3">Total</td>
            <td>Rp {{number_format($total_debit)}}</td>
            <td>Rp {{number_format($total_kredit)}}</td>
        </tr>
    </tbody>
</table>