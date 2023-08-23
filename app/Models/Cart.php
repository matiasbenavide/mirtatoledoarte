<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;

class Cart
{
    public $products = null;
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart)
        {
            $this->products = $oldCart->products;
            $this->totalQuantity = $oldCart->totalQuantity;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function addProduct($product, $id)
    {
        $storedProduct = ['quantity' => 0, 'price' => $product->price, 'product' => $product];

        if ($this->products) {
            if (array_key_exists($id, $this->products)) {
                $storedProduct = $this->products[$id];
            }
        }

        $storedProduct['quantity']++;
        $storedProduct['price'] = $product->price * $storedProduct['quantity'];

        $this->products[$id] = $storedProduct;
        $this->totalQuantity ++;
        $this->totalPrice += $this->products[$id]['product']->price;
    }

    public function removeProduct($product, $id)
    {
        $storedProduct = ['quantity' => 0, 'price' => $product->price, 'product' => $product];

        if ($this->products) {
            if (array_key_exists($id, $this->products)) {
                $storedProduct = $this->products[$id];
            }
        }

        $storedProduct['quantity']--;
        $storedProduct['price'] = $storedProduct['product']->price * $storedProduct['quantity'];

        $this->products[$id] = $storedProduct;
        $this->totalQuantity --;
        $this->totalPrice -= $this->products[$id]['price'];
        if ($this->totalPrice < 0) {
            $this->totalPrice = 0;
        }
    }

    public function deleteProduct($id)
    {
        $this->totalQuantity -= $this->products[$id]['quantity'];
        $this->totalPrice -= $this->products[$id]['price'];
        if ($this->totalPrice < 0) {
            $this->totalPrice = 0;
        }
        unset($this->products[$id]);
    }
}
