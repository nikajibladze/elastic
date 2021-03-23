<?php 
session_start();
require 'vendor/autoload.php';

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'documents');
function getDB() 
{
$dbhost=DB_SERVER;
$dbuser=DB_USERNAME;
$dbpass=DB_PASSWORD;
$dbname=DB_DATABASE;
try {
$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass); 
$dbConnection->exec("set names utf8");
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $dbConnection;
}
catch (PDOException $e) {
echo 'Connection failed #: ' . $e->getMessage();
}
}

$db=getDB();
use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

$array=array();
$response = $client->search([
    'index' => 'docs',
    'body'  => [
        "query"=> [
            "bool"=>  [
              "phrase"=> [
                ["match"=>  [ "name"=> "nika123" ]],
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


$select_document=$db->prepare("SELECT * from document where id IN ($ids)");
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