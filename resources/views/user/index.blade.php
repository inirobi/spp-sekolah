@extends('layouts.login')

@section('title')
SPP | Change Password
@endsection

@section('content')
<div class="row" align="center">
    <h2>{{ __('Change Password') }}</h2>
    <hr>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Sucess!</strong> {{$message}}.
    </div>
    @elseif ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Warning!</strong> {{$message}}.
    </div>
    @elseif ($message = Session::get('danger'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Alert!</strong> {{$message}}.
    </div>
    @endif
</div>
<form method="POST" action="{{ route('password.update') }}" id="loginForm" onsubmit="return checkForm(this);">
    @csrf
    <div class="form-group">
        <label for="password" class="control-label">{{ __('Old Password') }}</label>
        <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror"
            name="old_password" required autocomplete="current-old_password">
        @error('old_password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password" class="control-label">{{ __('New Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="current-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password_confirm" class="control-label">{{ __('Confirm Password') }}</label>
        <input id="password_confirm" type="password" class="form-control @error('password_confirm') is-invalid @enderror"
            name="password_confirm" required autocomplete="current-password_confirm">
        @error('password_confirm')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <button class="btn btn-success btn-block loginbtn" type="submit">
        {{ __('Change Password') }}
    </button>
    <button class="btn btn-danger btn-block loginbtn" onclick="history.back()">
        {{ __('Batal') }}
    </button>
</form>
@endsection

@push('scripts')
<script type="text/javascript">

  function checkPassword(str)
  {
    var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
    return re.test(str);
  }

  function checkForm(form)
  {
    re = /^\w+$/;
    if(form.password.value != "" && form.password.value == form.password_confirm.value) {
      if(!checkPassword(form.password.value)) {
        swal({
            title: 'Error!',
            text: 'Masukan kombinasi yang aman!',
        });
        form.password.focus();
        return false;
      }
    } else {
      swal({
            title: 'Error!',
            text: 'Password Tidak Sama!',
        });
      form.password.focus();
      return false;
    }
    return true;
  }

</script>
@endpush