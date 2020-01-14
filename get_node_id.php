<?php
include './iot/conn.php';
$mac=$_GET["mac"];
$sql = "SELECT node_id FROM node_data WHERE mac='".$mac."' LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
		echo "node_id:";
        echo $row["node_id"];
	
}
?>