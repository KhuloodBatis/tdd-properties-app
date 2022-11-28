<?php

namespace Tests\Feature\Http\Request;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PropertyRequestTest extends TestCase
{
    //to refresh database
    // use RefreshDatabase;
    // to prefix route
    private string $routePrefix = 'api.properties.';

    /**
     * @test
     * @throws \Throwable
     */
    public function test_type_is_required()
    {

        $validatedField = 'type';
        $brokenRule  = null;

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);

        // Update assertion
        $existingProperty = Property::factory()->create();
        $newProperty = Property::factory()->make([
            $validatedField => $brokenRule
        ]);
        $this->putJson(
            route($this->routePrefix . 'update', $existingProperty),
            $newProperty->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     */
    public function type_must_not_exceed_20_characters()
    {
        $validatedField = 'type';
        $brokenRule = Str::random(21);

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function test_price_is_required()
    {
        $validatedField = 'price';
        $brokenRule = null;

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function test_price_must_be_an_integer()
    {
        $validatedField = 'price';
        $brokenRule = 'not-integer';

        $property = Property::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validatedField);
    }
}
