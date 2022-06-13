<?php

require_once('UpdateSheets.php');
$str = 'Тестовая строка sadasdadasd';

$updSheets = new UpdateSheets();
$updSheets->update([$str]);

?>