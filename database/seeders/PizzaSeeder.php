<?php
namespace Database\Seeders;
use App\Models\Pizza;
use Illuminate\Database\Seeder;

class PizzaSeeder extends Seeder
{
    public function run(): void
    {
        $pizzas = [
            [
                'name' => 'Margherita',
                'description' => 'Tomate San Marzano, mozzarella y albahaca fresca.',
                'price' => 10.50,
                'image_url' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Diavola',
                'description' => 'Tomate, mozzarella y salami picante.',
                'price' => 13.50,
                'image_url' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Quattro Formaggi',
                'description' => 'Mozzarella, gorgonzola, parmesano y provolone.',
                'price' => 14.00,
                'image_url' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Prosciutto e Funghi',
                'description' => 'Tomate, mozzarella, jamón cocido y champiñones.',
                'price' => 12.50,
                'image_url' => null,
                'is_available' => true,
            ],
        ];

        foreach ($pizzas as $pizza) {
            Pizza::create($pizza);
        }
    }
}
