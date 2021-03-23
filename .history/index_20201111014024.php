<?php 
require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();


$params = [
    'index' => 'my_index',
    'id'    => 'my_id',
    'body'  => ['testField' => 'abc']
];

$response = $client->index($params);
print_r($response);
?>