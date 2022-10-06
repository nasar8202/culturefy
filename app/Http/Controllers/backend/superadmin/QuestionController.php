<?php

namespace App\Http\Controllers\backend\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrandCultureQuestion;
use App\Models\BrandCultureCategory;
use App\Http\Requests\storeQuestion;
use DB;
class QuestionController extends Controller
{
    public function questionForm()
    {

        try{
            $brandParentCategory = BrandCultureCategory::where(['status'=>1,'parent_id'=>0])->get();
            $brandChildCategories = BrandCultureCategory::where(['status'=>1])->get();

        }catch(\Exception $e)
        {

            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }

        return view('backend.superadmin.questions.create',compact('brandChildCategories','brandParentCategory'));
    }

    public function storeQuestion(storeQuestion $request){
       $validated = $request->validated();

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

        return redirect()->route('viewQuestions')->with('success','Question Added Successfully!');

    }

    public function viewQuestions(Request $request){
        //$validated = $request->validated();

         try{
             $viewQuestions = BrandCultureQuestion::with('parent_category')->where('status',1)->get();
// dd($viewQuestions);
         }catch(\Exception $e)
         {

             return Redirect()->back()
                 ->with('error',$e->getMessage() )
                 ->withInput();
         }

         return view('backend.superadmin.questions.viewQuestions',compact('viewQuestions'));


     }

     public function EditQuestionForm($id){
        DB::beginTransaction();
        try{
            $BrandCultureQuestion = BrandCultureQuestion::where('id',$id)->first();
           // dd($BrandCultureQuestion->brand_culture_category_id);
            $brandCategories = BrandCultureCategory::where('id',$BrandCultureQuestion->brand_culture_category_id)->get();
// dd($brandCategories);
        }catch(\Exception $e)
        {
            DB::rollback();
            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();

        return view('backend.superadmin.questions.editQuestion',compact('BrandCultureQuestion','brandCategories'));
    }

    public function update(storeQuestion $request, $id)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try{
            $input['question'] = $request->question;
            $input['brand_culture_category_id'] = $request->brand_culture_category_id;
            BrandCultureQuestion::where('id',$id)->update($input);

        }catch(\Exception $e)
        {
            DB::rollback();

            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }
        DB::commit();
        return redirect()->route("viewQuestions")->with('success','Question updated Successfully');
    }
}
