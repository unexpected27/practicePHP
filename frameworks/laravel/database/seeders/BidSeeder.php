<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Bid;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bid::create([
            'title' => 'Vintage Camera',
            'description' => 'A well-preserved Leica M3 from the 1950s.',
            'amount' => 1200.00,
            'status' => 'pending',
        ]);

        Bid::create([
            'title' => 'Gaming Laptop',
            'description' => 'High-end gaming laptop with RTX 4090.',
            'amount' => 3500.50,
            'status' => 'accepted',
        ]);

        Bid::create([
            'title' => 'Ergonomic Chair',
            'description' => 'Used Herman Miller Aeron, minor scratches.',
            'amount' => 600.00,
            'status' => 'rejected',
        ]);

        Bid::create([
            'title' => 'Mechanical Keyboard',
            'description' => 'Custom built with Gateron Ink Black switches.',
            'amount' => 250.00,
            'status' => 'pending',
        ]);
    }
}
