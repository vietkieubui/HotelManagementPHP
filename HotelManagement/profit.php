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
                        <a class="active-menu" href="profit.php"><i class="fas fa-chart-line"></i> Profit</a>
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
                            Profit Details
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <?php 
                    include('db.php');
                    $get_chart_data = "SELECT * FROM bill, registrationform WHERE registrationform.registerID = bill.registerID AND registrationform.note='paid' ";
                    $tot = 0;
                    $chart_data = '';
                    $get_chart_data_result = mysqli_query($conn,$get_chart_data);
                    $arr_date = array("1");
                    while($get_chart_data_row = mysqli_fetch_array($get_chart_data_result)){
                        // tính doanh thu theo ngày                        

                        $tmp_date = $get_chart_data_row['paymentDate'];
                        $tmp_billid = $get_chart_data_row['billID'];
                        $tmp_profit = $get_chart_data_row['profit'];
                        $c=0;
                        // check tồn tại
                        foreach($arr_date as $tmp_date_1){
                            if($tmp_date == $tmp_date_1){
                                $c+=1; 
                                goto a;
                            }                            
                        }
                        // nếu có
                        if($c !=0 ){
                        }
                        // nếu ko có
                        else{
                            
                            $get_chart_data_result_1 = mysqli_query($conn,$get_chart_data);
                            while($get_chart_data_row_1 = mysqli_fetch_array($get_chart_data_result_1)){
                                if($tmp_date == $get_chart_data_row_1['paymentDate']){  
                                    if($tmp_billid < $get_chart_data_row_1['billID']){                                  
                                    $tmp_profit += $get_chart_data_row_1['profit'];  
                                    }
                                }
                            }
                            
                        }   
                        $arr_date[]=$tmp_date;
                        $chart_data = $chart_data."{ date:'$tmp_date', profit:'$tmp_profit'}, ";
                        a:
                        $tot+= $tmp_profit;
                    }
                    $chart_data = substr($chart_data, 0, -2);
                ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div id="chart"></div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Bill ID</th>
                                                <th>Name</th>
                                                <th>Check in</th>
                                                <th>Check out</th>
                                                <th>Payment Date</th>
                                                <th>Room Charge</th>
                                                <th>Service Charge</th>
                                                <th>VAT</th>
                                                <th>Total </th>
                                                <th>Profit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        include('db.php');
                                            $get_profit_info = "SELECT bill.billID, customer.customerName, registrationform.checkIn, registrationform.checkOut, bill.paymentDate, bill.roomcharge, bill.servicecharge, bill.vat,bill.total, bill.profit FROM `bill`,`registrationform`,`customer` WHERE bill.registerID = registrationform.registerID AND registrationform.customerID = customer.customerID AND registrationform.note='paid'";
                                            $get_profit_info_result = mysqli_query($conn,$get_profit_info);
                                            $total_profit = 0;
                                            while($get_profit_info_row = mysqli_fetch_array($get_profit_info_result)){
                                                $billid = $get_profit_info_row['billID'];
                                                $customerName = $get_profit_info_row['customerName'];
                                                $checkin = $get_profit_info_row['checkIn'];
                                                $checkout = $get_profit_info_row['checkOut'];
                                                $paymentdate = $get_profit_info_row['paymentDate'];
                                                $roomcharge = $get_profit_info_row['roomcharge'];
                                                $servicecharge = $get_profit_info_row['servicecharge'];
                                                $vat = $get_profit_info_row['vat'];
                                                $total = $get_profit_info_row['total'];
                                                $profit = $get_profit_info_row['profit'];
                                                $total_profit += $profit;
                                                echo "<tr>
                                                <td>".$billid."</td>
                                                <td>".$customerName."</td>
                                                <td>".$checkin."</td>
                                                <td>".$checkout."</td>
                                                <td>".$paymentdate."</td>
                                                <td>".$roomcharge."</td>
                                                <td>".$servicecharge."</td>
                                                <td>".$vat."</td>
                                                <td>".$total."</td>
                                                <td>".$profit."</td>
                                                </tr>"; 
                                            }
                                            echo "<tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style='border: groove; text-align: right;border-right: hidden; '>Total: </td>
                                                <td style='border: groove; border-left: hidden; '>".$total_profit."</td>
                                                </tr>"; 
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
    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
    Morris.Area({
        element: 'chart',
        data: [<?php echo $chart_data; ?>],
        xkey: 'date',
        ykeys: ['profit'],
        labels: ['Profit'],
        hideHover: 'auto',
        stacked: true,
        // xLabelAngle: 60
    });
    </script>

</body>

</html>