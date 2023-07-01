<?php

namespace Database\Seeders;

use App\Dto\Availability\CreateAvailability;
use App\Enums\Projections\AvailabilityName;
use App\Events\NewAvailability;
use App\Projections\Availability;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AvailabilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! Availability::where('name', 'Total Available Amount')->count()) {
            NewAvailability::dispatch(new CreateAvailability(
                    uuid: Str::uuid(),
                    name: AvailabilityName::AVAILABLE,
                    amount: 0.0
                )
            );
        }
    }
}
