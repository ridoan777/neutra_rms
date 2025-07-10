<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'description',
        'quantity',
        'rate',
        'total',
    ];

    public function record()
    {
        return $this->belongsTo(Allitems::class);
    }
}
