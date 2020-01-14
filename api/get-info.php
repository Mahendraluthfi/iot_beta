<?php
include_once( './../iot/conn.php');
//include './../conn.php';
//require_once( './../session_test.php');

$node_id=$_GET["node_id"];
$count=0;
$data_arr=array();
$data_arr["records"]=array();
$sql = "SELECT COUNT(DISTINCT time) AS today FROM realtime_data WHERE node_id=".$node_id." AND function='d2' AND time >= DATE(NOW()) AND time <= DATE_ADD(NOW(),INTERVAL 1 DAY)";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	//$firmware=$row['firmware'];
	$count=$row['today'];
}
$count_cycle=getCountCycle($node_id);
$count_str=round($count/$count_cycle,1);
$data_item=array(
	"count" => ''.$count_str.''
);
 
array_push($data_arr["records"], $data_item);
$json=json_encode($data_arr);
http_response_code(200);
echo $json;

?>

<?php $conn->close();?>