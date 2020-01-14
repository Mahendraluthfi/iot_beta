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
  
  ?>
  </body>
</html>
