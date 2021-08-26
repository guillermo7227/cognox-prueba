<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransferenceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_transfer_funds_to_another_account()
    {
        $user = User::factory()->create();

        $accountA = Account::factory()->create([
            'user_id' => $user->id,
            'balance' => 1000
        ]);        
        $accountB = Account::factory()->create([
            'user_id' => $user->id,
            'balance' => 1000
        ]);

        $response = $this->actingAs($user)
            ->post(route('transferences.store', [
                'origin_account_id' => $accountA->id,
                'destination_account_id' => $accountB->id,
                'amount' => 100
            ]));

        $response->assertStatus(200);

        $this->assertDatabaseHas('accounts', [
            'id' => $accountA->id,
            'balance' => 900
        ]);

        $this->assertDatabaseHas('accounts', [
            'id' => $accountB->id,
            'balance' => 1100
        ]);

        
        $this->assertDatabaseHas('transferences', [
            'origin_account_id' => $accountA->id,
            'destination_account_id' => $accountB->id,
            'amount' => 100
        ]);

    }
}
