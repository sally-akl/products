@extends('layouts.loginLayout')

@section('logincontent')


<div class="header">{{ __('Reset Password') }}</div>

<form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
    @csrf
<div class="body bg-gray">
    <div class="form-group">


      <div class="alert alert-success" style="{{session('status') ?'display:block':'display:none'}}">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
      </div>


      <div class="alert alert-danger" style="{{count($errors) > 0 ?'display:block':'display:none'}}">
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>

      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required>

    </div>

</div>
<div class="footer">

  <button type="submit" class="btn bg-bl2 btn-primary">
      {{ __('Send Password Reset Link') }}
  </button>

</div>

</form>
@endsection
