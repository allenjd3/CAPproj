<?php

namespace App\Http\Controllers;

use App\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    
    public function show($id)
    {
        $survey = Survey::find($id);
        return $survey;
    }
}
