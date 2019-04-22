<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Mail\ProjectCreated;
use App\Events\ProjectCreatedEvent;

// use App\Twitter; // Service Containter examples

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	// $projects = Project::all(); // gives all projects

        // Third ver: commented previous return statement
        return view('projects.index', [
            'projects' => auth()->user()->projects
        ]);

        // Second ver: better readability
        // $projects = auth()->user()->projects;

        // First version: get all the projects for the authenticated user
        // $projects = Project::where('owner_id', auth()->id())/*->take(2)*/->get(); // select * from projects where owner_id = 4 // for ex

        // $stats = cache()->get('stats');
        // dump($stats);

        // tinker: cache()->get('stats')
        // cache()->rememberForever('stats', function() {
        //     return ['lessons' => 12000, 'hours' => 100000, 'series' => 50000];
        // });

        // dump($projects); // were testing telescope

        return view('projects.index', compact('projects'));
    }

public function show(Project $project /* , Twitter $twitter */)
{
        // dd($twitter); // Service Containter examples

        // Eighth
        // auth()->user()->can('update', $project); // or cannot() // but not working...

        // Seventh: at Routes put ->middleware(can:update,project);

        // Sixth
        // abort_unless(\Gate::allows('update', $project), 403);

        // Fifth
        // abort_if(\Gate::denies('update', $project), 403);

        //Fourth version
        // if (\Gate::denies('update', $project)){ // opposite is allows
        //     abort(403);
        // }

        // Third version with policy
    $this->authorize('update', $project);

        // Second version
        // can also abort_unless
        // abort_if($project->owner_id != auth()->id(), 403); // changed !== to !=

        // First version
        // if ($project->owner_id !== auth()->id()) {
        //     abort(403);
        // }

    return view('projects.show', compact('project'));
}

public function create()
{
 return view('projects.create');
}

public function store()
{
        // Fifth way
        // Project::create(request()->validate([
        //     'title' => ['required', 'min:3', 'max:255'], // or just 'required | min:3'
        //     'description' => ['required', 'min:3', 'max:255']
        // ]));

        // Fourth way
    $attributes = $this->validateProject();
        // dd(auth()->id());
    $attributes['owner_id'] = auth()->id();

    // Commented for the "2nd way"
    /*$project = */Project::create($attributes /* + ['owner_id' => auth()->id()]*/ ); // line 52 chosen

    $project = Project::create($attributes); 

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

    // First way for mail: good enough. For the "2nd way" this code is copied to Project model
    // \Mail::to($project->owner->email/*'nurtay_zh@mail.ru'*/)->send(
    //         new ProjectCreated($project) // creating a Mailable instance
    //     );

    // no need anymore because of $dispatchesEvents at Project model
    // event(New ProjectCreatedEvent($project));

    // Session: 1st way
    // session()->flash('message', 'Your project has been created!');

    // Session: 2nd way is in return line

    // Session: 3rd way: created helper.php and autoloaded composer
    flash('Your project has been created!');
    return redirect('/projects')/*->with('message', 'Your project has been created!')*/; // Session 2nd way is here
}

public function edit(Project $project)
{
   return view('projects.edit', compact('project'));
}

public function update(Project $project)
{

    $this->authorize('update', $project);

    	// Second way
    $project->update($this->validateProject());

    	// First way
    	// $project->title = request('title');
    	// $project->description = request('description');
    	// $project->save();

    return redirect('/projects');
}

public function destroy(Project $project)
{
    $this->authorize('update', $project);

    $project->delete();
    return redirect('/projects');
}

public function validateProject() {

    return request()->validate([
            'title' => ['required', 'min:3', 'max:255'], // or just 'required | min:3'
            'description' => ['required', 'min:3', 'max:255']
        ]);
}
}
