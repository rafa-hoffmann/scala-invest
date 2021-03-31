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

    protected $appends = ['soma_patrimonio'];

    public function stocks()
    {
        return $this->belongsToMany(Stock::class)->withPivot('id', 'goal','goal_distance', 'comprado');
    }

    public function getSomaPatrimonioAttribute()
    {
        $soma = 0;
        foreach ($this->stocks as $stock) {
            $soma += $stock->patrimonio_att;
        }
        return $soma;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
