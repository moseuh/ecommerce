<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Sample Product 1',
                'price' => 19.99,
                'category' => 'Category 1',
                'description' => 'This is a sample product description.',
                'gallery' => 'https://via.placeholder.com/100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Product 2',
                'price' => 29.99,
                'category' => 'Category 2',
                'description' => 'This is another sample product description.',
                'gallery' => 'https://via.placeholder.com/100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Product 3',
                'price' => 39.99,
                'category' => 'Category 3',
                'description' => 'A fantastic product for everyone.',
                'gallery' => 'https://via.placeholder.com/100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Product 4',
                'price' => 49.99,
                'category' => 'Category 1',
                'description' => 'Get this amazing product now.',
                'gallery' => 'https://via.placeholder.com/100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Product 5',
                'price' => 15.99,
                'category' => 'Category 2',
                'description' => 'An affordable and useful product.',
                'gallery' => 'https://via.placeholder.com/100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Product 6',
                'price' => 25.99,
                'category' => 'Category 3',
                'description' => 'A must-have item for daily use.',
                'gallery' => 'https://via.placeholder.com/100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Product 7',
                'price' => 99.99,
                'category' => 'Category 1',
                'description' => 'A premium product for premium users.',
                'gallery' => 'https://via.placeholder.com/100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Product 8',
                'price' => 9.99,
                'category' => 'Category 2',
                'description' => 'A budget-friendly product.',
                'gallery' => 'https://via.placeholder.com/100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Product 9',
                'price' => 79.99,
                'category' => 'Category 3',
                'description' => 'A reliable and trusted product.',
                'gallery' => 'https://via.placeholder.com/100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Product 10',
                'price' => 59.99,
                'category' => 'Category 1',
                'description' => 'An amazing product for professionals.',
                'gallery' => 'https://via.placeholder.com/100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Product 11',
                'price' => 39.99,
                'category' => 'Category 2',
                'description' => 'A versatile product for everyone.',
                'gallery' => 'https://via.placeholder.com/100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sample Product 12',
                'price' => 19.99,
                'category' => 'Category 3',
                'description' => 'A simple yet effective product.',
                'gallery' => 'https://via.placeholder.com/100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
