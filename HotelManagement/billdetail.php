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
                        <a href="customer.php"><i class="fas fa-users"></i> Customer</a>
                    </li>
                    <li>
                        <a href="checkonlinebooking.php"><i class="fas fa-check"></i> Online Booking</a>
                    </li>
                    <li>
                        <a href="profit.php"><i class="fas fa-chart-line"></i> Profit</a>
                    </li>
                    <li>
                        <a class="active-menu" href="billdetail.php"><i class="fas fa-money-bill"></i> Bill details</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Bill Details
                        </h1>
                    </div>
                </div>  
                <?php
						include ('db.php');
						$sql = "SELECT bill.billID, customer.customerName, customer.idCard, customer.phoneNumber, bill.roomcharge, bill.servicecharge, bill.subTotal, bill.vat,bill.total FROM `bill`, `registrationform`,`customer` WHERE bill.registerID = registrationform.registerID AND registrationform.customerID = customer.customerID AND registrationform.note ='paid'";
						$result = mysqli_query($conn,$sql);
						$c = 0;
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
                                            <div>
                                                List Bill <span class="badge"><?php echo $c ; ?></span>
                                            </div>
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
                                                                    <th>Bill ID</th>
                                                                    <th>Customer Name</th>
                                                                    <th>idCard</th>
                                                                    <th>Phone Number</th>
                                                                    <th>Room Charge</th>
                                                                    <th>Service Charge</th>
                                                                    <th>Sub Total</th>
                                                                    <th>VAT</th>
                                                                    <th>Total</th>
                                                                    <th>Details</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $get_bill_infor = "SELECT bill.registerID, bill.billID, customer.customerName, customer.idCard, customer.phoneNumber, bill.roomcharge, bill.servicecharge, bill.subTotal, bill.vat,bill.total FROM `bill`, `registrationform`,`customer` WHERE bill.registerID = registrationform.registerID AND registrationform.customerID = customer.customerID AND registrationform.note ='paid'";
                                                                    $get_bill_infor_result = mysqli_query($conn,$get_bill_infor);
                                                                    while($trow=mysqli_fetch_array($get_bill_infor_result) )
                                                                    {
                                                                        $billID = $trow['billID'];
                                                                        $customerName = $trow['customerName'];
                                                                        $idCard = $trow['idCard'];
                                                                        $phoneNumber = $trow['phoneNumber'];
                                                                        $roomCharge = $trow['roomcharge'];
                                                                        $serviceCharge = $trow['servicecharge']; 
                                                                        $subTotal = $trow['subTotal'];
                                                                        $VAT = $trow['vat'];
                                                                        $total = $trow['total'];
                                                                        $registerID = $trow['registerID'];										
                                                                        echo"<tr>
                                                                            <th>".$billID."</th>
                                                                            <th>".$customerName."</th>
                                                                            <th>".$idCard."</th>
                                                                            <th>".$phoneNumber."</th>
                                                                            <th>".$roomCharge."</th>
                                                                            <th>".$serviceCharge."</th>
                                                                            <th>".$subTotal."</th>
                                                                            <th>".$VAT."</th>
                                                                            <th>".$total."</th>
                                                                            <td><a href='print.php?id=$registerID' target='_blank'><button class='btn btn-primary btn' data-toggle='modal' data-target='#myModal2'><i class='fas fa-edit'></i> Details</button></a></td>                                           
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
                                    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Add New Customer</h4>
                                                </div>
                                                <form method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Customer Name</label>
                                                            <input name="newcn" class="form-control" id="name123"
                                                                placeholder="Enter Customer Name">
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>ID Card</label>
                                                            <input name="newidc" class="form-control" id="idc"
                                                                placeholder="Enter ID Card">
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            <select name="newgd" class="form-control">
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <input name="newad" class="form-control" id="province"
                                                                placeholder="Enter Address">
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <input name="newpn" class="form-control" id="phone"
                                                                placeholder="Enter Phone Number">
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nationality</label>
                                                            <input name="newna" class="form-control" id="Vietnamese"
                                                                placeholder="Enter Nationality">
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input name="newem" class="form-control"
                                                                placeholder="Enter Email">
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Note</label>
                                                            <input name="newnote" class="form-control"
                                                                placeholder="Enter Note">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                        <input type="submit" name="addnew" value="Add"
                                                            class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                            if(isset($_POST['addnew']))
                                            {
                                                    
                                                $newcname = $_POST['newcn'];                            
                                                $newcidcard = $_POST['newidc'];
                                                $newcgender = $_POST['newgd'];
                                                $newcaddress = $_POST['newad'];
                                                $newcphonenumber = $_POST['newpn'];
                                                $newcnationality = $_POST['newna'];
                                                $newcemail = $_POST['newem'];
                                                $newcnote = $_POST['newnote'];

                                                $newsql ="INSERT INTO customer(customerName, idCard, gender, address, phoneNumber, nationality, email, note) VALUES ('$newcname','$newcidcard','$newcgender','$newcaddress','$newcphonenumber','$newcnationality','$newcemail','$newcnote')";
                                                echo $newsql;
                                                    
                                                if(mysqli_query($conn,$newsql))
                                                {
                                                    echo "<script language='javascript' type='text/javascript'> alert('Add customer success!') </script>";
                                                }
                                                header("Location: customer.php");
                                            }
                                        ?>
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