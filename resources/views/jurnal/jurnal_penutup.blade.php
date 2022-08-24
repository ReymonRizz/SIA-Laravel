@extends('master')
@section('judul', 'Jurnal Penutup')
@section('content')
<!-- <button class="btn btn-primary my-2" data-toggle="modal" data-target="#addBebanModal">+ Aset</button> -->
@php
$month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
$year = date('Y');
@endphp
<form id="form_search">
    @csrf
   
    <div class="form-group">
        <label>Tahun</label>
        <select name="tahun" id="tahun_pilih" class="form-control">
            {{ $last= date('Y')-5 }}
            {{ $now = date('Y') }}

            @for ($i = $now; $i >= $last; $i--)
            <option value="{{ $i }}">{{ $i }}</option>
            @endfor

        </select>

    </div>

    <div class="form-group">
        <label>&nbsp;</label>
        <button class="btn btn-primary col-sm-2">Cari</button>
        <button type="button" id="print" class="btn btn-light border col-sm-2">Print</button>
    </div>
</form>
<div class="table-responsive" id="table_result">
    
</div>

@endsection

@section('js')
<script>
    $('#print').click(function() {
        let tahun = $('#tahun_pilih').val()
        let bulan = $('#bulan').val()
        window.open(`/jurnal/penutup/print?tahun=${tahun}`)
    })
    $('#nominal_format').change(function() {
        let nominal = $(this).val()

        nominal = nominal.toString().replace(/\./g, '')
        $('#nominal').val(nominal)
    })
    $('#nominal_format_edit').change(function() {
        let nominal = $(this).val()

        nominal = nominal.toString().replace(/\./g, '')
        $('#nominal_edit').val(nominal)
    })

    // function deletPeralatan(id) {

    //     swal.fire({
    //         icon: 'warning',
    //         title: 'Hapus Peralatan',
    //         text: "Anda Yakin Hapus Peralatan Ini ?",
    //         showCancelButton: true,
    //         confirmButtonText: 'Yes',
    //         confirmButtonColor: "#dc3545"
    //     }).then((result) => {
    //         if (result.value) {
    //             $.ajax({
    //                 url: '/data-peralatan/delete/' + id,
    //                 type: 'GET',
    //                 cache: false,
    //                 success: function(res) {
    //                     if (res == 200) {

    //                         swal.fire({
    //                             icon: 'success',
    //                             title: 'Berhasil Hapus Peralatan}',
    //                         }).then((result) => {
    //                             location.reload()
    //                         });
    //                     }
    //                 }
    //             })
    //         }
    //     })
    // }


    $('#form_search').submit(function(ev){
        ev.preventDefault();
        $.ajax({
            url :`/jurnal/search/jurnal-penutup`,
            type : 'POST',
            cache : false,
            data : $(this).serialize(),
            success:function(res){
                console.log(res)
                $('#table_result').html(res.view)
            }
        })
    })

    function editBeban(d) {
        let data = JSON.parse(d)
        $('#id_peralatan').val(data.id)
        $('#nama_aset_edit').val(data.nama_aset)
        $('#tgl_aset_edit').val(data.tgl_aset)
        $('#nominal_format_edit').val(formatNumber(data.harga_aset))
        $('#nominal_edit').val(data.harga_aset)
        $('#jumlah_aset_edit').val(data.jumlah_aset)
        $('#masa_manfaat_edit').val(data.masa_manfaat)
        $('#editperalatanmdl').modal('show')
    }
</script>
@endsection