<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function root_redirects_to_dashboard()
    {
        $response = $this->get('/');

        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function dashboard_returns_successful_response_for_authenticated_user()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(), // usuario verificado
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }
}
