<?php

namespace App\Models\Customers;

use App\Models\Products\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function products() : HasMany {
        return $this->hasMany(Product::class, 'customer_id');
    }
}
