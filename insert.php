<?php 
require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();


$params = [
    'index'     => 'my_index23',
    'id'        => 'my_id',

    'body'      => [ 'testField' => 'abc']
];
$response = $client->index($params);
?>