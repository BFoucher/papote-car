<?php

namespace App\Domain\Journey;

use App\Entity\Journey;
use App\Entity\JourneyStep;

class JourneyStepHelper
{
    public function setStep(Journey $journey){
        $previousStep = null;
        foreach ($journey->getSteps() as $key => $step){
            if ($previousStep instanceof JourneyStep){
                $previousStep->setNextStep($step);
            }
            $previousStep = $step;
        }
    }
}