<?php

namespace Tests\Feature;

use App\User;
use App\Module;
use App\Survey;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
    *@test
    */
    function a_user_should_be_able_to_get_all_surveys_associated_with_user() {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $module = factory(Module::class)->create();

        for($x=0; $x<=4; $x++) {
            $user->surveys()->create([
                'title'=>'CET-01',
                'module_id'=>$module->id,
                'user_id'=>$user->id,
                'due_date'=>Carbon::parse('+1 week')
            ]);
        }
        $response = $this->json('GET', "api/user/$user->id/survey");
        $response->assertStatus(200);
        $this->assertCount(5, $response->getData()->surveys);
        
    }
}
