<?php 
require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();


$params = [
    'index' => 'index',
    'id'    => 'my_id',
    'body'  => ['name' => 'vaxo']
];

$response = $client->index($params);
print_r($response);
?>