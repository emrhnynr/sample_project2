<?php

namespace App\Models\Products;

use App\Models\Categories\Category;
use App\Models\Customers\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';
    protected $guarded = [];


    public function gold_purities() : BelongsToMany {
        return $this->belongsToMany(GoldPurity::class, 'product_gold_purities', 'product_id', 'gold_purity_id');
    }
    public function mineral_colours() : BelongsToMany {
        return $this->belongsToMany(MineralColour::class, 'product_mineral_colours', 'product_id', 'mineral_colour_id');
    }

    public function customer() : BelongsTo {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
