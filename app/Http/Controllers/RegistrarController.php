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

class RegistrarController extends Controller
{
    # registrar login
    public function login(Request $request){

        $rules = [
            'phone' => 'required',
            'password' => 'required'
        ];

        # validator 
        $validator  = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            # collect data
            $phone = $request->phone;
            $password = $request->password;

            # check if registrar exists
            $validateRegistrar = Registrar::where('phone', $phone)->first();

            if(!$validateRegistrar){
                
                $error = Session::flash('error', 'Credentials supplied do not match any record.');
                return redirect()->back()->withInput()->with($error);
            }else{

                # get validated admin password
                $registrarPassword = $validateRegistrar->password;

                # verify password match
                $verify = Hash::check($password, $registrarPassword);

                if(!$verify){

                    $error = Session::flash('error', 'Invalid login credentials.');
                    return redirect()->back()->withInput()->with($error);
                }else{

                    # goto dashboard
                    $registrarSession = Session::put('registrar', $phone);
                    return redirect()->to('registrar/dashbord')->with($registrarSession);
                }
            }
        }
    }

    # registrar dashboard
    public function home(Request $request){
        
        try{

            # logged in registrar session
            $loggedInRegistrar = $request->session()->get('registrar');

            if(!empty($loggedInRegistrar)){

                # registrar
                $registrar = Registrar::where('phone', $loggedInRegistrar)->first();

                # female immigrants count
                $femaleImmigrantCount = Immigrant::where('gender', 'female')->count();

                # male immigrants count
                $maleImmigrantCount = Immigrant::where('gender', 'male')->count();

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

                return view::make('registrar/index')->with([
                    'registrar' => $registrar,
                    'female_immigrant' => $femaleImmigrantCount,
                    'male_immigrant' => $maleImmigrantCount,
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

            # logged in registrar session
            $loggedInRegistrar = $request->session()->get('registrar');

            if(!empty($loggedInRegistrar)){

                # registrar data
                $registrar = Registrar::where('phone', $loggedInRegistrar)->first();

                return view::make('registrar/profile')->with([
                    'registrar' => $registrar,
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

            # logged in registrar session
            $loggedInRegistrar = $request->session()->get('registrar');

            if(!empty($loggedInRegistrar)){

                $rules = [
                    'fullname' => 'required',
                    'gender' => 'required',
                    'phone' => 'required'
                ];

                # validator
                $validator = Validator::make($request->all(), $rules);

                if($validator->fails()){
                    return redirect()->back()->withErrors($validator);
                }else{

                    # validate registrar
                    $validateRegistrar = Registrar::where('phone', $loggedInRegistrar)->first();

                    if(!$validateRegistrar){
                        $error = Session::flash('error', 'Sorry, profile update could not be completed.');
                        return redirect()->back()->with($error);
                    }else{

                        # collect data
                        $fullname = $request->fullname;
                        $gender = $request->gender;
                        $phone = $request->phone;

                        try{

                            # update profile
                            $updateProfile = Registrar::find($validateRegistrar->id)->update([
                                'fullname' => $fullname,
                                'gender' => $gender,
                                'phone' => $phone
                            ]);

                            $success = Session::flash('success', 'Profile updated successfully.');
                            return redirect()->to('registrar/profile')->with($success);
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

            # logged in registrar session
            $loggedInRegistrar = $request->session()->get('registrar');

            if(!empty($loggedInRegistrar)){

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
                    $validateRegistrar = Registrar::where('phone', $loggedInRegistrar)->first();

                    if(!$validateRegistrar){
                        $error = Session::flash('error', 'Sorry, you are not authorized.');
                        return redirect()->back()->with($error);
                    }else{

                        # collect data
                        $old_password = $request->old_password;
                        $new_password = $request->new_password;

                        try{

                            # compar passwords
                            $previousPassword = $validateRegistrar->password;
                            $checkPassword = Hash::check($old_password, $previousPassword);

                            if(!$checkPassword){
                                $error = Session::flash('error', 'Invalid old password supplied.');
                                return redirect()->back()->with($error);
                            }else{

                                # hash new password
                                $password = Hash::make($new_password);

                                # update profile
                                $updateProfile = Registrar::find($validateRegistrar->id)->update([
                                    'password' => $password
                                ]);

                                $success = Session::flash('success', 'Password updated successfully.');
                                return redirect()->to('registrar/profile')->with($success);
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

    # new immigrant page
    public function newImmigrantPage(Request $request){

        try{

            # logged in registrar session
            $loggedInRegistrar = $request->session()->get('registrar');

            if(!empty($loggedInRegistrar)){

                # registrar
                $registrar = Registrar::where('phone', $loggedInRegistrar)->first();

                return view::make('registrar/immigrant')->with([
                    'registrar' => $registrar
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

            # logged in registrar session
            $loggedInRegistrar = $request->session()->get('registrar');

            if(!empty($loggedInRegistrar)){

                # get registrar name
                $registrar_data = Registrar::where('phone', $loggedInRegistrar)->first();
                $registrar_name = $registrar_data->fullname;

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
                                    'registered_by' => $registrar_name
                                ]);
                                
                                $success = Session::flash('success', 'Migrant registered successfully.');
                                return redirect()->to('registrar/register/immigrant')->with($success);
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

            # logged in registrar session
            $loggedInRegistrar = $request->session()->get('registrar');

            if(!empty($loggedInRegistrar)){

                # registrar
                $registrar = Registrar::where('phone', $loggedInRegistrar)->first();

                # immigrants
                $immigrants = Immigrant::select('immigrants.id', 'immigrants.surname', 'immigrants.firstname', 'immigrants.dob', 'immigrants.phone_no', 'immigrants.occupation', 'immigrants.identification', 'immigrants.address', 'immigrants.gender', 'immigrants.status', 'immigrants.registered_by', 'countries.country')->leftJoin('countries', 'countries.id', '=', 'immigrants.country_id')->orderBy('immigrants.created_at', 'DESC')->get();

                return view::make('registrar/manage_immigrants')->with([
                    'registrar' => $registrar,
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

            # logged in registrar session
            $loggedInRegistrar = $request->session()->get('registrar');

            if(!empty($loggedInRegistrar)){

                # registrar
                $registrar = Registrar::where('phone', $loggedInRegistrar)->first();

                # immigrant id
                $immigrant_id = $request->id;

                # validate immigrant
                $validateImmigrant = Immigrant::findOrFail($immigrant_id);

                return view::make('registrar/immigrant')->with([
                    'registrar' => $registrar,
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

            # logged in registrar session
            $loggedInRegistrar = $request->session()->get('registrar');            

            if(!empty($loggedInRegistrar)){

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
                                return redirect()->to('registrar/immigrants')->with($success);
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

            # logged in registrar session
            $loggedInRegistrar = $request->session()->get('registrar');

            if(!empty($loggedInRegistrar)){

                # registrar data
                $registrar = Registrar::where('phone', $loggedInRegistrar)->first();

                # get country list
                $country_list = Immigrant::select('countries.id', 'countries.country')->leftJoin('countries', 'countries.id', 'immigrants.country_id')->get();
                
                # total countries
                $countries = Immigrant::distinct('country_id')->select('country_id')->count();

                return view::make('registrar/country_report')->with([
                    'registrar' => $registrar,                
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

            # logged in registrar session
            $loggedInRegistrar = $request->session()->get('registrar');

            if(!empty($loggedInRegistrar)){

                # registrar data
                $registrar = Registrar::where('phone', $loggedInRegistrar)->first();

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

           # logged in registrar session
           $loggedInRegistrar = $request->session()->get('registrar');

            if(!empty($loggedInRegistrar)){

                # registrar data
                $registrar = Registrar::where('phone', $loggedInRegistrar)->first();

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
                
                return view::make('registrar/print_report')->with([
                    'registrar' => $registrar,                
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

            # logged in registrar session
            $loggedInRegistrar = $request->session()->get('registrar');

            if(!empty($loggedInRegistrar)){

                # registrar data
                $registrar = Registrar::where('phone', $loggedInRegistrar)->first();

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
