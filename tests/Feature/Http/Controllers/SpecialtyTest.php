<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\Specialty;
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
    
    public function est_index_method_returns_view_with_specialties_list(): void
    {
        $specialties = Specialty::factory()->count(3)->create();
        
        $response = $this->get(action([SpecialtyController::class, 'index']));
        
        $response->assertStatus(200)
            ->assertViewIs('specialties.index')
            ->assertViewHas('specialties', $specialties);

            /* $request = new Request();
    $controller = new SpecialtyController();
    $view = $controller->index($request);
    
    $this->assertInstanceOf(View::class, $view);
    $this->assertArrayHasKey('specialties', $view->getData()); */
    }
}
