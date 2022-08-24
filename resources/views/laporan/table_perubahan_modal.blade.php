<div class="table-responsive">
    <table class="table table-borderless text-center">
      
        <thead>
            <tr>
                <th class="" colspan="2">
                    <h1>LAPORAN PERUBAHAN MODAL <br/> <small>{{$bulan}} {{$tahun}}</small></h1>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Modal Awal</td>
                <td>Rp. {{number_format($data->saldo_awal)}}</td>
            </tr>
            <tr>
                <td>Penanaman Modal</td>
                <td>Rp.0</td>
            </tr>
            <tr>
                <td>Laba Usaha</td>
                <td>Rp. 0</td>
            </tr>
             <tr class="font-weight-bold">
                <td>Modal Akhir</td>
                <td>Rp. {{number_format($data->saldo_awal)}}</td>
            </tr>
        </tbody>
    </table>
</div>