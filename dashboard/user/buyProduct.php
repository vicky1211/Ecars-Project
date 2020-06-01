<?php
//print_r($_POST);
include("../dbconnect.php");
$sql = "insert into myOrders (productId, userId, quantity, date) values('".$_POST['productId']."', '".$_SESSION['uid']."', '".$_POST['quantity']."', '".date('d-m-Y')."')";
//echo date('d-m-Y');
if($conn->query($sql))
{
	echo "Order Placed Successfully.";
}
else
{
	echo "Something Went Wrong. Please Try Again Later";
}
?>