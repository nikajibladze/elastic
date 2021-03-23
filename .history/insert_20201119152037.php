<?php 
require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();


$params = [
    'index'     => 'my_index',
    'id'        => 'my_id',
    'routing'   => 'company_xyz',
    'timestamp' => strtotime("-1d"),
    'body'      => [ 'testField' => 'abc']
];


$response = $client->index($params);
?>