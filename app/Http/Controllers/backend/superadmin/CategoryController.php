<?php

namespace App\Http\Controllers\backend\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory;
use App\Models\BrandCultureCategory;
use Auth;
use DB;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function categoryForm(){
        return view('backend.superadmin.categories.create');
    }
    public function subCategoryForm(){
        $brandCategories = BrandCultureCategory::where('parent_id',0)->get();

        return view('backend.superadmin.categories.createSubCategory',compact('brandCategories'));
    }

    public function store(StoreCategory $request){
        $validated = $request->validated();

        DB::beginTransaction();
        try{
            $user_id = Auth::user()->id;
            $addBrandCategory = new BrandCultureCategory();
            $addBrandCategory->category_name = $request->category_name;
            $addBrandCategory->status = 1;
            $addBrandCategory->user_id = $user_id;
            $addBrandCategory->save();
        }catch(\Exception $e)
        {
            DB::rollback();
            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();

        return redirect()->route('viewCategories')->with('success','Category Added Successfully!');

    }

    public function storeSubCategory(StoreCategory $request){
        $validated = $request->validated();

        DB::beginTransaction();
        try{
            $categoryName = Str::ucfirst($request->category_name);
            $user_id = Auth::user()->id;
            $addBrandCategory = new BrandCultureCategory();
            $addBrandCategory->category_name = $categoryName;
            $addBrandCategory->status = 1;
            $addBrandCategory->user_id = $user_id;
            $addBrandCategory->parent_id =$request->id;
            $addBrandCategory->save();

        }catch(\Exception $e)
        {
            DB::rollback();
            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();

        return redirect()->route('viewCategories')->with('success','Category Added Successfully!');

    }

    public function viewCategories(){
        DB::beginTransaction();
        try{

            $brandCategories = BrandCultureCategory::where('status',1)->get();

        }catch(\Exception $e)
        {
            DB::rollback();
            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();

        return view('backend.superadmin.categories.viewCategories',compact('brandCategories'));
    }

    public function EditCategoryForm($id){
        DB::beginTransaction();
        try{
            $brandCategory = BrandCultureCategory::where('id',$id)->first();
            $brandCategories = BrandCultureCategory::where('parent_id',0)->get();

        }catch(\Exception $e)
        {
            DB::rollback();
            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();

        return view('backend.superadmin.categories.edit',compact('brandCategory','brandCategories'));
    }

    public function update(StoreCategory $request, $id)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try{
            $input['category_name'] = $request->category_name;
            BrandCultureCategory::where('id',$id)->update($input);

        }catch(\Exception $e)
        {
            DB::rollback();

            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();
        return redirect()->route("viewCategories")->with('success','Category updated Successfully');
    }
}
