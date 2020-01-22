<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//this controller has helper functions that shall be used throughout the project
class HelpersController extends Controller
{
    //
/*
This function helps check to see if an option from a select drop down matches with an original database value or a value returned from validation error and then sets the matching option as "selected"
*/
    public static function selecting_dropdown_option($old_returned_value , $database_value , $dropdown_option_value){

        if($old_returned_value && $old_returned_value == $dropdown_option_value){

          echo 'selected';

        }elseif( $database_value && $database_value == $dropdown_option_value){

           echo 'selected';

         }else{

            echo '';
          }
  }

  /*
  This function helps to display the corresponding "number word" to a number e.g 1 = first , 3 = third
  */
   public static function number_to_position_word($number){
     if($number == NULL || $number == ''){

       echo "Not Applicable";
       return false;

     }else{
       switch ($number){
         case "1" :

         echo "First";

         break;

         case "2" :

         echo "Second";

         break;

         case "3" :

         echo "Third";

         break;

         case "4" :

         echo "Fourth";

         break;

         case "5" :

         echo "Fifth";

         break;

       }

     }     
   }


} //CLASS FINAL BRACKET
