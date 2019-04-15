<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

use App\Project;

class ProjectTasksController extends Controller
{
	public function update(Task $task)
	{
		// ver 4
		$method = request()->has('completed') ? 'complete' : 'incomplete';
		$task->$method();
		 
		// ver 3
		// request()->has('completed') ? $task->complete() : $task->incomplete();

		// ver 2: better encapsulation
		// $task->complete(request()->has('completed'));

		// ver 1
		// $task->update([
		// 	'completed' => request()->has('completed')
		// ]);

		return back();
	}

	public function store(Project $project)
	{
		$attributes = request()->validate(['description' => 'required|min:3']);
		// Better way
		$project->addTask($attributes);

		// First way
		// Task::create([
		// 	'project_id' => $project->id,
		// 	'description' => request('description')
		// ]);

		return back();
	}
}
