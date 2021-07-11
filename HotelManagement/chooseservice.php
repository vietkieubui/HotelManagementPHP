<?php
    include ('db.php'); 
	$type = $_POST["selected"];
    $query_service="select * from service where type='".$type."'";
		
?>