<?php 
require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();


$response = $client->index($params);
print_r($response);
?>