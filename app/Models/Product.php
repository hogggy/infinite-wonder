<?php
/**
 * Created by IntelliJ IDEA.
 * User: williamhogben
 * Date: 7/25/15
 * Time: 11:08 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'desc', 'price'];
}