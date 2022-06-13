<?php
require __DIR__.'/../lib/vendor/autoload.php';
require __DIR__.'/PhpMimeClient.php';

class Mail {
	var $service;
	var $email;
	var $bkcode;

	function __construct($client, $email, $bkcode) {
		date_default_timezone_set('Europe/Prague');

		//$this->service = new Google_Service_Gmail($client);
		$this->email = $email;
		$this->bkcode = $bkcode;
		

	}

	function sendMail($data) {

		switch ($this->bkcode) {
			case 'TR':
				sendMailTR($data);
				break;
			
			default:
				# code...
				break;
		}

	}


	function sendMailTR($data){
		$this->service = new Google_Service_Gmail($client);
		$mime_client = new PhpMimeClient();
		$mime_client->addTo($data['email_client'], $data['name_client']);
		$mime_client->addTo($this->email, $data['name']);
		// create mime
		$mime_client->createMime($data['name'],
							     $this->email,
							     $data['title'],
							     $this->getBody($data), 
							     $this->email);
		// get mime
		$mime = rtrim(strtr(base64_encode($mime_client->getMime()), '+/', '-_'), '=');

		$msg = new Google_Service_Gmail_Message();
	    $msg->setRaw($mime);

		$message_sent = $this->service->users_messages->send($this->email, $msg);

		return $message_sent->getId();

	}
	//COSMOS http://drive.google.com/uc?id=173I9ZagiEzKNOVAkvJvuFXTsdoZUbIcy
	//MH http://drive.google.com/uc?id=18QKBwgdVn8WCVCSdGRwnJwwv5We0x_G3
	function getBody($data) {
		$body = $data['body'];
		$game_pic = 'http://drive.google.com/uc?id=18QKBwgdVn8WCVCSdGRwnJwwv5We0x_G3';
		if ($data['game_name'] === 'Cosmos') {
		  $game_pic = 'http://drive.google.com/uc?id=173I9ZagiEzKNOVAkvJvuFXTsdoZUbIcy';
		}
		$vars = array(
			'{game_name}' => preg_replace('/\s+/', ' ', $data['game_name']),
			'{lang}' => $data['lang'],
			'{players}' => $data['players'],
			'{date_mail}' => $data['date_mail'],
			'{time_mail}' => $data['time_mail'],
  			'{delete_link}' => $data['delete_link'],
  			'{total_cost}' => $data['total_cost'],
  			'{voucher_code}' => $data['voucher_code'],
  			//MAIL PICTURES HERE; make link here: http://kolorobot.github.io/permalink/; pic should be shared for everyone copy link pictures here: https://drive.google.com/drive/folders/1LxM_2Gx1drqf4uuAyrWlg7vX9_N5dYL-?ogsrc=32 	 
  			//GIF animated logo http://drive.google.com/uc?id=1F9quKYwNWDPhJkbW5fszKS8OuWoMi6xH
  			'{poster_pic}' => 'http://drive.google.com/uc?id=1GzYUwFuqvRN_NoYH59MJ2EhSB3M4Yqqj',
  			'{logo_pic}' => 'http://drive.google.com/uc?id=12r9LGWQDawkogpXzGxFxyw4dcHBOz4od',
  			'{fb_pic}' => 'http://drive.google.com/uc?id=1D3DPd8tDbRCNS1fLv1OGkNZyqgxS568U',
  			'{insta_pic}' => 'http://drive.google.com/uc?id=1uXxQ202Zp6qru5x5n7Dpe2CPCzLCxvwl',
  			'{game_pic}' => $game_pic
		);

		return strtr($body, $vars);
	}
}

?>