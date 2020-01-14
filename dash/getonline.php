<?php
include 'conn.php';

$sql = "SELECT mac,serial_no,last_online from node_data";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$updated_time=$row["last_online"];
		$current_time = date( 'Y-m-d H:i:s' );
		$diff=strtotime($current_time)-strtotime($updated_time);
		if($diff>15){
			$status="Offline";
			$boxbg="info-box bg-red hover-expand-effect";
		}else{
			$status="Online";
			$boxbg="info-box bg-green hover-expand-effect";
		}
		

		echo '<a href="./info_by_mac.php?mac='.$row["mac"].'">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="'.$boxbg.'"><div class="icon"><i class="material-icons">perm_data_setting</i></div><div class="content"><div class="text">'.$row["serial_no"].'</div><div class="number count-to">'.$status.'</div></div></div></div></a>';
	}
}

?>