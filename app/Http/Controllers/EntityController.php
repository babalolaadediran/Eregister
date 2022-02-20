<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;
use View;
use Session;
use Redirect;
use Validator;
use App\Country;
use App\Registrar;
use App\Occupation;
use App\Administrator;

class EntityController extends Controller
{
    # get all countries
    public function getAllCountries(){

        # all countries
        $countries = Country::all();

        if(count($countries)){

            echo '<option value="">--Select Country--</option>';

            foreach($countries as $country){

                echo '<option value="'.$country->id.'">'.$country->country.'</option>';
            }
        }else{

            echo '<option value="">--Select Country--</option>';
        }
    }

    # get all occupations
    public function getAllOccupations(){

        # all countries
        $occupations = Occupation::orderBy('occupation', 'ASC')->get();

        if(count($occupations)){

            echo '<option value="">--Select Occupation--</option>';

            foreach($occupations as $occupation){

                echo '<option value="'.$occupation->occupation.'">'.$occupation->occupation.'</option>';
            }
        }else{

            echo '<option value="">--Select Occupation--</option>';
        }
    }

    # login
    public function login(Request $request){

        $rules = [
            'phone' => 'required',
            'password' => 'required'
        ];

        # validator 
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            # collect data
            $phone = $request->phone;
            $password = $request->password;            

            # check if admin exists
            $validateAdmin = Administrator::where('phone', $phone)->first();

            if(!empty($validateAdmin)){

                # get validated admin password
                $adminPassword = $validateAdmin->password;

                # verify password match
                $verify = Hash::check($password, $adminPassword);

                if(!$verify){

                    $error = Session::flash('error', 'Invalid login credentials.');
                    return redirect()->back()->withInput()->with($error);
                }else{

                    # goto dashboard
                    $adminSession = Session::put('administrator', $phone);
                    return redirect()->to('administrator/home')->with($adminSession);
                }
            }else{

                # check if registrar exists
                $validateRegistrar = Registrar::where('phone', $phone)->first();

                if(!$validateRegistrar){
                    $error = Session::flash('error', 'Credentials supplied do not match any record.');
                    return redirect()->back()->withInput()->with($error);
                }else{

                    # get validated registrar password
                    $registrarPassword = $validateRegistrar->password;

                    # verify pasword match
                    $authenticate = Hash::check($password, $registrarPassword);

                    if(!$authenticate){
                        $error = Session::flash('error', 'Invalid login credentials.');
                        return redirect()->back()->withInput()->with($error);
                    }else{
                        # goto dashboard
                        $registrarSession = Session::put('registrar', $phone);
                        return redirect()->to('registrar/home')->with($registrarSession);
                    }
                }
            }
        }
    }
}