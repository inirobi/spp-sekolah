@extends('layouts.app')

@section('content')
<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="container-sm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="main-sparkline13-hd">
                                        <h3>Nama Tabel</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button style="float: right;" type="button" class="btn btn-custon-rounded-three btn-success">
                                        <i class="fa fa-magic edu-checked-pro" aria-hidden="true"></i>
                                        Tambah
                                    </button>
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
                                data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true"
                                data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true"
                                data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="id">ID</th>
                                        <th data-field="name" data-editable="false">Task</th>
                                        <th data-field="email" data-editable="true">Email</th>
                                        <th data-field="phone" data-editable="true">Phone</th>
                                        <th data-field="complete">Completed</th>
                                        <th data-field="task" data-editable="true">Task</th>
                                        <th data-field="date" data-editable="true">Date</th>
                                        <th data-field="price" data-editable="true">Price</th>
                                        <th data-field="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-field="state" data-checkbox="true"></td>
                                        <td data-field="id">ID</td>
                                        <td data-field="name" data-editable="false">Task</td>
                                        <td data-field="email" data-editable="true">Email</td>
                                        <td data-field="phone" data-editable="true">Phone</td>
                                        <td data-field="complete">Completed</td>
                                        <td data-field="task" data-editable="true">Task</td>
                                        <td data-field="date" data-editable="true">Date</td>
                                        <td data-field="price" data-editable="true">Price</td>
                                        <td data-field="action">Action</td>
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
@endpush
