<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

// use App\Twitter; // Service Containter examples

class ProjectsController extends Controller
{
    public function index()
    {
    	$projects = Project::all();
    	return view('projects.index', compact('projects'));
    }

    public function show(Project $project /* , Twitter $twitter */)
    {
        // dd($twitter); // Service Containter examples
    	return view('projects.show', compact('project'));
    }

    public function create()
    {
    	return view('projects.create');
    }

    public function store()
    {
        // Fifth way
        Project::create(request()->validate([
            'title' => ['required', 'min:3', 'max:255'], // or just 'required | min:3'
            'description' => ['required', 'min:3', 'max:255']
        ]));

        // Fourth way
        // $attributes = request()->validate([
        //     'title' => ['required', 'min:3', 'max:255'], // or just 'required | min:3'
        //     'description' => ['required', 'min:3', 'max:255']
        // ]);
        
        // Project::create($attributes);

        // Third way
     //    request()->validate([
     //        'title' => ['required', 'min:3', 'max:255'], // or just 'required | min:3'
     //        'description' => ['required', 'min:3', 'max:255']
     //    ]);
        
    	// Project::create(request(['title', 'description']));

    	// Second way
    	// Project::create([
    	// 	'title' => request('title'),
    	// 	'description' => request('description')
    	// ]);

    	// First way
    	// $project = new Project();
    	// $project->title = request('title');
    	// $project->description = request('description');
    	// $project->save();

        return redirect('/projects');
    }

    public function edit(Project $project)
    {
    	return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
    	// Second way
    	$project->update(request(['title', 'description']));

    	// First way
    	// $project->title = request('title');
    	// $project->description = request('description');
    	// $project->save();

    	return redirect('/projects');
    }

    public function destroy(Project $project)
    {
    	$project->delete();
      return redirect('/projects');
  }
}
