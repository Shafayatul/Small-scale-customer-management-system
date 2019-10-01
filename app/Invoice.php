<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'invoices';
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
    protected $fillable = ['user_id', 'is_autometic', 'autometic_email_day', 'invoice_email', 'total_amount', 'is_paid', 'last_email_date'];
}
