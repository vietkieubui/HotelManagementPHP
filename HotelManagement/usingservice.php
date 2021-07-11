<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}

ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/ava.ico" />
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
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

<body onload="loadData()">
    <div style="display: flex; justify-content: space-around;">
        <?php
            include ('db.php'); 
            $id =$_GET['id'];	//$id is registerID
            // get Customer name
            $get_customer_name = "SELECT * FROM `registrationform`, `customer` WHERE registrationform.customerID = customer.customerID AND registrationform.registerID = '$id'";
            $customer_name_result = mysqli_query($conn,$get_customer_name);
            while($cus_row=mysqli_fetch_array($customer_name_result)){
                $customer_name = $cus_row['customerName'];
            }
            // convert service to array
            $get_service = "SELECT * FROM `service`";
            $get_service_result = mysqli_query($conn, $get_service);
            $string_service_name ="<option>Choose Service</option>";
            while($service_row = mysqli_fetch_array($get_service_result)){
                $serviceArray[] = $service_row;
                $serviceID = $service_row['serviceID'];
                $serviceName = $service_row['serviceName'];
                $string_service_name= $string_service_name."<option id='$serviceID' value='$serviceID'>$serviceName</option>";
            }
            $json_array_service = json_encode($serviceArray);
        ?>
        <div class="" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Using Service</h4>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input name="newcn" class="form-control" value="<?php echo $customer_name ?>" readonly>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div style="display: flex;">

                                <div class="form-group" style="flex:6;">
                                    <label>Service</label>
                                    <select name="newserviceName" class="form-control" id="choose_service"
                                        onchange="showPrice(this)">

                                    </select>
                                </div>
                                <div class="form-group" style="flex:3;">
                                    <label>Đơn giá</label>
                                    <input id="price" type="number" min="0" name="newprice" class="form-control"
                                        value="0" readonly>
                                </div>
                                <div class="form-group" style="flex:3;">
                                    <label style="padding-left: 36px;">Số Lượng</label>
                                    <div style="display: flex;">
                                        <i class="btn fas fa-minus-circle"
                                            style="padding: 0; font-size: 29px; margin-top: 3px;"
                                            onclick="minus_1()"></i>
                                        <input id="amount" type="number" min="1" name="newamount" class="form-control"
                                            value="1" onchange="showPrice(this)">
                                        <i class="btn fas fa-plus-circle"
                                            style="padding: 0; font-size: 29px; margin-top: 3px;"
                                            onclick="plus_1()"></i>
                                    </div>
                                </div>

                                <div class="form-group" style="flex:3;">
                                    <label>Thành tiền</label>
                                    <input id="total" name="newtotal" class="form-control" value="0" readonly>
                                </div>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="submit" name="close" class="btn btn-default"
                                data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php                    
            if(isset($_POST['close'])){
                header("Location: home.php");
            }

            if(isset($_POST['submit']))
            {   
                $serviceID = 0;
                $serviceName = $_POST['newserviceName'];
                $get_service_id = "SELECT `serviceID` FROM `service` WHERE serviceName = '$serviceName'";
                $get_service_id_result = mysqli_query($conn,$get_service_id);
                while($row_service_id = mysqli_fetch_array($get_service_id_result)){
                    $serviceID = $row_service_id['serviceID'];
                }
                $amount = $_POST['newamount'];
                $total = $_POST['newtotal'];

                if($serviceID!=0){
                    $update_service_registration = "INSERT INTO `serviceregistration`(`registerID`, `serviceID`, `amount`, `total`) VALUES ('$id','$serviceID','$amount','$total')";
                    if(mysqli_query($conn,$update_service_registration)){
                        echo' <script language="javascript" type="text/javascript"> alert("Order Success!")</script>';                             
                    }

                }else{
                    echo' <script language="javascript" type="text/javascript"> alert("Choose 1 service!")</script>';
                }
                
                
                
            }
        ?>
        <div class="col-md-6 col-sm-6" style="margin-top: 3%">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Service Information
                    </a>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Service Name</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                        <th>Total</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $get_service_using = "SELECT * FROM `serviceregistration`, `service` WHERE serviceregistration.serviceID = service.serviceID AND registerID = '$id'";                         
                                        $get_service_using_result = mysqli_query($conn,$get_service_using);
                                        while($get_service_using_row = mysqli_fetch_array($get_service_using_result)){
                                            $serviceName_using = $get_service_using_row['serviceName'];
                                            $servicePrice_using = $get_service_using_row['price'];
                                            $serviceAmount_using = $get_service_using_row['amount'];
                                            $serviceTotal_using = $get_service_using_row['total'];
                                            $serviceID_using = $get_service_using_row['id'];
                                            echo"<tr>
                                                <td>$serviceName_using</td>
                                                <td>$servicePrice_using</td>
                                                <td>$serviceAmount_using</td>
                                                <td>$serviceTotal_using</td>
                                                <td><a href='serviceusingdel.php?id=$serviceID_using'><button class='btn btn-danger'><i class='far fa-trash-alt'></i> Delete</button></a></td>
                                            </tr>";
                                        }    
									?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- end of table customer -->

            </div>
        </div>
    </div>
    <script>
        function loadData() {
            var array_object = <?php echo $json_array_service ?>;
            let string_option = "<option id='0'>Choose service</option>";
            array_object.forEach(item => {
                let html = "<option id='" + item["serviceID"] + "'>" + item["serviceName"] + "</option>";
                string_option += html;
            });
            document.getElementById("choose_service").innerHTML = string_option;
        }

        function showPrice() {
            var value = document.getElementById("choose_service").value;
            var array_object = <?php echo $json_array_service ?>;

            array_object.forEach(item => {
                if (item["serviceName"] == value) {
                    document.getElementById("price").value = item["price"];

                }
            });
            var price = Number(document.getElementById("price").value);
            var amount = Number(document.getElementById("amount").value);
            document.getElementById("total").value = calTotal(amount, price);

        }

        function calTotal(amount, price) {
            return amount * price;
        }

        function plus_1() {
            amount = Number(document.getElementById("amount").value);
            amount += 1;
            document.getElementById("amount").value = amount;
            showPrice();
        }

        function minus_1() {
            amount = Number(document.getElementById("amount").value);
            amount -= 1;
            if (amount <= 0) {
                amount = 1;
            }
            document.getElementById("amount").value = amount;
            showPrice();
        }
    </script>
</body>

</html>