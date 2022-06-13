<?php
require __DIR__.'/../lib/vendor/autoload.php';

class Authorize {
	var $client;

	function __construct($email) {
		$this->client = new Google_Client();	
		// putenv('GOOGLE_APPLICATION_CREDENTIALS='.__DIR__.'/secret/torchvrbk.json');
		$this->client->setAuthConfig(__DIR__.'/secret/torchvrbk.json');
		//$this->client->useApplicationDefaultCredentials();
		$this->client->setSubject($email);
		$this->client->addScope('https://www.googleapis.com/auth/calendar');
		$this->client->addScope('https://mail.google.com/');
		
	}
}

?>