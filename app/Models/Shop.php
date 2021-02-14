<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Shop
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $is_active
 * @property string|null $online_from
 * @property string|null $online_until
 * @property string|null $shop_banner
 * @property string|null $shop_logo
 * @property int $shop_owner_id
 * @property int $email_template_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop query()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereEmailTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereOnlineFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereOnlineUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereShopBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereShopLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereShopOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Shop extends Model
{
    use HasFactory;

    protected $table = 'shop';

    protected $fillable = [
        'id',
        'name',
        'description',
        'online_from',
        'online_until',
        'shop_banner',
        'shop_logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'shop_owner_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class)->orderBy('display_order', 'ASC');
    }
}
