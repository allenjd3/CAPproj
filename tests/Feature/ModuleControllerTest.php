<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Module;
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

        $response->assertStatus(200);

        $response->assertJson([
            'number'=>1520
            ]);
    }

    /**
    *@test
    */
    function a_user_can_create_a_module() {
        $response = $this->json('POST', 'api/module/', [
            'number' => 1234,
            'tests' => ['Na', 'K', 'Cl']
        ]);

        $response->assertJson([
            'created' => true,

        ]);

    }

    
}
