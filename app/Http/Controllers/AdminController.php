<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use PDF;
use View;
use Carbon;
use Session;
use Redirect;
use Response;
use App\Country;
use App\Registrar;
use App\Immigrant;
use App\Administrator;

class AdminController extends Controller
{

    # admin login
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

            if(!$validateAdmin){
                
                $error = Session::flash('error', 'Credentials supplied do not match any record.');
                return redirect()->back()->withInput()->with($error);
            }else{

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
            }
        }
    }

    # admin dashboard
    public function home(Request $request){
        
        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                # admin data
                $admin = Administrator::where('phone', $loggedInAdmin)->first();

                # female immigrants count
                $femaleImmigrantCount = Immigrant::where('gender', 'female')->count();

                # male immigrants count
                $maleImmigrantCount = Immigrant::where('gender', 'male')->count();

                # total registrars
                $total_registrar = Registrar::count();

                # total countries
                $countries = Immigrant::distinct('country_id')->select('country_id')->count();

                # ages array
                $first_level = [];
                $second_level = [];
                $third_level = [];

                # current year
                $year = date('Y');

                # get all immigrants
                $all_immigrants = Immigrant::select('dob')->orderBy('dob', 'DESC')->get();

                foreach($all_immigrants as $immigrant){

                    # format year of birth
                    $birth_year = \Carbon\Carbon::parse($immigrant->dob)->format('Y');

                    # computed year
                    $total = (int)($year - $birth_year);

                    if($total <= 18){
                        array_push($first_level, $birth_year);
                    }elseif(($total > 18) && ($total < 40)){
                        array_push($second_level, $birth_year);
                    }else{
                        array_push($third_level, $birth_year);
                    }
                }

                return view::make('administrator/index')->with([
                    'admin' => $admin,
                    'female_immigrant' => $femaleImmigrantCount,
                    'male_immigrant' => $maleImmigrantCount,
                    'registrar_count' => $total_registrar,
                    'countries' => $countries,
                    'teens' => $first_level,
                    'youths' => $second_level,
                    'adults' => $third_level
                ]);
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # admin profile
    public function profile(Request $request){

        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                # admin data
                $admin = Administrator::where('phone', $loggedInAdmin)->first();

                return view::make('administrator/profile')->with([
                    'admin' => $admin,
                ]);
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # update profile
    public function updateProfile(Request $request){

        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                $rules = [
                    'fullname' => 'required',
                    'email' => 'required',
                    'phone' => 'required'
                ];

                # validator
                $validator = Validator::make($request->all(), $rules);

                if($validator->fails()){
                    return redirect()->back()->withErrors($validator);
                }else{

                    # validate admin
                    $validateAdministrator = Administrator::where('phone', $loggedInAdmin)->first();

                    if(!$validateAdministrator){
                        $error = Session::flash('error', 'Sorry, profile update could not be completed.');
                        return redirect()->back()->with($error);
                    }else{

                        # collect data
                        $fullname = $request->fullname;
                        $email = $request->email;
                        $phone = $request->phone;

                        try{

                            # update profile
                            $updateProfile = Administrator::find($validateAdministrator->id)->update([
                                'fullname' => $fullname,
                                'email' => $email,
                                'phone' => $phone
                            ]);

                            $success = Session::flash('success', 'Profile updated successfully.');
                            return redirect()->to('administrator/profile')->with($success);
                        }catch(\Exception $ex){
                            $error = Session::flash('error', 'Sorry, profile update could not be completed.'.$ex->getMessage());
                            return redirect()->back()->with($error);
                        }
                    }
                }               
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # update password
    public function updatePassword(Request $request){
        
        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                $rules = [
                    'old_password' => 'required',
                    'new_password' => 'required'
                ];

                # validator
                $validator = Validator::make($request->all(), $rules);

                if($validator->fails()){
                    return redirect()->back()->withErrors($validator);
                }else{

                    # validate admin
                    $validateAdministrator = Administrator::where('phone', $loggedInAdmin)->first();

                    if(!$validateAdministrator){
                        $error = Session::flash('error', 'Sorry, you are not authorized.');
                        return redirect()->back()->with($error);
                    }else{

                        # collect data
                        $old_password = $request->old_password;
                        $new_password = $request->new_password;

                        try{

                            # compar passwords
                            $previousPassword = $validateAdministrator->password;
                            $checkPassword = Hash::check($old_password, $previousPassword);

                            if(!$checkPassword){
                                $error = Session::flash('error', 'Invalid old password supplied.');
                                return redirect()->back()->with($error);
                            }else{

                                # hash new password
                                $password = Hash::make($new_password);

                                # update profile
                                $updateProfile = Administrator::find($validateAdministrator->id)->update([
                                    'password' => $password
                                ]);
    
                                $success = Session::flash('success', 'Password updated successfully.');
                                return redirect()->to('administrator/profile')->with($success);
                            }
                        }catch(\Exception $ex){
                            $error = Session::flash('error', 'Sorry, password update could not be completed.'.$ex->getMessage());
                            return redirect()->back()->with($error);
                        }
                    }
                }               
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # register new registrar
    public function newRegistrarPage(Request $request){

        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                # admin data
                $admin = Administrator::where('phone', $loggedInAdmin)->first();

                # registrars
                $registrars = Registrar::orderBy('created_at', 'DESC')->get();

                return view::make('administrator/registrars')->with([
                    'admin' => $admin,
                    'registrars' => $registrars
                ]);
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # register new registrar
    public function newRegistrar(Request $request){

        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                $rules = [
                    'fullname' => 'required',
                    'gender' => 'required',
                    'phone' => 'required'  
                ];

                # validator
                $validator = Validator::make($request->all(), $rules);

                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput();
                }else{

                    # collect data
                    $fullname = $request->fullname;
                    $gender = $request->gender;
                    $phone = $request->phone;
                    $password  = Hash::make(123456);

                    // validate registrar
                    $validateRegistrarPhone = Registrar::where('phone', $phone)->first();

                    if($validateRegistrarPhone){
                        $error = Session::flash('error', 'A registrar with this phone number is already registered.');
                        return redirect()->back()->withInput()->with($error);
                    }else{

                        # validate registrar full details
                        $validateRegistrarData = Registrar::where('fullname', $fullname)->where('phone', $phone)->first();

                        if($validateRegistrarData){
                            $error = Session::flash('error', 'A registrar with the data provided is already registered.');
                            return redirect()->back()->withInput()->with($error);
                        }else{

                            try{
                                
                                # create new registrar account
                                $registrar = Registrar::create([
                                    'fullname' => $fullname,
                                    'gender' => $gender,
                                    'phone' => $phone,
                                    'password' => $password
                                ]);

                                $success = Session::flash('success', 'Registration successful.');
                                return redirect()->to('administrator/registrars')->with($success);
                            }catch(\Exception $ex){
                                $error = Session::flash('error', 'Sorry, registrar could not be registered.'.$ex->getMessage());
                                return redirect()->back()->withInput()->with($error);
                            }
                        }
                    }
                }
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # edit registrar page
    public function editRegistrar(Request $request, $id){
        
        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                # admin data
                $admin = Administrator::where('phone', $loggedInAdmin)->first();

                # registrar id
                $registrar_id = $request->id;

                # validate registrar
                $validateRegistrar = Registrar::findOrFail($registrar_id);

                # registrars
                $registrars = Registrar::orderBy('created_at', 'DESC')->get();

                return view::make('administrator/registrars')->with([
                    'admin' => $admin,
                    'edit' => $validateRegistrar,
                    'registrars' => $registrars
                ]);
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # update registrar
    public function updateRegistrar(Request $request, $id){
        
        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                $rules = [
                    'fullname' => 'required',
                    'gender' => 'required',
                    'phone' => 'required'  
                ];

                # validator
                $validator = Validator::make($request->all(), $rules);

                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput();
                }else{

                    # collect data
                    $fullname = $request->fullname;
                    $gender = $request->gender;
                    $phone = $request->phone;
                    $registrar_id = $request->id;                    

                    // validate registrar
                    $validateRegistrarPhone = Registrar::where('phone', $phone)->first();

                    if($validateRegistrarPhone && $validateRegistrarPhone->id != $registrar_id){
                        $error = Session::flash('error', 'A registrar with this phone number is already registered.');
                        return redirect()->back()->with($error);
                    }else{

                        # validate registrar full details
                        $validateRegistrarData = Registrar::where('fullname', $fullname)->where('phone', $phone)->first();

                        if($validateRegistrarData && $validateRegistrarData->id != $registrar_id){
                            $error = Session::flash('error', 'A registrar with the data provided is already registered.');
                            return redirect()->back()->with($error);
                        }else{

                            try{
                                
                                # update registrar account
                                $registrar = Registrar::find($registrar_id)->update([
                                    'fullname' => $fullname,
                                    'gender' => $gender,
                                    'phone' => $phone
                                ]);

                                $success = Session::flash('success', 'Registrar record updated successfully.');
                                return redirect()->to('administrator/registrars')->with($success);
                            }catch(\Exception $ex){
                                $error = Session::flash('error', 'Sorry, registrar record could not be updated.');
                                return redirect()->back()->with($error);
                            }
                        }
                    }
                }
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # delete registrar
    public function deleteRegistrar(Request $request){

        if($request->ajax()){

            // registrar id
            $registrar_id = $request->id;

            // validate registrar
            $validateRegistrar = Registrar::find($registrar_id);

            if($validateRegistrar){

                try{

                    # delete account
                    $deleteRegistrar = $validateRegistrar->delete();

                    $success = 'Registrar deleted successfully.';
                    return response()->json(['status' => 200, 'message' => $success]);
                }catch(\Exception $ex){
                    $error = 'Sorry, registrar could not be deleted. Try again.';
                    return response()->json(['status' => 203, 'message' => $error]);
                }
            }else{
                $error = 'Sorry, registrar could not be validated.';
                return response()->json(['status' => 404, 'message' => $error]);
            }
        }
    }

    # new immigrant page
    public function newImmigrantPage(Request $request){

        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                # admin
                $admin = Administrator::where('phone', $loggedInAdmin)->first();

                return view::make('administrator/immigrant')->with([
                    'admin' => $admin
                ]);
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # register new immigrant
    public function newImmigrant(Request $request){

        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                $rules = [
                    'surname' => 'required',
                    'firstname' => 'required',
                    'country' => 'required',
                    'gender' => 'required',
                    'dob' => 'required',
                    'occupation' => 'required',
                    'phone' => 'required',
                    'identification' => 'required',
                    'address' => 'required',
                    'status' => 'required'
                ];

                # validator
                $validator = Validator::make($request->all(), $rules);

                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput();
                }else{

                    # collect data
                    $surname = $request->surname;
                    $firstname = $request->firstname;
                    $country = $request->country;
                    $gender = $request->gender;
                    $dob = $request->dob;
                    $occupation = $request->occupation;
                    $phone = $request->phone;
                    $identification = $request->identification;
                    $address = $request->address;
                    $status = $request->status;

                    # validate immigrant
                    $validateImmigrantPhone = Immigrant::where('phone_no', $phone)->first();

                    if($validateImmigrantPhone){
                        $error = Session::flash('error', 'A migrant with this phone is already registered.');
                        return redirect()->back()->withInput()->with($error);
                    }else{

                        # validate immigrant
                        $validateImmigrantData = Immigrant::where('surname', $surname)->where('firstname', $firstname)->where('country_id', $country)->where('gender', $gender)->where('dob', $dob)->where('address', $address)->where('status', $status)->first();

                        if($validateImmigrantData){
                            $error = Session::flash('error', 'A migrant with the provided information has already been registered.');
                            return redirect()->back()->withInput()->with($error);
                        }else{

                            try{

                                # register immigrant
                                $immigrant = Immigrant::create([
                                    'surname' => $surname,
                                    'firstname' => $firstname,
                                    'country_id' => $country,
                                    'gender' => $gender,
                                    'dob' => $dob,
                                    'occupation' => $occupation,
                                    'phone_no' => $phone,
                                    'identification' => $identification,
                                    'address' => $address,
                                    'status' => $status,
                                    'registered_by' => 'Administrator'
                                ]);
                                
                                $success = Session::flash('success', 'Migrant registered successfully.');
                                return redirect()->to('administrator/register/immigrant')->with($success);
                            }catch(\Exception $ex){
                                $error = Session::flash('error', 'Sorry, migrant registration could not be completed. Try again.');
                                return redirect()->back()->withInput()->with($error);
                            }
                        }
                    }
                }
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # manage immigrant
    public function manageImmigrantsPage(Request $request){

        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                # admin
                $admin = Administrator::where('phone', $loggedInAdmin)->first();

                # immigrants
                $immigrants = Immigrant::select('immigrants.id', 'immigrants.surname', 'immigrants.firstname', 'immigrants.dob', 'immigrants.phone_no', 'immigrants.occupation', 'immigrants.identification', 'immigrants.address', 'immigrants.gender', 'immigrants.status', 'immigrants.registered_by', 'countries.country')->leftJoin('countries', 'countries.id', '=', 'immigrants.country_id')->orderBy('immigrants.created_at', 'DESC')->get();

                return view::make('administrator/manage_immigrants')->with([
                    'admin' => $admin,
                    'immigrants' => $immigrants
                ]);
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # edit immigrant
    public function editImmigrant(Request $request, $id){
        
        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                # admin
                $admin = Administrator::where('phone', $loggedInAdmin)->first();

                # immigrant id
                $immigrant_id = $request->id;

                # validate immigrant
                $validateImmigrant = Immigrant::findOrFail($immigrant_id);

                return view::make('administrator/immigrant')->with([
                    'admin' => $admin,
                    'edit' => $validateImmigrant
                ]);
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # update immigrant
    public function updateImmigrant(Request $request, $id){

        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                $rules = [
                    'surname' => 'required',
                    'firstname' => 'required',
                    'country' => 'required',
                    'gender' => 'required',
                    'dob' => 'required',
                    'occupation' => 'required',
                    'phone' => 'required',
                    'identification' => 'required',
                    'address' => 'required',
                    'status' => 'required'
                ];

                # validator
                $validator = Validator::make($request->all(), $rules);

                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput();
                }else{

                    # collect data
                    $surname = $request->surname;
                    $firstname = $request->firstname;
                    $country = $request->country;
                    $gender = $request->gender;
                    $dob = $request->dob;
                    $occupation = $request->occupation;
                    $phone = $request->phone;
                    $identification = $request->identification;
                    $address = $request->address;
                    $status = $request->status;
                    $immigrant_id = $request->id;

                    # validate immigrant
                    $validateImmigrantPhone = Immigrant::where('phone_no', $phone)->first();

                    if($validateImmigrantPhone && $validateImmigrantPhone->id != $immigrant_id){
                        $error = Session::flash('error', 'A migrant with this phone is already registered.');
                        return redirect()->back()->withInput()->with($error);
                    }else{

                        # validate immigrant
                        $validateImmigrantData = Immigrant::where('surname', $surname)->where('firstname', $firstname)->where('country_id', $country)->where('gender', $gender)->where('dob', $dob)->where('address', $address)->where('status', $status)->first();

                        if($validateImmigrantData && $validateImmigrantData->id != $immigrant_id){
                            $error = Session::flash('error', 'A migrant with the provided information has already been registered.');
                            return redirect()->back()->withInput()->with($error);
                        }else{

                            try{

                                # register immigrant
                                $immigrant = Immigrant::find($immigrant_id)->update([
                                    'surname' => $surname,
                                    'firstname' => $firstname,
                                    'country_id' => $country,
                                    'gender' => $gender,
                                    'dob' => $dob,
                                    'occupation' => $occupation,
                                    'phone_no' => $phone,
                                    'identification' => $identification,
                                    'address' => $address,
                                    'status' => $status
                                ]);
                                
                                $success = Session::flash('success', 'Migrant record update successfully.');
                                return redirect()->to('administrator/immigrants')->with($success);
                            }catch(\Exception $ex){
                                $error  = Session::flash('error', 'Sorry, migrant record update could not be completed. Try again.');
                                return redirect()->back()->withInput()->with($error);
                            }
                        }
                    }
                }
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # delete immigrant
    public function deleteImmigrant(Request $request){

        if($request->ajax()){

            // immigrant id
            $immigrant_id = $request->id;

            // validate immigrant
            $validateImmigrantData = Immigrant::find($immigrant_id);

            if($validateImmigrantData){

                try{

                    # delete account
                    $deleteImmigrant = $validateImmigrantData->delete();

                    $success = 'Migrant deleted successfully.';
                    return response()->json(['status' => 200, 'message' => $success]);
                }catch(\Exception $ex){
                    $error = 'Sorry, migrant could not be deleted. Try again.';
                    return response()->json(['status' => 203, 'message' => $error]);
                }
            }else{
                $error = 'Sorry, migrant could not be validated.';
                return response()->json(['status' => 404, 'message' => $error]);
            }
        }
    }

    # country report
    public function countryReport(Request $request){

        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                # admin data
                $admin = Administrator::where('phone', $loggedInAdmin)->first();

                # get country list
                $country_list = Immigrant::select('countries.id', 'countries.country')->leftJoin('countries', 'countries.id', 'immigrants.country_id')->get();
                
                # total countries
                $countries = Immigrant::distinct('country_id')->select('country_id')->count();

                return view::make('administrator/country_report')->with([
                    'admin' => $admin,                
                    'countries' => $countries,
                    'country_list' => $country_list
                ]);
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # print general country report
    public function printGeneralCountryReport(Request $request){
       
        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                # admin data
                $admin = Administrator::where('phone', $loggedInAdmin)->first();

                # get country list
                $country_list = Immigrant::select('countries.id', 'countries.country', 'immigrants.created_at')->leftJoin('countries', 'countries.id', 'immigrants.country_id')->orderBy('immigrants.created_at', 'DESC')->get();
            
                # array
                $countryArray = [];                        

                # gather registered immigrants by country within selected frame
                foreach($country_list as $country){

                    # check if country id in array
                    if(in_array($country->id, $countryArray)){
                        continue;
                    }else{
                        # store country id
                        array_push($countryArray, $country->id);
                    }
                }
                
                # check data in country array before building pdf
                if(count($countryArray) < 1){
                    $error = Session::flash('error', 'Sorry, no record found.');
                    return redirect()->back()->with($error);
                }else{

                    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'san-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'isJavascriptEnabled' => true, 'footerSpacing' => 10, 'isPhpEnabled', true]);

                    # pdf output
                    $output = '
                        <!DOCTYPE html>
                        <html>
                            <head>
                                <meta charset="utf-8">
                                <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
                                <title>Report</title>
                                <style>
                                    table {
                                        // font-family: arial, sans-serif;
                                        border-collapse: collapse;
                                        width: 100%;
                                    }

                                    td, th {
                                        border: 1px solid #dddddd;
                                        text-align: left;
                                        padding: 8px;
                                    }
                                        
                                    // tr:nth-child(even) {
                                    //     background-color: #dddddd;
                                    // }
                                    .page-break {
                                        page-break-after: always;
                                    }
                                    @page {
                                        margin: 50px 50px;
                                    }
                                    @media print {
                                        .export-table {
                                            overflow: visible !important;
                                        }
                                    }
                                </style>
                            </head>
                            <body>';
                                $output.= '
                                <div>                                
                                    <div style="float:left; margin-left: 5px;">
                                        <img src="'.public_path('nis-logo.png').'" style="height: 70px; width: 70px; margin-bottom: 0px; margin-top: 20px; float:left;" alt="Immigration Logo">
                                    </div>
                                    <center>
                                        <h4>MIGRANT e-REGISTRATION DAILY REPORT SHEET</h4>
                                        <h4 style="line-height: 10px;">OGUN STATE COMMAND</h4>                
                                    </center>
                                </div>';
                                $output.= '<table class="table table-condensed table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="border-bottom: 0;"></th>
                                            <th style="border-bottom: 0;"></th>
                                            <th style="border-bottom: 0; text-align: center;">NUMBER</th>
                                            <th colspan="2" style="text-align: center;">STATUS</th>
                                            <th colspan="2" style="text-align: center;">SEX</th>
                                            <th style="border-bottom: 0;"></th>
                                        </tr>
                                        <tr>
                                            <th style="border-top: 0;">S/N</th>
                                            <th style="border-top: 0; text-align: center;">COUNTRY</th>
                                            <th style="border-top: 0; text-align: center;">REGISTERED</th>
                                            <th>R</th>
                                            <th>IR</th>
                                            <th>M</th>
                                            <th>F</th>
                                            <th style="border-top: 0; text-align: center;">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                                        # serial number
                                        $sn = 1;

                                        foreach($countryArray as $countryData) {

                                            # get country name
                                            $country_name = Country::where('id', $countryData)->first();

                                            # registered number
                                            $registered_number = Immigrant::where('country_id', $countryData)->count();
                                            
                                            # regular
                                            $regular = Immigrant::where('country_id', $countryData)->where('status', 'Regular')->count();

                                            # irregular
                                            $irregular = Immigrant::where('country_id', $countryData)->where('status', 'Irregular')->count();

                                            # male 
                                            $male = Immigrant::where('country_id', $countryData)->where('gender', 'Male')->count();

                                            # female
                                            $female = Immigrant::where('country_id', $countryData)->where('gender', 'Female')->count();

                                            # total
                                            $total = Immigrant::where('country_id', $countryData)->count();

                                            # total male
                                            $total_male = Immigrant::where('gender', 'Male')->count();

                                            # total female 
                                            $total_female = Immigrant::where('gender', 'Female')->count();

                                            # total regular
                                            $total_regular = Immigrant::where('status', 'Regular')->count();

                                            # total regular
                                            $total_irregular = Immigrant::where('status', 'Irregular')->count();

                                            # overall total
                                            $overall_total = Immigrant::count();

                                            # output
                                            $output.= '<tr>';
                                                $output.= '<td>'.$sn++.'.</td>';
                                                $output.= '<td>'.$country_name->country.'</td>';
                                                $output.= '<td>'.number_format($registered_number).'</td>';
                                                $output.= '<td>'.number_format($regular).'</td>';
                                                $output.= '<td>'.number_format($irregular).'</td>';
                                                $output.= '<td>'.number_format($male).'</td>';
                                                $output.= '<td>'.number_format($female).'</td>';
                                                $output.= '<td>'.number_format($total).'</td>';
                                            $output.= '</tr>';                                                              
                                        }
                                    $output.= '</tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"><strong>SUMMATION</strong></td>
                                            <td>'.number_format($overall_total).'</td>                                         
                                            <td>'.number_format($total_regular).'</td>
                                            <td>'.number_format($total_irregular).'</td>
                                            <td>'.number_format($total_male).'</td>
                                            <td>'.number_format($total_female).'</td>
                                            <td>'.number_format($overall_total).'</td>                                            
                                        </tr>
                                    </tfoot>
                                </table>
                                <p><b>Total Regular</b>: '.number_format($total_regular).'</p>
                                <p><b>Total Irregular</b>: '.number_format($total_irregular).'</p>
                                <p><b>Total Male</b>: '.number_format($total_male).'</p>
                                <p><b>Total Female</b>: '.number_format($total_female).'</p>        
                            </body>
                        </html>
                    ';
                    
                    # initate pdf display
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->LoadHTML($output)->setPaper('a4', 'portrait');
                    return $pdf->stream();
                }            
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # print report page
    public function printReportPage(Request $request){

        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                # admin data
                $admin = Administrator::where('phone', $loggedInAdmin)->first();

                # array
                $datesArray = [];

                # dates
                $dates = Immigrant::distinct('created_at')->select('created_at')->orderBy('created_at', 'DESC')->get();

                foreach($dates as $date){

                    # split date
                    $split_date = explode(' ', $date->created_at);

                    # new date
                    $new_date = $split_date[0];

                    # format date
                    $format_date = \Carbon\Carbon::parse($new_date)->format('d M Y');
                    
                    # check if date is in array
                    if(in_array($format_date, $datesArray)){
                        continue;
                    }else{
                        # store date in array                                                
                        array_push($datesArray, $format_date);
                    }
                }
                
                return view::make('administrator/print_report')->with([
                    'admin' => $admin,                
                    'dates' => $datesArray
                ]);
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }
    }

    # print report
    public function initiatePrinting(Request $request){

        try{

            # logged in admin session
            $loggedInAdmin = $request->session()->get('administrator');

            if(!empty($loggedInAdmin)){

                # admin data
                $admin = Administrator::where('phone', $loggedInAdmin)->first();

                $rules = [
                    'from' => 'required'
                ];

                # form validator
                $validator = Validator::make($request->all(), $rules);

                if($validator->fails()){
                    return redirect()->back()->withInput()->withErrors($validator);
                }else{

                    # collect data
                    $start_date = $request->from;
                    $end_date = $request->to;
                    
                    # check if end date is supplied
                    if(empty($end_date)){

                        # get country list
                        $country_list = Immigrant::select('immigrants.id as immigrant_id', 'countries.id', 'countries.country', 'immigrants.created_at')->leftJoin('countries', 'countries.id', 'immigrants.country_id')->orderBy('immigrants.created_at', 'DESC')->get();

                        # arrays
                        $countryArray = [];
                        $personsArray = [];

                        # gather registered immigrants by country within selected frame
                        foreach($country_list as $country){

                            # split date
                            $split_date = explode(' ', $country->created_at);

                            # new date
                            $new_date = $split_date[0];

                            # format date
                            $format_date = \Carbon\Carbon::parse($new_date)->format('d M Y');

                            # compare date
                            if(strtotime($start_date) === strtotime($format_date)){

                                # check if country id in array
                                if(in_array($country->id, $countryArray)){
                                    if(in_array($country->immigrant_id, $personsArray)){
                                        continue;
                                    }else{
                                        # store person id
                                        array_push($personsArray, $country->immigrant_id);
                                    }
                                }else{
                                    # store country id
                                    array_push($countryArray, $country->id);

                                    # store person id
                                    array_push($personsArray, $country->immigrant_id);
                                }
                            }else{
                                continue;
                            }
                        }
                        
                        # check data in country array before building pdf
                        if(count($countryArray) < 1){
                            $error = Session::flash('error', 'Sorry, the selected date does not have any record.');
                            return redirect()->back()->with($error);
                        }else{

                            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'san-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'isJavascriptEnabled' => true, 'footerSpacing' => 10, 'isPhpEnabled', true]);

                            # pdf output
                            $output = '
                                <!DOCTYPE html>
                                <html>
                                    <head>
                                        <meta charset="utf-8">
                                        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0"> 
                                        <title>Report</title>
                                        <style>
                                            table {
                                                // font-family: arial, sans-serif;
                                                border-collapse: collapse;
                                                width: 100%;
                                            }
    
                                            td, th {
                                                border: 1px solid #dddddd;
                                                text-align: left;
                                                padding: 8px;
                                            }
                                                
                                            // tr:nth-child(even) {
                                            //     background-color: #dddddd;
                                            // }
                                            .page-break {
                                                page-break-after: always;
                                            }
                                            @page {
                                                margin: 50px 50px;
                                            }
                                            @media print {
                                                .export-table {
                                                    overflow: visible !important;
                                                }
                                            }
                                        </style>
                                    </head>
                                    <body>';
                                        $output.= '
                                            <div>                                
                                                <div style="float:left; margin-left: 5px;">
                                                    <img src="'.public_path('nis-logo.png').'" style="height: 70px; width: 70px; margin-bottom: 0px; margin-top: 20px; float:left;" alt="Immigration Logo">
                                                </div>
                                                <center>
                                                    <h4>MIGRANT e-REGISTRATION DAILY REPORT SHEET</h4>
                                                    <h4 style="line-height: 10px;">OGUN STATE COMMAND</h4>                
                                                </center>
                                            </div>
                                        ';
                                        if(empty($end_date)){
                                            $output.= '<p><strong>DATE</strong>: '.$start_date.'</p>';
                                        }else{
                                            $output.= '<p><strong>DATE</strong>: '.$start_date.' <b>TO</b> '.$end_date.'</p>';
                                        }
                                        $output.= '<table class="table table-condensed table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="border-bottom: 0;"></th>
                                                    <th style="border-bottom: 0;"></th>
                                                    <th style="border-bottom: 0; text-align: center;">NUMBER</th>
                                                    <th colspan="2" style="text-align: center;">STATUS</th>
                                                    <th colspan="2" style="text-align: center;">SEX</th>
                                                    <th style="border-bottom: 0;"></th>
                                                </tr>
                                                <tr>
                                                    <th style="border-top: 0;">S/N</th>
                                                    <th style="border-top: 0; text-align: center;">COUNTRY</th>
                                                    <th style="border-top: 0; text-align: center;">REGISTERED</th>
                                                    <th>R</th>
                                                    <th>IR</th>
                                                    <th>M</th>
                                                    <th>F</th>
                                                    <th style="border-top: 0; text-align: center;">TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
    
                                                # serial number
                                                $sn = 1;
    
                                                foreach($countryArray as $countryData) {
    
                                                    # get country name
                                                    $country_name = Country::where('id', $countryData)->first();
    
                                                    # registered number
                                                    $registered_number = Immigrant::where('country_id', $countryData)->whereIn('id', $personsArray)->count();
                                                    
                                                    # regular
                                                    $regular = Immigrant::where('country_id', $countryData)->where('status', 'Regular')->whereIn('id', $personsArray)->count();
    
                                                    # irregular
                                                    $irregular = Immigrant::where('country_id', $countryData)->where('status', 'Irregular')->whereIn('id', $personsArray)->count();
    
                                                    # male 
                                                    $male = Immigrant::where('country_id', $countryData)->where('gender', 'Male')->whereIn('id', $personsArray)->count();
    
                                                    # female
                                                    $female = Immigrant::where('country_id', $countryData)->where('gender', 'Female')->whereIn('id', $personsArray)->count();
    
                                                    # total
                                                    $total = Immigrant::where('country_id', $countryData)->whereIn('id', $personsArray)->count();

                                                    # total male
                                                    $total_male = Immigrant::where('gender', 'Male')->whereIn('country_id', $countryArray)->whereIn('id', $personsArray)->count();

                                                    # total female 
                                                    $total_female = Immigrant::where('gender', 'Female')->whereIn('country_id', $countryArray)->whereIn('id', $personsArray)->count();

                                                    # total regular
                                                    $total_regular = Immigrant::where('status', 'Regular')->whereIn('country_id', $countryArray)->whereIn('id', $personsArray)->count();

                                                    # total regular
                                                    $total_irregular = Immigrant::where('status', 'Irregular')->whereIn('country_id', $countryArray)->whereIn('id', $personsArray)->count();

                                                    # overall total
                                                    $overall_total = Immigrant::whereIn('country_id', $countryArray)->whereIn('id', $personsArray)->count();
    
                                                    # output
                                                    $output.= '<tr>';
                                                        $output.= '<td>'.$sn++.'.</td>';
                                                        $output.= '<td>'.$country_name->country.'</td>';
                                                        $output.= '<td>'.number_format($registered_number).'</td>';
                                                        $output.= '<td>'.number_format($regular).'</td>';
                                                        $output.= '<td>'.number_format($irregular).'</td>';
                                                        $output.= '<td>'.number_format($male).'</td>';
                                                        $output.= '<td>'.number_format($female).'</td>';
                                                        $output.= '<td>'.number_format($total).'</td>';
                                                    $output.= '</tr>';                                                              
                                                }
                                            $output.= '</tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2"><strong>SUMMATION</strong></td>
                                                    <td>'.number_format($overall_total).'</td>                                         
                                                    <td>'.number_format($total_regular).'</td>
                                                    <td>'.number_format($total_irregular).'</td>
                                                    <td>'.number_format($total_male).'</td>
                                                    <td>'.number_format($total_female).'</td>
                                                    <td>'.number_format($overall_total).'</td>                                            
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <p><b>Total Regular</b>: '.number_format($total_regular).'</p>
                                        <p><b>Total Irregular</b>: '.number_format($total_irregular).'</p>
                                        <p><b>Total Male</b>: '.number_format($total_male).'</p>
                                        <p><b>Total Female</b>: '.number_format($total_female).'</p>        
                                    </body>
                                </html>
                            ';
                            
                            # initate pdf display
                            $pdf = \App::make('dompdf.wrapper');
                            $pdf->LoadHTML($output)->setPaper('a4', 'portrait');
                            return $pdf->stream();
                        }
                    }else{

                        $rules = [
                            'to' => 'required'
                        ];
        
                        # form validator
                        $validator = Validator::make($request->all(), $rules);
        
                        if($validator->fails()){
                            return redirect()->back()->withInput()->withErrors($validator);
                        }else{
                            
                            # check selected dates
                            if(strtotime($start_date) > strtotime($end_date)){
                                $error = Session::flash('error', 'Sorry, beginnig date can not be greater than end date.');
                                return redirect()->back()->with($error);
                            }else{
    
                                # get country list
                                $country_list = Immigrant::select('immigrants.id as immigrant_id', 'countries.id', 'countries.country', 'immigrants.created_at')->leftJoin('countries', 'countries.id', 'immigrants.country_id')->orderBy('immigrants.created_at', 'DESC')->get();
        
                                # array
                                $countryArray = [];
                                $personsArray = [];                        
        
                                # gather registered immigrants by country within selected frame
                                foreach($country_list as $country){
        
                                    # split date
                                    $split_date = explode(' ', $country->created_at);
        
                                    # new date
                                    $new_date = $split_date[0];
        
                                    # format date
                                    $format_date = \Carbon\Carbon::parse($new_date)->format('d M Y');
        
                                    # compare date
                                    if((strtotime($start_date) <= strtotime($format_date)) && (strtotime($end_date) >= strtotime($format_date))){
        
                                        # check if country id in array
                                        if(in_array($country->id, $countryArray)){
                                            if(in_array($country->immigrant_id, $personsArray)){
                                                continue;
                                            }else{
                                                # store person id
                                                array_push($personsArray, $country->immigrant_id);
                                            }
                                        }else{
                                            # store country id
                                            array_push($countryArray, $country->id);

                                            # store person id
                                            array_push($personsArray, $country->immigrant_id);
                                        }
                                    }else{
                                        continue;
                                    }
                                }
                                
                                # check data in country array before building pdf
                                if(count($countryArray) < 1){
                                    $error = Session::flash('error', 'Sorry, the selected date does not have any record.');
                                    return redirect()->back()->with($error);
                                }else{

                                    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'san-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'isJavascriptEnabled' => true, 'footerSpacing' => 10, 'isPhpEnabled', true]);
        
                                    # pdf output
                                    $output = '
                                        <!DOCTYPE html>
                                        <html>
                                            <head>
                                                <meta charset="utf-8">
                                                <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0"> 
                                                <title>Report</title>
                                                <style>
                                                    table {
                                                        // font-family: arial, sans-serif;
                                                        border-collapse: collapse;
                                                        width: 100%;
                                                    }
            
                                                    td, th {
                                                        border: 1px solid #dddddd;
                                                        text-align: left;
                                                        padding: 8px;
                                                    }
                                                        
                                                    // tr:nth-child(even) {
                                                    //     background-color: #dddddd;
                                                    // }
                                                    .page-break {
                                                        page-break-after: always;
                                                    }
                                                    @page {
                                                        margin: 50px 50px;
                                                    }
                                                    @media print {
                                                        .export-table {
                                                            overflow: visible !important;
                                                        }
                                                    }
                                                </style>
                                            </head>
                                            <body>';
                                                $output.= '
                                                    <div>
                                                        <div style="float:left; margin-left: 5px;">
                                                            <img src="'.public_path('nis-logo.png').'" style="height: 70px; width: 70px; margin-bottom: 0px; margin-top: 20px; float:left;" alt="Immigration Logo">
                                                        </div>
                                                        <center>
                                                            <h4>MIGRANT e-REGISTRATION DAILY REPORT SHEET</h4>
                                                            <h4 style="line-height: 10px;">OGUN STATE COMMAND</h4>                
                                                        </center>
                                                    </div>
                                                ';
                                                if(empty($end_date)){
                                                    $output.= '<p><strong>DATE</strong>: '.$start_date.'</p>';
                                                }else{
                                                    $output.= '<p><strong>DATE</strong>: '.$start_date.' <b>TO</b> '.$end_date.'</p>';
                                                }
                                                $output.= '<table class="table table-condensed table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="border-bottom: 0;"></th>
                                                            <th style="border-bottom: 0;"></th>
                                                            <th style="border-bottom: 0; text-align: center;">NUMBER</th>
                                                            <th colspan="2" style="text-align: center;">STATUS</th>
                                                            <th colspan="2" style="text-align: center;">SEX</th>
                                                            <th style="border-bottom: 0;"></th>
                                                        </tr>
                                                        <tr>
                                                            <th style="border-top: 0;">S/N</th>
                                                            <th style="border-top: 0; text-align: center;">COUNTRY</th>
                                                            <th style="border-top: 0; text-align: center;">REGISTERED</th>
                                                            <th>R</th>
                                                            <th>IR</th>
                                                            <th>M</th>
                                                            <th>F</th>
                                                            <th style="border-top: 0; text-align: center;">TOTAL</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';
            
                                                        # serial number
                                                        $sn = 1;
            
                                                        foreach($countryArray as $countryData) {
            
                                                            # get country name
                                                            $country_name = Country::where('id', $countryData)->first();
            
                                                            # registered number
                                                            $registered_number = Immigrant::where('country_id', $countryData)->whereIn('id', $personsArray)->count();
                                                            
                                                            # regular
                                                            $regular = Immigrant::where('country_id', $countryData)->where('status', 'Regular')->whereIn('id', $personsArray)->count();
            
                                                            # irregular
                                                            $irregular = Immigrant::where('country_id', $countryData)->where('status', 'Irregular')->whereIn('id', $personsArray)->count();
            
                                                            # male 
                                                            $male = Immigrant::where('country_id', $countryData)->where('gender', 'Male')->whereIn('id', $personsArray)->count();
            
                                                            # female
                                                            $female = Immigrant::where('country_id', $countryData)->where('gender', 'Female')->whereIn('id', $personsArray)->count();
            
                                                            # total
                                                            $total = Immigrant::where('country_id', $countryData)->whereIn('id', $personsArray)->count();

                                                            # total male
                                                            $total_male = Immigrant::where('gender', 'Male')->whereIn('country_id', $countryArray)->whereIn('id', $personsArray)->count();

                                                            # total female 
                                                            $total_female = Immigrant::where('gender', 'Female')->whereIn('country_id', $countryArray)->whereIn('id', $personsArray)->count();

                                                            # total regular
                                                            $total_regular = Immigrant::where('status', 'Regular')->whereIn('country_id', $countryArray)->whereIn('id', $personsArray)->count();

                                                            # total regular
                                                            $total_irregular = Immigrant::where('status', 'Irregular')->whereIn('country_id', $countryArray)->whereIn('id', $personsArray)->count();

                                                            # overall total
                                                            $overall_total = Immigrant::whereIn('country_id', $countryArray)->whereIn('id', $personsArray)->count();
            
                                                            # output
                                                            $output.= '<tr>';
                                                                $output.= '<td>'.$sn++.'.</td>';
                                                                $output.= '<td>'.$country_name->country.'</td>';
                                                                $output.= '<td>'.number_format($registered_number).'</td>';
                                                                $output.= '<td>'.number_format($regular).'</td>';
                                                                $output.= '<td>'.number_format($irregular).'</td>';
                                                                $output.= '<td>'.number_format($male).'</td>';
                                                                $output.= '<td>'.number_format($female).'</td>';
                                                                $output.= '<td>'.number_format($total).'</td>';
                                                            $output.= '</tr>';                                                              
                                                        }
                                                    $output.= '</tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="2"><strong>SUMMATION</strong></td>
                                                            <td>'.number_format($overall_total).'</td>                                         
                                                            <td>'.number_format($total_regular).'</td>
                                                            <td>'.number_format($total_irregular).'</td>
                                                            <td>'.number_format($total_male).'</td>
                                                            <td>'.number_format($total_female).'</td>
                                                            <td>'.number_format($overall_total).'</td>   
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <p><b>Total Regular</b>: '.number_format($total_regular).'</p>
                                                <p><b>Total Irregular</b>: '.number_format($total_irregular).'</p>
                                                <p><b>Total Male</b>: '.number_format($total_male).'</p>
                                                <p><b>Total Female</b>: '.number_format($total_female).'</p>        
                                            </body>
                                        </html>
                                    ';
                                    
                                    # initate pdf display
                                    $pdf = \App::make('dompdf.wrapper');
                                    $pdf->LoadHTML($output)->setPaper('a4', 'portrait');
                                    return $pdf->stream();
                                }
                            }
                        }
                    }
                }            
            }else{
                return redirect()->to('/');
            }
        }catch(\Exception $ex){
            return redirect()->to('/');
        }        
    }

    # logout
    public function logout(Request $request){
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->to('/');
    }
}
