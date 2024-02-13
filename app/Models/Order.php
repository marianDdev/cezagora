<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int        $id
 * @property int        $total_price
 * @property Collection $items
 * @property Company    $customer
 * @property string      $status
 */
class Order extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'payment_pending';
    public const STATUS_COMPLETED = 'payment_completed';
    public const STATUS_CANCELED           = 'payment_canceled';
    public const STATUS_PAYMENT_COLLECTED  = 'payment_collected';
    public const STATUS_AWAINTING_SHIPMENT = 'payment_awaiting_shipment';

    protected $fillable = [
        'customer_id',
        'status',
        'total_price',
        'total_weight',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'customer_id', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_id', 'id');
    }

    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING =>  'Customer started the checkout process but did not complete it. Incomplete orders are assigned a "Pending" status and can be found under the More tab in the View Orders screen.',
            self::STATUS_AWAINTING_SHIPMENT => 'Order has been pulled and packaged and is awaiting collection from a shipping provider.',
            'Awaiting' =>  'Pickup — Order has been packaged and is awaiting customer pickup from a seller-specified location.',
            'Partially' =>  'Shipped — Only some items in the order have been shipped.',
            self::STATUS_COMPLETED =>  '— Order has been shipped/picked up, and receipt is confirmed; client has paid for their digital product, and their file(s) are available for download.',
            'Shipped' =>  '— Order has been shipped, but receipt has not been confirmed; seller has used the Ship Items action. A listing of all orders with a "Shipped" status can be found under the More tab of the View Orders screen.',
            'Cancelled' =>  '— Seller has cancelled an order, due to a stock inconsistency or other reasons. Stock levels will automatically update depending on your Inventory Settings. Cancelling an order will not refund the order. This status is triggered automatically when an order using an authorize-only payment gateway is voided in the control panel before capturing payment.',
            'Declined' =>  '— Seller has marked the order as declined.',
            'Refunded' =>  '— Seller has used the Refund action to refund the whole order. A listing of all orders with a "Refunded" status can be found under the More tab of the View Orders screen.',
            'Disputed' =>  '— Customer has initiated a dispute resolution process for the PayPal transaction that paid for the order or the seller has marked the order as a fraudulent order.',
            'Manual' =>  'Verification Required — Order on hold while some aspect, such as tax-exempt documentation, is manually confirmed. Orders with this status must be updated manually. Capturing funds or other order actions will not automatically update the status of an order marked Manual Verification Required.',
            'Partially' =>  'Refunded — Seller has partially refunded the order.',
        ];
    }
}
