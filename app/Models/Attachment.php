<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    // Relations
	public function news()
	{
		return $this->belongsTo('App\Models\News');
	}
}
