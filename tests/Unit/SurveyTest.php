<?php

namespace Tests\Unit;

use Tests\TestCase;
use Carbon\Carbon;
use App\Survey;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SurveyTest extends TestCase
{
    use RefreshDatabase;
    /**
    *@test
    */
    function it_should_cast_the_due_date_to_carbon() {
        $survey = factory(Survey::class)->create([
            'due_date' => Carbon::parse('10/21/86 22:34')
        ]);
        $s = Survey::find($survey->id);
        $this->assertInstanceOf(Carbon::class, $s->due_date);
    }
}
