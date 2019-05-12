<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Module;
use App\User;
use App\Survey;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
    *@test
    */
    function a_user_can_request_a_module_via_json() {
        $this->withoutExceptionHandling();
        $module = factory(Module::class)->create([
            'number'=>1520
        ]);

        $response = $this->json('GET', "api/module/{$module->id}");

        $response->assertStatus(202);

        $response->assertJson([
            'module'=>['number'=>1520]
            ]);
    }

    /**
    *@test
    */
    function a_user_can_create_a_module() {
        $response = $this->json('POST', 'api/module/', [
            'main_title'=>'Immunology',
            'number' => 1234,
            'tests' => ['Na', 'K', 'Cl']
        ]);

        $response->assertStatus(202);
        $response->assertJson([
            'created' => true,

        ]);

    }

    /**
    *@test
    */
    function a_user_can_update_a_module() {
        $module = factory(Module::class)->create([
            'number' => 2387,
            'main_title' => 'Special Clinical Microsco'
        ]);

        $response = $this->json('PUT', 'api/module/'. $module->id, [
            'number' => 5678,
            'main_title' => 'Special Clinical Microscopy'
        ]);

        $response->assertJson([
            'updated' => true,
        ]);

        $mod = Module::find($module->id);
        $this->assertEquals(5678, $mod->number);
        $this->assertEquals('Special Clinical Microscopy', $mod->main_title);
    }

    /**
    *@test
    */
    function a_user_can_get_surveys_that_belong_to_specific_modules() {
        
        $this->withoutExceptionHandling();
        $module = factory(Module::class)->create();
        $user = factory(User::class)->create();
        $surveys = factory(Survey::class, 5)->create([
            'title'=>'Random Stinking Title',
            'module_id'=>$module->id,
            'user_id'=>$user->id
        ]);

        $response = $this->json('GET', "/api/module/$module->id/survey");
        $response->assertStatus(200);
        $this->assertCount(5, $response->getData()->surveys);
    }
}
