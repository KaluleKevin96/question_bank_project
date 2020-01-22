<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

//MODELS
use App\Users;
use App\Colleges_model;
use App\Courses;
use App\CourseUnits;
use App\QuestionPapers;


class PagesController extends Controller
{
    //

    //global variable for number of users
    public $number_of_users,$number_of_colleges,$number_of_courses,$number_of_course_units,$number_of_question_papers;

     public function __construct()
    {
        $this->number_of_users = count(Users::get_users("active"));
        $this->number_of_colleges = count(Colleges_model::get_colleges("active"));
        $this->number_of_courses = count(Courses::get_courses("active"));
        $this->number_of_course_units = count(CourseUnits::get_course_units("active"));
        $this->number_of_question_papers = count(QuestionPapers::get_question_papers("active"));
    }

public function index()
    {
      //$all_users = count(Users::all());

        $page_title = "WELCOME TO THE QUESTION BANK ";

        return view('home',['number_of_users'=>$this->number_of_users,'number_of_courses'=>$this->number_of_courses,'number_of_colleges'=>$this->number_of_colleges,'number_of_course_units'=>$this->number_of_course_units,'number_of_question_papers'=>$this->number_of_question_papers, 'page_title'=>$page_title]);

    }


//FUNCTION TO LOAD LOGGED IN  HOMEPAGE
 public function get_homepage()
    {
         if(!Auth::check()){

            return redirect('/')->with('please_log_in', 'ACCESS DENIED <br/> PLEASE LOG IN TO CONTINUE');
        }

        $all_users = count(Users::all());

        $page_title = "WELCOME TO THE QUESTION BANK ";

        return view('home',['number_of_users'=>$this->number_of_users,'number_of_courses'=>$this->number_of_courses,'number_of_colleges'=>$this->number_of_colleges,'number_of_course_units'=>$this->number_of_course_units,'number_of_question_papers'=>$this->number_of_question_papers, 'page_title'=>$page_title]);
    }


    /* ---------------------------------- FUNCTIONS RELATING TO USERS ----------------------------------*/
    //FUNCTION TO LOAD ALL USERS PAGE
 public function all_users_page()
    {
         if(!Auth::check()){

            return redirect('/')->with('please_log_in', 'ACCESS DENIED <br/> PLEASE LOG IN TO CONTINUE');
        }

        //$all_users = count(Users::all());

        $page_title = "ALL USERS ";
        $active_users = Users::get_users('active');
        //dd($active_users);
        $inactive_users = Users::get_users('inactive');

        return view('users.all_users',['number_of_users'=>$this->number_of_users, 'page_title'=>$page_title,'active_users'=>$active_users,'inactive_users'=>$inactive_users]);
    }

    //FUNCTION TO LOAD ADD USER PAGE
 public function load_add_user_form()
    {
         if(!Auth::check()){

            return redirect('/')->with('please_log_in', 'ACCESS DENIED <br/> PLEASE LOG IN TO CONTINUE');
        }

        //$all_users = count(Users::all());

        $page_title = "REGISTER NEW USER ";


        return view('users.add_new_user',['number_of_users'=>$this->number_of_users, 'page_title'=>$page_title]);
    }

    //FUNCTION TO LOAD EDIT USER PAGE
 public function get_edituser_page($security,$user_id)
    {

       //snippet to check current user's session
        if(!Auth::check()){

            return redirect('/')->with('please_log_in', 'PLEASE LOG IN TO CONTINUE');
        }

        if($security != md5('security')){

            return redirect()->back()->with('no_access', 'ACCESS DENIED');
        }

        $user = Users::findOrFail($user_id); //USING the id
        //$user = Suppliers::where('supplier_no',$supplier_number)->first();

        $page_title = "EDIT ".strtoupper($user->last_name ." ". $user->first_name) ." PROFILE";

        return view('users.edit_user_form' , ['number_of_users'=>$this->number_of_users,'page_title'=>$page_title , 'user'=>$user]);
    }

    /* ---------------------------------- FUNCTIONS RELATING TO COLLEGES ----------------------------------*/
    //FUNCTION TO LOAD ALL COLLEGES PAGE
  public function all_colleges_page()
    {
        //  if(!Auth::check()){
        //
        //     return redirect('/')->with('please_log_in', 'ACCESS DENIED <br/> PLEASE LOG IN TO CONTINUE');
        // }

        //$all_users = count(Users::all());

        $page_title = "ALL COLLEGES";
        $active_colleges = Colleges_model::get_colleges('active');
        //dd($active_users);
        $inactive_colleges = Colleges_model::get_colleges('inactive');

        return view('colleges.all_colleges',['number_of_users'=>$this->number_of_users, 'page_title'=>$page_title,'active_colleges'=>$active_colleges,'inactive_colleges'=>$inactive_colleges]);
    }

    //FUNCTION TO LOAD ADD COLLEGE PAGE
  public function load_add_college_form()
    {
         if(!Auth::check()){

            return redirect('/')->with('please_log_in', 'ACCESS DENIED <br/> PLEASE LOG IN TO CONTINUE');
        }

        //$all_users = count(Users::all());

        $page_title = "REGISTER NEW COLLEGE ";


        return view('colleges.add_new_college_form',['number_of_users'=>$this->number_of_users, 'page_title'=>$page_title]);
    }

    //FUNCTION TO LOAD EDIT COLLEGE PAGE
  public function get_editcollege_page($security,$college_id)
    {

       //snippet to check current user's session
        if(!Auth::check()){

            return redirect('/')->with('please_log_in', 'PLEASE LOG IN TO CONTINUE');
        }

        if($security != md5('security')){

            return redirect()->back()->with('no_access', 'ACCESS DENIED');
        }

        $college = Colleges_model::findOrFail($college_id); //USING the id
        //$user = Suppliers::where('supplier_no',$supplier_number)->first();

        $page_title = "EDIT ".strtoupper($college->college_name);

        return view('colleges.edit_college_form' , ['number_of_users'=>$this->number_of_users,'page_title'=>$page_title , 'college'=>$college]);
    }

    /* ---------------------------------- FUNCTIONS RELATING TO COURSES ----------------------------------*/
    //FUNCTION TO LOAD ALL COURSES PAGE
  public function all_courses_page()
    {

        $page_title = "ALL COURSES";
        $active_courses = Courses::get_courses('active');
        $inactive_courses = Courses::get_courses('inactive');

        $active_colleges = Colleges_model::get_colleges('active');

        return view('courses.all_courses',['number_of_users'=>$this->number_of_users, 'page_title'=>$page_title,'active_courses'=>$active_courses,'inactive_courses'=>$inactive_courses,'active_colleges'=>$active_colleges]);
    }

    //FUNCTION TO LOAD ADD COURSE PAGE
  public function load_add_course_form()
    {
         if(!Auth::check()){

            return redirect('/')->with('please_log_in', 'ACCESS DENIED <br/> PLEASE LOG IN TO CONTINUE');
        }

        $page_title = "REGISTER NEW COURSE ";

          $active_colleges = Colleges_model::get_colleges('active');


        return view('courses.add_new_course_form',['number_of_users'=>$this->number_of_users, 'page_title'=>$page_title,'active_colleges'=>$active_colleges]);
    }

    //FUNCTION TO LOAD EDIT COURSE PAGE
  public function get_editcourse_page($security,$course_id)
    {
       //snippet to check current user's logged in
        if(!Auth::check()){

            return redirect('/')->with('please_log_in', 'PLEASE LOG IN TO CONTINUE');
        }

        if($security != md5('security')){

            return redirect()->back()->with('no_access', 'ACCESS DENIED');
        }

        $course = Courses::findOrFail($course_id); //USING the id
        //$user = Suppliers::where('supplier_no',$supplier_number)->first();

        $page_title = "EDIT ".strtoupper($course->course_name);

        $active_colleges = Colleges_model::get_colleges('active');

        return view('courses.edit_course_form' , ['number_of_users'=>$this->number_of_users,'page_title'=>$page_title , 'course'=>$course,'active_colleges'=>$active_colleges]);
    }

  /* ---------------------------------- FUNCTIONS RELATING TO COURSE UNITS ----------------------------------*/
    //FUNCTION TO LOAD ALL COURSE UNITS PAGE
  public function all_course_units_page()
    {

        $page_title = "ALL COURSE UNITS";
        $active_course_units = CourseUnits::get_course_units('active');
        $inactive_course_units = CourseUnits::get_course_units('inactive');

        $active_courses = Courses::get_courses('active');

        return view('course_units.all_course_units',['number_of_users'=>$this->number_of_users, 'page_title'=>$page_title,'active_course_units'=>$active_course_units,'inactive_course_units'=>$inactive_course_units,'active_courses'=>$active_courses]);
    }

    //FUNCTION TO LOAD ADD COURSE UNIT PAGE
  public function load_add_course_unit_form()
    {
         if(!Auth::check()){

            return redirect('/')->with('please_log_in', 'ACCESS DENIED <br/> PLEASE LOG IN TO CONTINUE');
        }

        //$all_users = count(Users::all());

        $page_title = "REGISTER NEW COURSE UNIT ";

          $active_courses = Courses::get_courses('active');


        return view('course_units.add_new_course_unit_form',['number_of_users'=>$this->number_of_users, 'page_title'=>$page_title,'active_courses'=>$active_courses]);
    }

    //FUNCTION TO LOAD EDIT COURSE UNIT PAGE
  public function get_editcourse_unit_page($security,$course_unit_id)
    {
       //snippet to check current user's logged in
        if(!Auth::check()){

            return redirect('/')->with('please_log_in', 'PLEASE LOG IN TO CONTINUE');
        }

        if($security != md5('security')){

            return redirect()->back()->with('no_access', 'ACCESS DENIED');
        }

        $course_unit = CourseUnits::findOrFail($course_unit_id); //USING the id
        //$user = Suppliers::where('supplier_no',$supplier_number)->first();

        $page_title = "EDIT ".strtoupper($course_unit->course_unit_name);

        $active_courses = Courses::get_courses('active');

        return view('course_units.edit_course_unit_form' , ['number_of_users'=>$this->number_of_users,'page_title'=>$page_title , 'course_unit'=>$course_unit,'active_courses'=>$active_courses]);
    }

    /* ---------------------------------- FUNCTIONS RELATING TO 'question' PAPERS ----------------------------------*/
    //FUNCTION TO LOAD ALL question PAPEPRS PAGE
  public function all_question_papers_page()
    {

        $page_title = "ALL QUESTION PAPERS";

        $all_question_papers = QuestionPapers::get_question_papers('active');
        $inactive_question_papers = QuestionPapers::get_question_papers('inactive');

        $active_course_units = CourseUnits::get_course_units('active');
        $active_courses = Courses::get_courses('active');
        $active_colleges = Colleges_model::get_colleges('active');

        return view('question_papers.all_question_papers',['number_of_users'=>$this->number_of_users, 'page_title'=>$page_title,'all_question_papers'=>$all_question_papers,'inactive_question_papers'=>$inactive_question_papers,'active_course_units'=>$active_course_units,'active_colleges'=>$active_colleges,'active_courses'=>$active_courses]);
    }

    //FUNCTION TO LOAD ADD question PAPER PAGE
  public function load_upload_question_paper_form()
    {
         if(!Auth::check()){

            return redirect('/')->with('please_log_in', 'ACCESS DENIED <br/> PLEASE LOG IN TO CONTINUE');
        }

        //$all_users = count(Users::all());

        $page_title = "UPLOAD QUESTION PAPER";

        $active_course_units = CourseUnits::get_course_units('active');
        $active_courses = Courses::get_courses('active');
        // $active_colleges = Colleges_model::get_colleges('active');


        return view('question_papers.add_new_question_paper_form',['number_of_users'=>$this->number_of_users, 'page_title'=>$page_title,'active_course_units'=>$active_course_units,'active_courses'=>$active_courses]);
    }

    //FUNCTION TO LOAD EDIT question PAPER PAGE
  public function get_editquestion_paper_page($security,$question_paper_id)
    {
       //snippet to check current user's logged in
        if(!Auth::check()){

            return redirect('/')->with('please_log_in', 'PLEASE LOG IN TO CONTINUE');
        }

        if($security != md5('security')){

            return redirect()->back()->with('no_access', 'ACCESS DENIED');
        }

        $question_paper = QuestionPapers::findOrFail($question_paper_id); //USING the id
        //$user = Suppliers::where('supplier_no',$supplier_number)->first();

        $page_title = "EDIT ".strtoupper($question_paper->paper_title);

        $active_course_units = CourseUnits::get_course_units('active');
        $active_courses = Courses::get_courses('active');
        $active_colleges = Colleges_model::get_colleges('active');

        return view('question_papers.edit_question_paper_form' , ['number_of_users'=>$this->number_of_users,'page_title'=>$page_title , 'question_paper'=>$question_paper,'active_course_units'=>$active_course_units,'active_colleges'=>$active_colleges,'active_courses'=>$active_courses]);
    }


}//class final bracket
