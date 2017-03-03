<?php

$allowed = [
	'bootstrap-style/bootstrap3.nextras.datagrid.css' => true,
	'js/nextras.datagrid.js' => true,
];

if (!isset($allowed[$_GET['f']])) {
	header("HTTP/1.0 404 Not Found");
	exit;
}

$file = __DIR__ . '/../vendor/nextras/datagrid/' . $_GET['f'];
if (strpos($file, '.css') !== FALSE) {
	header('Content-type: text/css', TRUE);
} elseif (strpos($file, '.js') !== FALSE) {
	header('Content-type: application/javascript', TRUE);
}

echo file_get_contents($file);
