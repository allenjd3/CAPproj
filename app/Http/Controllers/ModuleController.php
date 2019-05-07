<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;

class ModuleController extends Controller
{
    
    public function show($id) {
        $module = Module::findOrFail($id);
        return $module;
    }
}
