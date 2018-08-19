<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
   protected $table = 'currency';

   public function getCurrency(){
   		return $this->currency_code . ' ' . '(' . $this->symbol . ')';
   }
}
