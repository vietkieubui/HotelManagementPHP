<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
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
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

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
                <a class="navbar-brand" href="home.php">MAIN MENU </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="usersetting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="room.php"><i class="fa fa-gear fa-fw"></i>Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a class="" href="room.php"><i class="fa fa-plus-circle"></i>Add Room</a>
                    </li>
                    <li>
                        <a class="active-menu" href="service.php"><i class="fa fa-plus-circle"></i>Add Service</a>
                    </li>
                </ul>
            </div>

        </nav>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            NEW SERVICE <small></small>
                        </h1>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-5 col-sm-5">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                ADD NEW SERVICE
                            </div>
                            <div class="panel-body">
                                <form name="form" method="post">
                                    <div class="form-group">
                                        <label>Name of Service</label>
                                        <input type="text" name="newservicename" class="form-control"
                                            placeholder="Enter Service Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="float" name="newserviceprice" class="form-control"
                                            placeholder="Enter Service Price">
                                    </div>
                                    <div class="form-group">
                                        <label>Note</label>
                                        <input type="text" name="newservicenote" class="form-control"
                                            placeholder="Enter Service Note">
                                    </div>

                                    <input type="submit" name="add" value="Add New" class="btn btn-primary">
                                </form>
                                <?php
							include('db.php');
							if(isset($_POST['add']))
							{
								$servicename = $_POST['newservicename'];
								$serviceprice = $_POST['newserviceprice'];
                                $servicenote = $_POST['newservicenote'];							
								
							    $sql ="INSERT INTO `service`( `serviceName`, `price`, `note`) VALUES ('$servicename','$serviceprice','$servicenote')" ;
							    if(mysqli_query($conn,$sql))
							    {
							         echo '<script>alert("New Service Added") </script>' ;
							    } else {
							        echo '<script>alert("Sorry ! Check The System") </script>' ;
							    }							    
							}
							?>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    SERVICES INFORMATION
                                </div>
                                <div class="panel-body">
                                    <div class="panel panel-default">

                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover"
                                                    id="dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Price</th>
                                                            <th>Note</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php                                    
                                        $sql = "select * from service";
                                        $result = mysqli_query($conn,$sql);                                    
										while($row= mysqli_fetch_array($result))
										{
                                            $serviceid = $row['serviceID'];
                                            $servicename = $row['serviceName'];
                                            $serviceprice = $row['price'];
                                            $servicenote = $row['note'];
											
                                            echo "<tr>
											    <th>".$serviceid."</th>
											    <th>".$servicename."</th>
											    <th>".$serviceprice."</th>
											    <th>".$servicenote."</th>											    	
                                                <td><a href='servicedel.php?id=$serviceid'><button class='btn btn-danger'> <i class='fa fa-edit' ></i> Delete</button></a></td>										
											    </tr>";
										}
									?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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