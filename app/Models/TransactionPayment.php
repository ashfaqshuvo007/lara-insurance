<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionPayment extends Model
{
    protected $table = "transaction_payment_method";

    protected $guarded = [];
}