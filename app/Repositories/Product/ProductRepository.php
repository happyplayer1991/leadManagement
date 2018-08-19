<?php
namespace App\Repositories\Product;

use App\Models\Product;
use Notifynder;
use Carbon;
use DB;

class ProductRepository implements ProductRepositoryContract
{

    const ADDED = 'added';
    
    public function find($id)
    {
        return Product::findOrFail($id);
    }


    public function create($requestData)
    {
        $product = New Product();
        $product->product_name = $requestData->product_name;
        $product->price = $requestData->price;
        $product->description = $requestData->description;
        $product->company_id = \Auth::user()->company_id;
        $product->user_id = \Auth::id();
        $product->save();
        
        event(new \App\Events\ProductAction($product, self::ADDED));
        return $product;
    }
   
}
