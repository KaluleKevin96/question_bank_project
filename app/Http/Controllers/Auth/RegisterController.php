<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//MODELS
use App\Users;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'contact' => 'required|string|max:10|min:10',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:20|min:6|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
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

        return User::create([
        	'user_number' => $newNo,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'contact' => $data['contact'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'status' => 'active',
            'position' => $position,
            'autonumber'=> $autonumber,
            'year'=> $year,
        ]);
    }
}
