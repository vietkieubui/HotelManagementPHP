<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}

ob_start();
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
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">MAIN MENU</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="usersetting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="room.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu" href="usersetting.php"><i class="fas fa-tachometer-alt"></i> User
                            Dashboard</a>
                    </li>
            </div>
        </nav>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            ADMINISTRATOR<small> accounts </small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Password</th>
                                                <th>Update</th>
                                                <th>Remove</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                        include ('db.php');
                                        $get_user_infor = "SELECT * FROM `login`";
                                        $get_user_infor_result = mysqli_query($conn,$get_user_infor);
										while($row = mysqli_fetch_array($get_user_infor_result))
										{
										
											$userid = $row['id'];
											$username = $row['user'];
											$userpass = $row['pass'];
											echo"<tr class='gradeC'>
											        <td>".$userid."</td>
											        <td>".$username."</td>
											        <td>".$userpass."</td>

											        <td><a href='userupdate.php?id=$userid'><button class='btn btn-primary btn' data-toggle='modal' data-target='#myModal'><i class='fa fa-edit' ></i>
											        		 Update 
											        </button></a></td>
											        <td><a href='userdel.php?id=$userid'> <button class='btn btn-danger'><i class='far fa-trash-alt'></i> Delete</button></td>
											    </tr>";
										}
										
									?>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="panel-body">
                            <button class="btn btn-primary btn" data-toggle="modal" data-target="#myModal1">
                                Add New Admin
                            </button>
                            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Add the User name and Password
                                            </h4>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Add new User name</label>
                                                    <input name="newusername" class="form-control"
                                                        placeholder="Enter User name">
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input name="newpassword" class="form-control"
                                                        placeholder="Enter Password">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>

                                                <input type="submit" name="add" value="Add" class="btn btn-primary">
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
						if(isset($_POST['add']))
						{
							$newuser = $_POST['newusername'];
							$newpass = $_POST['newpassword'];
                            $check_username = "SELECT * FROM login WHERE user='$newuser'";
                            $check_username_result = mysqli_query($conn,$check_username);
                            $data = mysqli_fetch_array($check_username_result, MYSQLI_NUM);
                            if($data[0] > 1) {
                                echo "<script type='text/javascript'> alert('User Already in Exists')</script>";                                        
                            }else{
                                $newsql ="INSERT INTO login (user,pass) values ('$newuser','$newpass')";
                                if(mysqli_query($conn,$newsql))
                                {
                                    echo' <script language="javascript" type="text/javascript"> alert("User name and password Added") </script>';
                                    header("Location: usersetting.php");
                                }
                            }
						}
						?>
                </div>
            </div>
        </div>
    </div>
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