@extends('layouts.app')

@section('content')
<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                        <div class="container-sm">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Data Siswa</h3>
                                    <small class="all-pro-ad">Silahkan pilih data siswa</small>
                                </div>
                                <div class="col-md-6">
                                   
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
                            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="id">No</th>
                                        <th data-field="nis">NIS</th>
                                        <th data-field="name">Nama</th>
                                        <th data-field="jenis_kelamin">Jenis Kelamin</th>
                                        <th data-field="kelas">Kelas</th>
                                        <th data-field="major">Nama Jurusan</th>
                                        <th data-field="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $data)
                                    <tr>
                                        <td></td>
                                        <td>{{$no++}}</td>
                                        <td>{{$data->nis}}</td>
                                        <td>{{$data->nama}}</td>
                                        <td>{{$data->jenis_kelamin}}</td>
                                        <td>{{$data->kelas}}</td>
                                        <td>{{$data->major->nama}}</td>
                                        <td>
                                          <a href="{{route('payment.category',$data->id)}}"><i class="fa fa-history"></i></a>
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

     <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/form/all-type-forms.css')}}">
     <!-- chosen CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/chosen/bootstrap-chosen.css')}}">

    <!-- datapicker CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/datapicker/datepicker3.css')}}">
@endpush

@push('scripts-asset')
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

    <!-- icheck JS
		============================================ -->
    <script src="{{ asset('assets/js/icheck/icheck.min.js')}}"></script>
    <script src="{{ asset('assets/js/icheck/icheck-active.js')}}"></script>

    <!-- chosen JS
		============================================ -->
    <script src="{{ asset('assets/js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{ asset('assets/js/chosen/chosen-active.js')}}"></script>

    <!-- input-mask JS
		============================================ -->
    <script src="{{ asset('assets/js/input-mask/jasny-bootstrap.min.js')}}"></script>

    <!-- datapicker JS
		============================================ -->
    <script src="{{ asset('assets/js/datapicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('assets/js/datapicker/datepicker-active.js')}}"></script>
  @endpush