@extends('layouts.app')

@section('content')

  <div class="card">
  	<div class="card-header">
  		<strong class="card-title title-text text-center">
  			UPLOAD QUESTION PAPER
  			<small>
  				<span class="float-right mt-1">
  					<a href="{{ route('all_question_papers') }}" class="btn btn-md btn-primary" title="ALL QUESTION PAPERS"> <i class="fa fa-list-ul"></i> </a>
  				</span>
  			</small>
  		</strong>
  	</div>
  	<div class="card-body">
      <div class="container">
         <form method="POST" action="{{ route('add_question_paper') }}" enctype="multipart/form-data">
                         @csrf

              <div class="row">
                <!-- Course Unit the paper is for -->
                  <div class="col-md-5 col-8">
                      <div class="form-group" id="associated_course_unit">

                    <label for="course_unit_code" class="col-form-label"> Course Unit </label>

                    <select name="course_unit_code" class="form-control" id="course_unit_code">
                        @if($active_course_units->count() != 0)
                              <option value="" selected> Select the Course Unit the paper belongs to </option>
                          @foreach($active_course_units as $course_unit)
                           <option value="<?=$course_unit->course_unit_code?>"> <?=$course_unit->course_unit_name?> </option>
                          @endforeach
                        @else
                            <option value="" selected> No Course Units Registered </option>
                        @endif
                    </select>

                    @error('course_unit_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                  </div>
                  <!-- Course the paper is attached to -->
                  <div class="col-md-5 col-8">
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
          <!-- Semester in which the paper is sat -->
                  <div class="col-md-2 col-3">
                      <div class="form-group">
                           <label for="course_unit_semester" class="col-form-label"> Semester </label>

                           <select name="semester" class="form-control" id="semester">
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
<br/>
              <div class="row">
                <div class="col-md-2 col-12">
                  <label for="birthday" class="heading"> <b> Paper Category </b> : </label>
                </div>
                 <div class="form-group col-md-6 col-12">
                                <div class="form-row">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="paper_category" id="Test" value="Test">
                                        <label class="form-check-label" for="male"> Test </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="paper_category" id="Exam" value="Exam">
                                        <label class="form-check-label" for="femaile"> Exam </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="paper_category" id="Practice" value="Practice">
                                        <label class="form-check-label" for="custom"> Practice </label>
                                    </div>
                                    <br/>
                   <small class="text-muted ml-3 mt-2"> (The paper could be <b> Test </b> , <b> Exam </b> or <b> Practice </b> paper) </small>

                </div>
                </div>
              </div>
<br/><br/>
<!--  The question paper upload  -->
              <div class="row">
                <div class="col-md-5 col-5">
                    <div class="form-group">
                         <div class="custom-file">
                          <input type="file" class="custom-file-input" id="question_paper" name="question_paper">
                          <label class="custom-file-label" for="question_paper"> Choose Paper to Upload</label>
                        </div>
                    @error('question_paper')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>

<!-- Description of the Course Unit -->
                  <div class="col-md-5 col-5 offset-1">
                      <div class="form-group">

                      <label for="question_paper_description" class="col-form-label"> Question Paper Description </label>

                      <br/> <span class="hint-block"> Short Description about the Question Paper <strong>(Optional)</strong> </span>

                      <textarea id="question_paper_description" class="form-control @error('question_paper_description') is-invalid @enderror" name="question_paper_description" autocomplete="question_paper_description">

                          {{ old('question_paper_description')?old('question_paper_description'):'' }}

                      </textarea>

                      @error('question_paper_description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                  </div>
              </div>


              <div class="form-group row mb-0">
                  <div class="col-md-5">
                       <button type="submit" class="btn btn-success btn-md"> <i class="fa fa-upload"></i> &nbsp;&nbsp; UPLOAD QUESTION PAPER </button>
                  </div>
              </div>
          </form>

      </div>
    </div>
  </div>
@endsection
