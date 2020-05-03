@extends('layouts.app')

@section('title')
SPP | Pembayaran Bulanan
@endsection

@section('content')
@php
$bulan = ['',"Januari", "Februari", "Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
@endphp


<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

    <div class="hpanel hblue sparkline16-list responsive-mg-b-30">
        <div class="panel-body custom-panel-jw">
            <h3>Form Pembayaran</h3>
            <p class="all-pro-ad">Masukan pembayaran disini</p>
            <hr>

            <div class="sparkline16-graph">
                <div class="date-picker-inner">

                    <div class="basic-login-inner">
                        
                            <div class="form-group">
                                <label>NIS</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                                    <input type="text" class="form-control" name="calendar" value="{{$datas['nis']}}" readonly disable>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                    <input type="text"class="form-control" name="nominal"
                                        value="{{$datas['nama']}}"readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mortar-board  "></i></span>
                                    <input type="text" min="0" class="form-control" name="nominal"
                                        value="{{$datas['kelas']}} - {{$datas->major->nama}}"readonly>
                                </div>
                            </div>
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
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div style="float:right;">
                                                <a href="{{ route('financing.periode',$financing->id)}}"
                                                    style="color:white; margin-top:0" class=" btn btn-success" target="_blank"><i
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
                                                <th data-field="periode">
                                                    <div style="text-align: center">
                                                    Periode
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
                                                <th data-field="action">
                                                    <div style="text-align: center">
                                                    Action
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $total=0;
                                            @endphp
                                            @foreach($bigDatas as $data)
                                            @php
                                            if($data->status=="Lunas"){
                                                $total+=intval($data->nominal);
                                            }
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
                                                    @if($data->status=="Lunas")
                                                    {{$data->created_at}}
                                                    @elseif($data->status=="Waiting")
                                                    <span class="badge" style="background-color:yellow;color:black">Waiting</span>
                                                    @else
                                                    <span class="badge" style="background-color:red;color:white">Nunggak</span>
                                                    @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: right">
                                                    {{$bulan[$data->bulan]}} {{$data->tahun}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: right">
                                                    {{number_format($data->nominal,0,',','.')}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: center">
                                                    @if($data->status=="Lunas")
                                                    {{$data->penerima}}
                                                    @elseif($data->status=="Waiting")
                                                    <span class="badge" style="background-color:yellow;color:black">Waiting</span>
                                                    @else
                                                    <span class="badge" style="background-color:red;color:white">Nunggak</span>
                                                    @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: center">
                                                    @if($data->status=="Lunas")
                                                    <a href="#" class="btn btn-success" style="color:white;margin-top:0"><i class="fa fa-print"></i></a>
                                                    @else
                                                      <button class="btn btn-primary" title="Atur Pembayaran" onclick="addConfirm({{$data}})"><i class="fa fa-credit-card"></i></button>
                                                    @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @php
                                            $sisa=intval($datas['akumulasi'])-$total;
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
                                                                                <strong>{{number_format($datas['akumulasi'],0,',','.')}}</strong></span>
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
<!-- modal add -->
<div class="modal fade bd-example-modal-lg" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="modalAddLabel">Pilih Metode Pembayaran Pembiayaan</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('payment.monthly.detail.update') }}" role="form" method="post">
                @method('PUT')
                {{csrf_field()}}
                <input type="hidden" name="payment_id" value="{{$datas->payment_id}}">
                <input type="hidden" name="student_id" value="{{$datas->id}}">
                <input type="hidden" name="category_id" value="{{$datas->financing_id}}">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="periode_id" value="">
                <input type="hidden" name="nominal" value="">
                <input type="hidden" name="penerima" value="{{ Session::get('nama') }}">
                
                <div class="form-group">
                    <label class="control-label col-md-4">Status Pembayaran<kode>*</kode></label>
                    <div class="chosen-select-single mg-b-20">
                        <select class="chosen-select" name="status">
                            <option value="Lunas">Lunas</option>
                            <option value="Nunggak">Nunggak</option>
                            <option value="Waiting">Waiting</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type='submit' class="btn btn-primary"><i class="fa fa-floppy-o"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal periode -->
<div class="modal fade bd-example-modal-lg" id="modalPeriode" tabindex="-1" role="dialog" aria-labelledby="modalPeriodeLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="modalPeriodeLabel">Pilih Periode Pembayaran</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('payment.monthly.detail.add') }}" role="form" method="post">
                {{csrf_field()}}
                <input type="hidden" name="payment_id" value="{{$datas->payment_id}}">
                <input type="hidden" name="student_id" value="{{$datas->id}}">
                <input type="hidden" name="category_id" value="{{$datas->financing_id}}">
                <div class="form-group">
                    <label class="control-label col-md-4">Periode Pembayaran<kode>*</kode></label>
                    <div class="chosen-select-single mg-b-20">
                        <select class="chosen-select" name="periode" id="metode_pembayaran_period">
                        @foreach($periodes as $periode)
                            <option value="{{$periode->id}}">{{$bulan[$periode->bulan]}} {{$periode->tahun}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type='submit' class="btn btn-primary"><i class="fa fa-floppy-o"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
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
<!-- forms CSS
============================================ -->
<link rel="stylesheet" href="{{asset('assets/css/form/all-type-forms.css')}}">
<!-- chosen CSS
============================================ -->
<link rel="stylesheet" href="{{asset('assets/css/chosen/bootstrap-chosen.css')}}">
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
<!-- chosen JS
    ============================================ -->
    <script src="{{ asset('assets/js/chosen/chosen.jquery.js')}}"></script>
<script src="{{ asset('assets/js/chosen/chosen-active.js')}}"></script>

<script>
    function addConfirm(data){
        $('input[name=id]').attr('value',data.id);
        $('input[name=periode_id]').attr('value',data.periode_id);
        $('input[name=nominal]').attr('value',data.nominal);
        event.preventDefault();
        $('#modalAdd').modal();
    }
    function addPeriode() {
        event.preventDefault();
        $('#modalPeriode').modal();
    }
</script>
@endpush

@push('breadcrumb-left')
<div class="col-md-1" style="item-align:center">
<a class="btn btn-primary" href="{{ route('payment.show',$financing->id)}}" title="Kembali"><i class="fa fa-arrow-left" ></i></a>
</div>
<div class="col-md-11">
    <div style="margin-left:15px;">
    <h4>Pembayaran {{$financing->nama}}</h4>
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
