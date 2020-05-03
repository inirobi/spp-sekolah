@extends('layouts.app')

<<<<<<< HEAD
@section('title')
SPP | User Management
@endsection

=======
>>>>>>> 5712863acc5007702de3b0ee794de8ebf220b77d
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
                                        <h3>User Management</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <a style="float:right" data-toggle="modal" href="#modalAdd"
                                            class="btn btn-success"><i class="fa fa-plus"></i> Tambah </a>
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
                                data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true"
                                data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true"
                                data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="id">No</th>
                                        <th data-field="name">Nama</th>
                                        <th data-field="username">Username</th>
                                        <th data-field="email">Email</th>
                                        <th data-field="tanggal_bergabung">Tanggal Bergabung</th>
                                        <th data-field="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $data)
                                    <tr>
                                        <td></td>
                                        <td><div style="text-align:center;">{{$no++}}</div></td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->username}}</td>
                                        <td><div style="text-align:center;vertical-align:middle;">{{$data->email}}</div></td>
                                        <td><div style="text-align:center">{{$data->created_at}}</div></td>
                                        <td>
                                            <div style="text-align:center">
                                              <a href="#" class="btn btn-info"
                                              onclick="editConfirm( '{{$data->id}}', '{{$data->name}}', '{{$data->username}}','{{$data->email}}')"
                                              title="Edit"><i class="fa fa-edit"> Edit</i></a>
                                              <a href="{{ route('user.destroy',$data) }}" class="btn btn-danger"
                                              onclick="event.preventDefault();destroy('{{ route('user.destroy',$data) }}');"
                                              title="Hapus"><i class="fa fa-trash"></i> Hapus</a>
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
              <h4 class="modal-title" id="modalAddLabel">Add New User</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.store') }}" role="form" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="control-label col-md-2">Nama </label>
                        <input name='nama' placeholder="Masukan nama" type='text' class='form-control' required>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Username </label>
                        <input name='username' placeholder="Masukan username" type='text' class='form-control' required>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Email </label>
                        <input name='email' placeholder="Masukan email mis. nama@example.com" type='text' class='form-control' required>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Password </label>
                        <input name='password' placeholder="Masukan password" type='text' title="Untuk pembuatan akun sementara akan menggunakan password default" value="12345" class='form-control' readonly required>
                    </div>
            </div>
            <div class="modal-footer">
                <div style="float: right">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" tabindex="-1">Close</button>
                  <button type='submit' class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal add -->
<div class="modal fade bd-example-modal-lg" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="modalUpdateLabel">Update User Data</h4>
            </div>
            <div class="modal-body">
                <form id="editForm" role="form" method="put">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="control-label col-md-2">Nama </label>
                        <input name='nama' id="nama" placeholder="Masukan nama" type='text' class='form-control' required>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Username </label>
                        <input name='username' id="username" placeholder="Masukan username" title="Hanya dapat mengubah nama saja" type='text' class='form-control' required disabled>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Email </label>
                        <input name='email' id="email" placeholder="Masukan email mis. nama@example.com" type='text' title="Hanya dapat mengubah nama saja" class='form-control' required disabled>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Password </label>
                        <input name='password' id="password" placeholder="Masukan password" type='password' title="Hanya dapat mengubah nama saja" value="12345" class='form-control' disabled>
                    </div>
            </div>
            <div class="modal-footer">
                <div style="float: right">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" tabindex="-1" tabindex="-1">Close</button>
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
<style>
  th{
    text-align:center;
  }
</style>
@endpush

@push('scripts')

<script>
    function editConfirm(id, nama, username, email) 
    {
      $('#nama').attr('value', nama);
      $('#username').attr('value', username);
      $('#email').attr('value', email);
      $('#editForm').attr('action',"{{ url('users') }}/"+id)
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

@push('breadcrumb-right')
<div style="float:right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="margin-bottom:0">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">User</li>
        </ol>
    </nav>
</div>
@endpush