<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_homepage_contains_empty_table(): void
    {
        $response = $this->get('/students');

        $response->assertStatus(200);
        $response->assertSee('No Data Found');
    }

    public function test_homepage_contains_non_empty_table()
    {
        Student::create([
            'name' => 'John Doe',
            'email' => 'jon@example.com',
            'reg' => '123456',
            'roll' => '123',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'gender' => 'male',
            'image' => null
        ]);
        $response = $this->get('/students');

        $response->assertStatus(200);
        $response->assertSee('No Data Found');
    }
}
