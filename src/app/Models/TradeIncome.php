<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeIncome extends Model
{
    use HasFactory;

    protected $fillable= ["user_id", "prev_inc", "new_inc", "wallet"];
}
