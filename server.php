<?php require_once __DIR__ . '/vendor/autoload.php';
/**
 * This is test file on real http requests
 *
 * @author Shvorak Alexey <dr.emerido@gmail.com>
 * @version 0.0.1
 */
$server = new \Hope\Http\Server($_SERVER);

$request = $server->getRequest();
$response = $server->getResponse();

var_dump($server);