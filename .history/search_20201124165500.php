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
              "should"=> [
                ["prefix"=>  [ "name"=> "nika123" ]],
                //,[ "match"=>  [ "id"=>  802 ]]
              ]
              
              ]
              'sort' => [
                'name' => [
                    ['order' => 'asc']
                ]
            ]
             
              ]
    ]
]);
$result=$response["hits"]["hits"];
foreach($result as $values){
 
$array[]= $values["_source"]["id"];
}
echo $ids=implode(",",$array);

echo "<hr>";

$select_document=$db->prepare("SELECT 
document.id, 
motion.date as motion_date
FROM document
INNER JOIN motion 
ON document.id=motion.document_id 
WHERE document.id IN ($ids) and motion.target_id=2 and motion.filed1='ledi'");
$select_document->execute();
while($result=$select_document->fetch()){
echo $result["motion_date"];
}
/*

,
              "sort"=> [  
                ["date"=> ["order"=> "desc"]]
            ]
*/
?>