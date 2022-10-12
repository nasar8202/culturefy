<?php

namespace App\Http\Controllers\backend\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BrandCultureCategory;
use App\Models\BrandCultureQuestion;
use App\Http\Controllers\Auth\Api\BaseController;

class QuestionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $question = BrandCultureQuestion::where('status',1)->with(["category"])->get()->makeHidden(['created_at','updated_at','deleted_at','status']);

            if(!$question->isEmpty())
            {
            return $this->sendResponse($question, 'Data Fetched successfully.',200);
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
            return response()->json(['success'=>false,'message' => $e->getMessage()]);
        }
        
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
