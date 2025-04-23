<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'session_id',
        'user_id',
        'converted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'converted_at' => 'datetime',
    ];

    /**
     * Get the user that owns the cart.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items in the cart.
     */
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get the total quantity of items in the cart.
     */
    public function getTotalQuantityAttribute(): int
    {
        return $this->items->sum('quantity');
    }

    /**
     * Get the subtotal of the cart.
     */
    public function getSubtotalAttribute(): float
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    /**
     * Convert the cart to an order.
     */
    public function convertToOrder(array $orderData): Order
    {
        // Create a new order
        $order = Order::create([
            'order_number' => uniqid('ORD-'),
            'user_id' => $this->user_id,
            'subtotal' => $this->getSubtotalAttribute(),
            'tax' => $orderData['tax'] ?? 0,
            'shipping' => $orderData['shipping'] ?? 0,
            'discount' => $orderData['discount'] ?? 0,
            'total' => $this->getSubtotalAttribute() + 
                       ($orderData['tax'] ?? 0) + 
                       ($orderData['shipping'] ?? 0) - 
                       ($orderData['discount'] ?? 0),
            'payment_method' => $orderData['payment_method'] ?? null,
            // Add shipping and billing info from $orderData
        ]);

        // Convert cart items to order items
        foreach ($this->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'sku' => $item->product->sku,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->price * $item->quantity,
                'attributes' => $item->attributes,
            ]);
        }

        // Mark this cart as converted
        $this->converted_at = now();
        $this->save();

        return $order;
    }
}
