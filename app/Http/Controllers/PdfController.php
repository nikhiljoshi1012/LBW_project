<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log; // this line to import the Log class

class PdfController extends Controller
{
    public function downloadPdf($id)
    {
        // Retrieve the specific data from the database
        $project = Project::findOrFail($id);
        $output = isset($project->output) ? json_decode($project->output, true) : null; // Ensure output is set

        $data = [
            'project' => $project,
            'title' => 'Project Details',
            'date' => date('m/d/Y'),
            'output' => $output // Pass output to the view
        ];
        Log::debug('Output data', ['output' => $output]);

        $pdf = Pdf::loadView('projects.generate-product-pdf', $data);
        return $pdf->download('project-' . $project->id . '.pdf');
    }
    
}
