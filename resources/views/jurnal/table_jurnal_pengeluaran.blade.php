<table class="table table-bordered" id="datatable">
    <thead>
        <tr>
            <th rowspan="2" class="text-center">Tanggal</th>
            <th rowspan="2" class="text-center">Faktur</th>
            <th rowspan="2" class="text-center">Keterangan</th>

            <th colspan="3" class="text-center">Debit</th>
            <th colspan="1" class="text-center">Kredit</th>
        </tr>
        <tr>
            <th class="text-center">Persediaan</th>
            <th class="text-center">Utang Usaha</th>
            <th class="text-center">Beban</th>
            <th class="text-center">Kas</th>
        </tr>
    </thead>
    <tbody>
        @php
        
        @endphp
        @foreach($data as $dt)
        @php
        $persediaan = 0;
        $utang_usaha = 0;
        $beban = 0;
        $kas = 0;
        if($dt->jenis == "beli"){
        if($dt->cara_beli=='Tunai'){
        $persediaan = $dt->jlh * $dt->nominal;
        }
        if($dt->cara_beli == 'Kredit'){
        $utang_usaha = $dt->jlh * $dt->nominal;
        }
        }
        if($dt->jenis == "beban"){

        $beban = $dt->nominal;

        }
        $kas += $persediaan;
        $kas += $utang_usaha;
        $kas += $beban;
        @endphp
        <tr>
            <td>{{$dt->tgl}}</td>
            <td>{{$dt->kode}}</td>
            <td>{{$dt->ket}}</td>
            <td>Rp.{{number_format($persediaan)}}</td> <!-- Persediaan -->
            <td>Rp.{{number_format($utang_usaha)}}</td> <!-- Utang Usaha -->
            <td>Rp.{{number_format($beban)}}</td> <!-- Beban -->
            <td>Rp.{{number_format($kas)}}</td> <!-- Kas -->
        </tr>

        @endforeach
    </tbody>
</table>