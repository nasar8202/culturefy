<?php

namespace App\Http\Controllers\backend\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\RolePermissionStoreRequest;
use DB;
class SuperAdminDashboardController extends Controller
{
    public function superadmin()
    {
        return view('backend.superadmin.dashboard');
    }
    public function RoleForm()
    {
        return view('backend.superadmin.role.create');
    }
    public function store(RolePermissionStoreRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try{
            // $data= $request->role_permission;
            // $jsonData = json_encode($data);
            // // //dd(json_encode($data));
            // // $data['role_name'] = $request->role_name;
            // // dd($data);
            // $input = new Role();
            // $input->role_name = $request->role_name;
            // $input->role_permission = $jsonData;
            // //dd($input);
            // $input->save();
        $input = $request->all();
        $input['role_permission'] = $request->input('role_permission');
        Role::create($input);
        }catch(\Exception $e)
        {
            DB::rollback();
            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();


        return redirect('superadmin/view-role')->with('success','Data added Successfully');
         //Role::create([$input]);
        //return view('backend.superadmin.role.create');
    }

    public function ViewRole(Request $request)
    {
        DB::beginTransaction();
        try{

            $rolePermissions = Role::where('role_status',0)->get()->toArray();

        }catch(\Exception $e)
        {
            DB::rollback();
            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();

        //dd($rolePermissions);
        return view('backend.superadmin.role.view',compact('rolePermissions'));
    }
    public function EditRoleForm($id)
    {

        DB::beginTransaction();
        try{
            $rolePermissionsUser = Role::where('role_id',$id)->first();
            //dd($rolePermissionsUser);
            $rolePermissions = Role::where('role_id',$id)->first();
            //$data= $rolePermissions->role_permission;

            $rolePermissionsArray = [];
            foreach($rolePermissions->role_permission as $value ){
                $rolePermissionsArray[$value] = $value;

            }
            //$rolePermissions = json_decode($rolePermissions);
           // $rolePermissions = json_encode($rolePermissions) . PHP_EOL;
           // dd($rolePermissions->role_permission);
            //return view('backend.superadmin.role.edit',compact('rolePermissions'));
        }catch(\Exception $e)
        {
            DB::rollback();
            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();

        return view('backend.superadmin.role.edit',compact('rolePermissionsArray','rolePermissionsUser'));
    }

    public function update(RolePermissionStoreRequest $request, $id)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try{

            // $role = Role::where('role_id',$id)->first();
            // // dd($role);
            // $role = new Role();
            // // $role->role_id = $role->role_id;
            // $role->role_name = $request->role_name ;
            // $role->role_permission = $jsonData ;
            // $role->save();

            $input['role_name'] = $request->role_name;
            $input['role_permission'] = $request->input('role_permission');
            Role::where('role_id',$id)->update($input);
            // $input = $request->role_name;
            // $input['role_permission']= $request->role_permission;

            // Role::find($id)->update($input);
        }catch(\Exception $e)
        {
            DB::rollback();

            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();
        return redirect('superadmin/view-role')->with('success','Data updated Successfully');
    }

    public function delete($id)
    {

        DB::beginTransaction();
        try{
            $delete  = Role::where('role_id',$id)->delete();
        }catch(\Exception $e)
        {
            DB::rollback();

            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();
        return redirect('superadmin/view-role')->with('success','Data Deleted Successfully');
    }
}
