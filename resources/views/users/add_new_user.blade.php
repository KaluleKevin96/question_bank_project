@extends('layouts.app')

@section('content')

  <div class="card">
  	<div class="card-header">
  		<strong class="card-title title-text text-center">
  			REGISTER NEW USER
  			<small>
  				<span class="float-right mt-1">
  					<a href="{{ route('all_users') }}" class="btn btn-md btn-primary" title="All Users"> <i class="zmdi zmdi-accounts-list"></i> </a>
  				</span>
  			</small>
  		</strong>
  	</div>
  	<div class="card-body">
      <div class="container">
         <form method="POST" action="{{ route('add_user') }}">
              @csrf

              <div class="row">
                  <div class="col-md-6 col-6">
                      <div class="form-group">
                           <label for="first_name" class="col-form-label"> First Name </label>

                      <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                      @error('first_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
                  <div class="col-md-6 col-6">
                       <div class="form-group">
                           <label for="last_name" class="col-form-label"> Last Name</label>

                      <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                      @error('last_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>

              </div>
  <!--'first_name' => 'required|string|min:3|max:255',
  'last_name' => 'required|string|min:3|max:255',
  'contact' => 'required|string|max:10|min:10',
  'email' => 'required|string|email|max:255|unique:users',
  'username' => 'required|string|max:20|min:6|unique:users',
  'password' => 'required|string|min:6|confirmed', -->
              <div class="row">
                  <div class="col-md-6 col-6">
                      <div class="form-group">

                      <label for="contact" class="col-form-label"> Phone Contact </label>

                      <input id="contact" type="tel" class="col-md-6 form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus>

                      @error('contact')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
                  <div class="col-md-6 col-6">
                       <div class="form-group">

                       <label for="email" class="col-form-label">E-mail Address</label>

                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>

              </div>

               <div class="row">
                  <div class="col-md-6 col-6">
                      <div class="form-group">

                      <label for="username" class="col-form-label">Desired Username</label>

                     <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                      @error('username')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
                  <div class="col-md-6 col-6">
                       <div class="form-group">

                       <label for="password" class="col-form-label">{{ __('Password') }}</label>

                       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror

                      </div>

                      <div class="form-group">
                          <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>

                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                      </div>
                  </div>

              </div>


              <div class="form-group row mb-0 mt-5">
                  <div class="col-md-5">
                       <button type="submit" class="btn btn-success btn-md"> <i class="zmdi zmdi-account-add"></i> &nbsp;&nbsp; ADD USER  </button>
                  </div>
              </div>
          </form>

      </div>
    </div>
  </div>
@endsection
