<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(int $userId = 1): void
    {
        $products = [
            [
                'name'        => 'Robe Élégante',
                'description' => 'Magnifique robe de soirée, coupe ajustée, tissu satiné.',
                'price'       => 189.00,
                'image'       => 'robe.jpg',
                'category'    => 'Robes',
                'user_id'     => $userId,
            ],
            [
                'name'        => 'Jupe Fleurie',
                'description' => 'Jupe légère aux imprimés floraux, parfaite pour l\'été.',
                'price'       => 120.00,
                'image'       => 'jupe.jpg',
                'category'    => 'Jupes',
                'user_id'     => $userId,
            ],
            [
                'name'        => 'Robe Bohème',
                'description' => 'Robe longue style bohème, tissu fluide et confortable.',
                'price'       => 155.00,
                'image'       => null,
                'category'    => 'Robes',
                'user_id'     => $userId,
            ],
            [
                'name'        => 'Jupe Midi',
                'description' => 'Jupe midi classique, coupe droite, polyvalente au quotidien.',
                'price'       => 95.00,
                'image'       => null,
                'category'    => 'Jupes',
                'user_id'     => $userId,
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name'], 'user_id' => $product['user_id']],
                $product
            );
        }
    }
}
