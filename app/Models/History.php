<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'acao',
        'quantidade',
        'wallet_id',
        'stock_symbol'
    ];

    public function stock() {
        return $this->belongsTo(Stock::class);
    }

    public function wallet() {
        return $this->belongsTo(Wallet::class);
    }
}
