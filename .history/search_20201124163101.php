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
                ["match"=>  [ "name"=> "S5JYY" ]],
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


$select_document=$db->prepare("SELECT * from document where id IN ($id)");
$select_document->execute();
while($result=$select_document->fetch()){
var_dump($result);
}
/*

,
              "sort"=> [  
                ["date"=> ["order"=> "desc"]]
            ]
*/
?>