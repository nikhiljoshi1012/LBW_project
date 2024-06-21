<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class PdfController extends Controller
{
    public function downloadPdf($id)
    {
        // Retrieve the specific data from the database
        $project = Project::findOrFail($id);
        Log::debug('Project retrieved', ['project' => $project]);

        $data = $project->data;
        Log::debug('Data', ['data' => $data]);

        $pdfData = [
            'project' => $project,
            'title' => 'Project Details',
            'date' => date('m/d/Y'),
            'output' => $data // Pass data to the view
        ];

        $pdf = Pdf::loadView('projects.generate-product-pdf', $pdfData);
        return $pdf->download('project-' . $project->id . '.pdf');
    }
}