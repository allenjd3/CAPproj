<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];
    protected $dates = [
        'due_date'
    ];
    
}