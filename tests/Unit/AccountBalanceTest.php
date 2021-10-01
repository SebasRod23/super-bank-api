<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Account;
use App\Models\Movement;
use App\Models\User;

class AccountBalanceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_checkBalance()
    {
        $expected = 200;
        $account = $this->createAccount('Test', $expected);
        $this->assertEquals($expected, $account->current_balance);
    }

    public function test_checkBalanceAfterMovement()
    {
        $expected = 200;
        $account = $this->createAccount('Test', 100);
        $movement = Movement::Register($account, 100);
        $account->fresh();
        $this->assertEquals($expected, $account->current_balance);
    }

    function createAccount(string $name, int $balance): Account
    {
        $user = User::factory()->create();
        $data['name'] = $name;
        $data['user_id'] = $user->id;
        $data['current_balance'] = $balance;
        $account = Account::create($data);
        return $account;
    }
}
