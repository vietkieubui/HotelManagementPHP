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
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

</head>

<body onload="loadData()">
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"> <?php echo $_SESSION["user"]; ?> </a>
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
                        <a href="home.php"><i class="fas fa-tachometer-alt"></i> Status</a>
                    </li>
                    <li>
                        <a href="roombooking.php"><i class="fa fa-bar-chart-o"></i> Room Booking</a>
                    </li>
                    <li>
                        <a class="active-menu" href="customer.php"><i class="fas fa-users"></i> Customer</a>
                    </li>
                    <li>
                        <a href="checkonlinebooking.php"><i class="fas fa-check"></i> Online Booking</a>
                    </li>
                    <li>
                        <a href="profit.php"><i class="fas fa-chart-line"></i> Profit</a>
                    </li>
                    <li>
                        <a href="billdetail.php"><i class="fas fa-money-bill"></i> Bill details</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Customer
                        </h1>
                    </div>
                </div>
                <?php
						include ('db.php');
						$sql = "select * from customer";
						$result = mysqli_query($conn,$sql);
						$c =0;
						while($row=mysqli_fetch_array($result) )
						{
								$c+=1;						
						}
				?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="float:left; margin:12px">
                                                List Customer <span class="badge"><?php echo $c ; ?></span>
                                            </div>
                                            <button class="btn btn-success" type="button" data-toggle="modal"
                                                data-target="#myModal1">New Customer</button>

                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                        <div class="panel-body">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover"
                                                            id="dataTables">
                                                            <thead>
                                                                <tr>
                                                                    <th>CustomerID</th>
                                                                    <th>CustomerName</th>
                                                                    <th>idCard</th>
                                                                    <th>gender</th>
                                                                    <th>address</th>
                                                                    <th>PhoneNumber</th>
                                                                    <th>Natinality</th>
                                                                    <th>Email</th>
                                                                    <th>Note</th>
                                                                    <th>Update</th>
                                                                    <th>Remove</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $tsql = "select * from customer";
                                                                    $tresult = mysqli_query($conn,$tsql);
                                                                    while($trow=mysqli_fetch_array($tresult) )
                                                                    {
                                                                        $customerID = $trow['customerID'];
                                                                        $customerName = $trow['customerName'];
                                                                        $idCard = $trow['idCard'];
                                                                        $gender = $trow['gender'];
                                                                        $address = $trow['address'];
                                                                        $phoneNumber = $trow['phoneNumber']; 
                                                                        $nationality = $trow['nationality'];
                                                                        $email = $trow['email'];
                                                                        $note = $trow['note'];										
                                                                        echo"<tr>
                                                                            <th>".$customerID."</th>
                                                                            <th>".$customerName."</th>
                                                                            <th>".$idCard."</th>
                                                                            <th>".$gender."</th>
                                                                            <th>".$address."</th>
                                                                            <th>".$phoneNumber."</th>
                                                                            <th>".$nationality."</th>
                                                                            <th>".$email."</th>
                                                                            <th>".$note."</th>
                                                                            <td><a href='customerupdate.php?id=$customerID'><button class='btn btn-primary btn' data-toggle='modal' data-target='#myModal2'><i class='fas fa-edit'></i> Update</button></a></td>                                           
                                                                            
                                                                            <td><a href='customerdel.php?eid=$customerID'><button class='btn btn-danger'> <i class='far fa-trash-alt'></i> Delete</button></a></td>
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
            </div>
        </div>
    </div>
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js">
    </script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>

    <script>
    function loadData() {
        $('#dataTables').DataTable();
    }
    </script>
</body>

</html>