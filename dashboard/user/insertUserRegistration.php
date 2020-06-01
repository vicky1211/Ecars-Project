<?php

//error_reporting(0);

include('../dbconnect.php');

$sql1 = "select * from user where email ='".$_POST['email']."'"; 
$q1 = $conn->query($sql1);

	
if($q1->num_rows == 0)
{
	
	
	if( $_FILES['profile']['name'] != "" )
	{
		$rand = rand(0, 999999999);
		$filename = $rand."".$_FILES['profile']['name'];
		$profile="profile/".$filename;
		move_uploaded_file( $_FILES['profile']['tmp_name'],$profile);
		
	}
	else
	{
		$profile ="profile/default.jpg";
	}


	$sql = "insert into user (fname, email, pass, mobNo, address, profile) values('".$_POST['fname']."', '".$_POST['email']."', '".$_POST['pass']."', '".$_POST['mobno']."', '".$_POST['address']."', '".$profile."')";
	
	if($conn->query($sql))
	{
		echo '
		<div class="alert  alert-success alert-dismissible fade show" role="alert">
							<span class="badge badge-pill badge-success">X</span> You Have Register Successfully. Please Login to Continue
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
							</div>
		';
	}
	
}
else
{
echo '
<div class="alert  alert-danger alert-dismissible fade show" role="alert">
							<span class="badge badge-pill badge-danger">X</span> Email Already Exists. Please Login To Continue.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
							</div>
';
}

?>
