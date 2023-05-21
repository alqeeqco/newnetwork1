<?php

namespace App\Repositories\Cart;

use App\Models\Products;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

interface CartInterface
{
    public function get() : Collection;

    public function add(Products $product, $color, $quantity = 1);

    public function update(Products $product, $quantity);

    public function delete($id);

    public function coupon(Request $request);

    public function empty();

    public function total() : float;
}
