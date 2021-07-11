<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
ob_start();
include ('db.php'); 
	$id =$_GET['id'];	
    $get_user_info ="SELECT* FROM login WHERE id ='$id' ";
    $get_user_info_result = mysqli_query($conn,$get_user_info);
    while($row = mysqli_fetch_array($get_user_info_result)){
        $user = $row['user'];
        $pass = $row['pass'];
    }
?>

<?php 
    
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/ava.ico" />
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>

<body>
    <div class="panel-body">
        <div class="" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Change the User name and Password</h4>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Change User name</label>
                                <input name="username" value="<?php echo $user ?>" class="form-control"
                                    placeholder="Enter User name">
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Change Password</label>
                                <input name="pass" value="<?php echo $pass ?>" class="form-control"
                                    placeholder="Enter Password">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" name='close' class="btn btn-default" data-dismiss="modal">Close</button>

                            <input type="submit" name="update" value="Update" class="btn btn-primary">
                    </form>

                </div>
            </div>
        </div>
    </div>
    <?php 
		if(isset($_POST['update']))
		{
			$username = $_POST['username'];
			$password = $_POST['pass'];
			
			$upsql = "UPDATE `login` SET `user`='$username',`pass`='$password' WHERE id = '$id'";
			if(mysqli_query($conn,$upsql))
			{
			    echo' <script language="javascript" type="text/javascript"> alert("User name and password update") </script>';
                header("Location: usersetting.php");
			}
		}elseif(isset($_POST['close'])){
            header("Location: usersetting.php");
        }

	?>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>