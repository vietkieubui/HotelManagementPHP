<?php 
    include ('db.php'); 
    $id =$_GET['id'];
    $delete_service_registration = "DELETE FROM `serviceregistration` WHERE id='$id'";
    if(mysqli_query($conn,$delete_service_registration)){
        echo "<script language='javascript' type='text/javascript'> alert('Delete success!') </script>";
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>