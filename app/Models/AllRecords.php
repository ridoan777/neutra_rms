<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllRecords extends Model
{
	use HasFactory;
	protected $fillable = [
		'date_made',
		'date_due',
		'r_id',
		'ref',
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
	public function projectInfo()
	{
		return $this->belongsTo('App\Models\Project', 'p_id', 'id');
		// p_id from AllRecord model links the id of Project model
	}
}
