<?php

// do not use this on production!!!

$root = realpath(__DIR__ . '/../vendor/nextras/datagrid');
$file = $root . '/' . (isset($_GET['f']) ? $_GET['f'] : '');

if (preg_match('#\.\.#', $file) || !file_exists($file)) {
	header("HTTP/1.0 404 Not Found");
	exit;
}

if (strpos($file, '.css') !== FALSE) {
	header('Content-type: text/css', TRUE);
} elseif (strpos($file, '.js') !== FALSE) {
	header('Content-type: application/javascript', TRUE);
}

echo file_get_contents($file);
