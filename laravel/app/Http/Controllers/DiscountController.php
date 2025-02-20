<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function calculate(Order $order): JsonResponse
    {
        $discounts = [];
        $totalDiscount = 0;
        $subtotal = $order->total;

        // 1000 TL Üzeri %10 İndirim
        if ($subtotal >= 1000) {
            $discount = $subtotal * 0.10;
            $discounts[] = [
                'discountReason' => '10_PERCENT_OVER_1000',
                'discountAmount' => number_format($discount, 2),
                'subtotal' => number_format($subtotal - $discount, 2),
            ];
            $totalDiscount += $discount;
            $subtotal -= $discount;
        }

        // 2 ID'li Kategoriden 6 Adet Alınca 1 Ücretsiz
        foreach ($order->items as $item) {
            if ($item->product->category == 2 && $item->quantity >= 6) {
                $discount = $item->product->price;
                $discounts[] = [
                    'discountReason' => 'BUY_5_GET_1',
                    'discountAmount' => number_format($discount, 2),
                    'subtotal' => number_format($subtotal - $discount, 2),
                ];
                $totalDiscount += $discount;
                $subtotal -= $discount;
            }
        }

        // 1 ID'li Kategoriden 2 veya Daha Fazla Ürün
        $category1Products = $order->items->filter(fn($item) => $item->product->category == 1);
        if ($category1Products->count() >= 2) {
            $cheapest = $category1Products->sortBy('unit_price')->first();
            $discount = $cheapest->unit_price * 0.20;
            $discounts[] = [
                'discountReason' => 'CHEAPEST_20_PERCENT',
                'discountAmount' => number_format($discount, 2),
                'subtotal' => number_format($subtotal - $discount, 2),
            ];
            $totalDiscount += $discount;
            $subtotal -= $discount;
        }

        return response()->json([
            'orderId' => $order->id,
            'discounts' => $discounts,
            'totalDiscount' => number_format($totalDiscount, 2),
            'discountedTotal' => number_format($subtotal, 2),
        ]);
    }
}
