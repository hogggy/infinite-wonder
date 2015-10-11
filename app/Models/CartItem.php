<?php
/**
 * Created by IntelliJ IDEA.
 * User: williamhogben
 * Date: 7/29/15
 * Time: 4:13 PM
 */

namespace App\Models;

use Mockery\CountValidator\Exception;

class CartItem extends UuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cart_item';

    public $product = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'quantity'];

    public function __construct($attributes = array()) {
        if (isset($attributes['product_id']) && !Product::find($attributes['product_id'])) {
            throw new Exception("Item not found");
        }

        parent::__construct($attributes);
    }

    public function user() {
        return $this->belongsTo('App\Models\Cart');
    }

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function toArray() {
        return array(
            'product_id' => $this->productId,
            'quantity' => $this->quantity
        );
    }
}
