@extends('layouts.app')

@section('title')
SPP | Pemasukan
@endsection

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
                                </div>
                                <div class="col-md-6">
                                    <div style="float:right;">
                                      <a href="{{route('pdf.print','pemasukan')}}" style="color:white; margin-top:0" class=" btn btn-info" target="_blank"><i class="fa fa-print"></i>&nbsp; Cetak</a>
                                      <a data-toggle="modal" href="#modalAdd" @endphp class="btn btn-success" ><i class="fa fa-plus"></i> Tambah </a>
                                    </div>
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
                                        <th data-field="foto">Foto</th>
                                        <th data-field="title">Judul</th>
                                        <th data-field="description">Deskripsi</th>
                                        <th data-field="sumber">Sumber</th>
                                        <th data-field="nominal">Nominal</th>
                                        <th data-field="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td></td>
                                        <td>{{$no++}}</td>
                                        <td class="avatar text-center">
                                          <img class="rounded-circle" style="width: 100px; height: 100px;" src="nota/{{ $data -> foto }}" alt="">  
                                        </td>
                                        <td>{{$data->title}}</td>
                                        <td>{{$data->description}}</td>
                                        <td>{{$data->sumber}}</td>
                                        <td>
                                        <div style="text-align: right">
                                        {{number_format($data->nominal,0,',','.')}}
                                        </div>
                                        </td>
                                        <td>
                                          <a href="#" class="btn btn-warning" onclick="editConfirm( '{{$data->id}}','{{$data->title}}','{{$data->description}}','{{$data->sumber}}','{{$data->nominal}}')" title="Edit"><i class="fa fa-edit"> Edit</i></a>
                                          <a href="{{ route('income.destroy',$data) }}" class="btn btn-danger" onclick="event.preventDefault();destroy('{{ route('income.destroy',$data) }}');" title="Hapus"><i class="fa fa-trash"></i> Hapus</a>
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
<div class="modal fade bd-example-modal-lg" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="modalAddLabel">Tambah Pengeluaran</h5>
      </div>
      <div class="modal-body">
      <div class="basic-login-form-ad">
        <form action="{{ route('income.store') }}" role="form" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <label class="control-label col-md-2">Judul<kode>*</kode></label>
            <input name='title' placeholder=" Masukan Title" type='text' class='form-control' required>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Deskripsi<kode>*</kode></label>
            <textarea name='description' placeholder=" Masukan Deskripsi" required></textarea>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Sumber<kode>*</kode></label>
            <div class="chosen-select-single mg-b-20">
              <select class="chosen-select" name="sumber" id="sumber">
                <option value="Yayasan">Yayasan</option>
                <option value="Sekolah">Sekolah</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Nominal<kode>*</kode></label>
            <input name='nominal' placeholder="Masukan Nominal" type='number' class='form-control' required>
          </div>
          <div class="form-group">
          <div class="form-group-inner">
            <label class="control-label col-md-2">Foto<kode>*</kode></label>
            <div class="row">
                <div class="col-lg-12">
                    <div class="file-upload-inner ts-forms">
                        <div class="input prepend-big-btn">
                            <label class="icon-right" for="prepend-big-btn"><i class="fa fa-download"></i></label>
                            <div class="file-button">
                                Browse
                                <input type="file" name='foto' onchange="document.getElementById('prepend-big-btn').value = this.value;">
                            </div>
                            <input type="text" id="prepend-big-btn" placeholder="no file selected" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          </div>
          
      </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" tabindex="-1">Close</button>
          <button type='submit' class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
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
        <h5 class="modal-title" id="modalUpdateLabel">Ubah Pengeluaran</h5>
      </div>
      <div class="modal-body">
      <div class="basic-login-form-ad">
        <form action="" id='editPengeluaran' role="form" method="post" enctype="multipart/form-data">
        @method('PUT')
          {{csrf_field()}}
          <div class="form-group">
            <label class="control-label col-md-2">Judul<kode>*</kode></label>
            <input name='title' id='title' placeholder=" Masukan Title" type='text' class='form-control' required>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Deskripsi<kode>*</kode></label>
            <textarea name='description' id='description' placeholder=" Masukan Deskripsi" required></textarea>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Sumber<kode>*</kode></label>
            <div class="chosen-select-single mg-b-20">
              <select class="chosen-select" name="sumber" id="sumber_edit">
                <option value="Yayasan">Yayasan</option>
                <option value="Sekolah">Sekolah</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Nominal<kode>*</kode></label>
            <input name='nominal' id='nominal' placeholder="Masukan Nominal" type='number' class='form-control' readonly required>
          </div>
          <div class="form-group">
          <div class="form-group-inner">
            <label class="control-label col-md-2">Foto<kode>*</kode></label>
            <div class="row">
                <div class="col-lg-12">
                    <div class="file-upload-inner ts-forms">
                        <div class="input prepend-big-btn">
                            <label class="icon-right" for="prepend-big-btn"><i class="fa fa-download"></i></label>
                            <div class="file-button">
                                Browse
                                <input type="file" name='foto' onchange="document.getElementById('prepend-big-btn2').value = this.value;">
                            </div>
                            <input type="text" id="prepend-big-btn2" placeholder="no file selected">
                        </div>
                    </div>
                </div>
            </div>
        </div>
          </div>
          
      </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" tabindex="-1">Close</button>
          <button type='submit' class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
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

@push('scripts')

    <script>
    function editConfirm(id,title,description,sumber,nominal)
    {
        $('#title').attr('value',title);
        $('#description').html(description);
        $('#nominal').attr('value',nominal);
        
        $('#sumber_edit').val(sumber);
        $('#sumber_edit_chosen .chosen-single span').html(sumber);
        
        $('#editPengeluaran').attr('action',"{{ url('income') }}/"+id)
        $('#modalUpdate').modal();
    }

    function destroy(action){
        swal({
            title: 'Apakah anda yakin?',
            text: 'Setelah dihapus, Anda tidak akan dapat mengembalikan data ini!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
            document.getElementById('destroy-form').setAttribute('action', action);
            document.getElementById('destroy-form').submit();
            }else {
            swal("Data kamu aman!");
        }
        });
    }
    </script>
    
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

@push('breadcrumb-left')
<h3>Data Pemasukan</h3>
@endpush

@push('breadcrumb-right')
<div style="float:right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="margin-bottom:0">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pemasukan</li>
        </ol>
    </nav>
</div>
@endpush
