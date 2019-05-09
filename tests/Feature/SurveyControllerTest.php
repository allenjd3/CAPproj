<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Module;
use App\Survey;
use App\User;
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
}
