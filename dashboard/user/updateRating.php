<?php
//print_r($_POST);
include("../dbconnect.php");

$sql1 = "select * from myorders where productId = '".$_POST['productId']."' and userId = '".$_SESSION['uid']."'";
$q1 = $conn->query($sql1); 
//echo $conn->error;
if($q1->num_rows > 0)
{
	
	$sql2 = "select * from rating where productId = '".$_POST['productId']."' and userId = '".$_SESSION['uid']."'";
	$q2 = $conn->query($sql2); 
	if($q2->num_rows == 0)
	{

		$sql = "insert into rating (productId, userId, rating) values('".$_POST['productId']."', '".$_SESSION['uid']."', '".$_POST['rating']."')";
	}
	else
	{
		$sql = "update rating set rating = '".$_POST['rating']."' where productId = '".$_POST['productId']."' and userId = '".$_SESSION['uid']."'";
	}

	if($conn->query($sql))
	{
		echo "Rating Updated Successfully.";
	}
	else
	{
		echo "Something Went Wrong. Please Try Again Later";
	}

}
else
{
	echo "Buy This Product To Rate.";
}
?>