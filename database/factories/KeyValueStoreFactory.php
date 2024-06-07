<?php

namespace Database\Factories;

use App\Models\KeyValueStore;
use Illuminate\Database\Eloquent\Factories\Factory;

class KeyValueStoreFactory extends Factory
{
    protected $model = KeyValueStore::class;

    public function definition()
    {
        return [
            'key' => $this->faker->word(),
            'value' => $this->faker->word(),
            'expires_at' => $this->faker->dateTime(),
        ];
    }
}
