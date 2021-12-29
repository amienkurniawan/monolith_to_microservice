<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use DB;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderItems = DB::connection('old_mysql')->table('order_items')->get();
        foreach ($orderItems as $orderItem) {
            OrderItem::create([
                'id' => $orderItem->id,
                'order_id' => $orderItem->order_id,
                'product_title' => $orderItem->product_title,
                'price' => $orderItem->price,
                'quantity' => $orderItem->quantity,
                'revenue' => $orderItem->influencer_revenue,
                'created_at' => $orderItem->created_at,
                'updated_at' => $orderItem->updated_at,
            ]);
        }
    }
}
