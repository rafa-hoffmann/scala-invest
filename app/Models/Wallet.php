<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function stocks() {
        return $this->belongsToMany(Stock::class)->withPivot('id', 'goal');
    }
}
