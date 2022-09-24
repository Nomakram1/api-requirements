<?php

namespace App\GraphQL;
use App\Models\Product;
use App\Enums\DiscountedEnums;
class ProductResolverInsuranceSku extends ProductResolver{


    public function __invoke($_, array $args)
    {
        $results = Product::latest()->get();
        $resultantArr = [];
        foreach ($results as $row ){
            $priceObj = [
                'original' => $row->price,
                'final' => $row->price,
                'discount_percentage' => null,
                'currency'=> 'EUR'
            ];
            if ($row->sku==config('global.DiscountedSKU')){
                $discount = $row->price*(config('global.DiscountedSKUPercentage')/100);
                $priceObj['discount_percentage']=config('global.DiscountedSKUPercentage').'%';
                $priceObj['final']=$row->price-$discount;
            }
            elseif ($row->Category->category_name == config('global.DiscountedCategory')){
                $discount = $row->price*(config('global.DiscountedSKUCategoryPercentage')/100);
                $priceObj['discount_percentage']=config('global.DiscountedSKUCategoryPercentage').'%';
                $priceObj['final']=$row->price-$discount;
            }
            $productObj=['sku'=> $row->sku,
                'name'=>$row->name,
                'category'=> $row->Category->category_name,
                'price'=>$priceObj
            ];
            $resultantArr[]=$productObj;
        }
        return $resultantArr;

    }



}



?>
