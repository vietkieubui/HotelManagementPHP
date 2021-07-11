<?php
    include ('db.php'); 
	$id =$_GET['id'];		
	$newsql ="DELETE FROM room WHERE roomid ='$id' ";
	if(mysqli_query($conn,$newsql))
	{}
	header("Location: room.php");
		
?>