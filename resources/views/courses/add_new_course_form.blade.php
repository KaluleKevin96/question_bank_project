@extends('layouts.app')

@section('content')

  <div class="card">
  	<div class="card-header">
  		<strong class="card-title title-text text-center">
  			REGISTER NEW COURSE
  			<small>
  				<span class="float-right mt-1">
  					<a href="{{ route('all_courses') }}" class="btn btn-md btn-primary" title="ALL COURSES"> <i class="fa fa-list-ul"></i> </a>
  				</span>
  			</small>
  		</strong>
  	</div>
  	<div class="card-body">
      <div class="container">
         <form method="POST" action="{{ route('add_course') }}">
                         @csrf

              <div class="row">
                  <div class="col-md-3 col-4">
                      <div class="form-group">
                           <label for="course_code" class="col-form-label"> Course Code </label>

                      <input id="course_code" type="text" class="form-control @error('course_code') is-invalid @enderror" name="course_code" value="{{ old('course_code') }}" required autocomplete="course_code" autofocus>

                      @error('course_code')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
                  <div class="col-md-6 col-5">
                      <div class="form-group">
                           <label for="course_name" class="col-form-label"> Course Name </label>

                      <input id="course_name" type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{ old('course_name') }}" required autocomplete="course_name">

                      @error('course_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
                  <div class="col-md-3 col-3">
                      <div class="form-group">
                           <label for="course_duration" class="col-form-label"> Duration </label>

                           <select name="course_duration" class="form-control" id="course_duration">
                                  <option value="1" {{ (old('course_duration') == 1)? 'selected':'' }}> 1 Years </option>
                                  <option value="2" {{ (old('course_duration') == 2)? 'selected':'' }}> 2 Years </option>
                                  <option value="3" {{ (old('course_duration') == 3)? 'selected':'' }}> 3 Years </option>
                                  <option value="4" {{ (old('course_duration') == 4)? 'selected':'' }}> 4 Years </option>
                                  <option value="5" {{ (old('course_duration') == 5)? 'selected':'' }}> 5 Years </option>
                           </select>
                      @error('course_duration')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
              </div>

              <div class="row">
                <div class="col-md-7 col-6">
                    <div class="form-group" id="associated_college">

                    <label for="associated_college" class="col-form-label"> Associated College </label>

                    <select name="associated_college" class="form-control" id="associated_college">
                        @if($active_colleges->count() != 0)
                              <option value="" selected> Select the College the course belongs to </option>
                          @foreach($active_colleges as $college)
                           <option value="<?=$college->college_number?>"> <?=$college->college_name?> </option>
                          @endforeach
                        @else
                            <option value="" selected> No Colleges Registered </option>
                        @endif
                    </select>

                    @error('associated_college')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>

                  <div class="col-md-5 col-6">
                      <div class="form-group">

                      <label for="course_description" class="col-form-label"> Course Description </label>

                      <br/> <div class="hint-block"> Short Description about the Course <strong>(Optional)</strong> </div>

                      <textarea id="course_description" class="form-control @error('course_description') is-invalid @enderror" name="course_description" autocomplete="contact">

                          {{ old('course_description')?old('course_description'):'' }}

                      </textarea>

                      @error('course_description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
              </div>


              <div class="form-group row mb-0">
                  <div class="col-md-5">
                       <button type="submit" class="btn btn-success btn-md"> <i class="zmdi zmdi-plus-square"></i> &nbsp;&nbsp; REGISTER COURSE  </button>
                  </div>
              </div>
          </form>

      </div>
    </div>
  </div>
@endsection
