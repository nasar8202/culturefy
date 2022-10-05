<?php

namespace App\Http\Controllers\backend\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function questionForm()
    {
        return view('backend.superadmin.questions.create');
    }
}
