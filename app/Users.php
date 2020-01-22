<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Users extends Model
{
    //
	 protected $table = "users";

//FUNCTION TO GET MOST RECENT AUTONUMBER AND YEAR FOR TABLE
    public function getMostRecentAutonumber(){

        $most_recent = DB::table($this->table)->latest()->first(); //Users::latest()->keyBy('id');
        $current_date = getdate();
        $return_data = array();

        if($most_recent == NULL){ //when no records i.e. first record

            $return_data['autonumber'] = 1;
            $return_data['year'] = $current_date['year'];
        }else{
            if($most_recent->year == $current_date['year'] ){ //if it is still the same year

                $return_data['autonumber'] = $most_recent->autonumber + 1;
                $return_data['year'] = $current_date['year'];

            }else{ //if the year is different i.e a new year.

                $return_data['autonumber'] = 1;
                $return_data['year'] = $current_date['year'];
            }

        }

        return $return_data;

    }

//FUNCTION TO GET USERS
    public static function get_users($status="active"){

        return $records = DB::table('users')->where('status',$status)->get();

    }
}
