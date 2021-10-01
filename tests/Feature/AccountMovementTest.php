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
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_betweenMyAccounts()
    {
        $amount = 50;
        $balance1 = 0;
        $balance2 = $amount*2;

        $user = User::factory()->create();
        $account1 = Account::create([
            'name' => 'Account 1',
            'current_balance' => $balance1,
            'user_id' => $user->id
        ]);
        
        $account2 = Account::create([
            'name' => 'Account 2',
            'current_balance' => $balance2,
            'user_id' => $user->id
        ]);
        
        
        $movement = Movement::BetweenAccounts($account2, $account1, $amount);
        $account1->fresh();
        $account2->fresh();
        $this->assertEquals($amount, $account1->current_balance);
        $this->assertEquals($amount, $account2->current_balance);
    }

    public function test_betweenOtherAccounts()
    {
        $amount = 50;
        $balance1 = 0;
        $balance2 = $amount*2;

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $account1 = Account::create([
            'name' => 'Account 1',
            'current_balance' => $balance1,
            'user_id' => $user1->id
        ]);
        
        $account2 = Account::create([
            'name' => 'Account 2',
            'current_balance' => $balance2,
            'user_id' => $user2->id
        ]);
        
        
        $movement = Movement::BetweenAccounts($account2, $account1, $amount);
        $account1->fresh();
        $account2->fresh();
        $this->assertEquals($amount, $account1->current_balance);
        $this->assertEquals($amount, $account2->current_balance);
    }
}
