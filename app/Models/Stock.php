<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $primaryKey = 'symbol';
    protected $keyType = 'string';
    public $incrementing = false;

    public function wallets()
    {
        return $this->belongsToMany(Wallet::class)->withPivot('id', 'goal', 'comprado');
    }

    public function last_quote()
    {
        return $this->hasOne(LastQuote::class, 'symbol', 'symbol');
    }
}
