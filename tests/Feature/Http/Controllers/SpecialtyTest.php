<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\Specialty;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\SpecialtyController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpecialtyTest extends TestCase
{
    use RefreshDatabase;

    public function test_set_database_config()
    {
        Artisan::call('migrate:fresh --seed');
    }

    // The index method should return a view with a list of specialties and a filter value when a GET request is made.
    public function test_index_method_with_get_request()
    {
        $request = new Request();
        $controller = new SpecialtyController();
        $response = $controller->index($request);

        $this->assertInstanceOf(View::class, $response);
        $this->assertArrayHasKey('specialties', $response->getData());
        $this->assertArrayHasKey('filterValue', $response->getData());
    }

    // The create method should return a view with a specialty object when a GET request is made.
    public function test_create_method_with_get_request()
    {
        $specialty = new Specialty();
        $controller = new SpecialtyController();
        $response = $controller->create($specialty);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals($specialty, $response->getData()['specialty']);
    }

    public function test_store_method_with_post_request()
{
    $request = new Request(['name' => 'Test Specialty']);
    $controller = new SpecialtyController();
    $controller->store($request);

    $this->assertDatabaseHas('specialties', ['name' => 'Test Specialty']);
}

public function test_index_method_with_no_specialties()
{
    Specialty::truncate();
    $request = new Request();
    $controller = new SpecialtyController();
    $response = $controller->index($request);

    $this->assertInstanceOf(View::class, $response);
    $this->assertEmpty($response->getData()['specialties']);
    $this->assertNull($response->getData()['filterValue']);
}

    // The index method should return a view with a list of specialties and a filter value when a GET request is made with an empty filter value.
    public function test_index_method_with_empty_filter_value()
    {
        $request = new Request(['filterValue' => '']);
        $controller = new SpecialtyController();
        $response = $controller->index($request);
    
        $this->assertInstanceOf(View::class, $response);
        $this->assertArrayHasKey('specialties', $response->getData());
        $this->assertArrayHasKey('filterValue', $response->getData());
    }

        // The index method should return a view with a list of specialties and a filter value when a GET request is made with a non-empty filter value.
public function test_index_method_with_non_empty_filter_value()
{
    $request = new Request(['filterValue' => 'Test']);
    $controller = new SpecialtyController();
    $response = $controller->index($request);

    $this->assertInstanceOf(View::class, $response);
    $this->assertArrayHasKey('specialties', $response->getData());
    $this->assertArrayHasKey('filterValue', $response->getData());
}
}
