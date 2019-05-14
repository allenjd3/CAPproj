<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getsurvey(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $surveys = $user->surveys()->get();
        return response()->json([
            'surveys'=>$surveys
        ]);
    }
}
