<?php

namespace App\Http\Controllers\Filters;

use App\Models\Product;

class PriceFilter
{
    public function limit($min,$max)
    {
        return Product::whereBetween('price', [$min, $max])->get();
    }
}
