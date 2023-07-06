<?php

namespace Database\Seeders;
use App\Models\Book;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with fake books.
     */
    public function run(): void
    {
        Book::factory()
        ->count(100)
        ->create();
    }
}
