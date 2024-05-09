<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MineralColour extends Model
{
    use SoftDeletes;

    protected $table = 'mineral_colours';
    protected $guarded = [];
}
