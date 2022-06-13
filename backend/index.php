<?php
require __DIR__.'/view/Json.php';
require __DIR__.'/lib/vendor/autoload.php';

$config = ['settings' => [
    'addContentLengthHeader' => false,
]];

$app = new Slim\App($config);

$app->get('/services', function ($request, $response, $args) {

	$json = new Json();

	$response->
		getBody()->
			write($json->getServices());
});


$app->get('/serviceMH', function ($request, $response, $args) {

	$json = new Json();

	$response->
		getBody()->
			write($json->getServiceByName("Mind_Horror"));
});

$app->get('/serviceVRT', function ($request, $response, $args) {

	$json = new Json();

	$response->
		getBody()->
			write($json->getServiceByName("Virtualizer"));
});



//get reservations = /reservations?game=1&amount=2
$app->get('/reservations', function ($request, $response, $args) {
	$game_name = $request->getQueryParam('game');
	$amount_players = (int)$request->getQueryParam('amount');

	///NEW!!!!!!!!!
	$date = $request->getQueryParam('date');

	$json = new Json();

	$response->
		getBody()->
			write($json->getReservations($game_name, $amount_players, $date));
});

//insert reservations = /reservation
$app->post('/reservation', function ($request, $response, $args) {
	$data = $request->getParsedBody();
	
	$json = new Json();
	$status = $json->saveReservation($data);
	$response->getBody()->write($status);
});

//delete {reservation} = /delete?reserv=abcd&lang=czk
$app->get('/delete', function ($request, $response, $args) {
    $unique_id = $request->getQueryParam('reserv');
    $lang = $request->getQueryParam('lang');
	
	$json = new Json();
	$status = $json->deleteReservation($unique_id, $lang);

	$response->getBody()->write($status);
});

$app->run();

?>
