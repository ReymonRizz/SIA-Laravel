<h1 class="text-center">BUKU BESAR <br /> <small>{{$bulan}} {{$tahun}}</small></h1>
<div class="table-responsive">
    @foreach($data[0]->data as $dt)
    @php
    $saldo =0;
    @endphp
    <b>{{$dt->kode_akun}} - {{$dt->nama_akun}}</b>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">Debit</th>
                <th rowspan="2">Kredit</th>
                <th colspan="2">Saldo</th>
            </tr>
            <tr>
                <th>Debit</th>
                <th>Kredit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4">
                    Saldo Awal
                </td>
                <td colspan="2">
                    Bulan: {{$bulan}}<br>
                    Tahun: {{$tahun}}<br>
                    @if($dt->saldo_normal == "Debit")
                    <?php echo "Rp " . number_format($dt->saldo_awal, 0, ',', '.') ?>
                    <?php $saldo = $dt->saldo_awal ?>

                    @else
                    <?php echo "Rp " . number_format(-$dt->saldo_awal, 0, ',', '.') ?>
                    <?php $saldo = $dt->saldo_awal ?>

                    @endif
                </td>
            </tr>
            @if($dt->kode_akun == 1011)
            @php
            $debit = 0;
            $kredit = 0;
            $debit_format = "";
            $kredit_format = "";
            @endphp

            @foreach($data[0]->penjualan as $jual)
            @php
            if($jual->cara_jual =='Tunai'){
            $debit += $jual->harga_jual;
            $debit_format = "Rp ".number_format($debit);
            $saldo += $debit;
            $kredit_format = "-";
            }
            if($jual->cara_jual =='Kredit'){
            $kredit += $jual->harga_jual;
            $kredit_format = "Rp ".number_format($kredit);
            $saldo -= $kredit;
            $debit_format = "-";
            }
            @endphp
            <tr>
                <td>{{$jual->tgl_jual}}</td>
                <td>Penjualan {{$jual->nama_barang}}</td>
                <td>{{$debit_format}}</td>
                <td>{{$kredit_format}}</td>
                <td>Rp {{number_format($saldo)}}</td>
                <td></td>
            </tr>
            @endforeach
            @endif

            <!-- Persediaan -->
            @if($dt->kode_akun == 1103)
            @php
            $debit = 0;
            $kredit = 0;
            $debit_format = "";
            $kredit_format = "";
            @endphp

            @foreach($data[0]->pembelian as $beli)
            @php
            if($beli->cara_beli =='Tunai'){
            $debit += $beli->harga_beli;
            $debit_format = "Rp ".number_format($debit);
            $saldo += $debit;
            $kredit_format = "-";
            }
            if($beli->cara_beli =='Kredit'){
            $kredit += $beli->harga_beli;
            $kredit_format = "Rp ".number_format($kredit);
            $saldo -= $kredit;
            $debit_format = "-";
            }
            @endphp
            <tr>
                <td>{{$beli->tgl_beli}}</td>
                <td>Pembelian {{$beli->nama_barang}}</td>
                <td>{{$debit_format}}</td>
                <td>{{$kredit_format}}</td>
                <td>Rp {{number_format($saldo)}}</td>
                <td></td>
            </tr>
            @endforeach
            @php
            $debit = 0;
            $kredit = 0;
            $debit_format = "";
            $kredit_format = "";
            @endphp

            @foreach($data[0]->penjualan as $jual)
            @php
            $kredit += $jual->harga_jual;
            $kredit_format = "Rp ".number_format($kredit);
            $saldo -= $kredit;
            $debit_format = "-";
            @endphp
            <tr>
                <td>{{$jual->tgl_jual}}</td>
                <td>Penjualan {{$jual->nama_barang}}</td>
                <td>{{$debit_format}}</td>
                <td>{{$kredit_format}}</td>
                <td>Rp {{number_format($saldo)}}</td>
                <td></td>
            </tr>
            @endforeach
            @endif


            <!-- Penjualan -->
            @if($dt->kode_akun == 4101)
            @php
            $debit = 0;
            $kredit = 0;
            $debit_format = "";
            $kredit_format = "";
            @endphp

            @foreach($data[0]->penjualan as $jual)
            @php
            $kredit += $jual->harga_jual;
            $kredit_format = "Rp ".number_format($kredit);
            $saldo += $kredit;
            $debit_format = "-";
            @endphp
            <tr>
                <td>{{$jual->tgl_jual}}</td>
                <td>Penjualan {{$jual->nama_barang}}</td>
                <td>{{$debit_format}}</td>
                <td>{{$kredit_format}}</td>
                <td></td>
                <td>Rp {{number_format($saldo)}}</td>
            </tr>
            @endforeach
            @endif


            <!-- Hutang Biaya -->
            @if($dt->kode_akun == 2102)
            @php
            $debit = 0;
            $kredit = 0;
            $debit_format = "";
            $kredit_format = "";
            @endphp

            @foreach($data[0]->beban_gaji as $gaji)
            @php
            $kredit += $gaji->nominal;
            $kredit_format = "Rp ".number_format($kredit);
            $saldo += $kredit;
            $debit_format = "-";
            @endphp
            <tr>
                <td>{{$gaji->tgl_beban}}</td>
                <td>{{$gaji->keterangan}}</td>
                <td>{{$debit_format}}</td>
                <td>{{$kredit_format}}</td>
                <td></td>
                <td>Rp {{number_format($saldo)}}</td>
            </tr>
            @endforeach
            @endif
            

            <!-- Pendapatan Jasa -->
            @if($dt->kode_akun == 4102)
            @php
            $debit = 0;
            $kredit = 0;
            $debit_format = "";
            $kredit_format = "";
            @endphp

            @foreach($data[0]->jasa as $jasa)
            @php
            $kredit += $jasa->harga_jual;
            $kredit_format = "Rp ".number_format($kredit);
            $saldo += $kredit;
            $debit_format = "-";
            @endphp
            <tr>
                <td>{{$jasa->tgl_jual}}</td>
                <td>Jasa {{$jasa->nama_jasa}}</td>
                <td>{{$debit_format}}</td>
                <td>{{$kredit_format}}</td>
                <td></td>
                <td>Rp {{number_format($saldo)}}</td>
            </tr>
            @endforeach
            @endif
            

            <!-- HPP -->
            @if($dt->kode_akun == 5101)
            @php
            $debit = 0;
            $kredit = 0;
            $debit_format = "";
            $kredit_format = "";
            @endphp

            @foreach($data[0]->penjualan as $jual)
            @php
            $kredit += $jual->harga_beli;
            $kredit_format = "Rp ".number_format($kredit);
            $saldo += $kredit;
            $debit_format = "-";
            @endphp
            <tr>
                <td>{{$jual->tgl_jual}}</td>
                <td>{{$jual->keterangan}}</td>
                <td>{{$debit_format}}</td>
                <td>{{$kredit_format}}</td>
                <td></td>
                <td>Rp {{number_format($saldo)}}</td>
            </tr>
            @endforeach
            @endif

            <!-- Beban Gaji -->
            @if($dt->kode_akun == 6101)
            @php
            $debit = 0;
            $kredit = 0;
            $debit_format = "";
            $kredit_format = "";
            @endphp

            @foreach($data[0]->beban_gaji as $gaji)
            @php
            $kredit += $gaji->nominal;
            $kredit_format = "Rp ".number_format($kredit);
            $saldo += $kredit;
            $debit_format = "-";
            @endphp
            <tr>
                <td>{{$gaji->tgl_beban}}</td>
                <td>{{$gaji->keterangan}}</td>
                <td>{{$debit_format}}</td>
                <td>{{$kredit_format}}</td>
                <td></td>
                <td>Rp {{number_format($saldo)}}</td>
            </tr>
            @endforeach
            @endif

            <!-- Beban Gaji -->
            @if($dt->kode_akun == 6102)
            @php
            $debit = 0;
            $kredit = 0;
            $debit_format = "";
            $kredit_format = "";
            @endphp

            @foreach($data[0]->beban_listrik as $listrik)
            @php
            $kredit += $listrik->nominal;
            $kredit_format = "Rp ".number_format($kredit);
            $saldo += $kredit;
            $debit_format = "-";
            @endphp
            <tr>
                <td>{{$listrik->tgl_beban}}</td>
                <td>{{$listrik->keterangan}}</td>
                <td>{{$debit_format}}</td>
                <td>{{$kredit_format}}</td>
                <td></td>
                <td>Rp {{number_format($saldo)}}</td>
            </tr>
            @endforeach
            @endif

            <!-- Beban Jasa -->
            @if($dt->kode_akun == 6104)
            @php
            $debit = 0;
            $kredit = 0;
            $debit_format = "";
            $kredit_format = "";
            @endphp

            @foreach($data[0]->beban_jasa as $jasa)
            @php
            $kredit += $jasa->nominal;
            $kredit_format = "Rp ".number_format($kredit);
            $saldo += $kredit;
            $debit_format = "-";
            @endphp
            <tr>
                <td>{{$jasa->tgl_beban}}</td>
                <td>{{$jasa->keterangan}}</td>
                <td>{{$debit_format}}</td>
                <td>{{$kredit_format}}</td>
                <td></td>
                <td>Rp {{number_format($saldo)}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @endforeach
</div>