<?php 
require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$array=array();
$response = $client->search([
    'index' => 'documentebi2',
    'body'  => [
        "query"=> [
            "bool"=>  [
              "must"=> [
                ["match"=>  [ "text"=> "Et Co" ]],
                //,[ "match"=>  [ "id"=>  802 ]]
              
              ],
              "sort"=> [  
                ["date"=> ["order"=> "desc"]]
                
            ]
              
              ]
             
              ]
    ]
]);
$result=$response["hits"]["hits"];
foreach($result as $values){
 
$array[]= $values["_source"]["id"];
}
print_r($array);
?>