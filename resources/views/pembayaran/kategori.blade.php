@extends('layouts.app')

@section('content')

<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

    <div class="hpanel hblue sparkline16-list responsive-mg-b-30">
        <div class="panel-body custom-panel-jw">
            <h3>Informasi Data Siswa</h3>
            <hr>
            <div class="sparkline16-graph">
                <div class="date-picker-inner">
                    <div class="basic-login-inner">
                        <div class="form-group data-custon-pick">
                            <label>NIS</label>
                            <div class="input-group">
                                <span class="input-group-addon"><strong>Rp.</strong></span>
                                <input class="form-control" name="nominal" value="{{ $siswa->nis}}" readonly>
                            </div>
                        </div>
                        <div class="form-group data-custon-pick">
                            <label>Nama</label>
                            <div class="input-group">
                                <span class="input-group-addon"><strong>Rp.</strong></span>
                                <input class="form-control" name="nominal" value="{{ $siswa->nama}}" readonly>
                            </div>
                        </div>
                        <div class="form-group data-custon-pick">
                            <label>Jenis Kelamin</label>
                            <div class="input-group">
                                <span class="input-group-addon"><strong>Rp.</strong></span>
                                <input class="form-control" name="nominal" value="{{ $siswa->jenis_kelamin}}" readonly>
                            </div>
                        </div>
                        <div class="form-group data-custon-pick">
                            <label>Kelas</label>
                            <div class="input-group">
                                <span class="input-group-addon"><strong>Rp.</strong></span>
                                <input class="form-control" name="nominal" value="{{ $siswa->kelas}}" readonly>
                            </div>
                        </div>
                        <div class="form-group data-custon-pick">
                            <label>Jurusan</label>
                            <div class="input-group">
                                <span class="input-group-addon"><strong>Rp.</strong></span>
                                <input class="form-control" name="nominal" value="{{ $siswa->major->nama}}" readonly>
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
                                            <div class="main-sparkline13-hd">
                                                <h3>Pilih Kategori Pembayaran</h3>
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
                                                <th data-field="id">No</th>
                                                <th data-field="bulan" data-editable="false">Nama</th>
                                                <th data-field="tahun" data-editable="false">Besaran</th>
                                                <th data-field="nominal" data-editable="false">Jenis</th>
                                                <th data-field="status" data-editable="false">Status</th>
                                                <th data-field="action" data-editable="false">Action</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @php $no=1; @endphp
                                            @foreach($category as $data)
                                            <tr>
                                                <td></td>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>
                                                  <div style="text-align:center">
                                                  {{ number_format($data->besaran,0,'.',',')}}</td>
                                                  </div>
                                                <td>{{ $data->jenis }}</td>
                                                <td>
                                                Stat
                                                </td>
                                                <td>
                                                <button class="btn btn-primary" onclick="addConfirm('{{$data->id}}')" title="Pilih Metode Pembayaran">
                                                    <i class="fa fa-history"> Metode</i>
                                                </button>
                                                </td>
                                            </tr>
                                            @endforeach
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
                <form action="{{ route('payment.storeMethod') }}" role="form" method="post">
                {{csrf_field()}}
                <input type="hidden" name="payment_id" value="">
                <input type="hidden" name="financing_category_id" value="">
                <input type="hidden" name="financing_category" value="">
                <input type="hidden" name="nominal" value="">
                <input type="hidden" name="student_id" id="student_id_add" value="">
                <input type="hidden" name="student_name" id="student_name_add" value="">
                <input type="hidden" name="penerima" value="{{ Session::get('nama') }}">
                <div class="row mb-3">
                    <div class="col-md-3 col-sm-3">
                        Pembiayaan
                    </div>
                    :
                    <strong><span id="nama_pembiayaan"></span></strong>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        Nominal Pembayaran
                    </div>
                    : <strong>Rp. <span id="nominal_pembiayaan"></span></strong>
                </div>
                <hr>
                <div class="form-group">
                    <label class="control-label col-md-4">Metode Pembayaran<kode>*</kode></label>
                    <div class="chosen-select-single mg-b-20">
                        <select class="chosen-select" name="metode_pembayaran" id="metode_pembayaran_add">
                            <option value="Tunai">Tunai</option>
                            <option value="Cicilan">Cicilan</option>
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
<style>
.teks-kanan{
  text-align:right;
}
</style>
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

<!-- chosen JS
    ============================================ -->
    <script src="{{ asset('assets/js/chosen/chosen.jquery.js')}}"></script>
<script src="{{ asset('assets/js/chosen/chosen-active.js')}}"></script>

<script>
    function addConfirm(id) {
        $('#modalAdd').modal();
    }
</script>

@endpush
