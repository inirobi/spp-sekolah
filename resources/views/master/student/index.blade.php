@extends('layouts.app')

@section('title')
SPP | Siswa
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
                                        <form action="{{route('students.filter')}}" role="form" method="post">
                                        @csrf
                                            <div style="float:left; display:flex; flex-direction:row; max-height:55">
                                            <select class="form-control" name="kelas">
                                                <option value="">-- Pilih Kelas -- </option>
                                                <option value="">Semua</option>
                                                <option @if("X"==$kls) selected @endif value="X">X</option>
                                                <option @if("XI"==$kls) selected @endif value="XI">XI</option>
                                                <option @if("XII"==$kls) selected @endif value="XII">XII</option>
                                                </select>

                                                <select style="margin-left:5px;" class="form-control" name="jurusan">
                                                <option value="">-- Pilih Jurusan --</option>
                                                <option value="">Semua</option>
                                                    @foreach($majors as $d)
                                                    <option @if($fil==$d->id) selected @endif value="{{$d->id}}">{{$d->nama}}</option>
                                                    @endforeach
                                                </select>
                                                <button type='submit' class="btn btn-info" style="margin-left:5px;">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="float:right;">
                                            <form target="_blank" action="{{route('pdf.print.rekap.siswa')}}" role="form" method="post">
                                                @csrf 
                                                <input type="hidden" name='id_jur' value="{{$fil}}">
                                                <input type="hidden" name='kls' value="{{$kls}}">
                                                <button type='submit' class="btn btn-info" style="color:white; margin-top:0"><i class="fa fa-print"></i>&nbsp; Cetak</button>
                                            <a @php echo $jml < 1 ? 'onclick="peringatan()"':'data-toggle="modal" href="#modalAdd"' @endphp class="btn btn-success" ><i class="fa fa-plus"></i> Tambah </a>
                                            </form>
                                        </div>
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
                                        <th data-field="id"><div style="text-align:center;">No</div></th>
                                        <th data-field="nis"><div style="text-align:center;">NIS</div></th>
                                        <th data-field="name"><div style="text-align:center;">Nama</div></th>
                                        <th data-field="jenis_kelamin"><div style="text-align:center;">L/P</div></th>
                                        <th data-field="kelas"><div style="text-align:center;">Kelas</div></th>
                                        <th data-field="major"><div style="text-align:center;">Nama Jurusan</div></th>
                                        <th data-field="alamat"><div style="text-align:center;">Alamat</div></th>
                                        <th data-field="phone"><div style="text-align:center;">No Hp</div></th>
                                        <th data-field="action"><div style="text-align:center;">Action</div></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $data)
                                    <tr>
                                        <td></td>
                                        <td>{{$no++}}</td>
                                        <td>{{$data->nis}}</td>
                                        <td>{{$data->nama}}</td>
                                        <td><div style="text-align:center;">{{$data->jenis_kelamin}}</div></td>
                                        <td><div style="text-align:center;">{{$data->kelas}}</div></td>
                                        <td><div style="text-align:center;">{{$data->major->nama}}</div></td>
                                        <td><div style="text-align:center;">{{$data->alamat}}</div></td>
                                        <td><div style="text-align:center;">{{$data->phone}}</div></td>
                                        <td>
                                        <div style="text-align:center;">
                                        <a href="#" class="btn btn-warning"
                                            onclick="editConfirm( '{{$data->id}}','{{$data->nis}}','{{$data->nama}}','{{$data->jenis_kelamin}}','{{$data->kelas}}','{{$data->major_id}}', '{{$data->major->nama}}','{{$data->phone}}','{{$data->email}}','{{$data->tgl_masuk}}','{{$data->alamat}}')"
                                            title="Edit"><i class="fa fa-edit"> Edit</i></a>
                                        <a href="{{ route('students.destroy',$data) }}" class="btn btn-danger"
                                            onclick="event.preventDefault();destroy('{{ route('students.destroy',$data) }}');"
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
        <div class="modal fade bd-example-modal-lg" id="modalAdd" tabindex="-1" role="dialog"
            aria-labelledby="modalAddLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="modalAddLabel">Tambah Siswa</h5>
                    </div>
                    <div class="modal-body">
                        <div class="basic-login-form-ad">
                            <form action="{{ route('students.store') }}" role="form" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="control-label col-md-2">NIS<kode>*</kode></label>
                                    <input name='nis' placeholder=" Masukan Nama Jurusan" type='text'
                                        class='form-control' required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Nama Siswa<kode>*</kode></label>
                                    <input name='nama' placeholder=" Masukan Nama Siswa" type='text'
                                        class='form-control' required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Jenis Kelamin<kode>*</kode></label>
                                    <div class="chosen-select-single mg-b-20">
                                        <select class="chosen-select" name="jenis_kelamin" id="jenis_kelamin_add">
                                            <option value="L">Laki - Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Jurusan<kode>*</kode></label>
                                    <div class="chosen-select-single mg-b-20">
                                        <select class="chosen-select" name="major_id" id="major_id_add" required>
                                            @foreach($majors as $d)
                                            <option @php value="{{$d->id}}">{{$d->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Kelas<kode>*</kode></label>
                                    <div class="chosen-select-single mg-b-20">
                                        <select class="chosen-select" name="kelas" id="kelas_add" required>
                                            <option value="X">X</option>
                                            <option value="XI">XI</option>
                                            <option value="XII">XII</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">No Telpon<kode>*</kode></label>
                                    <input name='phone' placeholder="Masukan No Telpon" type='text' class='form-control'
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Alamat<kode>*</kode></label>
                                    <textarea name='alamat' placeholder=" Masukan Alamat" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Email</label>
                                    <input name='email' placeholder=" Masukan Email" type='text' class='form-control'
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Tanggal Masuk<kode>*</kode></label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group data-custon-pick" id="data_3">
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i></span>
                                                    <input type="text" name='tgl_masuk' class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type='submit' class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal edit -->
        <div class="modal fade bd-example-modal-lg" id="modalUpdate" tabindex="-1" role="dialog"
            aria-labelledby="modalUpdateLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="modalUpdateLabel">Ubah Siswa</h5>
                    </div>
                    <div class="modal-body">
                        <form id='editSiswa' action='' role="form" method="post">
                            @method('PUT')
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label col-md-2">NIS<kode>*</kode></label>
                                <input name='nis' id='nis' placeholder=" Masukan Nama Jurusan" type='text'
                                    class='form-control' required>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Nama Siswa<kode>*</kode></label>
                                <input name='nama' id='nama' placeholder=" Masukan Nama Siswa" type='text'
                                    class='form-control' required>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Jenis Kelamin<kode>*</kode></label>
                                <div class="chosen-select-single mg-b-20">
                                    <select class="chosen-select" name="jenis_kelamin" id="jenis_kelamin_edit">
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Jurusan<kode>*</kode></label>
                                <div class="chosen-select-single mg-b-20">
                                    <select class="chosen-select" tabindex="-1" name="major_id" id="major_id_edit"
                                        required>
                                        @foreach($majors as $d)
                                        <option @php value="{{$d->id}}">{{$d->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Kelas<kode>*</kode></label>
                                <div class="chosen-select-single mg-b-20">
                                    <select class="chosen-select" name="kelas" id="kelas_edit" required>
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">No Telpon<kode>*</kode></label>
                                <input name='phone' id='phone' placeholder="Masukan No Telpon" type='number'
                                    class='form-control' required>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Alamat<kode>*</kode></label>
                                <textarea name='alamat' id="alamat" placeholder=" Masukan alamat siswa" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Email</label>
                                <input name='email' id='email' placeholder=" Masukan Email" type='text'
                                    class='form-control' required>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Tanggal<kode>*</kode></label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group data-custon-pick" id="data_3">
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" name='tgl_masuk' id='tgl_masuk' class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type='submit' class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal detail -->
        <div class="modal fade bd-example-modal-lg" id="modalDetail" tabindex="-1" role="dialog"
            aria-labelledby="modalDetail" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetail">Detail Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id='editSiswa' action='' role="form" method="post">
                            @method('PUT')
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label col-md-2">Jenis Kelamin<kode>*</kode></label>
                                <div class="chosen-select-single mg-b-20">
                                    <select class="chosen-select" disabled name="jenis_kelamin" id="jenis_kelamin_edit">
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Jurusan<kode>*</kode></label>
                                <div class="chosen-select-single mg-b-20">
                                    <select class="chosen-select" disabled tabindex="-1" name="major_id" required>
                                        <option @php value="{{$d->id}}">-- Pilih Jurusan --</option>
                                        <option @php value="{{$d->id}}">Semua</option>
                                        @foreach($majors as $d)
                                        <option @php value="{{$d->id}}">{{$d->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Kelas<kode>*</kode></label>
                                <div class="chosen-select-single mg-b-20">
                                    <select class="chosen-select" disabled name="kelas" id="kelas_edit" required>
                                        <option value="">-- Pilih Kelas --</option>
                                        <option value="All">Semua</option>
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    </form>
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

        <style>
            kode {
                color: red;
            }

        </style>
        @endpush

        @push('scripts')

        <script>
            function peringatan() {
                swal('Gagal!', 'Sekolah belum mempunyai jurusan. Silahkan diisi terlebih dahulu', 'error')
            }

            function show_selected() {
                var selector = document.getElementById('jurusan');
                var value = selector[selector.selectedIndex].value;

                document.getElementById('display').innerHTML = value;
            }

            function editConfirm(id, nis, nama, jenis_kelamin, kelas, major_id, major, phone, email, tgl_masuk, alamat) {
                $('#nis').attr('value', nis);
                $('#nama').attr('value', nama);
                $('#tgl_masuk').attr('value', tgl_masuk);
                $('#email').attr('value', email);
                $('#phone').attr('value', phone);
                $('#alamat').attr('value', alamat);

                $('#jenis_kelamin_edit').val(jenis_kelamin);
                $('#jenis_kelamin_edit_chosen .chosen-single span').html((jenis_kelamin == 'L') ? 'Laki - Laki' :
                    'Perempuan');

                $('#major_id_edit').val(major_id);
                $('#major_id_edit_chosen .chosen-single span').html(major);

                $('#kelas_edit').val(kelas);
                $('#kelas_edit_chosen .chosen-single span').html(kelas);

                $('#editSiswa').attr('action', "{{ url('students') }}/" + id)
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
        <h2>Data Siswa</h2>
        @endpush


        @push('breadcrumb-right')
        <div style="float:right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin-bottom:0">
                    <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Siswa</li>
                </ol>
            </nav>
        </div>
        @endpush
