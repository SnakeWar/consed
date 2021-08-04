<?php
namespace App\Models\Transform;

class ProductTransform implements Transformable {
    public function transform($product) {
        $product->image = asset("storage/products/{$product->file}");
        $product->price_formatted = money_format('%.2n', $product->price);
        
        $product->status = (new \DateTime() < new \DateTime($product->limit_date)) ? "Publicado" : "Expirado";
        return $product;
    }
}