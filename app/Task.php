<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $guarded = [];
	
	public function project()
	{
		return $this->belongsTo(Project::class);
	}

	public function complete($completed = true)
	{
		$this->update(compact('completed')); // 'completed' = $completed
	}

	public function incomplete()
	{
		$this->complete(false);
	}
}
