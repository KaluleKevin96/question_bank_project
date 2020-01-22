<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//MODELS
use App\Users;

class UsersController extends Controller
{
    //
    //global variable for number of users
    public $number_of_users;

     public function __construct()
    {
        $this->number_of_users = count(Users::get_users("active"));

        $this->middleware('auth');
    }

    //FUNCTION TO ADD USER
 public function add_user(Request $request){
 // 'email' => 'required|string|email|max:255|unique:users',
         $this->validate($request,[
             'first_name' => 'required|string|min:3|max:255',
             'last_name' => 'required|string|min:3|max:255',
             'contact' => 'required|string|max:10|min:10',
             'email' => 'required|string|email|max:255|unique:users',
             'username' => 'required|string|max:20|min:6|unique:users',
             'password' => 'required|string|min:6|confirmed',
         ]);

         $users = new Users();
         $recent = $users->getMostRecentAutonumber();
         $autonumber = $recent['autonumber'];
         $year = $recent['year'];

          if($autonumber == 1 && $year == date('Y')){
             $position = "super_admin"; //first person to register is a super administrator
         }else{
             $position = "admin";
            }

            if ($autonumber < 10) {
        			$newNo = "U".date('y')."000".$autonumber ;
        		} elseif ($autonumber >= 10) {
        			$newNo = "U".date('y')."00".$autonumber ;
        		} elseif ($autonumber >= 100) {
        			$newNo = "U".date('y')."0".$autonumber ;
        		} elseif ($autonumber >= 1000) {
        			$newNo = "U".date('y')."".$autonumber ;
        		}

         //assigning values to the columns
         $users->user_number = $newNo;
         $users->first_name = $request->input('first_name');
         $users->last_name = $request->input('last_name');
         $users->contact = $request->input('contact');
         $users->email = $request->input('email');
         $users->username = $request->input('username');
         $users->password = bcrypt($request->input('password'));
         $users->position = $position;
         $users->status = "active";
         $users->autonumber = $autonumber;
         $users->year = $year;

         //Then saving the data
         $users->save();

         $message = 'CONGRATULATIONS <br/> USER "'.$request->input('last_name')." ". $request->input('first_name').'" HAS BEEN ADDED SUCCESSFULLY';
         //after saving, redirect to view all suppliers page
         return redirect('all_users')->with('success', $message);
     }

     //FUNCTION TO EDIT USER
     public function edit_user(Request $request){

         //VALIDATION
         $this->validate($request,[
                 'first_name' => 'required|string|min:3|max:255',
                 'last_name' => 'required|string|min:3|max:255',
                 'contact' => 'required|string|max:10|min:10',
               ]);
               /*
                 'username' => 'required|string|max:20|min:6|unique:users',
                 'password' => 'required|string|min:6|confirmed',
               */

                 $user = Users::find($request->input('id'));


             if(Auth::user()->id == $user->id){ //this only happens if a user is editing their own account

                 if($user->username != $request->input('username')){
                     //if a username has been changed

                     //after it being changed need to make sure it is unique
                     $this->validate($request,['username' => 'required|string|max:20|min:6|unique:users']);

                     $user->username = $request->input('username');

                 }

             if($user->email != $request->input('email')){
                     //if the email has been changed

                     //after it being changed need to make sure it is unique
                     $this->validate($request,['email' => 'string|email|max:255|unique:users']);

                     $user->email = $request->input('email');

                 }

          if($request->input('password') != NULL ){
                     //if password has been changed

                     //after it being changed, need to make sure it is unique and it matches confirmed password
                     $this->validate($request,['password'=>'required|string|min:6|confirmed']);

                      $user->password = bcrypt($request->input('password'));

                 }

             }

             $user->first_name = $request->input('first_name');
             $user->last_name = $request->input('last_name');
             $user->contact = $request->input('contact');
             $user->email = $request->input('email');

             //then saving/updating the data
             $user->save();

             $message = 'USER "'.$user->last_name." ".$user->first_name.'" HAS BEEN EDITED SUCCESSFULLY';

             //after saving, redirect to view all categories page
             return redirect('all_users')->with('success', $message);

         }

         //FUNCTION TO DELETE / inactivate USER
    public function delete_user($security,$user_id){

                //snippet to check current user's session

        //if(Auth::user()->position == "admin")
        if($security != md5('security')){

            return redirect()->back()->with('no_access', 'ACCESS DENIED');
        }

    $user = Users::find($user_id);

    $user->status = "inactive";

    $user->save();

    $message = 'USER "'.$user->last_name." ".$user->first_name.'" HAS BEEN IN-ACTIVATED';

        return redirect('all_users')->with('warning', $message);

    }

    //FUNCTION TO REACTIVATE USER
    public function reactivate_user($security,$user_id){

                //snippet to check current user's session

        //if(Auth::user()->position == "admin")
        if($security != md5('security')){

            return redirect()->back()->with('no_access', 'ACCESS DENIED');
        }

    $user = Users::find($user_id);

    $user->status = "active";

    $user->save();

    $message = 'USER "'.$user->last_name." ".$user->first_name.'" HAS BEEN RE-ACTIVATED';

        return redirect('all_users')->with('success', $message);

    }

}
