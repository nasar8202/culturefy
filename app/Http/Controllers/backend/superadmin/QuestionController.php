<?php

namespace App\Http\Controllers\backend\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrandCultureQuestion;
use App\Models\BrandCultureCategory;
use DB;
class QuestionController extends Controller
{
    public function questionForm()
    {
        DB::beginTransaction();
        try{
            //$brandCategory = BrandCultureCategory::where('id',$id)->first();
            $brandCategories = BrandCultureCategory::where(['status'=>1,'parent_id'=>0])->get();

        }catch(\Exception $e)
        {
            DB::rollback();
            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();

        return view('backend.superadmin.questions.create',compact('brandCategories'));
    }

    public function storeQuestion(Request $request){
       //$validated = $request->validated();

        DB::beginTransaction();
        try{
            $addBrandCultureQuestion = new BrandCultureQuestion();
            $addBrandCultureQuestion->brand_culture_category_id = $request->id;
            $addBrandCultureQuestion->status = 1;
            $addBrandCultureQuestion->question = $request->question;
            $addBrandCultureQuestion->save();

        }catch(\Exception $e)
        {
            DB::rollback();
            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();

        return redirect()->route('viewCategories')->with('success','Question Added Successfully!');

    }

}
