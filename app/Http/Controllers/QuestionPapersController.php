<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Courses;
use App\Colleges_model;
use App\CourseUnits;
use App\QuestionPapers;

use Illuminate\Http\Request;

class QuestionPapersController extends Controller
{
    //
    //
  public function __construct()
 {
//have to be logged in to perform any of the methods below
     $this->middleware('auth');

 }

 //FUNCTION TO ACTUALLY INSERT THE PAPER
public function insert_question_paper(Request $request){

  // dd($request);

if(Auth::user()->position != "super_admin" && Auth::user()->position != "college_admin"){

    return redirect()->back()->with('no_access', 'ACCESS DENIED');
}

$paper_title = $request->associated_course."-".$request->course_unit_code."-".$request->question_paper->getClientOriginalName();

      $this->validate($request,[ //field validation rules
          'question_paper' => 'required|mimes:pdf,docx|max:5024',
          'paper_category' => 'required|string|min:4',

          'course_unit_code' => 'required|string|min:4|exists:course_units,course_unit_code',
          'associated_course' => 'required|string|min:4|exists:courses,course_code',
          'semester' => 'numeric|min:1|max:4',
          'paper_description' => 'nullable|string|min:3',
      ],
      [ //custom error messages
        'course_unit_code.exists' =>"Please select a Course Unit that has been registered. <br/> In the event that a Valid Course Unit has not been registered, contact the System's Administrator to register the Course Unit <br/>",
        'associated_course.exists' =>"Please select a Course that has been registered. <br/> In the event that a Valid Course has not been registered, contact the System's Administrator to register the Course",
        'question_paper' => "Please choose a question paper to Upload"
      ]);

      //uploading the question paper
        $file_path = $request->question_paper->storeAs('question_papers' , $paper_title);

      if($file_path){
			      $question_papers = new QuestionPapers();

			      $recent = $question_papers->getMostRecentAutonumber();
			      $autonumber = $recent['autonumber'];
			      $year = $recent['year'];

			      //getting the system generated paper number
			        if ($autonumber < 10) {
			            $newNo = "QP".date('y')."000".$autonumber ;
			          } elseif ($autonumber >= 10) {
			            $newNo = "QP".date('y')."00".$autonumber ;
			          } elseif ($autonumber >= 100) {
			            $newNo = "QP".date('y')."0".$autonumber ;
			          } elseif ($autonumber >= 1000) {
			            $newNo = "QP".date('y')."".$autonumber ;
			          }
                //
			          // // paper title shall be the generated paper number appended to the course unit name and paper category
			         	//  $paper_title = $request->input('course_unit_name')."-".$request->input('paper_category')." Paper-".$newNo;
                //


			        if($request->input('question_paper_description') === "<p></p>"){

			          $question_paper_description = "<p> No Description Listed </p>";

			        }elseif($request->input('question_paper_description') == "" || $request->input('question_paper_description') == null ){

			          $question_paper_description = "<p> No Description Listed </p>";

			        }else{

			          $question_paper_description = $request->input('question_paper_description');
			        }


			      //assigning values to the columns
			      $question_papers->paper_number = $newNo;
			      $question_papers->course_unit_code = $request->input('course_unit_code');
			      $question_papers->file_path = $file_path;
			      $question_papers->associated_course = $request->input('associated_course');
			      $question_papers->paper_title = $paper_title;

			      $question_papers->semester = $request->input('semester');
            $question_papers->paper_category = $request->input('paper_category');
			      $question_papers->paper_description = $question_paper_description;

			      $question_papers->status = "active";
			      $question_papers->autonumber = $autonumber;
            $question_papers->uploaded_by = Auth::user()->user_number;
			      $question_papers->year = $year;

			      //Then saving the data
			      $question_papers->save();

			      $message = 'QUESTION PAPER <b>"'.$paper_title.'"</b> HAS BEEN UPLOADED SUCCESSFULLY';
			      //after saving, redirect to view all suppliers page
			      return redirect('all_question_papers')->with('success', $message);

  	}else{

  		//if file is not uploaded, redirect back
  		 return redirect()->back()->with('no_access', 'FILE UPLOAD FAILED !!');

  	}
  }

  //FUNCTION TO EDIT question PAPER
  public function edit_question_paper(Request $request){

    if(Auth::user()->position != "super_admin" && Auth::user()->position != "college_admin"){

        return redirect()->back()->with('no_access', 'ACCESS DENIED');
    }

              $question_paper = CourseUnits::find($request->input('id'));

              if($question_paper->course_unit_code != $request->input('course_unit_code')){
                  //if a course unit has been changed

                  //after it being changed need to make sure it exists
                $this->validate($request,['course_unit_code' => 'required|string|min:4|exists:course_units,course_unit_code',],
                	[ 'course_unit_code.exists' =>"Please select a Course Unit that has been registered. <br/> In the event that a Valid Course Unit has not been registered, contact the System's Administrator to register the Course Unit <br/>"]);

                  $question_paper->course_unit_code = $request->input('course_unit_code');

              }

              if($question_paper->associated_course != $request->input('associated_course')){
                  //if attached course has been changed

                  //after it being changed need to make sure it exists
                $this->validate($request,['associated_course' => 'required|string|min:4|exists:courses,course_code',],
                ['associated_course.exists' =>"Please select a Course that has been registered. <br/> In the event that a Valid Course has not been registered, contact the System's Administrator to register the Course",]);

                  $question_paper->associated_course = $request->input('associated_coursee');
              }

              if($question_paper->semester != $request->input('semester')){
                  //if the semester has been changed

                  //after it being changed need to validate
                $this->validate($request,['semester' => 'numeric|min:1|max:4',]);

                  $question_paper->semester = $request->input('semester');
              }

          if($question_paper->paper_description != $request->input('paper_description')){
                  //if the description has been changed

                  $this->validate($request,['paper_description' => 'nullable|string|min:3',]);

                  if($request->input('paper_description') === "<p></p>"){

                    $question_paper_description = "<p> No Description Listed </p>";

                  }elseif($request->input('paper_description') == "" || $request->input('paper_description') == NULL ){

                    $question_paper_description = "<p> No Description Listed </p>";

                  }else{

                    $question_paper_description = $request->input('paper_description');
                  }

                  $question_paper->paper_description = $question_paper_description;
              }

          //then saving/updating the data
          $question_paper->save();

          $message = 'QUESTION PAPER "'.$question_paper->paper_title.'" HAS BEEN EDITED SUCCESSFULLY';

          //after saving, redirect to view all question papers page
          return redirect('all_question_papers')->with('success', $message);

      }

      //FUNCTION TO DELETE / inactivate question PAPER
 public function delete_question_paper($security,$question_paper_id){

     //if(Auth::user()->position == "admin")
     if($security != md5('security') || (Auth::user()->position != "super_admin" && Auth::user()->position != "college_admin")){

         return redirect()->back()->with('no_access', 'ACCESS DENIED');
     }

 $question_paper = QuestionPapers::find($question_paper_id);

 $question_paper->status = "inactive";

 $question_paper->save();

 $message = 'QUESTION PAPER "'.$question_paper->paper_title.'" HAS BEEN IN-ACTIVATED';

     return redirect('all_question_papers')->with('warning', $message);

 }

 //FUNCTION TO REACTIVATE QUETION PAPER
 public function reactivate_question_paper($security,$question_paper_id){

     if($security != md5('security') || (Auth::user()->position != "super_admin" && Auth::user()->position != "college_admin")){

         return redirect()->back()->with('no_access', 'ACCESS DENIED');
     }

 $question_paper = QuestionPapers::find($question_paper_id);

 $question_paper->status = "active";

 $question_paper->save();

 $message = 'QUESTION PAPER "'.$question_paper->paper_title.'" HAS BEEN RE-ACTIVATED';

     return redirect('all_question_papers')->with('success', $message);
 }

}//CLASS FINAL BRACKET
