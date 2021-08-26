<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Transference;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transference::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $accountsIds = Account::all()->pluck('id');
        $originAccountId = $this->faker->randomElement($accountsIds);
        return [
            'origin_account_id' => $originAccountId,
            'destination_account_id' => $this->faker->valid(fn($id) => $id <> $originAccountId)->randomElement($accountsIds),
            'amount' => $this->faker->numberBetween(10, 99999),
        ];
    }
}
