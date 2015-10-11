<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Cashier\Contracts\Billable as BillableContract;
use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class User extends UuidModel implements AuthenticatableContract, CanResetPasswordContract, BillableContract
{
    use Authenticatable, CanResetPassword, Billable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'stripe_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function carts() {
        return $this->hasMany('App\Models\Cart');
    }

    public function registerCustomer($token) {
        \Stripe\Stripe::setApiKey($this->getStripeKey());
        $json = \Stripe\Customer::create(array("source" => $token));
        $this->stripe_id = $json->id;
        $this->save();
    }
}
