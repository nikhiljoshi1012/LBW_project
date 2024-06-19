<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function index()
    {
        // Show only the projects that belong to the authenticated user
        $projects = Project::where('user_id', Auth::id())->get();
        return view('projects.index', compact('projects'));
    }
    public function projectList()
    {
        // Show only the projects that belong to the authenticated user
        $projects = Project::where('user_id', Auth::id())->get();
        return response()->json($projects);
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
        $projectNames = Project::where('user_id', Auth::id())->pluck('name');
        $project = new Project();
        $project->name = $this->newUntitled();
        $project->data = json_encode([]); // Store decoded data
        $project->user_id = Auth::id(); // Set the user ID for the project
        $project->save();
        
        return view('raaga_taal', compact('project')); //TODO : Change the view name to a more systematic name
    }

    public function store(Request $request)
    {
        Log::debug('Request received in store method', ['request' => $request->all()]);
        $request->validate([
            'name' => 'required|string|max:255',
            'project_data' => 'required|string', // Change validation to string
        ]);

        // Decode JSON data
        $projectData = json_decode($request->input('project_data'), true);

        // Find the existing project for the authenticated user
        $project = Project::where('user_id', Auth::id())->first();

        if ($project) {
            // Update the project data
            $project->name = $request->input('name');
            $project->data = $projectData;
            $project->save();

            return redirect()->route('dashboard')->with('success', 'Project data updated successfully.');
        } else {
            // Create a new project if none exists
            $project = new Project();
            $project->name = $request->input('name');
            $project->data = $projectData;
            $project->user_id = Auth::id();
            $project->save();

            return redirect()->route('dashboard')->with('success', 'New project created successfully.');
        }

        //return redirect()->route('dashboard')->with('success', 'Project created successfully.');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);

        // Retrieve the timezone from the config
        $timezone = config('app.timezone', 'Asia/Kolkata');

        // Convert the created_at and updated_at fields to the configured timezone
        $createdAt = new \DateTime($project->created_at, new \DateTimeZone('Asia/Kolkata'));
        $createdAt->setTimezone(new \DateTimeZone($timezone));
        $project->created_at = $createdAt->format('Y-m-d H:i:s');

        $updatedAt = new \DateTime($project->updated_at, new \DateTimeZone('Asia/Kolkata'));
        $updatedAt->setTimezone(new \DateTimeZone($timezone));
        $project->updated_at = $updatedAt->format('Y-m-d H:i:s');

        return view('projects.show', compact('project'));
    }
}