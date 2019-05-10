<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Module;
use App\Survey;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SurveyControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
    *@test
    */
    function a_user_can_request_a_survey_via_json() {
        
        $user = factory(User::class)->create();
        $module = factory(Module::class)->create();
        $survey = factory(Survey::class)->create([
            'module_id' => $module->id,
            'user_id'=> $user->id,
            'is_sent'=>true
        ]);

        $response = $this->json('GET', 'api/survey/'.$survey->id);
     
        $response->assertStatus(200);
        $response->assertJson([
            'is_sent' => true
        ]);
    }

    /**
    *@test
    */
    function a_user_can_store_a_survey() {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $module = factory(Module::class)->create();
        $response = $this->json('POST', 'api/survey/', [
            'module_id'=>$module->id,
            'user_id'=>$user->id,
            'due_date'=>Carbon::parse('+1 week')->toDateTimeString()
        ]);

        $response->assertStatus(202);
        $response->assertJson([
            'created'=>true,
        ]);
    }

    /**
    *@test
    */
    function a_user_can_view_all_surveys() {

        $user = factory(User::class)->create();
        $module = factory(Module::class)->create();
        $surveys = factory(Survey::class, 5)->create();

        $response = $this->json('GET', 'api/survey/');
        $response->assertStatus(200);
        $this->assertCount(5, $response->getData()->surveys);
    }

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
