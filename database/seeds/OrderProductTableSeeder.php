<?php

use Illuminate\Database\Seeder;

class OrderProductTableSeeder extends Seeder
{

    public function run()
    {
        for ($i=1; $i <= 10 ; $i++) { 
            $order =App\Order::find($i);
            for ($j=1; $j <=3 ; $j++) { 
            	 $order->products()->attach(rand(1,10));
            }
        }    
DB::table('order_product')->insert([
            'description' => $faker->country,
        'quantity' => random_int(30000, 2500000),
        ]);

    }
}

