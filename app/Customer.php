<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'customers';
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone_number', 'business_name', 'address', 'city', 'state', 'zip', 'is_invoice_auto', 'days', 'invoice_email'];
}
