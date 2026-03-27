<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('events');

        for ($i = 1; $i <= 20; $i++) {

            // Use online placeholder image
            $imageUrl = "https://picsum.photos/seed/" . Str::random(10) . "/640/480";

            // Download image
            $imageContents = file_get_contents($imageUrl);

            $fileName = 'events/' . Str::random(10) . '.jpg';

            Storage::disk('public')->put($fileName, $imageContents);

            Event::create([
                'name' => fake()->sentence(3),
                'description' => fake()->paragraph(),
                'event_datetime' => fake()->dateTimeBetween('now', '+1 year'),
                'price' => fake()->randomFloat(2, 100, 5000),
                'capacity' => fake()->numberBetween(10, 500),
                'status' => fake()->randomElement(['upcoming', 'completed']),
                'image' => $fileName,
            ]);
        }
    }
}
