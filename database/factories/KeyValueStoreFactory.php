<?php

namespace Database\Factories;

use App\Models\KeyValueStore;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class KeyValueStoreFactory extends Factory
{
    protected $model = KeyValueStore::class;

    public function definition(): array
    {
        return [
            'key' => $this->faker->word(),
            'value' => $this->faker->word(),
            'expires_at' => $this->faker->dateTime(),
        ];
    }

    public function withTTL($seconds): KeyValueStoreFactory
    {
        return $this->state(function (array $attributes) use ($seconds) {
            return [
                'expires_at' => Carbon::now()->addSeconds($seconds),
            ];
        });
    }
}
