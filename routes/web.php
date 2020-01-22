<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PagesController@index')->name('/'); //default route

Auth::routes();

Route::get('/home', 'PagesController@get_homepage')->name('home');


/*------------------------------ USERS ROUTES -------------------------------------------*/
Route::get('/all_users', 'PagesController@all_users_page')->name('all_users');
Route::get('/add_user_form', 'PagesController@load_add_user_form')->name('add_user_form');
Route::post('/add_user', 'UsersController@add_user')->name('add_user');
Route::get('/edit_user_form/{security}/{user_id}','PagesController@get_edituser_page')->name('edit_user_form'); //loading edit page
Route::post('/edit_user','UsersController@edit_user')->name('edit_user'); //handling edit post form
Route::get('/delete_user/{security}/{user_id}','UsersController@delete_user')->name('delete_user'); //handling delete user get request
Route::get('/reactivate_user/{security}/{user_id}','UsersController@reactivate_user')->name('reactivate_user'); //handling reactivate user get request

/*------------------------------ COLLEGES ROUTES -------------------------------------------*/
Route::get('/all_colleges', 'PagesController@all_colleges_page')->name('all_colleges');
Route::get('/add_college_form', 'PagesController@load_add_college_form')->name('add_college_form');
Route::post('/add_college', 'CollegesController@insert_college')->name('add_college');
Route::get('/edit_college_form/{security}/{college_id}','PagesController@get_editcollege_page')->name('edit_college_form'); //loading edit page
Route::post('/edit_college','CollegesController@edit_college')->name('edit_college'); //handling edit post form
Route::get('/delete_college/{security}/{college_id}','CollegesController@delete_college')->name('delete_college'); //handling delete college get request
Route::get('/reactivate_college/{security}/{college_id}','CollegesController@reactivate_college')->name('reactivate_college'); //handling reactivate college

/*------------------------------ COURSES ROUTES -------------------------------------------*/
Route::get('/all_courses', 'PagesController@all_courses_page')->name('all_courses');
Route::get('/add_course_form', 'PagesController@load_add_course_form')->name('add_course_form');
Route::post('/add_course', 'CoursesController@insert_course')->name('add_course');
Route::get('/edit_course_form/{security}/{course_id}','PagesController@get_editcourse_page')->name('edit_course_form'); //loading edit page
Route::post('/edit_course','CoursesController@edit_course')->name('edit_course'); //handling edit post form
Route::get('/delete_course/{security}/{course_id}','CoursesController@delete_course')->name('delete_course'); //handling delete course get request
Route::get('/reactivate_course/{security}/{course_id}','CoursesController@reactivate_course')->name('reactivate_course'); //handling reactivate course

/*------------------------------ COURSE UNITS ROUTES -------------------------------------------*/
Route::get('/all_course_units', 'PagesController@all_course_units_page')->name('all_course_units');
Route::get('/add_course_unit_form', 'PagesController@load_add_course_unit_form')->name('add_course_unit_form');
Route::post('/add_course_unit', 'CourseUnitsController@insert_course_unit')->name('add_course_unit');
Route::get('/edit_course_unit_form/{security}/{course_unit_id}','PagesController@get_editcourse_unit_page')->name('edit_course_unit_form'); //loading edit course_unit page
Route::post('/edit_course_unit','CourseUnitsController@edit_course_unit')->name('edit_course_unit'); //handling edit post form
Route::get('/delete_course_unit/{security}/{course_unit_id}','CourseUnitsController@delete_course_unit')->name('delete_course_unit'); //handling delete course_unit get request
Route::get('/reactivate_course_unit/{security}/{course_unit_id}','CourseUnitsController@reactivate_course_unit')->name('reactivate_course_unit'); //handling reactivate course_unit

/*------------------------------ QUESTION PAPER ROUTES -------------------------------------------*/
Route::get('/all_question_papers', 'PagesController@all_question_papers_page')->name('all_question_papers');
Route::get('/add_question_paper_form', 'PagesController@load_upload_question_paper_form')->name('add_question_paper_form');
Route::post('/add_question_paper', 'QuestionPapersController@insert_question_paper')->name('add_question_paper');
Route::get('/edit_question_paper_form/{security}/{question_paper_id}','PagesController@get_editquestion_paper_page')->name('edit_question_paper_form'); //loading edit question paper page
Route::post('/edit_question_paper','QuestionPapersController@edit_question_paper')->name('edit_question_paper'); //handling edit post form
Route::get('/delete_question_paper/{security}/{question_paper_id}','QuestionPapersController@delete_question_paper')->name('delete_question_paper'); //handling delete question paper get request
Route::get('/reactivate_question_paper/{security}/{question_paper_id}','QuestionPapersController@reactivate_question_paper')->name('reactivate_question_paper'); //handling reactivate question paper
