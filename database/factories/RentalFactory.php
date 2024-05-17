<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bookIds = Book::all()->pluck("id");
        $startDate = fake()->date();
        $endDate = fake()->date($startDate ('+1 week'));
        //$startDate = fake()->dateTimeBetween('-1year')->format("Y-m-d");
        //$endDate = date("Y-m-d", strtotime($startDate. " +1 week"));
        return [
            'book_id' => fake()->randomElement($bookIds),
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
    }
}
