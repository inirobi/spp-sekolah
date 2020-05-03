@extends('layouts.app')

@section('title')
SPP | Cicilan Pembayaran
@endsection

@section('content')

<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

    <div class="hpanel hblue sparkline16-list responsive-mg-b-30">
        <div class="panel-body custom-panel-jw">
            <h3>Form Pembayaran</h3>
            <p class="all-pro-ad">Masukan pembayaran disini</p>
            <hr>

            <div class="sparkline16-graph">
                <div class="date-picker-inner">

                    <div class="basic-login-inner">
                        <form action="{{route('payment.details.cicilan.store')}}" method="post" id="form-bayar">
                            @csrf
                            <input type="hidden" name="financing_category_id" value="{{ $payments->financing_category_id }}">
                            <input type="hidden" name="student_id" value="{{ $payments->student_id}}">
                            <input type="hidden" name="payment_id" value="{{ $payments->id }}">
                            <div class="form-group data-custon-pick" id="data_4">
                                <label>Tanggal Pembayaran</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="calendar" value="{{$date}}" readonly title="Tanggal pembayaran otomatis hari ini">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nominal</label>
                                <div class="input-group date">
                                    <span class="input-group-addon">Rp.</span>
                                    <input type="number" min="0" class="form-control" name="nominal"
                                        placeholder="Masukan nominal">
                                </div>
                            </div>
                            <div class="login-btn-inner">
                                <div class="inline-remember-me">
                                    @if($payment_details->last() !== null && $payment_details->last()->status=="Lunas")
                                    <div class="alert alert-info" role="alert">
                                        <strong>Info!</strong> Pembayaran telah lunas.
                                    </div>
                                    @else
                                    <button class="btn btn-sm btn-primary pull-right login-submit-cs"
                                        id="btn-form-bayar">Submit</button>
                                    <label>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
    <div class="hpanel hblue contact-panel contact-panel-cs responsive-mg-b-30">
        <div class="panel-body custom-panel-jw">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="container-sm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span class="">NIS :
                                                <strong>{{$datas[0]->nis}}</strong></span><br>
                                            <span class="">Nama :
                                                <strong>{{$datas[0]->nama}}</strong></span><br>
                                            <span class="">Kelas &nbsp;: <strong>{{$datas[0]->kelas}} -
                                                    {{$datas[0]->major->nama}}</strong></span>
                                        </div>
                                        <div class="col-md-6">
                                            <div style="float:right;">
                                                <a href="{{ route('financing.periode',$financing->id)}}"
                                                    style="color:white" class=" btn btn-success"><i
                                                        class="fa fa-print"></i>&nbsp; Cetak</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control dt-tb">
                                            <option value="">Export Basic</option>
                                            <option value="all">Export All</option>
                                            <option value="selected">Export Selected</option>
                                        </select>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true"
                                        data-show-columns="true" data-show-pagination-switch="true"
                                        data-show-refresh="true" data-key-events="true" data-show-toggle="true"
                                        data-resizable="true" data-cookie="true" data-cookie-id-table="saveId"
                                        data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">
                                                    <div style="text-align: center">
                                                    No
                                                    </div>
                                                </th>
                                                <th data-field="tanggal">
                                                    <div style="text-align: center">
                                                    Tanggal Pembayaran
                                                    </div>
                                                </th>
                                                <th data-field="nominal">
                                                    <div style="text-align: center">
                                                    Nominal
                                                    </div>
                                                </th>
                                                <th data-field="total">
                                                    <div style="text-align: center">
                                                    Penerima
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $total=0;
                                            @endphp
                                            @foreach($payment_details as $data)
                                            @php
                                            $total+=intval($data->nominal);
                                            @endphp
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <div style="text-align: center">
                                                    {{$no++}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: center">
                                                    {{$data->created_at}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: right">
                                                    {{number_format($data->nominal,0,',','.')}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: center">
                                                    {{$data->user->name}}
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @php
                                            $sisa=intval($financing->besaran)-$total;
                                            @endphp
                                        </tbody>
                                    </table>
                                    <div class="container-sm" style="margin-top:10px">
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div style="float:right; margin-right:20%">
                                                    <div class="row">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Total</td>
                                                                    <td>:</td>
                                                                    <td>Rp.</td>
                                                                    <td>
                                                                        <div style="text-align: right">
                                                                            <span class="" style="font-size:18px;">
                                                                                <strong>{{number_format($financing->besaran,0,',','.')}}</strong></span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Telah dibayar</td>
                                                                    <td>:</td>
                                                                    <td>Rp.</td>
                                                                    <td style="border-bottom: 1px solid #000;">
                                                                        <div style="text-align: right">
                                                                            <span class="" style="font-size:18px;">
                                                                                <strong>{{number_format($total,0,',','.')}}</strong></span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tunggakan</td>
                                                                    <td>:</td>
                                                                    <td>Rp.</td>
                                                                    <td>
                                                                        <div style="text-align: right">
                                                                            @if($sisa!=0)
                                                                            <span class="" style="font-size:24px;color:red">
                                                                            @else
                                                                            <span class="" style="font-size:24px;color:green">
                                                                            @endif
                                                                                <strong>{{number_format($sisa,0,',','.')}}</strong>
                                                                            </span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Static Table End -->
@endsection

@push('styles')
<!-- x-editor CSS  -->
<link rel="stylesheet" href="{{ asset('assets/css/editor/select2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/editor/datetimepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/editor/bootstrap-editable.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/editor/x-editor-style.css') }}">
<!-- normalize CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/data-table/bootstrap-table.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/data-table/bootstrap-editable.css') }}">
@endpush

@push('scripts')
<!-- data table JS
		============================================ -->
<script src="{{ asset('assets/js/data-table/bootstrap-table.js') }}"></script>
<script src="{{ asset('assets/js/data-table/tableExport.js') }}"></script>
<script src="{{ asset('assets/js/data-table/data-table-active.js') }}"></script>
<script src="{{ asset('assets/js/data-table/bootstrap-table-editable.js') }}"></script>
<script src="{{ asset('assets/js/data-table/bootstrap-editable.js') }}"></script>
<script src="{{ asset('assets/js/data-table/bootstrap-table-resizable.js') }}"></script>
<script src="{{ asset('assets/js/data-table/colResizable-1.5.source.js') }}"></script>
<script src="{{ asset('assets/js/data-table/bootstrap-table-export.js') }}"></script>
<!--  editable JS
		============================================ -->
<script src="{{ asset('assets/js/editable/jquery.mockjax.js') }}"></script>
<script src="{{ asset('assets/js/editable/mock-active.js') }}"></script>
<script src="{{ asset('assets/js/editable/select2.js') }}"></script>
<script src="{{ asset('assets/js/editable/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/editable/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('assets/js/editable/bootstrap-editable.js') }}"></script>
<script src="{{ asset('assets/js/editable/xediable-active.js') }}"></script>

<!-- datapicker JS
		============================================ -->
<script src="{{asset('assets/js/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/js/datapicker/datepicker-active.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#btn-form-bayar').on('click', function () {
            event.preventDefault();
            swal({
                title: 'Apakah anda yakin?',
                text: 'Data yang sudah dimasukan tidak dapat diubah!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function (value) {
                if (value) {
                    let form = $('#form-bayar').serializeArray();
                    if (form[5].value>0) {
                        document.getElementById('form-bayar').submit();
                    } else {
                        swal({
                            text: 'Nominal Kosong! Transaksi dibatalkan',
                            icon: 'warning',
                            buttons: ["Yes!"],
                        });
                    }
                } else {
                    swal("Transaksi di batalkan!");
                }
            });
        });
    });

</script>
@endpush

@push('breadcrumb-left')
<div class="col-md-1" style="item-align:center">
<a class="btn btn-primary" href="{{ route('payment.show',$financing->id)}}" title="Kembali"><i class="fa fa-arrow-left" ></i></a>
</div>
<div class="col-md-11">
    <div style="margin-left:15px;">
    <h4>Cicilan {{$financing->nama}}</h4>
    <span class="all-pro-ad">Kategori Pembayaran : <strong>{{$financing->jenis}}</strong></span>
    </div>
</div>
@endpush

@push('breadcrumb-right')
<div style="float:right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="margin-bottom:0">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/payment')}}">Pembayaran</a></li>
            <li class="breadcrumb-item"><a href="{{ route('payment.show',$financing->id)}}">{{$financing->nama}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details</li>
        </ol>
    </nav>
</div>
@endpush
