<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
	protected $fillable = [
		'date',
		'prt_id',
		'name',
		'status',
		'attendee',
	];

	protected $casts = [
		'date' => 'date',
	];

	public function party()
	{
		return $this->belongsTo(Party::class, 'prt_id', 'prt_id');
	}
}