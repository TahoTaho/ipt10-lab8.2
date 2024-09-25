<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class HTMLFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $output = "<h1>Profile of " . $profile->getName() . "</h1>";
        
        // Birth Information
        $output .= "<h2>Birth Information</h2>";
        $output .= "<p>Birth Date: " . $profile->getBirth()['date'] . "</p>";
        $output .= "<p>Birth Event: " . $profile->getBirth()['event'] . "</p>";

        // Childhood Information
        $output .= "<h2>Childhood</h2>";
        $output .= "<p>Description: " . $profile->getChildhood()['description'] . "</p>";
        $output .= "<p>Achievements: " . implode(", ", $profile->getChildhood()['achievements']) . "</p>";

        // Education
        $education = $profile->getEducation();
        $output .= "<h2>Education</h2>";
        $output .= "<p>" . $education['degree'] . " from " . $education['college'] . " (Graduated in " . $education['graduation_year'] . ")</p>";
        $output .= "<p>Motivation: " . $education['motivation'] . "</p>";

        // Career Information
        $career = $profile->getCareer();
        $output .= "<h2>Career Dream</h2>";
        $output .= "<p>" . $career['dream'] . "</p>";

        // Initial School
        $initialSchool = $career['initial_school'];
        $output .= "<h2>Initial School</h2>";
        $output .= "<p>" . $initialSchool['name'] . " (Founded: " . $initialSchool['founded'] . ")</p>";
        $output .= "<p>Location: " . $initialSchool['location']['current_site'] . "</p>";

        // Challenges
        $output .= "<h2>Challenges</h2>";
        $output .= "<p>" . $career['challenges']['issue'] . " - " . $career['challenges']['result'] . "</p>";

        // Second Attempt
        $secondAttempt = $career['second_attempt'];
        $output .= "<h2>Second Attempt</h2>";
        $output .= "<p>" . $secondAttempt['school_name'] . " (Reestablished on: " . $secondAttempt['reestablished_date'] . ")</p>";
        $output .= "<p>Help: " . $secondAttempt['help'] . "</p>";

        // Opening Day Incident
        $output .= "<h2>Opening Day Incident</h2>";
        $output .= "<p>" . $secondAttempt['opening_day_incident']['event'] . " - Impact: " . $secondAttempt['opening_day_incident']['impact'] . "</p>";

        // Philanthropy
        $output .= "<h2>Philanthropy</h2>";
        $output .= "<p>Offered " . $secondAttempt['philanthropy']['free_tuition'] . " and scholarships to fire victims.</p>";

        // Legacy
        $legacy = $profile->getLegacy();
        $output .= "<h2>Legacy</h2>";
        $output .= "<p>Character: " . $legacy['character'] . "</p>";
        $output .= "<p>Resolve: " . $legacy['resolve'] . "</p>";

        $this->response = $output;
    }
    
    public function render()
    {
        return $this->response;
    }
}
