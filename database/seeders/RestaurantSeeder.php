<?php

namespace Database\Seeders;

use App\Models\RestaurantTable;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        RestaurantTable::insert([
            [
                'table_number' => 'Table 01',
                'seats' => 2,
                'location' => 'Indoor',
                'status' => 'available',
            ],
            [
                'table_number' => 'Table 02',
                'seats' => 4,
                'location' => 'Indoor',
                'status' => 'available',
            ],
            [
                'table_number' => 'Table 03',
                'seats' => 6,
                'location' => 'Indoor',
                'status' => 'available',
            ],
            [
                'table_number' => 'Table 04',
                'seats' => 2,
                'location' => 'Outdoor',
                'status' => 'available',
            ],
            [
                'table_number' => 'Table 05',
                'seats' => 8,
                'location' => 'Private',
                'status' => 'available',
            ],
        ]);


        MenuItem::insert([
            [
                'name' => 'Salmon Aburi Sushi',
                'description' => 'Seared salmon, sushi rice, ponzu and scallions.',
                'price' => 6,
                'image' => 'images/food/salmon.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Tuna Tataki',
                'description' => 'Premium tuna with sesame and citrus ponzu.',
                'price' => 7,
                'image' => 'images/food/tuna.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Signature Roll',
                'description' => 'Salmon, avocado, cucumber and spicy mayo.',
                'price' => 8,
                'image' => 'images/food/roll.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Wagyu Donburi',
                'description' => 'Sliced wagyu beef, rice, onsen egg and tare.',
                'price' => 11,
                'image' => 'images/food/wagyu.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Chicken Karaage',
                'description' => 'Japanese-style crispy fried chicken.',
                'price' => 8,
                'image' => 'images/food/karaage.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Miso Ramen',
                'description' => 'Rich miso broth with noodles and vegetables.',
                'price' => 10,
                'image' => 'images/food/ramen.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Matcha Cheesecake',
                'description' => 'Creamy Japanese matcha cheesecake.',
                'price' => 5,
                'image' => 'images/food/cheesecake.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Yuzu Soda',
                'description' => 'Refreshing sparkling yuzu drink.',
                'price' => 4,
                'image' => 'images/food/yuzu.jpg',
                'is_available' => true,
            ],
        ]);
    }
}