<?php

namespace App\Events;
use \MaddHatter\LaravelFullcalendar\Calendar;

class MyCalendar extends Calendar {
	
	public function script()
    {
        $options = $this->getOptionsJson();

        return $this->view->make('calendar.script', [
            'id' => $this->getId(),
            'options' => $options,
        ]);
    }


}