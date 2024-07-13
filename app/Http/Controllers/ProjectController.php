<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Log;
use App\Models\User;
class ProjectController extends Controller
{
    public function index()
    {
        // Show only the projects that belong to the authenticated user
        $projects = Project::where('user_id', Auth::id())->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('raaga_taal'); //TODO : Change the view name to a more systematic name
    }

    public function store(Request $request)
    {
        // Log the received request data
        Log::debug('Request received in store method', ['request' => $request->all()]);
    
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'project_data' => 'required|string', // Validate project_data as string
        ]);
    
        // Decode JSON data
        $projectData = json_decode($request->input('project_data'), true);
    
        // Create a new project
        $project = new Project();
        $project->name = $request->input('name');
        $project->data = $projectData; // Store decoded data
        $project->user_id = Auth::id(); // Set the user ID for the project
        $project->save();
    
        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Project created successfully.');
    }
    

 
    public function show($id)
    {
        $project = Project::findOrFail($id);

        // Retrieve the timezone from the config
        $timezone = config('app.timezone', 'Asia/Kolkata');

        // Convert the created_at and updated_at fields to the configured timezone
        $createdAt = new \DateTime($project->created_at, new \DateTimeZone('UTC'));
        $createdAt->setTimezone(new \DateTimeZone($timezone));
        $formattedCreatedAt = $createdAt->format('d-m-Y');

        $updatedAt = new \DateTime($project->updated_at, new \DateTimeZone('UTC'));
        $updatedAt->setTimezone(new \DateTimeZone($timezone));
        $formattedUpdatedAt = $updatedAt->format('d-m-Y');

        return view('projects.show', compact('id','project', 'formattedCreatedAt', 'formattedUpdatedAt'));
    
    }

    public function downloadPdf($id)
    {
        $project = Project::findOrFail($id);

        if (isset($project->output)) {
            $output = json_decode($project->output, true);
        } else {
            $output = null;
        }

        $pdf = Pdf::loadView('projects.generate-product-pdf', compact('project', 'output'));
        Log::info('Output: ' . print_r($output, true));
        return $pdf->download('project-' . $project->id . '.pdf');
    }

    public function showWelcomePage()
    {
        // Assuming you're using Laravel's authentication
        $user = auth()->user(); // Get the currently authenticated user
        
        if ($user) {
            // Pass the user's name to the view
            return view('index', ['name' => $user->name]);
        } else {
            // Handle the case where no user is authenticated
            return view('index', ['name' => 'Guest']);
        }
    }
    
}