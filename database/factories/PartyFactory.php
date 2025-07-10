<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Party>
 */
class PartyFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$name = $this->faker->company; // Fake company name
		$firstWord = strtok($name, ' '); // First word of name
		$countryShort = strtoupper($this->faker->lexify('??')); // Fake 2-letter country code
		$ptr_id = substr($firstWord, 0, 6) . '_' . $countryShort . '_' . substr(time(), -4);

		return [
			'type' => $this->faker->randomElement(['supplier', 'customer', 'employee', 'admin', 'service', 'other']),
			'prt_id' => $ptr_id, // Example: 8-character unique id
			'name' => $name,
			'openingBal' => $this->faker->randomFloat(2, 1000, 10000),
			'currentBal' => $this->faker->randomFloat(2, 1000, 10000),
			'country' => $this->faker->country,
			'state' => $this->faker->state,
			'address' => $this->faker->regexify('[A-Za-z0-9\s]{10,15}'),
			'user' => $this->faker->userName,
			// 'updator' => $this->faker->userName,
			'description' => $this->faker->sentence(1),
			'image' => "storage/partyPics/Vivien.emanue_7246.jpg", // You can add fake images if needed
		];
	}
}
