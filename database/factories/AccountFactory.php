<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usersIds = User::all()->pluck('id')->toArray();
        return [
            'name' => ucfirst($this->faker->word()),
            'balance' => 100000,
            'user_id' => $this->faker->randomElement($usersIds),
            'active' => $this->faker->boolean(80),
            'transferable' => $this->faker->boolean(80),
        ];
    }
}
