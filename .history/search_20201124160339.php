<?php 
require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$array=array();
$response = $client->search([
    'index' => 'docs',
    'body'  => [
        "query"=> [
            "bool"=>  [
              "must"=> [
                ["match"=>  [ "name"=> "tND3n" ]],
                //,[ "match"=>  [ "id"=>  802 ]]
              ]
              
              ]
             
              ]
    ]
]);
$result=$response["hits"]["hits"];
foreach($result as $values){
 
$array[]= $values["_source"]["id"];
}
$ids=implode(",",$array);
echo $ids;
/*

,
              "sort"=> [  
                ["date"=> ["order"=> "desc"]]
            ]
*/
?>