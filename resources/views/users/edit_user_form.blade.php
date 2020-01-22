@extends('layouts.app')

@section('content')

  <div class="card">
  	<div class="card-header">
  		<div class="card-title title-text text-center">
  			EDIT {!! strtoupper($user->last_name . " " . $user->first_name) !!}
  			<small>
          <span class="float-right mt-1 pl-2" style="">
  					<a href="{{ route('add_user') }}" class="btn btn-md btn-success" title="Register New User"> <i class="zmdi zmdi-accounts-add"></i> </a>
  				</span>

  				<span class="float-right mt-1">
  					<a href="{{ route('all_users') }}" class="btn btn-md btn-primary" title="All Users"> <i class="zmdi zmdi-accounts-list"></i> </a>
  				</span>
  			</small>
  		</div>
  	</div>
  	<div class="card-body">
      <div class="container">
         <form method="POST" action="{{ route('edit_user') }}">
              @csrf
              <input type="hidden" name="id" value="{!! (old('id'))? old('id'):$user->id  !!}"/>
              <div class="row">
                  <div class="col-md-6 col-6">
                      <div class="form-group">
                           <label for="first_name" class="col-form-label"> First Name </label>

                      <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{!! (old('first_name'))?old('first_name'): $user->first_name  !!}" required autocomplete="first_name" autofocus>

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

                      <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{!! (old('last_name'))? old('last_name'): $user->last_name  !!}" required autocomplete="last_name" autofocus>

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

                      <input id="contact" type="tel" class="col-md-6 form-control @error('contact') is-invalid @enderror" name="contact" value="{!! ( old('contact'))? old('contact'): $user->contact  !!}" required autocomplete="contact" autofocus>

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

                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{!! (old('email'))? old('email'): $user->email !!}" required autocomplete="email">

                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>

              </div>
              @if(Auth::user()->user_number == $user->user_number){{-- only shows if user is editing their own account --}}
               <div class="row">
                  <div class="col-md-6 col-6">
                      <div class="form-group">

                      <label for="username" class="col-form-label">Desired Username</label>

                     <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{!! (old('username'))?old('username') : $user->username   !!}" required autocomplete="username">

                      @error('username')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                      <div class="hint-block mt-2 col-10">
                        You could change your username or password but it is not <strong> mandatory </strong>
                        <br/>
                        To change the username, just change the username in the respective <em> Username</em> field.
                        <br/>
                        To change your password, just fill in the <em>Password</em> field and confirm it by entering the same password in the <em>Confirm Password</em> field
                      </div>
                  </div>

                  <div class="col-md-6 col-6">
                       <div class="form-group">

                       <label for="password" class="col-form-label">{{ __('Password') }}</label>

                       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password">

                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror

                      </div>

                      <div class="form-group">
                          <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>

                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="password">

                      </div>
                  </div>

              </div>
            @endif


              <div class="form-group row mb-0 mt-5">
                  <div class="col-md-5">
                       <button type="submit" class="btn btn-primary btn-md"> <i class="zmdi zmdi-edit"></i> &nbsp;&nbsp; EDIT ACCOUNT  </button>
                  </div>
              </div>
          </form>

      </div>
    </div>
  </div>
@endsection
