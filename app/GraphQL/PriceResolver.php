<?php


namespace App\GraphQL;

use Illuminate\Support\Facades\DB;
class PriceResolver{
    public function __invoke($_, array $args)
    {
        //return Products::where('category_name', $args['category'])->first();
        return DB::table('products')
            ->select('products.sku','categories.category_name','products.name','products.price')
            ->join('categories','products.category_id','categories.id')
            ->where('products.price',$args['price'])
            ->get();
    }
}

?>
