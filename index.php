<?php
header('Location:/iot/index.php',true);
exit();
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
      <h2> Current Machines </h2>
    </div>
        <div class="body">
            

            <!-- Widgets -->
            <div class="row clearfix">
              <div id="dashboard">
              </div>
            </div>
        </div>


  </div>
</section>

    
<hr>

    
<?php
  include 'script.php';
  include 'conn.php';
  $location="all";
  if(isset($_GET["location"])){
	$location=safe($_GET["location"]);
  }
  ?>
  <script>
  function loadData() {
	
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("dashboard").innerHTML =
      this.responseText;
	
    }
  };
  xhttp.open("GET", "./getonline.php?location=<?php echo $location;?>", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhttp.send();
  setTimeout(loadData, 5000);
}
  
setTimeout(loadData, 100);
//setInterval(loadData, 5000);
</script>
  </body>
</html>
