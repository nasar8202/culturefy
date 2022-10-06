<?php

namespace App\Http\Controllers\backend\superadmin;

use App\Http\Controllers\Controller;
use App\Models\BrandCultureQuestion;
use App\Models\BrandCultureAnswer;
use Illuminate\Http\Request;
use DB;
use Auth;

use App\Http\Requests\storeAnswer;

class AnswerController extends Controller
{
    public function answerForm()
    {
        
        try{
            $BrandCultureQuestion = BrandCultureQuestion::get();
            // dd($BrandCultureQuestion);
        }catch(\Exception $e)
        {

            return Redirect()->back()
                ->with('error',$e->getMessage() )
                ->withInput();
        }

        return view('backend.superadmin.answers.create',compact('BrandCultureQuestion'));
    }

    public function storeAnswer(storeAnswer $request){
        // dd($request->all());
        $validated = $request->validated();
 
         DB::beginTransaction();
         try{
            $user_id = Auth::user()->id;
             $BrandCultureAnswer = new BrandCultureAnswer();
             $BrandCultureAnswer->brand_culture_question_id = $request->id;
             $BrandCultureAnswer->status = 1;
             $BrandCultureAnswer->answer = $request->answer;
             $BrandCultureAnswer->user_id = $user_id;
             $BrandCultureAnswer->save();
 
         }catch(\Exception $e)
         {
             DB::rollback();
             return Redirect()->back()
                 ->with('error',$e->getMessage() )
                 ->withInput();
         }
         DB::commit();
 
         return redirect()->route('viewAnswer')->with('success','Question Added Successfully!');
 
     }

     public function viewAnswer(Request $request){
        //$validated = $request->validated();

         try{
             $viewAnswer = BrandCultureAnswer::with('parent_question')->where('status',1)->get();
            //  dd($viewAnswer);

         }catch(\Exception $e)
         {
            return $e;
             return Redirect()->back()
                 ->with('error',$e->getMessage() )
                 ->withInput();
         }

         return view('backend.superadmin.answers.viewAnswers',compact('viewAnswer'));


     }
}
