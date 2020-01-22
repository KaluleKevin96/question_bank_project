<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Courses;
use App\CourseUnits;

class CourseUnitsController extends Controller
{
  //
  public function __construct()
 {
     $this->middleware('auth');

 }

 //FUNCTION TO INSERT COURSE
public function insert_course_unit(Request $request){

if(Auth::user()->position != "super_admin" && Auth::user()->position != "college_admin"){

    return redirect()->back()->with('no_access', 'ACCESS DENIED');
}

      $this->validate($request,[ //field validation rules
          'course_unit_code' => 'required|string|min:4|unique:course_units,course_unit_code',
          'course_unit_name' => 'required|string|min:5',
          'associated_course' => 'required|string|min:4|exists:courses,course_code',
          'credit_units' => 'numeric|min:2|max:5',
          'course_unit_semester' => 'numeric|min:1|max:4',
          'course_unit_description' => 'nullable|string|min:3',
      ],
      [ //custom error messages
        'course_unit_code.unique' =>"A Course Unit with this Course Code has already been registered. <br/> Course Unit codes are required to be unique even if the same course unit is being registered under different course_units. <br/>",
        'associated_course.exists' =>"Please select a Course that has been registered. <br/> In the event that a Valid Course has not been registered, contact the System's Administrator to register the Course",
      ]);

      $course_units = new CourseUnits();
      $recent = $course_units->getMostRecentAutonumber();
      $autonumber = $recent['autonumber'];
      $year = $recent['year'];

      //no need for using course_unit number but will instead use course_unit code.

        if($request->input('course_unit_description') === "<p></p>"){

          $course_unit_description = "<p> No Description Listed </p>";

        }elseif($request->input('course_unit_description') == "" || $request->input('course_unit_description') == NULL ){

          $course_unit_description = "<p> No Description Listed </p>";

        }else{

          $course_unit_description = $request->input('course_unit_description');
        }

      //assigning values to the columns
      $course_units->course_unit_code = $request->input('course_unit_code');
      $course_units->course_unit_name = $request->input('course_unit_name');
      $course_units->associated_course = $request->input('associated_course');
      $course_units->credit_units = $request->input('credit_units');
      $course_units->course_unit_semester = $request->input('course_unit_semester');
      $course_units->course_unit_description = $course_unit_description;

      $course_units->status = "active";
      $course_units->autonumber = $autonumber;
      $course_units->year = $year;

      //Then saving the data
      $course_units->save();

      $message = 'COURSE UNIT "'.$request->input('course_unit_name').'" HAS BEEN REGISTERED SUCCESSFULLY';
      //after saving, redirect to view all suppliers page
      return redirect('all_course_units')->with('success', $message);
  }

  //FUNCTION TO EDIT COURSE UNIT
  public function edit_course_unit(Request $request){

    if(Auth::user()->position != "super_admin" && Auth::user()->position != "college_admin"){

        return redirect()->back()->with('no_access', 'ACCESS DENIED');
    }

              $course_unit = CourseUnits::find($request->input('id'));

              if($course_unit->course_unit_name != $request->input('course_unit_name')){
                  //if a course unit name has been changed

                  //after it being changed need to make sure it is unique
                $this->validate($request,['course_unit_name' => 'required|string|min:5',]);

                  $course->course_name = $request->input('course_unit_name');

              }

              if($course_unit->associated_course != $request->input('associated_course')){
                  //if a course unit attached course has been changed

                  //after it being changed need to make sure it is unique
                $this->validate($request,['associated_course' => 'required|string|min:4|exists:courses,course_code',],
                ['associated_course.exists' =>"Please select a Course that has been registered. <br/> In the event that a Valid Course has not been registered, contact the System's Administrator to register the Course",]);

                  $course_unit->associated_course = $request->input('associated_coursee');
              }

              if($course_unit->credit_units != $request->input('credit_units')){
                  //if a course unit credit unit has been changed

                  //after it being changed need to make sure it is unique
                $this->validate($request,['credit_units' => 'numeric|min:3|max:5',]);

                  $course_unit->credit_units = $request->input('credit_units');
              }

              if($course_unit->course_unit_semester != $request->input('course_unit_semester')){
                  //if a course unit credit unit has been changed

                  //after it being changed need to make sure it is unique
                $this->validate($request,['course_unit_semester' => 'numeric|min:1|max:2',]);

                  $course_unit->course_unit_semester = $request->input('course_unit_semester');
              }

          if($course_unit->course_unit_description != $request->input('course_unit_description')){
                  //if the description has been changed

                  $this->validate($request,['course_unit_description' => 'nullable|string|min:3']);

                  if($request->input('course_unit_description') === "<p></p>"){

                    $course_unit_description = "<p> No Description Listed </p>";

                  }elseif($request->input('course_unit_description') == "" || $request->input('course_unit_description') == NULL ){

                    $course_unit_description = "<p> No Description Listed </p>";

                  }else{

                    $course_unit_description = $request->input('course_unit_description');
                  }

                  $course_unit->course_unit_description = $course_unit_description;
              }

          //then saving/updating the data
          $course_unit->save();

          $message = 'COURSE UNIT "'.$course_unit->course_unit_name.'" HAS BEEN EDITED SUCCESSFULLY';

          //after saving, redirect to view all colleges page
          return redirect('all_course_units')->with('success', $message);

      }

      //FUNCTION TO DELETE / inactivate COURSE UNIT
 public function delete_course_unit($security,$course_unit_id){

     //if(Auth::user()->position == "admin")
     if($security != md5('security') || (Auth::user()->position != "super_admin" && Auth::user()->position != "college_admin")){

         return redirect()->back()->with('no_access', 'ACCESS DENIED');
     }

 $course_unit = CourseUnits::find($course_unit_id);

 $course_unit->status = "inactive";

 $course_unit->save();

 $message = 'COURSE UNIT "'.$course_unit->course_unit_name.'" HAS BEEN IN-ACTIVATED';

     return redirect('all_course_units')->with('warning', $message);

 }

 //FUNCTION TO REACTIVATE COURSE UNITS
 public function reactivate_course_unit($security,$course_unit_id){

     if($security != md5('security') || (Auth::user()->position != "super_admin" && Auth::user()->position != "college_admin")){

         return redirect()->back()->with('no_access', 'ACCESS DENIED');
     }

 $course_unit = CourseUnits::find($course_unit_id);

 $course_unit->status = "active";

 $course_unit->save();

 $message = 'COURSE UNIT "'.$course_unit->course_unit_name.'" HAS BEEN RE-ACTIVATED';

     return redirect('all_course_units')->with('success', $message);
 }

}//CLASS FINAL BRACKET
