<?php

namespace App\Models;

class Cart extends UuidModel
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'cart';

    const STATUS_OPEN = 0;
    const STATUS_CHECKOUT = 1;
    const STATUS_CLOSED = 2;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function items() {
        return $this->hasMany('App\Models\CartItem');
    }

    public function addresses() {
        return $this->hasMany('App\Models\Address');
    }

    public function shippingAddress() {
        return $this->addresses()->where("type", Address::TYPE_SHIPPING)->first();
    }

    public function billingAddress() {
        return $this->addresses()->where("type", Address::TYPE_BILLING)->first();
    }

    public function toArray() {
        $itemsArray = array();
        foreach ($this->items()->get() as $item) {
            $itemsArray[] = $item->toArray();
        }
        $return = array(
            "id" => $this->id,
            "items" => $itemsArray
        );

        return $return;
    }

    public function getTotalPrice() {
        $price = 0;
        foreach ($this->items()->get() as $item) {
            $product = $item->product()->first();
            $price += $product->price * $item->quantity;
        }

        return $price;
    }
}
