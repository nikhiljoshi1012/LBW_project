<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())->get();
        return view('dashboard', compact('projects'));
    }

    public function create()
    {
        return view('raaga_taal'); //TODO : Change the view name to a more systematic name
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