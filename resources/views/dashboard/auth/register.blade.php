@extends('dashboard.layouts.loginLayout')
@section('logincontent')
	@include("dashboard.utility.error_messages")
<form class="card card-md" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
	@csrf
	<div class="card-body">
		<h2 class="mb-5 text-center">@lang('site.new_account_admin')</h2>
		<div class="mb-3">
			<label class="form-label">@lang('site.name')</label>
			<input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('site.name') }}"  name="name" value="{{ old('name') }}">
			@if ($errors->has('name'))
				 <span class="invalid-feedback" role="alert">
						 <strong>{{ $errors->first('name') }}</strong>
				 </span>
		  @endif
		</div>
		<div class="mb-3">
			<label class="form-label">@lang('site.email')</label>
			<input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('site.email') }}" name="email" value="{{ old('email') }}">
			@if ($errors->has('email'))
				<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('email') }}</strong>
				</span>
		  @endif
		</div>
		<div class="mb-3">
			<label class="form-label">@lang('site.password')</label>
			<div class="input-group input-group-flat">
				<input type="password" class="form-control"  placeholder="{{ __('site.password') }}" name="password">
				@if ($errors->has('password'))
					<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('password') }}</strong>
					</span>
	      @endif
			</div>
		</div>
		<div class="mb-3">
			<label class="form-label">@lang('site.re_password')</label>
			<div class="input-group input-group-flat">
				<input type="password" class="form-control"  placeholder="{{ __('site.re_password') }}" name="password_confirmation">
			</div>
			<input type="hidden" name="role" value="1" />
		</div>
		<div class="form-footer">
			<button type="submit" class="btn btn-primary btn-block">@lang('site.register')</button>
		</div>
	</div>
</form>
@endsection
