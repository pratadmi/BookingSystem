<?php
require __DIR__.'/../lib/vendor/autoload.php';

class Calendar {

	var $service;
	var $calendarId;

	function __construct($client, $calendarId) {
		date_default_timezone_set('Europe/Prague');

		$this->service = new Google_Service_Calendar($client);
		$this->calendarId = $calendarId;
	}

	function getEvent($eventId) {
		try {
			$response = $this->service->events->get($this->calendarId, $eventId);
			return $response;
		} catch(Google_Service_Exception $e) {
			return $e->getMessage();
		}	
	}

	function addEvent($data) {
		$event = new Google_Service_Calendar_Event(array(
		  'id' => $data['id'],
		  'colorId' => $data['colorId'], //green color of event
	      'summary' => $data['summary'],
	      'description' => $data['description'],
	      'start' => array(
	        'dateTime' => $data['start_datetime']   
	      ),
	      'end' => array(
	        'dateTime' => $data['end_datetime']
	      ),  
	      'reminders' => array(
	        'useDefault' => FALSE,
	        'overrides' => array(
	          // array('method' => 'email', 'minutes' => 24 * 60),
	          array('method' => 'popup', 'minutes' => 10)
	        )
	      )
	    ));

		$this->service->events->insert($this->calendarId, $event);
	}

	//delete event 
	function deleteEvent($eventId) {
		try {
			$response = $this->service->events->delete($this->calendarId, $eventId);
			return $response;
		} catch(Google_Service_Exception $e) {
			return $e->getMessage();
		}
	}

	function updateEvent($eventId, $data) {
		try {
			$event = new Google_Service_Calendar_Event(array(
			  'id' => $data['id'],
			  'colorId' => "2", //green color of event
		      'summary' => $data['summary'],
		      'description' => $data['description'],
		      'start' => array(
		        'dateTime' => $data['start_datetime']   
		      ),
		      'end' => array(
		        'dateTime' => $data['end_datetime']
		      ),  
		      'reminders' => array(
		        'useDefault' => FALSE,
		        'overrides' => array(
		          // array('method' => 'email', 'minutes' => 24 * 60),
		          array('method' => 'popup', 'minutes' => 10)
		        )
		      )
		    ));

			$response = $this->service->events->update($this->calendarId, $eventId, $event);
			return $response;
		} catch(Google_Service_Exception $e) {
			return $e->getMessage();
		}
	}

	//TEST FUNCTION
	function getListEvents($date) {
		$optParams = array(
			'maxResults' => 20,
			'orderBy' => 'startTime',
			'singleEvents' => true,
			'timeMin' => date('c', strtotime($date)),
			'showDeleted' => true
		);

		$results = $this->service->events->listEvents($this->calendarId, $optParams);

		$view = array();

		foreach ($results->getItems() as $event) {
			$start = $event->start->dateTime;
			if (empty($start)) {
				$start = $event->start->date;
			}

			$view[] = $event->getSummary() . ' : ' . $start;
		}

		return $view;
	}
}

?>