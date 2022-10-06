<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        DB::beginTransaction();
        try{
            $validator = Validator::make($row, [
                'full_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);
            // dd($validator->fails());
            if($validator->fails()){
                return response()->json(['success'=>false,'message' => $validator->errors()]);
                // return $this->sendError('Validation Error.', $validator->errors(),400);       
            }
            $user_data = new User;
                $user_data->full_name = $row['full_name'];
                $user_data->email = $row['email'];
                $user_data->status = 1;
                $user_data->password = Hash::make($row['password']);
                $user_data->role_id = 3;
                $user_data->save();
            // ]);
            $date =  date("Y-m-d",strtotime($row['date_of_birth']));
            $user_profile = new UserProfile;
                $user_profile->user_id = $user_data->id;
                $user_profile->email = $user_data->email;
                $user_profile->first_name = $row['first_name'];
                $user_profile->last_name = $row['last_name'];
                $user_profile->date_of_birth = $date;
                $user_profile->phone = $row['phone'];
                $user_profile->address = $row['address'];
                $user_profile->country = $row['country'];
                $user_profile->city = $row['city'];
                $user_profile->state = $row['state'];
                $user_profile->gender = ucwords($row['gender']);
                $user_profile->save();
        }catch(\Exception $e)
        {
            DB::rollback();
            return response()->json(['success'=>false,'message' => $e->getMessage()]);
            // return $this->sendError('error', "Something Went Wrong!",404);
        }
        DB::commit();
        return $user_profile;
    }
}
