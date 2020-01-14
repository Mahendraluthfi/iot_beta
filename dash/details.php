<?php
include 'conn.php';

$sql = "SELECT DISTINCT mac FROM node_data order by mac";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$sql2 = "SELECT * FROM master_data WHERE mac='".$row["mac"]."' order by time desc limit 1";
		
		$result2 = $conn->query($sql2);
		if ($result2->num_rows > 0) {
			echo "<hr>";
			while($row2 = $result2->fetch_assoc()) {
			
				echo "MAC:".$row["mac"]."<br>";
				echo "d1:".$row2["d1"]."<br>";
				echo "d2:".$row2["d2"]."<br>";
				echo "d3:".$row2["d3"]."<br>";
				echo "d4:".$row2["d4"]."<br>";
				echo "time:".$row2["time"]."<br>";
			}
			echo "<hr>";
		}
	}
	
}

?>