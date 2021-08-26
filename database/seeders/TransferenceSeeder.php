<?php

namespace Database\Seeders;

use App\Models\Transference;
use Illuminate\Database\Seeder;

class TransferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transference::factory()->count(50)->create();
    }
}
