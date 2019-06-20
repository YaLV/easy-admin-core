<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paysera extends Model
{
	protected $table = 'paysera';

	protected $fillable = [
		'order_header_id',
		'status',
		'amount',
	];
}
