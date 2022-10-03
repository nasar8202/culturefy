<?php

namespace App\Http\Controllers\Auth\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
                'full_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors(),400);       
            }
            $input = $request->all();
            // $input['role_id'] = 2;
            $input['status'] = 1;
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['full_name'] =  $user->full_name;
            $success['email'] =  $user->email;
            $success['role_id'] =  $user->role_id;
            $success['status'] =  $user->status;

        }catch(\Exception $e)
        {
            DB::rollback();
            return $this->sendError('error', "Something Went Wrong!",404);
            // return Redirect()->back()->with('error',$e->getMessage(),404)->withInput();
        }
        DB::commit();
        return $this->sendResponse($success, 'User register successfully.',200);
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
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
}
