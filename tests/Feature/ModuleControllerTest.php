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
            'number' => 2387
        ]);

        $response = $this->json('PUT', 'api/module/'. $module->id, [
            'number' => 5678
        ]);

        $response->assertJson([
            'updated' => true,
        ]);

        $mod = Module::find($module->id);
        $this->assertEquals(5678, $mod->number);
    }
}
