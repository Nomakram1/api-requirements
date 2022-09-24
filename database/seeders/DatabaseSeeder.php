<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $path = resource_path('jsonData/dataset.json');
        $car_json_data= file_get_contents($path);
        $car_json = json_decode($car_json_data,false);
        foreach ($car_json->products as $car){
            $category = Category::firstOrCreate([
                'category_name'=> $car->category
            ]);
            $category->products()->create(
                [
                    'sku'=>$car->sku,
                    'name'=>$car->name,
                    'price'=>$car->price
                ]
            );

        }
    }
}
