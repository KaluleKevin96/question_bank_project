<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//MODELS
use App\Courses;
use App\Colleges_model;

class CoursesController extends Controller{

    //
    public function __construct()
   {
       $this->middleware('auth');

   }

   //FUNCTION TO INSERT COURSE
public function insert_course(Request $request){

  if(Auth::user()->position != "super_admin" && Auth::user()->position != "college_admin"){

      return redirect()->back()->with('no_access', 'ACCESS DENIED');
  }

        $this->validate($request,[ //field validation rules
            'course_code' => 'required|string|min:4|unique:courses,course_code',
            'course_name' => 'required|string|min:5|unique:courses,course_name',
            'associated_college' => 'required|string|min:4|exists:colleges,college_number',
            'course_duration' => 'numeric|min:1|max:5',
            'course_description' => 'nullable|string|min:3|max:255',
        ],
        [ //custom error messages
          'course_code.unique' =>"A Course with this Course Code has already been registered. <br/> Course codes are required to be unique.",
          'associated_college.exists' =>"Please select a College that has been registered. <br/> In the event that a Valid College has not been registered, contact the System's Administrator to register the college",
        ]);

        $courses = new Courses();
        $recent = $courses->getMostRecentAutonumber();
        $autonumber = $recent['autonumber'];
        $year = $recent['year'];

        //no need for using course number but will instead use course code.

          if($request->input('course_description') === "<p></p>"){

            $course_description = "<p> No Description Listed </p>";

          }elseif($request->input('course_description') == "" || $request->input('course_description') == NULL ){

            $course_description = "<p> No Description Listed </p>";

          }else{

            $course_description = $request->input('course_description');
          }

        //assigning values to the columns
        $courses->course_code = $request->input('course_code');
        $courses->course_name = $request->input('course_name');
        $courses->associated_college = $request->input('associated_college');
        $courses->course_description = $course_description;

        $courses->status = "active";
        $courses->autonumber = $autonumber;
        $courses->year = $year;

        //Then saving the data
        $courses->save();

        $message = 'COURSE  "'.$request->input('course_name').'" HAS BEEN REGISTERED SUCCESSFULLY';
        //after saving, redirect to view all suppliers page
        return redirect('all_courses')->with('success', $message);
    }

    //FUNCTION TO EDIT COURSE
    public function edit_course(Request $request){

      if(Auth::user()->position != "super_admin" && Auth::user()->position != "college_admin"){

          return redirect()->back()->with('no_access', 'ACCESS DENIED');
      }

                $course = Courses::find($request->input('id'));

                if($course->course_name != $request->input('course_name')){
                    //if a course name has been changed

                    //after it being changed need to make sure it is unique
                  $this->validate($request,['course_name' => 'required|string|min:5|unique:courses,course_name',]);

                    $course->course_name = $request->input('course_name');

                }

                if($course->associated_college != $request->input('associated_college')){
                    //if a course college has been changed

                    //after it being changed need to make sure it is unique
                  $this->validate($request,['associated_college' => 'required|string|min:4|exists:colleges,college_number',]);

                    $course->associated_college = $request->input('associated_college');
                }

                if($course->course_duration != $request->input('course_duration')){
                    //if a course college has been changed

                    //after it being changed need to make sure it is unique
                  $this->validate($request,['course_duration' => 'numeric|min:3|max:5',]);

                    $course->course_duration = $request->input('course_duration');
                }

            if($course->course_description != $request->input('course_description')){
                    //if the description has been changed

                    $this->validate($request,['course_description' => 'nullable|string|min:3|max:255']);

                    if($request->input('course_description') === "<p></p>"){

                      $course_description = "<p> No Description Listed </p>";

                    }elseif($request->input('course_description') == "" || $request->input('course_description') == NULL ){

                      $course_description = "<p> No Description Listed </p>";

                    }else{

                      $course_description = $request->input('course_description');
                    }

                    $course->course_description = $course_description;
                }

            //then saving/updating the data
            $course->save();

            $message = 'COURSE "'.$course->course_name.'" HAS BEEN EDITED SUCCESSFULLY';

            //after saving, redirect to view all colleges page
            return redirect('all_courses')->with('success', $message);

        }

        //FUNCTION TO DELETE / inactivate COURSE
   public function delete_course($security,$course_id){

       //if(Auth::user()->position == "admin")
       if($security != md5('security') || (Auth::user()->position != "super_admin" && Auth::user()->position != "college_admin")){

           return redirect()->back()->with('no_access', 'ACCESS DENIED');
       }

   $course = Courses::find($course_id);

   $course->status = "inactive";

   $course->save();

   $message = 'COURSE "'.$course->course_name.'" HAS BEEN IN-ACTIVATED';

       return redirect('all_courses')->with('warning', $message);

   }

   //FUNCTION TO REACTIVATE COURSE
   public function reactivate_course($security,$course_id){

       if($security != md5('security') || (Auth::user()->position != "super_admin" && Auth::user()->position != "college_admin")){

           return redirect()->back()->with('no_access', 'ACCESS DENIED');
       }

   $course = Courses::find($course_id);

   $course->status = "active";

   $course->save();

   $message = 'COURSE "'.$course->course_name.'" HAS BEEN RE-ACTIVATED';

       return redirect('all_courses')->with('success', $message);

   }

} //FINAL CLASS ENDING BRACKET
