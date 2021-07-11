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
</head>

<body>
    <!-- wrapper -->
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
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
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
                        <a href="customer.php"><i class="fas fa-users"></i> Customer</a>
                    </li>
                    <li>
                        <a class="active-menu" href="checkonlinebooking.php"><i class="fas fa-check"></i> Online
                            Booking</a>
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
        <!-- từ đây trở lên là phần chung tất cả các trang chú ý class active-menu-->
        <!-- /. NAV SIDE  -->
        <!-- đây là phần body chính -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Online Booking
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <!-- count row not checked -->
                <div class="row">
                    <?php
                        include('db.php');
                        $select_online_booked_not = "SELECT customer.customerID, customer.customerName, prebook.phoneNumber, prebook.type,prebook.bedding, prebook.numroom, prebook.checkIn,prebook.checkOut,prebook.note FROM `prebook`,`customer` WHERE customer.customerID = prebook.customerID AND prebook.status != 'checked'";
                        $select_online_booked_not_result = mysqli_query($conn,$select_online_booked_not);
                        $c_not_checked = 0;                                    
                        while($row_booked_not = mysqli_fetch_array($select_online_booked_not_result)){
                            $c_not_checked+=1;
                        }
                    ?>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">

                                                <a data-parent="#accordion" href="#collapseOne" data-toggle="collapse"
                                                    role="button" aria-expanded="false" aria-controls="collapseOne">
                                                    <button class="btn btn-default collapsed" type="button" data-toggle="collapse"
                                                        data-target="#collapseOne" aria-expanded="false"
                                                        aria-controls="collapseOne">
                                                        Online Bookings not checked yet <span
                                                            class="badge"><?php echo $c_not_checked?></span>
                                                    </button>
                                                </a>
                                                <a href="roombooking.php">
                                                    <button class="btn btn-success" type="button">
                                                        New Room Bookings
                                                    </button>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse" style="height: auto;">
                                            <div class="panel-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>customerID</th>
                                                                        <th>customerName</th>
                                                                        <th>PhoneNumber</th>
                                                                        <th>IDCard</th>
                                                                        <th>Type</th>
                                                                        <th>Bed</th>
                                                                        <th>Room(s)</th>
                                                                        <th>CheckIn</th>
                                                                        <th>CheckOut</th>
                                                                        <th>Note</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                        include('db.php');
                                                                        $select_online_booked_not = "SELECT customer.customerID, customer.customerName, prebook.phoneNumber,customer.idCard, prebook.type,prebook.bedding, prebook.numroom, prebook.checkIn,prebook.checkOut,prebook.note FROM `prebook`,`customer` WHERE customer.customerID = prebook.customerID AND prebook.status != 'checked'";
                                                                        $select_online_booked_not_result = mysqli_query($conn,$select_online_booked_not);
                                                                        while($row_booked_not = mysqli_fetch_array($select_online_booked_not_result)){
                                                                            $customerID_not = $row_booked_not['customerID'];
                                                                            $customerName_not = $row_booked_not['customerName'];
                                                                            $phoneNumber_not = $row_booked_not['phoneNumber'];
                                                                            $idCard_not = $row_booked_not['idCard'];
                                                                            $type_not = $row_booked_not['type'];
                                                                            $bed_not = $row_booked_not['bedding'];
                                                                            $numroom_not = $row_booked_not['numroom'];
                                                                            $checkIn_not = $row_booked_not['checkIn'];
                                                                            $checkOut_not = $row_booked_not['checkOut'];
                                                                            $note_not = $row_booked_not['note'];
                                                                            echo "<tr>
                                                                                <th>".$customerID_not."</th>
                                                                                <th>".$customerName_not."</th>
                                                                                <th>".$phoneNumber_not."</th>
                                                                                <th>".$idCard_not."</th>
                                                                                <th>".$type_not."</th>
                                                                                <th>".$bed_not."</th>	
                                                                                <th>".$numroom_not."</th>
                                                                                <th>".$checkIn_not."</th>
                                                                                <th>".$checkOut_not."</th>
                                                                                <th>".$note_not."</th>
                                                                                <td><a href='onlinechecked.php?id=$customerID_not'><button class='btn btn-primary'> <i class='fas fa-check' ></i> Check</button></a></td>	
                                                                                </tr>";
                                                                        }									
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End  Basic Table  -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <?php
                                                include('db.php');
                                                $select_online_booked_checked = "SELECT customer.customerID, customer.customerName, prebook.phoneNumber, prebook.type,prebook.bedding, prebook.numroom, prebook.checkIn,prebook.checkOut,prebook.note FROM `prebook`,`customer` WHERE customer.customerID = prebook.customerID AND prebook.status = 'checked'";
                                                $select_online_booked_checked_result = mysqli_query($conn,$select_online_booked_checked);
                                                $c_checked = 0;                                    
                                                while($row_booked_checked = mysqli_fetch_array($select_online_booked_checked_result)){
                                                    $c_checked+=1;
                                                }
                                            ?>

                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                    <button class="btn btn-primary" type="button">
                                                        Online Bookings already checked <span
                                                            class="badge"><?php echo $c_checked?></span>
                                                    </button>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="collapse" style="height: auto;">
                                            <div class="panel-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>customerID</th>
                                                                        <th>customerName</th>
                                                                        <th>PhoneNumber</th>
                                                                        <th>IDCard</th>
                                                                        <th>Type</th>
                                                                        <th>Bed</th>
                                                                        <th>Room(s)</th>
                                                                        <th>CheckIn</th>
                                                                        <th>CheckOut</th>
                                                                        <th>Note</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                    include('db.php');
                                                                    $select_online_booked_checked = "SELECT customer.customerID, customer.customerName, prebook.phoneNumber,customer.idCard, prebook.type,prebook.bedding, prebook.numroom, prebook.checkIn,prebook.checkOut,prebook.note FROM `prebook`,`customer` WHERE customer.customerID = prebook.customerID AND prebook.status = 'checked'";
                                                                    $select_online_booked_checked_result = mysqli_query($conn,$select_online_booked_checked);
                                                                    while($row_booked_checked = mysqli_fetch_array($select_online_booked_checked_result)){
                                                                        $customerID_checked = $row_booked_checked['customerID'];
                                                                        $customerName_checked = $row_booked_checked['customerName'];
                                                                        $phoneNumber_checked = $row_booked_checked['phoneNumber'];
                                                                        $idCard_checked = $row_booked_checked['idCard'];
                                                                        $type_checked = $row_booked_checked['type'];
                                                                        $bed_checked = $row_booked_checked['bedding'];
                                                                        $numroom_checked = $row_booked_checked['numroom'];
                                                                        $checkIn_checked = $row_booked_checked['checkIn'];
                                                                        $checkOut_checked = $row_booked_checked['checkOut'];
                                                                        $note_checked = $row_booked_checked['note'];
                                                                        echo "<tr>
                                                                            <th>".$customerID_checked."</th>
                                                                            <th>".$customerName_checked."</th>
                                                                            <th>".$phoneNumber_checked."</th>
                                                                            <th>".$idCard_checked."</th>
                                                                            <th>".$type_checked."</th>
                                                                            <th>".$bed_checked."</th>	
                                                                            <th>".$numroom_checked."</th>
                                                                            <th>".$checkIn_checked."</th>
                                                                            <th>".$checkOut_checked."</th>
                                                                            <th>".$note_checked."</th>
                                                                            </tr>";
                                                                        }									
                                                                    ?>
                                                                    

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End  Basic Table  -->
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
    <!-- /. PAGE INNER  -->
    </div>



    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>