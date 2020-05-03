@extends('layouts.app')

@section('content')

<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

    <div class="hpanel hblue sparkline16-list responsive-mg-b-30">
        <div class="panel-body custom-panel-jw">
            <h3>Identitas Siswa</h3>
            <hr>

            <div class="sparkline16-graph">
                <div class="date-picker-inner">

                    <div class="basic-login-inner">
                        <form action="{{route('payment.details.cicilan.store')}}" method="post" id="form-bayar">
                            @csrf
                            <input type="hidden" name="financing_category_id"
                                value="">
                            <input type="hidden" name="student_id" value="">
                            <input type="hidden" name="payment_id" value="">
                            <div class="form-group">
                                <label>NIS</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                    <input type="text" class="form-control" name="nis" value="{{$datas[0]->nis}}"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group"> 
                                <label>Nama</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
                                    <input type="text" class="form-control" name="nama" value="{{$datas[0]->nama}}"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-ticket"></i></span>
                                    <input type="text" class="form-control" name="kelas" placeholder=""
                                        value="{{$datas[0]->kelas}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jurusan</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                                    <input type="text" class="form-control" name="jurusan" placeholder=""
                                        value="{{$datas[0]->major->nama}}" readonly>
                                </div>
                            </div>
                            <div class="login-btn-inner">
                                <div class="inline-remember-me">

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
                                            @if($payment_details->last() !== null && $payment_details->last()->status=="Lunas")
                                            <div class="alert alert-info" role="alert">
                                                <strong>Info!</strong> Pembayaran telah lunas.
                                            </div>
                                            @endif
                                            <a href="{{ route('financing.periode',$financing->id)}}"
                                                style="color:white" class=" btn btn-success"><i
                                                    class="fa fa-print"></i>&nbsp; Cetak</a>
                                        </div>
                                        <div class="col-md-6">
                                            <div style="float:right;">
                                                <a href="{{ route('financing.periode',$financing->id)}}"
                                                    style="color:white" class=" btn btn-primary"><i
                                                        class="fa fa-plus"></i>&nbsp;Pembayaran</a>

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
                                                <th data-field="id">No</th>
                                                <th data-field="periode">Periode</th>
                                                <th data-field="nominal">Nominal</th>
                                                <th data-field="dibayar">Tgl Dibayar</th>
                                                <th data-field="total">Status</th>
                                                <th data-field="aksi">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $total=0;
                                            $dibayar=0;
                                            $bulan=['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                            @endphp
                                            @foreach($bigDatas as $data)
                                            @php
                                            $total+=intval($data->nominal);
                                            if($data->status=="Lunas"){
                                                $dibayar+=intval($data->nominal);
                                            }
                                            $tgl = explode(" ",$data->created_at);
                                            @endphp
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$bulan[$data->bulan]}} {{$data->tahun}}</td>
                                                <td>
                                                    <div style="text-align:right">
                                                    {{number_format($data->nominal,0,',','.')}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align:center">
                                                        @if($data->status=="Lunas")
                                                            {{$data->updated_at}}
                                                        @elseif($data->status=="Waiting")
                                                            <span class="badge" style="background-color:yellow;color:black">Waiting</span>
                                                        @else
                                                            <span class="badge" style="background-color:red">Nunggak</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align:center">
                                                        @if($data->status=="Lunas")
                                                            <span class="badge" style="background-color:green;color:white">Lunas</span>
                                                        @elseif($data->status=="Waiting")
                                                            <span class="badge" style="background-color:yellow;color:black">Waiting</span>
                                                        @else
                                                            <span class="badge" style="background-color:red">Nunggak</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align:center">
                                                        @if($data->status=="Lunas")
                                                        <a href="#" class="btn btn-success" title="Cetak Nota Pembayaran {{$data->bulan}} {{$data->tahun}}" style="margin-top:0">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                        @else
                                                        <a href="#" class="btn btn-primary" title="Bayar uang {{$financing->nama}} periode {{$data->bulan}} {{$data->tahun}}" 
                                                        style="margin-top:0;color:white" onclick="addConfirm({{$data}})">
                                                            <i class="fa fa-credit-card"></i>
                                                        </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @php
                                            $sisa=$total-$dibayar;
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
                                                                    <td>Total Pembayaran</td>
                                                                    <td>:</td>
                                                                    <td>Rp.</td>
                                                                    <td>
                                                                        <div style="text-align: right">
                                                                            <span class="" style="font-size:18px;">
                                                                                <strong>{{number_format($total,0,',','.')}}</strong></span>
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
                                                                                <strong>{{number_format($dibayar,0,',','.')}}</strong></span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Sisa Pembayaran</td>
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
                <h5 class="modal-title" id="modalAddLabel">Konfirmasi Pembayaran Pembiayaan</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('payment.monthly.detail.store') }}" role="form" method="post">
                {{csrf_field()}}
                <input type="hidden" name="payment_id">
                <input type="hidden" name="nominal">
                <input type="hidden" name="bulan">
                <input type="hidden" name="tahun">
                <input type="hidden" name="siswa" value="{{$datas[0]->id}}">
                <input type="hidden" name="pembayaran" value="{{ $financing->nama }}">
                <input type="hidden" name="penerima_id" value="{{ Session::get('id') }}">
                <input type="hidden" name="penerima" value="{{ Session::get('nama') }}">
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-3">
                        NIS
                    </div>
                    :
                    <strong><span>{{$datas[0]->nis}}</span></strong>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-3">
                        Nama
                    </div>
                    :
                    <strong><span>{{$datas[0]->nama}}</span></strong>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-3">
                        Kelas
                    </div>
                    :
                    <strong><span>{{$datas[0]->kelas}} {{$datas[0]->major->nama}}</span></strong>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-3">
                        Pembiayaan
                    </div>
                    :
                    <strong><span>{{$financing->nama}}</span></strong>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        Nominal Pembayaran
                    </div>
                    : <strong>Rp. <span id="nominal"></span></strong>
                </div>
                <hr>
                <div class="form-group">
                    <label class="control-label col-md-4">Konfirmasi Pembayaran<kode>*</kode></label>
                    <div class="chosen-select-single mg-b-20">
                        <select class="chosen-select" name="status">
                            <option value="Lunas">Lunas</option>
                            <option value="Nunggak">Nunggak</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" tabindex="-1">Close</button>
                <button type='submit' class="btn btn-primary"><i class="fa fa-floppy-o"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD


<!-- modal add -->
<div class="modal fade bd-example-modal-lg" id="modalPeriode" tabindex="-1" role="dialog" aria-labelledby="modalPeriodeLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="modalPeriodeLabel">Konfirmasi Pembayaran Pembiayaan</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('payment.monthly.detail.store') }}" role="form" method="post">
                {{csrf_field()}}
                <input type="hidden" name="payment_id">
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-3">
                        NIS
                    </div>
                    :
                    <strong><span>{{$datas[0]->nis}}</span></strong>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-3">
                        Nama
                    </div>
                    :
                    <strong><span>{{$datas[0]->nama}}</span></strong>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-3">
                        Kelas
                    </div>
                    :
                    <strong><span>{{$datas[0]->kelas}} {{$datas[0]->major->nama}}</span></strong>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-3">
                        Pembiayaan
                    </div>
                    :
                    <strong><span>{{$financing->nama}}</span></strong>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        Nominal Pembayaran
                    </div>
                    : <strong>Rp. <span id="nominal"></span></strong>
                </div>
                <hr>
                <div class="form-group">
                    <label class="control-label col-md-4">Konfirmasi Pembayaran<kode>*</kode></label>
                    <div class="chosen-select-single mg-b-20">
                        <select class="chosen-select" name="status">
                        @php
                        $bulan = ['',"Januari", "Februari", "Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
                        @endphp
                        @foreach($periodes => $periode)
                            <option value="{{$periode->id}}">{{$bulan[$periode->bulan]}} {{$periode->tahun}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" tabindex="-1">Close</button>
                <button type='submit' class="btn btn-primary"><i class="fa fa-floppy-o"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
=======
>>>>>>> 5712863acc5007702de3b0ee794de8ebf220b77d
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

<!-- chosen JS
    ============================================ -->
    <script src="{{ asset('assets/js/chosen/chosen.jquery.js')}}"></script>
<script src="{{ asset('assets/js/chosen/chosen-active.js')}}"></script>

<script>
    function addConfirm(data) {
        $('input[name=payment_id]').attr('value',data.id);
        $('input[name=nominal]').attr('value',data.nominal);
        $('input[name=bulan]').attr('value',data.bulan);
        $('input[name=tahun]').attr('value',data.tahun);        
        $('#nominal').html(data.nominal);
        $('#modalAdd').modal();
    }
</script>

</script>
@endpush

@push('breadcrumb-left')
<div class="col-md-1" style="item-align:center">
<a href="{{ url('/payment')}}/{{$financing->id}}" class="btn btn-primary" href="#" title="Kembali"><i class="fa fa-arrow-left" ></i></a>
</div>
<div class="col-md-11">
    <div style="margin-left:15px;">
    <h4>Rincian Pembayaran {{$financing->nama}}</h4>
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