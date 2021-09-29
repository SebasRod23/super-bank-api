<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Account;
use App\Models\Movement;

class AccountMovementTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();
        $account = Account::create([
            'name' => 'Mi test account',
            'current_balance' => 100,
            'user_id' => $user->id
        ]);
        Movement::Register($account, 100);
        $account->fresh();
        $this->assertEquals(200, $account->current_balance);
    }
}
