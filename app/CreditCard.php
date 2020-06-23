<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Uuids;


class CreditCard extends Model
{
    use Uuids;
    public $incrementing = false;
    protected $fillable = [
      'card_holder_name','card_number','cvc','expiration_card'
    ];
}
