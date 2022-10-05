<?php

namespace App\Http\Controllers\Auth\Api;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\Api\BaseController;

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
            // $success['email'] =  $user->email;
            // $success['full_name'] =  $user->full_name;
            // $success['role_id'] =  $user->role_id;
            // $success['status'] =  $user->status;
            $user_data = User::select('full_name','email','role_id')->where('id',$user->id)->with("roles")->first();
        }catch(\Exception $e)
        {
            DB::rollback();
            return $this->sendError('error', "Something Went Wrong!",404);
            // return Redirect()->back()->with('error',$e->getMessage(),404)->withInput();
        }
        DB::commit();
        return $this->sendResponse([$success,$user_data], 'User register successfully.',200);
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try{
            // $id = $request->user_id;
            
            // $token = PersonalAccessToken::findToken($hashedTooken);
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
            $user_profile->date_of_birth = $request->date_of_birth;
            $user_profile->phone = $request->phone;
            $user_profile->address = $request->address;
            $user_profile->country = $request->country;
            $user_profile->city = $request->city;
            $user_profile->state = $request->state;
            $user_profile->bio = $request->bio;
            if(isset($user_profile->gender)){
                $user_profile->gender = ucwords($request->gender);
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
            return $this->sendError('error', "Something Went Wrong!",404);
            // return Redirect()->back()->with('error',$e->getMessage(),404)->withInput();
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
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            // $success['full_name'] =  $user->full_name;
            // $success['email'] =  $user->email;
            // $success['role_id'] =  $user->role_id;
            $user_data = User::select('full_name','email','role_id')->where('id',$user->id)->with("roles")->first();

            return $this->sendResponse([$success,$user_data], 'User login successfully.',200);
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Creadentials does not match'],400);
        } 
    }
}
