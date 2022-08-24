@extends('master')
@section('judul', 'Jurnal Penerimaan Kas')
@section('content')
<!-- <button class="btn btn-primary my-2" data-toggle="modal" data-target="#addBebanModal">+ Aset</button> -->
@php
$month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
$year = date('Y');
@endphp

<form id="form_search">
    @csrf
    <div class="form-group">
        <label>Bulan</label>
        <select name="bulan" id="bulan" class="form-control">
            @foreach($month as $key=>$value)
            <option value="{{$key + 1}}">{{$value}}</option>
            @endforeach

        </select>

    </div>
    <div class="form-group">
        <label>Tahun</label>
        <select name="tahun" id="tahun" class="form-control">
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
    </div>
</form>
</div>
<div class="table-responsive p-2" id="table_result">

</div>

@endsection

@section('js')
<script>
    $('#form_search').submit(function(ev) {
        ev.preventDefault();
        $.ajax({
            url: `/jurnal/search/penerimaan`,
            type: 'POST',
            cache: false,
            data: $(this).serialize(),
            success: function(res) {
                // console.log(res)
                $('#table_result').html(res.view)
            }
        })
    })
</script>
@endsection