<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_number',
        'user_id',
        'status',
        'subtotal',
        'tax',
        'shipping',
        'discount',
        'total',
        'payment_method',
        'payment_status',
        'currency',
        'shipping_name',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_postal_code',
        'shipping_country',
        'shipping_phone',
        'billing_name',
        'billing_address',
        'billing_city',
        'billing_state',
        'billing_postal_code',
        'billing_country',
        'billing_phone',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'shipping' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for the order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the status history for the order.
     */
    public function statusHistory(): HasMany
    {
        return $this->hasMany(OrderStatus::class)->orderBy('created_at', 'desc');
    }

    /**
     * Add a status change to the order.
     */
    public function addStatus(string $status, ?string $comment = null, ?int $updatedBy = null): OrderStatus
    {
        // Update the current order status
        $this->status = $status;
        $this->save();

        // Create a status history record
        return $this->statusHistory()->create([
            'status' => $status,
            'comment' => $comment,
            'updated_by' => $updatedBy,
        ]);
    }

    /**
     * Scope a query to only include orders with a specific status.
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get formatted shipping address.
     */
    public function getFormattedShippingAddressAttribute(): string
    {
        return $this->formatAddress(
            $this->shipping_name,
            $this->shipping_address,
            $this->shipping_city,
            $this->shipping_state,
            $this->shipping_postal_code,
            $this->shipping_country
        );
    }

    /**
     * Get formatted billing address.
     */
    public function getFormattedBillingAddressAttribute(): string
    {
        return $this->formatAddress(
            $this->billing_name,
            $this->billing_address,
            $this->billing_city,
            $this->billing_state,
            $this->billing_postal_code,
            $this->billing_country
        );
    }

    /**
     * Format an address.
     */
    private function formatAddress(?string $name, ?string $address, ?string $city, ?string $state, 
                                  ?string $postalCode, ?string $country): string
    {
        $parts = array_filter([
            $name,
            $address,
            $city,
            $state,
            $postalCode,
            $country
        ]);

        return implode(', ', $parts);
    }
}
