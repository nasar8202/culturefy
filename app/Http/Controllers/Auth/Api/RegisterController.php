<?php

namespace App\Http\Controllers\Auth\Api;

use App\Models\User;
use App\Models\UserProfile;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\BusinessInfo;
use App\Models\EmployeeInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\Api\BaseController;
use Maatwebsite\Excel\Validators\ValidationException;

class RegisterController extends BaseController
{
      /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        DB::beginTransaction();
        try{
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'role_id' => 'required',
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors(),400);       
            }
            $input = $request->all();
            $input['status'] = 1;
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;

            if($request->role_id == 2){
                $business_info = new BusinessInfo;
                $business_info->user_id = $user->id;
                $business_info->business_name = $request->business_name;
                $business_info->business_describe = $request->business_describe;
                $business_info->known_as = $request->known_as;
                $business_info->business_operating_start_date = $request->business_operating_start_date;
                $business_info->business_history_describe = $request->business_history_describe;
                $business_info->hr_point_person = $request->hr_point_person;
                $business_info->survey_result = $request->survey_result;
                $business_info->kickoff_session = $request->kickoff_session;
                $business_info->save();

                $employee_info = new EmployeeInfo;
                $employee_info->user_id = $user->id;
                $employee_info->demographic_info = $request->demographic_info;
                $employee_info->historical_employee_engagement = $request->historical_employee_engagement;
                $employee_info->org_chart = $request->org_chart;
                $employee_info->employe_handbook = $request->employe_handbook;
                $employee_info->turnover_data = $request->turnover_data;
                $employee_info->exit_interview = $request->exit_interview;
                $employee_info->save();
            }
            $user_profile = new UserProfile;
            $user_profile->user_id =  $user->id;
            $user_profile->email = $user->email;
            $user_profile->save();

            $user_data = User::select('full_name','email','role_id')->where('id',$user->id)->with("roles")->first();
        }catch(\Exception $e)
        {
            DB::rollback();
            return response()->json(['success'=>false,'message' => $e->getMessage()]);
            // return $this->sendError('error', "Something Went Wrong!",404);
        }
        DB::commit();
        return $this->sendResponse([$success,$user_data], 'User register successfully.',200);
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try{
            $auth_check = auth('sanctum')->user();
            if(empty($auth_check)){
                return $this->sendError("Token Missing!",'error',404);
            }
            $id  = auth('sanctum')->user()->id;
            $user_data = User::find($id);
            $user_profile_data = UserProfile::where("user_id",$id)->first();
            if($user_profile_data){
                $user_profile = UserProfile::find($user_profile_data->id);
            }
            else{
                $user_profile = new UserProfile;
            }
            $user_profile->user_id = $user_data->id;
            $user_profile->email = $user_data->email;
            $user_profile->first_name = $request->first_name;
            $user_profile->last_name = $request->last_name;
            if($request->date_of_birth){
                $date =  date("Y-m-d",strtotime($request->date_of_birth));
                $user_profile->date_of_birth = $date;
            }else{
                $user_profile->date_of_birth = $request->date_of_birth;
            }
            $user_profile->phone = $request->phone;
            $user_profile->address = $request->address;
            $user_profile->country = $request->country;
            $user_profile->city = $request->city;
            $user_profile->state = $request->state;
            $user_profile->bio = $request->bio;
            if(isset($user_profile->gender)){
                $user_profile->gender = ucwords($request->gender);
            }
            else{
                $user_profile->gender = $request->gender;
            }
            $user_profile->skills = $request->skills;
            $user_profile->website = $request->website;
            $user_profile->facebook_link = $request->facebook_link;
            $user_profile->instagram_link = $request->instagram_link;
            $user_profile->instagram_link = $request->instagram_link;
            $user_profile->linkedin_link = $request->linkedin_link;
            $user_profile->twitter_link = $request->twitter_link;
            $user_profile->life_experience = $request->life_experience;
            $user_profile->designation = $request->designation;
            $user_profile->is_mentor = $request->is_mentor;
            $user_profile->save();
            $user_profile_data = UserProfile::where("id",$user_profile->id)->first()->makeHidden(['id','created_at','updated_at','deleted_at','status']);
        }catch(\Exception $e)
        {
            DB::rollback();
            return response()->json(['success'=>false,'message' => $e->getMessage()]);
            // return $this->sendError('error', "Something Went Wrong!",404);
        }
        DB::commit();
        return $this->sendResponse($user_profile_data, 'User register successfully.',200);
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(),400);       
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $user_data = User::select('full_name','email','role_id')->where('id',$user->id)->with("roles")->first();

            return $this->sendResponse([$success,$user_data], 'User login successfully.',200);
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Creadentials does not match'],400);
        } 
    }

    // import export
    // public function importExportView()
    // {
    //    return view('import');
    // }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        try {
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:csv,txt',
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors(),400);       
            }
            Excel::import(new UsersImport,request()->file('file'));
            return response()->json(['success'=>true,'message'=>'Users register successfully.']);

        } catch (ValidationException $e) {
            return response()->json(['success'=>false,'message' => $e->getMessage()]);
        }
    }
    // import export


}
