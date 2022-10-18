<?php

namespace App\Http\Controllers\backend\admin;

use Illuminate\Http\Request;
use App\Models\SurveyStrategy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Api\SurveyStrategyRequest;
use App\Http\Controllers\Auth\Api\BaseController;

class SurveyStrategyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $survey_data = SurveyStrategy::where('status',1)->get()->makeHidden(['created_at','updated_at','deleted_at','status','remember_token']);

            if(!$survey_data->isEmpty())
            {
            return $this->sendResponse($survey_data, 'Data Fetched successfully.',200);
            }
            else
            {
                return $this->sendError(
                    'Invalid.',
                    ['error' => 'Record Not Found'],
                    200
                );
            }
        }
        catch (\Exception $e) {
            return response()->json(['success'=>false,'message' => $e->getMessage()],500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        DB::beginTransaction();
        try{
            $validator = Validator::make($request->all(), [
                'survey_data' => 'required',
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors(),400);       
            }
            $survey = new SurveyStrategy;
            $survey->survey_data = $request->survey_data;
            $survey->save();

        }catch(\Exception $e)
        {
            DB::rollback();
            return response()->json(['success'=>false,'message' => $e->getMessage()],500);
        }
        DB::commit();
        return $this->sendResponse($survey, 'Strategy Submit successfully.',200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //
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
