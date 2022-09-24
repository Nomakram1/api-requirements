<?php

namespace App\GraphQL;
use App\Models\Product;

abstract class ProductResolver
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return  Product::latest()->get();


    }
}
