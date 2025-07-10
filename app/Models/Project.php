<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'p_id',
        'status',
        'party',
        'user',
        'updater',
        'image',
        'description',
    ];
    public function partyInfo()
	{
		return $this->belongsTo('App\Models\User', 'party', 'id');
		// p_id from Project model links the id of User model
	}
}
