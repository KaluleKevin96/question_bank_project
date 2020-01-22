@extends('layouts.app')

@section('content')

  <div class="card">
  	<div class="card-header">
  		<strong class="card-title title-text text-center">
  			REGISTER NEW COLLEGE
  			<small>
  				<span class="float-right mt-1">
  					<a href="{{ route('all_colleges') }}" class="btn btn-md btn-primary" title="ALL COLLEGES"> <i class="fa fa-list-ul"></i> </a>
  				</span>
  			</small>
  		</strong>
  	</div>
  	<div class="card-body">
      <div class="container">
         <form method="POST" action="{{ route('add_college') }}">
                         @csrf

              <div class="row">
                  <div class="col-md-6 col-6">
                      <div class="form-group">
                           <label for="college_name" class="col-form-label"> College Name </label>

                      <input id="college_name" type="text" class="form-control @error('college_name') is-invalid @enderror" name="college_name" value="{{ old('college_name') }}" required autocomplete="college_name" autofocus>

                      @error('college_name')
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

                      <label for="college_description" class="col-form-label"> College Description </label>

                      <br/> <div class="hint-block"> Short Description about the college <strong>(Optional)</strong> </div>
                      
                      <textarea id="college_description" class="form-control @error('college_description') is-invalid @enderror" name="college_description" autocomplete="contact">

                          {{ old('college_description')?old('college_description'):'' }}

                      </textarea>

                      @error('college_description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
              </div>


              <div class="form-group row mb-0">
                  <div class="col-md-5">
                       <button type="submit" class="btn btn-success btn-md"> <i class="zmdi zmdi-plus-circle"></i> &nbsp;&nbsp; REGISTER COLLEGE  </button>
                  </div>
              </div>
          </form>

      </div>
    </div>
  </div>
@endsection
