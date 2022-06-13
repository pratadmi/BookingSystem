<?php

class Service {
	var $name_service;
	var $name_service_title;
	var $players = array();
	var $min_players;
	var $duration;
	var $price;
	var $url_preview;
	var $url;
	var $langs = array();

	function __construct($name_service, $max_players, $min_players, $duration, $price, $url_preview, $url) {
		$this->name_service = $name_service;
		$this->name_service_title = str_replace('_', ' ', $name_service);
		$this->min_players = $min_players;
		$this->addDuration($duration);
		$this->price = $price;
		$this->url_preview = $url_preview;
		$this->url = $url;
		$this->addArrayPlayers($max_players);
	}

	function addDuration($duration) {
		$this->duration = $duration;
		
	}

	function addLangs($langs) {
		for($i = 0; $i < sizeof($langs); $i++) {
			$this->langs[] = $this->getLang($langs[$i]->lang);
		}
	}

	function addArrayPlayers($max_players) {
		for($i = $this->min_players; $i <= $max_players; $i++) {
			$this->players[] = $i;
		}
	}

	function getLang($lang) {
		switch ($lang) {
			case 'CZK':
				return 'Czech';
				break;
			case 'ENG':
				return 'English';
				break;
			case 'RUS':
				return 'Russian';
				break;
			default:
				return 'lang not found';
				break;
		}
	}

}

?>