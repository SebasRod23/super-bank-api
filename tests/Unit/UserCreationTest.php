<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;

class UserCreationTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();
        $userNotSaved = User::factory ()->make();
        $this->assertIsInt($user->id);
    }
}
