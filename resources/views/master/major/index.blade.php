@extends('layouts.app')

@section('title')
SPP | Jurusan
@endsection

@section('content')

<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="hpanel hblue sparkline16-list responsive-mg-b-30">
        <div class="panel-body custom-panel-jw">
            <h3>Form Isian Jurusan</h3>
            <hr>
            <div class="sparkline16-graph">
                <div class="date-picker-inner">
                    <div class="basic-login-inner">
                        <div class="form-group">
                            <label>Nama Jurusan</label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                                <input type="text" id="jurusan" class="form-control" name="jurusan"
                                    placeholder="Masukan Nama Jurusan">
                            </div>
                        </div>
                        <div class="login-btn-inner">
                            <div class="inline-remember-me">
                                <button onclick="conf()" class="btn btn-sm btn-primary pull-right login-submit-cs">Submit</button>
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
                                    <div class="main-sparkline13-hd">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3>Data Jurusan</h3>
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
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true"
                                        data-show-columns="true" data-show-pagination-switch="true"
                                        data-show-refresh="true" data-key-events="true" data-show-toggle="true"
                                        data-resizable="true" data-cookie="true" data-cookie-id-table="saveId"
                                        data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">No</th>
                                                <th data-field="bulan" data-editable="false">Nama Jurusan</th>
                                                <th data-field="action" data-editable="false">
                                                    <div style="text-align:center;">Action</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($majors as $data)
                                            <tr>
                                                <td></td>
                                                <td>{{$no++}}</td>
                                                <td>{{$data->nama}}</td>
                                                <td>
                                                    <div style="text-align:center;">
                                                        <a href="#" class="btn btn-warning"
                                                            onclick="editConfirm( '{{$data->id}}', '{{$data->nama}}','{{$data->kelas[0]->nominal}}','{{$data->kelas[1]->nominal}}','{{$data->kelas[2]->nominal}}')"
                                                            title="Edit" style="margin-top:0;"><i
                                                                class="fa fa-edit"></i></a>
                                                        <a href="{{ route('majors.destroy',$data) }}"
                                                            class="btn btn-danger"
                                                            onclick="event.preventDefault();destroy('{{ route('majors.destroy',$data) }}');"
                                                            title="Hapus" style="margin-top:0;"><i
                                                                class="fa fa-trash"></i></a>
                                                    </div>
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
<div class="modal fade bd-example-modal-lg" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="modalAddLabel">Nominal Pembayaran SPP</span></h5>
      </div>
      <div class="modal-body">
         <form role="form" method="post" action="{{route('majors.store')}}">
            {{csrf_field()}}
            
            <div class="form-group">
                <label class="control-label col-md-2">Nama Jurusan</label>
                <input name='id_jur' id='id_jur' type='text' class='form-control' readonly>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Kelas X</label>
                <input name='x' type='number' class='form-control' required>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Kelas XI</label>
                <input name='xi' type='number' class='form-control' required>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Kelas XII</label>
                <input name='xii' type='number' class='form-control' required>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" tab-index="-1">Close</button>
                <button type='submit' class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal edit -->
<div class="modal fade bd-example-modal-lg" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="modalUpdateLabel">Nominal Pembayaran SPP</span></h5>
      </div>
      <div class="modal-body">
         <form role="form" id='form-jurusan' method="post" >
            @method('PUT')
            {{csrf_field()}}
            <div class="form-group">
                <label class="control-label col-md-2">Nama Jurusan</label>
                <input name='id_jur' id='jrs' type='text' class='form-control' required>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Kelas X</label>
                <input name='x' id='x' type='number' class='form-control' required>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Kelas XI</label>
                <input name='xi' id='xi' type='number' class='form-control' required>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Kelas XII</label>
                <input name='xii' id='xii' type='number' class='form-control' required>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" tab-index="-1">Close</button>
                <button type='submit' class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- hapus -->
<form id="destroy-form" method="POST">
    @method('DELETE')
    @csrf
</form>
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

<script>
    function conf()
    {
        let nama = document.getElementById('jurusan').value;
        $('#id_jur').attr('value', nama);
        $('#modalAdd').modal();
    }
    function editConfirm(id, nama,x,xi,xii) {
        $('#jrs').attr('value', nama);
        $('#x').attr('value', x);
        $('#xi').attr('value', xi);
        $('#xii').attr('value', xii);
        $('#form-jurusan').attr('action', "{{ url('majors') }}/" + id);
        $('#modalUpdate').modal();
    }

    function destroy(action) {
        swal({
            title: 'Apakah anda yakin?',
            text: 'Setelah dihapus, Anda tidak akan dapat mengembalikan data ini!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function (value) {
            if (value) {
                document.getElementById('destroy-form').setAttribute('action', action);
                document.getElementById('destroy-form').submit();
            } else {
                swal("Data kamu aman!");
            }
        });
    }

</script>
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

@push('breadcrumb-left')
<h2>Menu Jurusan</h2>
@endpush
@push('breadcrumb-right')
<div style="float:right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="margin-bottom:0">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jurusan</li>
        </ol>
    </nav>
</div>
@endpush
