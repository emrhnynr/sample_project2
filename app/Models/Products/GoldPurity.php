<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoldPurity extends Model
{
    use SoftDeletes;

    protected $table = 'gold_purities';
    protected $guarded = [];
}
