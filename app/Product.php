<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Product extends Model
{
    use Rateable;

    protected $table = 'products';

    public function reviews() {
        return $this->hasMany('App\Comment', 'product_id', 'id');
    }

    public function reviewCount() {
        return $this->reviews()->where('product_id', $this->id )->count();
    }

    public function productPrice() {

        $baseConfig = BasicConfig::first();

        if ($baseConfig->tax_flag) {
            $price =  $this->product_price * (1 + $baseConfig->tax_rate / 100);
        } else {
            $price = $this->product_price;
        }

        if ($this->product_special_price) {
            $price = $price - $this->product_special_price;
        }

        if ($baseConfig->global_discount && !$this->product_special_price) {
            if ($baseConfig->global_discount_type == 'fixed') {
                $price = $price - $baseConfig->global_discount;
            } else {
                $price = $price * (1 - $baseConfig->global_discount / 100);
            }
        }

        return '$' . $price;

    }

    public function oldProductPrice() {

        $baseConfig = BasicConfig::first();

        if ($baseConfig->global_discount || $this->product_special_price) {
            if ($baseConfig->tax_flag) {
                $price =  $this->product_price * (1 + $baseConfig->tax_rate / 100);
            } else {
                $price = $this->product_price;
            }

            return '$' . $price;
        } else {
            return;
        }

    }

}
