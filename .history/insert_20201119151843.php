<?php 
require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();


$params = [
    'index' => 'indexi',
    'id'    => 'my_id2',
    'body'  => ['name' => 'vaxo']
];

$response = $client->index($params);
print_r($response);
?>