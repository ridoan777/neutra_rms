<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
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
        // -----
        'from',
        'to',
        'ship',
        // -----
        'item_1',
        'qty_1',
        'rate_1',
        'item_2',
        'qty_2',
        'rate_2',
        'item_3',
        'qty_3',
        'rate_3',
        // -----
        'note',
        'terms',
        // -----
        'total',
        'tax',
        'discount',
        'paid',
        'dues',
    ];
}
