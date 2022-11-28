<?php

namespace Tests\Feature\Api;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertiesTest extends TestCase
{
    use RefreshDatabase;
    /**@test*/

    public function test_can_get_all_propertise()
    {

        // Create Property so that the response returns it.
        // Create Property so that the response returns it.
        $property = Property::factory()->create(); //instence
        //act
        $response = $this->getJson(route('api.properties.index'));
        // We will only assert that the response returns a 200
        // status for now.
        //assert
        $response->assertOk();

        // Add the assertion that will prove that we receive what we need
        // from the response.

        $response->assertJson([
            'data' => [
                [
                    'id' => $property->id,
                    'type' => $property->type,
                    'price' => $property->price,
                    'description' => $property->description,
                ]
            ]
        ]);
    }
    /**@test */
    public function test_can_store_a_property()
    {

        // Build a non-persisted Property factory model
        $newProperty = Property::factory()->make(); //object

        $response = $this->postJson(
            route('api.properties.store'),
            $newProperty->toArray()
        );

        // We assert that we get back a status 201:
        // Resource Created for now.

        $response->assertCreated();
        // Assert that at least one column gets returned from the response
        // in the format we need .
        $response->assertJson([
            'data' => ['type' => $newProperty->type]
        ]);
        // Assert the table properties contains the factory we made.

        $this->assertDatabaseHas(
            'properties',
            $newProperty->toArray()
        );

    }
   /** @test */
    // public function  test_can_update_a_property()
    // {
    //     $existingProperty = Property::factory()->create();
	// 	$newProperty = Property::factory()->make();

	// 	$response = $this->putJson(
	// 		route('api.properties.update', $gitexistingProperty),
	// 		$newProperty->toArray()
	// 	);
	// 	$response->assertJson([
	// 		'data' => [
	// 			// We keep the ID from the existing Property.
	// 			'id' => $existingProperty->id,
	// 			// But making sure the title changed.
	// 			'title' => $newProperty->title
	// 		]
	// 	]);

	// 	$this->assertDatabaseHas(
	// 		'properties',
	// 		$newProperty->toArray()
	// 	);
    // }
}
