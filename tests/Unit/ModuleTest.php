<?php

namespace Tests\Unit;

use App\Module;
use App\Survey;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleTest extends TestCase
{
    use RefreshDatabase;
    /**
    *@test
    */
    function it_should_cast_the_tests_to_an_array() {
        $module = factory(Module::class)->create([
            'tests' => ['Na', 'K', 'Cl']
        ]);
        $this->assertCount(3, $module->tests);
    }

    /**
    *@test
    */
    function it_should_be_able_to_get_surveys() {
        $module = factory(Module::class)->create();
        factory(Survey::class, 4)->create([
            'module_id'=>$module->id
        ]);
        
        $mod = Module::first();
        $surveys = $mod->surveys()->get();
        $this->assertCount(4, $surveys->toArray());


    }
}
