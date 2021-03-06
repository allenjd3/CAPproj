<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Module;
use App\Survey;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
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
            'survey'=>['is_sent'=>true]
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
            'title'=>'SC1',
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
    function a_user_can_update_a_survey() {
        $survey = factory(Survey::class)->create([
            'due_date' => Carbon::parse('05/30/20')->toDateTimeString()
        ]);

        $response = $this->json('PUT', 'api/survey/'. $survey->id, [
            'due_date' => Carbon::parse('05/12/20')->toDateTimeString()
        ]);

        $response->assertJson([
            'updated' => true,
        ]);

        $sur = Survey::find($survey->id);
        $this->assertEquals(Carbon::parse('05/12/20'), $sur->due_date);
    }

    /**
    *@test
    */
    function a_user_can_get_all_users_associated_with_survey() {
        $this->withoutExceptionHandling();
        $module = factory(Module::class)->create();

        $survey = factory(Survey::class)->create();

        for($x=0; $x<=4; $x++) {
            $survey->users()->create([
                'name'=>'James Allen',
                'email'=>"jacque2186$x@yahoo.com",
                'password'=>Hash::make('password'),
                'user_id'=>$survey->id
            ]);
        }
        $response = $this->json('GET', "api/survey/$survey->id/user");
        $response->assertStatus(200);
        $this->assertCount(5, $response->getData()->users);
        
    }
    

    
}
