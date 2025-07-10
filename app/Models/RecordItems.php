<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordItems extends Model
{
   use HasFactory;

	protected $fillable = [
		'r_id',
		'item_id',
		'particular',
		'quantity',
		'rate',
		'total',
	];

	public function record()
	{
		return $this->belongsTo(Allitems::class);
	}
}
