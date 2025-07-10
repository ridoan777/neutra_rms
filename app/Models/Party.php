<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
	use HasFactory;

	// Define the fillable attributes for mass assignment
	protected $fillable = [
		'name',
		'prt_id', //party id
		'country',
		'state',
		'address',
		'openingBal',
		'currentBal',
		'user',
		'updator',
		'type',
		'description',
		'image',
	];

	// Optionally, you can specify the table if it's different from the default
	// protected $table = 'parties';
}
