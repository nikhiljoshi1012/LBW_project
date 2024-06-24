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
        $name=$project->name;
        $data = $project->data;
        Log::debug('Data', ['data' => $data]);

        $pdfData = [
            'project' => $project,
            'title' => $name,
            'date' => date('m/d/Y'),
            'output' => $data // Pass data to the view
        ];

        $pdf = Pdf::loadView('projects.generate-product-pdf', $pdfData);
       

        // Add the watermark
        $canvas = $pdf->getCanvas();
        $fontMetrics = new \Dompdf\FontMetrics($canvas, $pdf->getOptions());
        $w = $canvas->get_width();
        $h = $canvas->get_height();
        $font = $fontMetrics->getFont('times');
        $text = "LBW";
        $txtHeight = $fontMetrics->getFontHeight($font, 70);
        $textWidth = $fontMetrics->getTextWidth($text, $font, 70);
        
        // Set text opacity
        $canvas->set_opacity(.2);
        
        // Specify horizontal and vertical position
        $x = (($w - $textWidth) / 2);
        $y = (($h - $txtHeight) / 2);
        
        // Writes text at the specified x and y coordinates
        $canvas->text($x, $y, $text, $font, 75);
        
        return $pdf->download('project-' . $project->id . '.pdf');
    }
}