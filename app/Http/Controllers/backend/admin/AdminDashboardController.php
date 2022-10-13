<?php

namespace App\Http\Controllers\backend\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BrandCultureCategory;
use App\Http\Controllers\Auth\Api\BaseController;

class AdminDashboardController extends BaseController
{
    public function index()
    {
        return view('backend.admin.dashboard');
    }

    public function admin()
    {

        return view('backend.admin.dashboard');
    }
    public function categories()
    {
        try {

            $categories = BrandCultureCategory::where('status',1)->with('sub_category')->get()->makeHidden(['created_at','updated_at','deleted_at','status']);

            if(!$categories->isEmpty())
            {
            return $this->sendResponse($categories, 'Data Fetched successfully.',200);
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


}
