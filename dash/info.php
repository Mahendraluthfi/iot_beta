<?php
include 'conn.php';

$sql = "SELECT DISTINCT mac FROM node_data order by mac";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<hr>";
		$mac=$row["mac"];
		echo "MAC:".$row["mac"]."<br>";
		
		$sql2 = "SELECT * FROM master_data WHERE mac='".$row["mac"]."' order by time desc limit 1";
		
		$result2 = $conn->query($sql2);
		
		//TODAY COUNT
		$sql_today = "SELECT COUNT(*) AS today FROM master_data WHERE mac='".$row["mac"]."' AND d2 IS NOT NULL AND time >= DATE(NOW())";
		$result_today = $conn->query($sql_today);
		if ($result_today->num_rows > 0) {
			$row_today = $result_today->fetch_assoc();
			$today_count=$row_today["today"];
		}
		
		//15 min COUNT
		$sql_min15 = "SELECT COUNT(*) AS min15 FROM master_data WHERE mac='".$row["mac"]."' AND d2 IS NOT NULL AND time >= DATE_ADD(NOW(), INTERVAL -15 MINUTE)";
		$result_min15 = $conn->query($sql_min15);
		if ($result_min15->num_rows > 0) {
			$row_min15 = $result_min15->fetch_assoc();
			$min15_count=$row_min15["min15"];
		}
		
		$sql_details="SELECT YEAR(time) AS 'year', 
		MONTH(time) AS 'month', 
		DAY(time) AS 'day', 
		COUNT(DISTINCT ts) AS 'data'
		FROM     master_data
		WHERE  MONTH(time)=MONTH(NOW()) AND (d2 > 6) AND mac='".$mac."'
		GROUP BY DAY(time), MONTH(time), YEAR(time)
		ORDER BY 'year', 'month', 'day'";
		$result_details = $conn->query($sql_details);
		if ($result_details->num_rows > 0) {
			echo "<table border='1'><tr><th>Year</th><th>Month</th><th>Day</th><th>Count</th><tr>";
			while($row_details = $result_details->fetch_assoc()) {
				echo "<tr>";
				$year=$row_details["year"];
				$month=$row_details["month"];
				$day=$row_details["day"];
				$data=$row_details["data"];
				echo "<td>";
				echo $year;
				echo "</td>";
				echo "<td>";
				echo $month;
				echo "</td>";
				echo "<td>";
				echo $day;
				echo "</td>";
				echo "<td>";
				echo $data;
				echo "</td>";
				echo "</tr>";
				
			}
			echo "</table>";
		}
		
		if ($result2->num_rows > 0) {
			
			while($row2 = $result2->fetch_assoc()) {
			
				
				echo "Last 15 Minute Count:".$min15_count."<br>";
				echo "Today Count:".$today_count."<br>";
			}
			echo "<hr>";
		}
	}
	
}

?>