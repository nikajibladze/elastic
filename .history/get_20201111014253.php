<?php 
require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$params = [
    'index' => 'my_index',
    'id'    => 'my_id'
];

$response = $client->get($params);
print_r($response);
?>