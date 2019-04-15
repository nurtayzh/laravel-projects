<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = 
	[
		'title', 'description'
	];
    // protected $guarded = []; // don't accept followings

    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
    	$this->tasks()->create($task);
    }
}
