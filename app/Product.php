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
            $price =  round($this->product_price * (1 + $baseConfig->tax_rate / 100), 2);
        } else {
            $price = round($this->product_price, 2);
        }

        if ($this->product_special_price) {
            $price = round($price - $this->product_special_price, 2);
        }

        if ($baseConfig->global_discount && !$this->product_special_price) {
            if ($baseConfig->global_discount_type == 'fixed') {
                $price = round($price - $baseConfig->global_discount, 2);
            } else {
                $price = round($price * (1 - $baseConfig->global_discount / 100), 2);
            }
        }

        return '$' . $price;

    }

    public function oldProductPrice() {

        $baseConfig = BasicConfig::first();

        if ($baseConfig->global_discount || $this->product_special_price) {
            if ($baseConfig->tax_flag) {
                $price =  round($this->product_price * (1 + $baseConfig->tax_rate / 100), 2);
            } else {
                $price = $this->product_price;
            }

            return '$' . $price;
        } else {
            return;
        }

    }

}
