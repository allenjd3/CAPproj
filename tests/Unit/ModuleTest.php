<?php

namespace Tests\Unit;

use App\Module;
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
}
