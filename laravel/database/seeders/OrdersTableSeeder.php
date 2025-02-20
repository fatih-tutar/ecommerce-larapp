<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = json_decode(file_get_contents(database_path('seeders/example-data/orders.json')), true);

        foreach ($orders as $order) {
            $createdOrder = Order::create([
                'id' => $order['id'],
                'customer_id' => $order['customerId'],
                'total' => $order['total']
            ]);

            foreach ($order['items'] as $item) {
                $createdOrder->items()->create([
                    'product_id' => $item['productId'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unitPrice'],
                    'total' => $item['total']
                ]);
            }
        }
    }
}
