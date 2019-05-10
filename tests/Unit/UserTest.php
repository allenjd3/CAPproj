<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Module;
use App\Survey;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
    *@test
    */
    function a_user_can_view_all_a_users_surveys() {
        $module = factory(Module::class)->create();
        
        $users = factory(User::class, 5)->create()->each(function($u){
            $u->surveys()->save(factory(Survey::class)->make([
                'user_id'=>$u->id
            ]));
        });

        $this->assertCount(5, Survey::all()->toArray());
    }
}
