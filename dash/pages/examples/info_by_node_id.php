<?php
include 'conn.php';
$node_id=$_GET["node_id"];
$date_comp=$_GET["date_comp"];

if($conn and isset($node_id)){
	$count_cycle=getCountCycle($node_id);
}
?>
<!DOCTYPE html>
<html>
<head>
  <?php
  include 'style.php';
  ?>
  <title>MICA IOT Dashboard</title>
</head>
<body class="theme-red">
<div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
<?php
  include 'nav_bar.php';
?>

<section class="content">
  <div class="card">
    <div class="header">
	
      <h2> 
	  <?php 
		echo "Node ID:".$node_id."<br>";
		?> 
</h2>
    </div>
        <div class="body">
            <!-- Widgets -->
            <div class="row clearfix">
			
<?php

//TODAY COUNT
include 'today_count.php';

//15 min COUNT
include 'min15_count.php';

//realtime date sql2
include 'realtime_data.php';

//info sql
include 'node_info.php';

//month data sql
include 'month_data.php';

//hour data
include 'hour_data.php';

?>

Manufacturer:<?php echo $manufacturer;?><br>
Serial No:<?php echo $serial_no;?><br>
Last 15 Minute Count:<?php echo round($min15_count/$count_cycle,1);?><br>
Today Count:<?php echo round($today_count/$count_cycle,1);?><br>
<hr>

<h2>Realtime Machine Time Chart</h2>
<canvas id="machineChart" width="70%" height="10%" ></canvas>

<hr>
<h2>Realtime Output Cycle Time Chart </h2>
<canvas id="realChart" width="70%" height="10%" ></canvas>
<hr>
<h2>Today Hour Count Chart</h2>

<canvas id="hourChart" width="70%" height="10%" ></canvas>
<hr>


<form action="#" method="get">
				<input type="hidden" name="node_id" value="<?php echo $node_id;?>">
				<input type="month" name="date_comp" value=
				<?php 
				if(isset($date_comp)){
					echo '"'.$date_comp.'"';
				}else{
					echo '"'.date("Y-m").'"';
				}
				?>>
				<input type="submit" name="Submit" value="Submit">
</form>



<h2>Month Count Chart </h2>
<canvas id="countChart" width="70%" height="10%" ></canvas>
              
            </div>
        </div>


  </div>
  <?php echo '<a href="./settings_node.php?node_id='.$node_id.'">Node Settings</a><br>';?>
  <?php echo '<a href="./settings_add_node.php">Add Node</a><br>';?>
</section>
<hr>


<?php
  include 'script.php';
?>

 <?php include 'charts_data.php';?>
 
 <script>
var options = {
			animation: false,
			//Boolean - If we want to override with a hard coded scale
			scaleOverride: false,
			//** Required if scaleOverride is true **
			//Number - The number of steps in a hard coded scale
			scaleSteps: 10,
			//Number - The value jump in the hard coded scale
			scaleStepWidth: 10,
			//Number - The scale starting value
			scaleStartValue: 0,
			scaleBeginAtZero : true,
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
};
function getValue(){

const url = 'getrealdata.php?node_id=<?php echo $node_id;?>';		 
  fetch(url)
  .then(res => {
    if (!res.ok) {
      throw new Error(res.statusText);
    };
    return res.json();
  })
  .then(data1 => {
		data_temp= {
        labels: [""],
        datasets: [{
            label: 'Count',
            data: [""],
			borderColor: 'rgba(233, 30, 99, 0.75)',
			backgroundColor: 'rgba(233, 30, 99, 0.3)',
			pointBorderColor: 'rgba(233, 30, 99, 0)',
			pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
			pointBorderWidth: 1,
            borderWidth: 1,
			fill:false,
        }]
		}
		
		data_temp.datasets[0].data.pop()
		data_temp.labels.pop()
	for (x in data1) {
		data_temp.datasets[0].data.push(data1[x]);
		data_temp.labels.push(x.toString());
		var myLineChart = new Chart(ctx_real_cycle, {
			type: "line",
			data: data_temp,
			options: options
		});
   }  
  }).catch(error => console.log("fetch error"));	
}

function getMachineValue(){

const url = 'getrealdata_machine.php?node_id=<?php echo $node_id;?>';		 
  fetch(url)
  .then(res => {
    if (!res.ok) {
      throw new Error(res.statusText);
    };
    return res.json();
  })
  .then(data1 => {
		data_temp= {
        labels: [""],
        datasets: [{
            label: 'Count',
            data: [""],
			borderColor: 'rgba(233, 30, 99, 0.75)',
			backgroundColor: 'rgba(233, 30, 99, 0.3)',
			pointBorderColor: 'rgba(233, 30, 99, 0)',
			pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
			pointBorderWidth: 1,
            borderWidth: 1,
			fill:false
			
        }]
		}
		
		data_temp.datasets[0].data.pop()
		data_temp.labels.pop()
	for (x in data1) {
		
		data_temp.datasets[0].data.push(data1[x]);
		//
		
		data_temp.labels.push(x.toString());
		//
		
		var myLineChart = new Chart(ctx_machine, {
			type: "line",
			data: data_temp,
			options: options
		});
   }  
    //data_temp.datasets[0].data.shift();
	//data_temp.labels.shift()
  }).catch(error => console.log("fetch error"));	
}
setInterval(getMachineValue,2000);
setInterval(getValue,2000);
</script>



  </body>
</html>
<?php $conn->close();?>