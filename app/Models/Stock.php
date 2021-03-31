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

    protected $appends = ['patrimonio_att'];

    public function wallets()
    {
        return $this->belongsToMany(Wallet::class)->withPivot('id', 'goal','goal_distance', 'comprado');
    }

    public function last_quote()
    {
        return $this->hasOne(LastQuote::class, 'symbol', 'symbol');
    }

    public function getPatrimonioAttAttribute()
    {
        if (!empty($this->last_quote) && !empty($this->pivot)) {
            return $this->pivot->comprado * $this->last_quote->price;
        }
        return 0;
    }
}
