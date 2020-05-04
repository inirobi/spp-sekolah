@extends('export.layout.landscape')

@section('title-html')
{{$title}}
@endsection

@section('title')
{{$title}}
@endsection

@section('content')
<table class="table1" width="100%">
    <tr>
        <th width="20%">No</th>
        <th width="75%">Tanggal</th>
        <th width="100%">Deskripsi</th>
        <th width="100%">Sumber</th>
        <th width="100%">Nominal</th>
    </tr>
@php
$total = 0;
@endphp
@foreach($datas as $data)
@php
    $total =$total + intval($data->kredit);
    $tanggal = explode(" ",$data->created_at);
@endphp
    <tr>
        <td>{{$no++}}</td>
        <td style="text-align:center;">{{$tanggal[0]}}</td>
        <td style="text-align:left;">{{$data->description}}</td>
        <td style="text-align:center;">{{$data->expense->sumber}}</td>
        <td style="text-align:right">{{number_format($data->kredit,0,',','.')}}</td>
    </tr>
@endforeach
    <tr class="footer-section">
        <th colspan="4" style="text-align:right"><span style="font-size:20px;font-weight:bold;">Total (Rp.) :</span></th>
        <th style="text-align:right;font-size:20px;font-weight:bold;">{{number_format($total,0,',','.')}}</th>
    </tr>
</table>
<small>Dibuat pada {{now()}}</small>
@endsection
