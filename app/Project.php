<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Mail;

use App\Mail\ProjectCreated;

use App\Events\ProjectCreatedEvent;

class Project extends Model
{
	// protected $fillable = // or can use $guarded
	// [
	// 	'title', 'description', 'owner_id'
	// ];
    protected $guarded = []; // don't accept followings

    protected $dispatchesEvents = [
        'created' => ProjectCreatedEvent::class
    ];

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
    	$this->tasks()->create($task);
    }
}
