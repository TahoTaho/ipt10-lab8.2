<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class TextFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $output = "Name: " . $profile->getName() . PHP_EOL;
        
        // Birth information
        $output .= "Birth Date: " . $profile->getBirth()['date'] . PHP_EOL;
        $output .= "Birth Event: " . $profile->getBirth()['event'] . PHP_EOL;

        // Childhood information
        $output .= "Childhood Description: " . $profile->getChildhood()['description'] . PHP_EOL;
        $output .= "Achievements: " . implode(", ", $profile->getChildhood()['achievements']) . PHP_EOL;

        // Education
        $education = $profile->getEducation();
        $output .= "Education: " . $education['degree'] . " from " . $education['college'] . " (Graduated in " . $education['graduation_year'] . ")" . PHP_EOL;
        $output .= "Motivation: " . $education['motivation'] . PHP_EOL;

        // Career
        $career = $profile->getCareer();
        $output .= "Career Dream: " . $career['dream'] . PHP_EOL;
        
        // Initial School
        $initialSchool = $career['initial_school'];
        $output .= "Initial School: " . $initialSchool['name'] . " (Founded: " . $initialSchool['founded'] . ")" . PHP_EOL;
        $output .= "Location: " . $initialSchool['location']['current_site'] . PHP_EOL;

        // Challenges
        $output .= "Challenges: " . $career['challenges']['issue'] . " - " . $career['challenges']['result'] . PHP_EOL;

        // Second Attempt
        $secondAttempt = $career['second_attempt'];
        $output .= "Second Attempt: " . $secondAttempt['school_name'] . " (Reestablished on: " . $secondAttempt['reestablished_date'] . ")" . PHP_EOL;
        $output .= "Help: " . $secondAttempt['help'] . PHP_EOL;

        // Opening day incident
        $output .= "Opening Day Incident: " . $secondAttempt['opening_day_incident']['event'] . " - Impact: " . $secondAttempt['opening_day_incident']['impact'] . PHP_EOL;

        // Philanthropy
        $output .= "Philanthropy: Offered " . $secondAttempt['philanthropy']['free_tuition'] . " and scholarships to fire victims." . PHP_EOL;

        // Legacy
        $legacy = $profile->getLegacy();
        $output .= "Character: " . $legacy['character'] . PHP_EOL;
        $output .= "Resolve: " . $legacy['resolve'] . PHP_EOL;

        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text');
        return $this->response;
    }
}
