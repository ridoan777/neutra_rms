<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allitems extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_made',
        'date_due',
        'ref_id',
        'user',
        'p_id',
        'method',
        'type',
        'from',
        'to',
        'ship',
        'note',
        'terms',
        'total',
        'tax',
        'discount',
        'paid',
        'dues',
    ];

    public function items()
    {
        return $this->hasMany(Invoice::class);
    }
}
