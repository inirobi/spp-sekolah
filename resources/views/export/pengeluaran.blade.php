@extends('export.layout.landscape')

@section('title-html')
{{$title}}
@endsection

@section('title')
{{$title}}
@endsection

@section('content')
<table class="table1">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Deskripsi</th>
        <th>Nominal</th>
    </tr>
@php
$total = 0;
@endphp
@foreach($datas as $data)
@php
    $total =$total + intval($data->kredit);
    
@endphp
    <tr>
        <td>{{$no++}}</td>
        <td style="text-align:left;">{{$data->created_at}}</td>
        <td style="text-align:left;">{{$data->description}}</td>
        <td style="text-align:right">{{number_format($data->kredit,0,',','.')}}</td>
    </tr>
@endforeach
    <tr class="footer-section">
        <th colspan="3" style="text-align:right"><span style="font-size:20px;font-weight:bold;">Total :</span></th>
        <th style="text-align:right;font-size:20px;font-weight:bold;">{{number_format($total,0,',','.')}}</th>
    </tr>
</table>
<small>Dibuat pada {{now()}}</small>
@endsection
