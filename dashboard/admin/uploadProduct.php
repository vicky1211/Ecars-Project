<?php
//print_r($_POST);
//print_r($_FILES);

include('../dbconnect.php');
$sql="insert into products(pName,pDesc,price) values('".$_POST['pName']."', '".$_POST['pDesc']."', '".$_POST['price']."')";
$conn->query($sql);
$lastId = $conn->insert_id;

foreach ($_FILES as $value) 
	{
    	$rand = rand(0, 999999999);
		$filename = $rand."".$value['name'];
		$profile="productimages/".$filename;
		move_uploaded_file( $value['tmp_name'],$profile);
		$sql2="insert into productimg(productId,url) values('".$lastId."', '".$profile."')";
		$conn->query($sql2);
	}
	
	echo "Product Inserted Successfully.";

?>