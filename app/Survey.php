<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];
    protected $dates = [
        'due_date'
    ];
 
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
