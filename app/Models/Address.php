<?php
/**
 * Created by IntelliJ IDEA.
 * User: williamhogben
 * Date: 8/13/15
 * Time: 3:39 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'address';

    const TYPE_BILLING = 'billing';
    const TYPE_SHIPPING = 'shipping';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'address1', 'address2', 'state', 'city', 'postal', 'country', 'type'];

    public function cart(){
        $this->belongsTo('App\Models\Cart');
    }
}