<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//MODELS
use App\Colleges_model;

class CollegesController extends Controller
{
    //
    public function __construct()
   {
       $this->middleware('auth');

   }

   //FUNCTION TO INSERT COLLEGE
public function insert_college(Request $request){

  if(Auth::user()->position != "super_admin"){

      return redirect()->back()->with('no_access', 'ACCESS DENIED');
  }

        $this->validate($request,[
            'college_name' => 'required|string|min:3|max:255|unique:colleges',
            'college_description' => 'nullable|string|min:3|max:255',
        ]);

        $colleges = new Colleges_model();
        $recent = $colleges->getMostRecentAutonumber();
        $autonumber = $recent['autonumber'];
        $year = $recent['year'];

           if ($autonumber < 10) {
            $newNo = "CL".date('y')."000".$autonumber ;
          } elseif ($autonumber >= 10) {
            $newNo = "CL".date('y')."00".$autonumber ;
          } elseif ($autonumber >= 100) {
            $newNo = "CL".date('y')."0".$autonumber ;
          } elseif ($autonumber >= 1000) {
            $newNo = "CL".date('y')."".$autonumber ;
          }

          if($request->input('college_description') === "<p></p>"){

            $college_description = "<p> No Description Listed </p>";

          }elseif($request->input('college_description') == "" || $request->input('college_description') == NULL ){

            $college_description = "<p> No Description Listed </p>";

          }else{

            $college_description = $request->input('college_description');
          }

        //assigning values to the columns
        $colleges->college_number = $newNo;
        $colleges->college_name = $request->input('college_name');
        $colleges->college_description = $college_description;

        $colleges->status = "active";
        $colleges->autonumber = $autonumber;
        $colleges->year = $year;

        //Then saving the data
        $colleges->save();

        $message = 'COLLEGE  "'.$request->input('college_name').'" HAS BEEN REGISTERED SUCCESSFULLY';
        //after saving, redirect to view all suppliers page
        return redirect('all_colleges')->with('success', $message);
    }

    //FUNCTION TO EDIT COLLEGE
    public function edit_college(Request $request){

      if(Auth::user()->position != "super_admin"){

          return redirect()->back()->with('no_access', 'ACCESS DENIED');
      }

                $college = Colleges_model::find($request->input('id'));

                if($college->college_name != $request->input('college_name')){
                    //if a college name has been changed

                    //after it being changed need to make sure it is unique
                  $this->validate($request,['college_name' => 'required|string|min:3|max:255|unique:colleges']);

                    $college->college_name = $request->input('college_name');

                }

            if($college->college_description != $request->input('college_description')){
                    //if the description has been changed

                    $this->validate($request,['college_description' => 'nullable|string|min:3|max:255']);

                    if($request->input('college_description') === "<p></p>"){

                      $college_description = "<p> No Description Listed </p>";

                    }elseif($request->input('college_description') == "" || $request->input('college_description') == NULL ){

                      $college_description = "<p> No Description Listed </p>";

                    }else{

                      $college_description = $request->input('college_description');
                    }

                    $college->college_description = $college_description;
                }            

            //then saving/updating the data
            $college->save();

            $message = 'COLLEGE "'.$college->college_name.'" HAS BEEN EDITED SUCCESSFULLY';

            //after saving, redirect to view all colleges page
            return redirect('all_colleges')->with('success', $message);

        }

        //FUNCTION TO DELETE / inactivate COLLEGE
   public function delete_college($security,$college_id){

       //if(Auth::user()->position == "admin")
       if($security != md5('security') || Auth::user()->position != "super_admin"){

           return redirect()->back()->with('no_access', 'ACCESS DENIED');
       }

   $college = Colleges_model::find($college_id);

   $college->status = "inactive";

   $college->save();

   $message = 'COLLEGE "'.$college->college_name.'" HAS BEEN IN-ACTIVATED';

       return redirect('all_colleges')->with('warning', $message);

   }

   //FUNCTION TO REACTIVATE COLLEGE
   public function reactivate_college($security,$college_id){

       if($security != md5('security') || Auth::user()->position != "super_admin"){

           return redirect()->back()->with('no_access', 'ACCESS DENIED');
       }

   $college = Colleges_model::find($college_id);

   $college->status = "active";

   $college->save();

   $message = 'COLLEGE "'.$college->college_name.'" HAS BEEN RE-ACTIVATED';

       return redirect('all_colleges')->with('success', $message);

   }

}
