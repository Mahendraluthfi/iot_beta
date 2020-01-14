<?php
$timezone = timezone_open("America/Chicago"); 
  
// Displaying the offset of America/Chicago and Europe/Amsterdam 
$datetime_eur = date_create("now", timezone_open("Europe/Amsterdam")); 
echo $datetime_eur; 

?>
