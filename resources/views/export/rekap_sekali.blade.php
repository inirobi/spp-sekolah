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
        <th>Nama</th>
        <th>Kelas</th>
        <th>Akumulasi Biaya</th>
        <th>Terbayar</th>
        <th>Sisa Pembayaran</th>
        <th>Metode Pembayaran</th>
    </tr>
@php
$total = [0,0,0,0];
@endphp
@foreach($datas as $data)
@php
    $besaran = intval($data->akumulasi);
    $terbayar = intval(($data->terbayar!=0)?$data->terbayar:0);
    $sisa = $besaran - $terbayar;
    $total[0] += $besaran;
    $total[1] += $terbayar;
    $total[2] += $sisa;
    $total[3] += intval($data->banyak_tunggakan);
@endphp
    <tr>
        <td>{{$no++}}</td>
        <td style="text-align:left;">{{$data->nama}}</td>
        <td>{{$data->kelas}}&nbsp;-&nbsp;{{$data->jurusan}}</td>
        <td style="text-align:right">{{number_format($data->akumulasi,0,',','.')}}</td>
        <td style="text-align:right">{{number_format($data->terbayar,0,',','.')}}</td>
        <td style="text-align:right">{{number_format($sisa,0,',','.')}}</td>
        <td>{{$data->jenis_pembayaran}}</td>
    </tr>
@endforeach
    <tr class="footer-section">
        <th colspan="3" style="text-align:right"><span style="font-size:20px;font-weight:bold;">Total :</span></th>
        <th style="text-align:right;font-size:20px;font-weight:bold;">{{number_format($total[0],0,',','.')}}</th>
        <th style="text-align:right;font-size:20px;font-weight:bold;">{{number_format($total[1],0,',','.')}}</th>
        <th style="text-align:right;font-size:20px;font-weight:bold;">{{number_format($total[2],0,',','.')}}</th>
        <th class="footer-right">&nbsp;</th>
    </tr>
</table>
@endsection
