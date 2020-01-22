@extends('layouts.app')

@section('content')

  <div class="card">
  	<div class="card-header">
  		<strong class="card-title title-text text-center">
  			REGISTER NEW COURSE UNIT
  			<small>
  				<span class="float-right mt-1">
  					<a href="{{ route('all_course_units') }}" class="btn btn-md btn-primary" title="ALL COURSE UNITS"> <i class="fa fa-list-ul"></i> </a>
  				</span>
  			</small>
  		</strong>
  	</div>
  	<div class="card-body">
      <div class="container">
         <form method="POST" action="{{ route('add_course_unit') }}">
                         @csrf

              <div class="row">
                <!-- Unique code for the Course Unit -->
                  <div class="col-md-3 col-4">
                      <div class="form-group">
                           <label for="course_unit_code" class="col-form-label"> Course Unit Code </label>

                      <input id="course_unit_code" type="text" class="form-control @error('course_unit_code') is-invalid @enderror" name="course_unit_code" value="{{ old('course_unit_code') }}" required autocomplete="course_unit_code" autofocus>

                      @error('course_unit_code')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
                  <!-- Name of the Course Unit -->
                  <div class="col-md-6 col-5">
                      <div class="form-group">
                           <label for="course_unit_name" class="col-form-label"> Course Unit Name </label>

                      <input id="course_unit_name" type="text" class="form-control @error('course_unit_name') is-invalid @enderror" name="course_unit_name" value="{{ old('course_unit_name') }}" required autocomplete="course_unit_name">

                      @error('course_unit_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
          <!-- Semester in which the course unit is studied -->
                  <div class="col-md-3 col-3">
                      <div class="form-group">
                           <label for="course_unit_semester" class="col-form-label"> Semester </label>

                           <select name="course_unit_semester" class="form-control" id="course_unit_semester">
                                  <option value="1" {{ (old('course_unit_semester') == 1)? 'selected':'' }}> First </option>
                                  <option value="2" {{ (old('course_unit_semester') == 2)? 'selected':'' }}> Second </option>
                                  <option value="3" {{ (old('course_unit_semester') == 3)? 'selected':'' }}> Third </option>
                                  <option value="4" {{ (old('course_unit_semester') == 4)? 'selected':'' }}> Fourth </option>
                           </select>
                      @error('course_unit_semester')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
              </div>
<!--  Course Unit credit units  -->
              <div class="row">
                <div class="col-md-3 col-3">
                    <div class="form-group">
                         <label for="credit_units" class="col-form-label"> Credit Units </label>

                         <select name="credit_units" class="form-control" id="credit_units">
                                <option value="2" {{ (old('credit_units') == 2)? 'selected':'' }}> 2 CU </option>
                                <option value="3" {{ (old('credit_units') == 3)? 'selected':'' }}> 3 CU </option>
                                <option value="4" {{ (old('credit_units') == 4)? 'selected':'' }}> 4 CU </option>
                                <option value="5" {{ (old('credit_units') == 5)? 'selected':'' }}> 5 CU </option>
                                <option value="0" {{ (old('credit_units') == 0)? 'selected':'' }}> N/A </option>
                         </select>
                    @error('credit_units')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
        <!-- The course that the course unit is being registered for -->
                <div class="col-md-5 col-6">
                    <div class="form-group" id="associated_course">

                    <label for="associated_course" class="col-form-label"> Associated Course </label>

                    <select name="associated_course" class="form-control" id="associated_course">
                        @if($active_courses->count() != 0)
                              <option value="" selected> Select the Course the Course Unit belongs to </option>
                          @foreach($active_courses as $course)
                           <option value="<?=$course->course_code?>"> <?=$course->course_name?> </option>
                          @endforeach
                        @else
                            <option value="" selected> No Courses Registered </option>
                        @endif
                    </select>

                    @error('associated_course')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
<!-- Description of the Course Unit -->
                  <div class="col-md-4 col-6">
                      <div class="form-group">

                      <label for="course_unit_description" class="col-form-label"> Course Unit Description </label>

                      <br/> <div class="hint-block"> Short Description about the Course Unit <strong>(Optional)</strong> </div>

                      <textarea id="course_unit_description" class="form-control @error('course_unit_description') is-invalid @enderror" name="course_unit_description" autocomplete="contact">

                          {{ old('course_unit_description')?old('course_unit_description'):'' }}

                      </textarea>

                      @error('course_unit_description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
              </div>


              <div class="form-group row mb-0">
                  <div class="col-md-5">
                       <button type="submit" class="btn btn-success btn-md"> <i class="zmdi zmdi-plus-square"></i> &nbsp;&nbsp; REGISTER COURSE UNIT </button>
                  </div>
              </div>
          </form>

      </div>
    </div>
  </div>
@endsection
