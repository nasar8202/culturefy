<?php

namespace App\Http\Controllers\Auth\Api;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'role_id' => 'required',
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors(),400);       
            }
            $input = $request->all();
            // $input['role_id'] = 2;
            $input['status'] = 1;
            $input['password'] = Hash::make($input['password']);
            $full_name = $input['first_name']." ".$input['last_name'];
            $user = User::create($input);
            $user->full_name = $full_name;
            $user->save();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['email'] =  $user->email;
            $success['role_id'] =  $user->role_id;
            $success['status'] =  $user->status;
            $user_profile = new UserProfile;
            $user_profile->user_id = $user->id;
            $user_profile->first_name = $request->first_name;
            $user_profile->last_name = $request->last_name;
            $user_profile->last_name = $request->last_name;
            $user_profile->email = $request->email;
            $user_profile->save();
            $user_data = User::where('id',$user->id)->with("roles")->first();
        }catch(\Exception $e)
        {
            dd($e);
            DB::rollback();
            return $this->sendError('error', "Something Went Wrong!",404);
            // return Redirect()->back()->with('error',$e->getMessage(),404)->withInput();
        }
        DB::commit();
        return $this->sendResponse($user_data, 'User register successfully.',200);
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try{
            $user_profile = new UserProfile;
            $user_profile->user_id = $user->id;
            $user_profile->first_name = $request->first_name;
            $user_profile->last_name = $request->last_name;
            $user_profile->last_name = $request->last_name;
            $user_profile->email = $request->email;
            $user_profile->save();
            $user_data = User::where('id',$user->id)->with("roles")->first();
        }catch(\Exception $e)
        {
            dd($e);
            DB::rollback();
            return $this->sendError('error', "Something Went Wrong!",404);
            // return Redirect()->back()->with('error',$e->getMessage(),404)->withInput();
        }
        DB::commit();
        return $this->sendResponse($user_data, 'User register successfully.',200);
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
            $success['full_name'] =  $user->full_name;
            $success['email'] =  $user->email;
            $success['role_id'] =  $user->role_id;
            $user_data = User::where('id',$user->id)->with("roles")->first();

            return $this->sendResponse($user_data, 'User login successfully.',200);
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Creadentials does not match'],400);
        } 
    }
}
