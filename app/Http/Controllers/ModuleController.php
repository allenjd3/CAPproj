<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;

class ModuleController extends Controller
{
    
    public function show($id) {
        $module = Module::findOrFail($id);
        return response()->json([
            'module' => $module
        ], 202);
    }

    public function store(Request $request) {
        $module = Module::create($request->all());

        return response()->json([
            'created'=>true,
            'module'=>$module
        ], 202);
    }

    public function update(Request $request, $id) {
        $module = Module::findOrFail($id);
        $module->update($request->all());
        return response()->json([
            'updated'=>true,
            'module'=>$module
        ], 202);
    }
}
