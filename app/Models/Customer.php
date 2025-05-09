<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

	protected $guarded = [];

    public function bills()
	{
		return $this->hasMany(Bill::class);
	}

	public function affectations()
	{
		return $this->hasMany(Affectation::class);
	}
}
