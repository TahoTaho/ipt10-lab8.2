<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;
use Fpdf\Fpdf;

class PDFFormat implements ProfileFormatter
{
    private $pdf;

    public function setData($profile)
    {
        $this->pdf = new Fpdf();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
        
        // Add Image
        $this->addImage('https://www.auf.edu.ph/images/articles/bya.jpg');

        // Move the cursor below the image (adjust the Y position)
        $this->pdf->SetY(60);

        $this->pdf->Cell(0, 10, 'Profile of ' . $profile->getName(), 0, 1, 'C');
        $this->pdf->SetFont('Arial', '', 12);

        // Birth information
        $this->pdf->MultiCell(0, 10, 'Birth Date: ' . $profile->getBirth()['date']);
        $this->pdf->MultiCell(0, 10, 'Birth Event: ' . $profile->getBirth()['event']);

        // Childhood information
        $this->pdf->MultiCell(0, 10, 'Childhood Description: ' . $profile->getChildhood()['description']);
        $this->pdf->MultiCell(0, 10, 'Achievements: ' . implode(", ", $profile->getChildhood()['achievements']));

        // Education
        $education = $profile->getEducation();
        $this->pdf->MultiCell(0, 10, 'Education: ' . $education['degree'] . ' from ' . $education['college'] . ' (Graduated in ' . $education['graduation_year'] . ')');
        $this->pdf->MultiCell(0, 10, 'Motivation: ' . $education['motivation']);

        // Career
        $career = $profile->getCareer();
        $this->pdf->MultiCell(0, 10, 'Career Dream: ' . $career['dream']);

        // Initial School
        $initialSchool = $career['initial_school'];
        $this->pdf->MultiCell(0, 10, 'Initial School: ' . $initialSchool['name'] . ' (Founded: ' . $initialSchool['founded'] . ')');
        $this->pdf->MultiCell(0, 10, 'Location: ' . $initialSchool['location']['current_site']);

        // Challenges
        $this->pdf->MultiCell(0, 10, 'Challenges: ' . $career['challenges']['issue'] . ' - ' . $career['challenges']['result']);

        // Second Attempt
        $secondAttempt = $career['second_attempt'];
        $this->pdf->MultiCell(0, 10, 'Second Attempt: ' . $secondAttempt['school_name'] . ' (Reestablished on: ' . $secondAttempt['reestablished_date'] . ')');
        $this->pdf->MultiCell(0, 10, 'Help: ' . $secondAttempt['help']);

        // Opening day incident
        $this->pdf->MultiCell(0, 10, 'Opening Day Incident: ' . $secondAttempt['opening_day_incident']['event'] . ' - Impact: ' . $secondAttempt['opening_day_incident']['impact']);

        // Philanthropy
        $this->pdf->MultiCell(0, 10, 'Philanthropy: Offered ' . $secondAttempt['philanthropy']['free_tuition'] . ' and scholarships to fire victims.');

        // Legacy
        $legacy = $profile->getLegacy();
        $this->pdf->MultiCell(0, 10, 'Character: ' . $legacy['character']);
        $this->pdf->MultiCell(0, 10, 'Resolve: ' . $legacy['resolve']);
    }

    public function addImage($imagePath)
    {
        // Set the position for the image
        $this->pdf->Image($imagePath, 10, 10, 40); // x, y, width (adjust as needed)
    }
    
    public function render()
    {
        // Output PDF to string (to save to file)
        return $this->pdf->Output();
    }
}
