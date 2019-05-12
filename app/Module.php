<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $guarded = [];
    protected $casts = [
        'tests' => 'array',
    ];

    public function surveys() {
        return $this->hasMany('App\Survey');
    }
}
