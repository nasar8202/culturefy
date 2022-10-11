<?php

namespace App\Http\Controllers\backend\admin;

use Illuminate\Http\Request;
use App\Models\BrandCultureAnswer;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\Api\BaseController;

class AnswerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try{
            $auth_check = auth('sanctum')->user();
            if(empty($auth_check)){
                return $this->sendError("Token Missing!",'error',404);
            }
            $id  = auth('sanctum')->user()->id;
            $input = $request->all();
            foreach($input as $data){
                $answer = new BrandCultureAnswer;
                $answer->user_id = $id;
                $answer->brand_culture_question_id = $data['brand_culture_question_id'];
                $answer->answer = $data['answer'];
                $answer->save();
            }

        }catch(\Exception $e)
        {
            DB::rollback();
            return response()->json(['success'=>false,'message' => $e->getMessage()]);
            // return $this->sendError('error', "Something Went Wrong!",404);
        }
        DB::commit();
        return $this->sendResponse("Success", 'Answer Submit successfully.',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
