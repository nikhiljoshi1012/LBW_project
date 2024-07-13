<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;


class ProjectController extends Controller
{
   
    public function index()
    {
        // Show only the projects that belong to the authenticated user
        $projects = Project::where('user_id', Auth::id())->get();
        return view('projects.index', compact('projects'));
    }

    public function newUntitled()
    {
        $user = Auth::user();
        $projectNames = Project::where('user_id', $user->id)->pluck('name')->toArray();

        $untitledCount = 1;
        $newProjectName = 'Untitled';

        while (in_array($newProjectName, $projectNames)) {
            $newProjectName = 'Untitled ' . '(' . $untitledCount . ')';
            $untitledCount++;
        }

        return $newProjectName;
    }
    public function newCopy($pname)
    {
        $user = Auth::user();
        $projectNames = Project::where('user_id', $user->id)->pluck('name')->toArray();

        $pnameCount = 1;
        $newProjectName = $pname . ' (Copy)';

        while (in_array($newProjectName, $projectNames)) {
            $newProjectName = $pname . ' (Copy)' . '(' . $pnameCount . ')';
            $pnameCount++;
        }

        return $newProjectName;
    }

    public function copyProject($id)
    {
        $project = Project::findOrFail($id);
        
        if($project->visibility == 'private' && $project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
            return; 
        }

        $projectNames = Project::where('user_id', Auth::id())->pluck('name');
        $newProjectName = $this->newCopy($project->name);

        $newProject = new Project();
        $newProject->name = $newProjectName;
        $newProject->data = $project->data;
        $newProject->user_id = Auth::id();
        $newProject->save();

        return response()->json(['redirect' => route('projects.show', ['project' => $newProject->id])]);
    }

    public function create()
    {
        $projectNames = Project::where('user_id', Auth::id())->pluck('name');
        $project = new Project();
        $project->name = $this->newUntitled();
        $data = [
            "cells" => [],
            "rowCount" => 14,
            "columnCount" => 5
        ];
        $project->data = $data; // Store decoded data

        $project->user_id = Auth::id(); // Set the user ID for the project
        $project->save();

        $projectId = $project->id;
        echo $projectId;
        return redirect()->route('projects.show', ['project' => $project->id])->with('success', 'New project created successfully.');
        //TODO : Change the view name to a more systematic name
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

        $project = new Project();
        $project->name = $request->input('name');
        $project->data = $projectData; // Store decoded data
        $project->user_id = Auth::id(); // Set the user ID for the project
        $project->save();

        return redirect()->route('dashboard')->with('success', 'Project created successfully.');
    }

    public function setVisibility(Request $request, $id)
    {
        
        
        $project = Project::findOrFail($id);
        if($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
            return; 
        }
        $project->visibility = $request->input('visibility');
        $project->save();

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $Allprojects = Project::where('user_id', Auth::id())->get();
        $project = Project::findOrFail($id);
        

        if($project->visibility == 'private' && $project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
            return; 
        }
        // Retrieve the timezone from the config
        $timezone = config('app.timezone', 'Asia/Kolkata');

        // Convert the created_at and updated_at fields to the configured timezone
        $createdAt = new \DateTime($project->created_at, new \DateTimeZone('Asia/Kolkata'));
        $createdAt->setTimezone(new \DateTimeZone($timezone));
        $project->created_at = $createdAt->format('Y-m-d H:i:s');

        $updatedAt = new \DateTime($project->updated_at, new \DateTimeZone('Asia/Kolkata'));
        $updatedAt->setTimezone(new \DateTimeZone($timezone));
        $project->updated_at = $updatedAt->format('Y-m-d H:i:s');

        return view('projects.show', compact('project', 'Allprojects'));
    }

    public function update(Request $request, $id)
    {
        Log::debug('Request received in update method', ['request' => $request->all()]);
        $request->validate([
            'name' => 'required|string|max:255',
            'project_data' => 'required|string', // Assuming project_data is still a JSON string
        ]);


        $project = Project::findOrFail($id);
        
        

        // Ensure the authenticated user is the owner of the project
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
            return redirect()->route('dashboard')->with('error', 'Unauthorized action.');
        }

        // Decode JSON data
        $projectData = json_decode($request->input('project_data'), true);

        $project->name = $request->input('name');
        $project->data = $projectData; // Store decoded data
        $project->save();

        session()->flash('success', 'Project updated successfully.');
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        
        // Ensure the authenticated user is the owner of the project
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
            return redirect()->route('dashboard')->with('error', 'Unauthorized action.');
        }

        $project->delete();

        return redirect()->route('dashboard')->with('success', 'Project deleted successfully.');
    }
}
