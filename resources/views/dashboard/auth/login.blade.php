@extends('dashboard.layouts.loginLayout')
@section('logincontent')
	@include("dashboard.utility.error_messages")

	<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
		@csrf

		<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

		<div class="form-floating">
			<input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}">
			<label for="floatingInput">Email address</label>
		</div>
		<div class="form-floating">
			<input type="password" class="form-control" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"  placeholder="{{ __('Password') }}">
			<label for="floatingPassword">Password</label>
		</div>

		<button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
		<p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
	</form>
@endsection
