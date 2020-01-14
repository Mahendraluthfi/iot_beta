<script>

function loadData() {
	
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("dashboard").innerHTML =
      this.responseText;
	  var d = new Date();
	  var n = d.toLocaleTimeString();
	  document.getElementById("time").innerHTML =n
    }
  };
  xhttp.open("GET", "./getonline.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhttp.send();
}
  
loadData();
setInterval(loadData, 2000);

</script>
<div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <div id="time" class="navbar-brand">  </div>
               <div class="navbar-brand"style="margin-top:-20px;overflow: visible;"> <h3>| MICA IoT Dashboard</h3></div>
               
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Time -->
                    <li class="dropdown">
                    
                    </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>

    