<?php
include_once( './../iot/conn.php');
//include './../conn.php';
//require_once( './../session_test.php');

$mac=$_GET["mac"];

$data_arr=array();
$data_arr["records"]=array();
$firmware="";
$node_id="";
	
$sql = "SELECT * FROM node_data WHERE mac='".$mac."' LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$firmware=$row['firmware'];
	$node_id=$row['node_id'];
	
}
//date_default_timezone_set("Asia/Colombo");
date_default_timezone_set("UTC"); 
//$dateTime=date_create("now",timezone_open("Asia/Colombo"));
$data_item=array(
	"node_id" => $node_id,
	"firmware" => $firmware,
	"time" => ''.time().''
);
 
array_push($data_arr["records"], $data_item);
$json=json_encode($data_arr);
http_response_code(200);
echo $json;

?>

<?php $conn->close();?>