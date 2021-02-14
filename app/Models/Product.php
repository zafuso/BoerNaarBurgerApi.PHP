<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $price
 * @property int|null $is_active
 * @property int|null $min_order_amount
 * @property int|null $max_order_amount
 * @property int|null $stock
 * @property int|null $display_order
 * @property string|null $online_from
 * @property string|null $online_until
 * @property int $shop_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Shop $shop
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMaxOrderAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMinOrderAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOnlineFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOnlineUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_active',
        'min_order_amount',
        'max_order_amount',
        'stock',
        'display_order',
        'online_from',
        'online_until',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function orderItem()
    {
        $this->hasMany(OrderItem::class);
    }
}
