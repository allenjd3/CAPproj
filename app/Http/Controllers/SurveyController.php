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

    public function update($id, Request $request) {
        $survey = Survey::findOrFail($id);
        $survey->update($request->all());

        return response()->json([
            'updated'=>true
        ]);
    }

    public function getuser(Request $request, $id)
    {
        $survey = Survey::findOrFail($id);
        $users = $survey->users()->get();

        return response()->json([
            'users' => $users
        ]);
    }
}
