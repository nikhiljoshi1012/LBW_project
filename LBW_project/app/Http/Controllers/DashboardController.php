<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())->get();
        return view('dashboard', compact('projects'));
    }
    public function newUntitled()
    {
        $user = Auth::user();
        $projectNames = Project::where('user_id', $user->id)->pluck('name')->toArray();

        $untitledCount = 1;
        $newProjectName = 'Untitled';

        while (in_array($newProjectName, $projectNames)) {
            $newProjectName = 'Untitled ' . $untitledCount;
            $untitledCount++;
        }

        return $newProjectName;
    }

    public function create()
    {
        $projects = Project::where('user_id', Auth::id())->get();
        $project = new Project;
        $project->name = $this->newUntitled();
        $project->data = json_encode([]); // Empty data initially
        $project->user_id = Auth::id();
        $project->save();

        return view('raaga_taal',compact('project')); //TODO : Change the view name to a more systematic name
    }

    

    public function store(Request $request)
    {
        $project = new Project;
        $project->name = $request->name;
        $project->data = json_encode([]); // Empty data initially
        $project->user_id = Auth::id();
        $project->save();

        return redirect()->route('dashboard');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }
}