<?php

namespace App\Http\Controllers;

use App\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();
        return response()->json([
            'surveys' => $surveys
        ]);
    }
    
    public function show($id)
    {
        $survey = Survey::find($id);
        return response()->json([
            'survey' => $survey
        ]);
    }

    public function store(Request $request) {
        $survey = Survey::create($request->toArray());

        return response()->json([
            'created' => true,
            'survey' => $survey
        ], 202);
    }
}
