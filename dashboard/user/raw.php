<?php
include('../dbconnect.php');
include('checklogin.php');
?>
<?php
				  $aKeyword = explode(" ", $_GET['keyword']);
				  $query ="SELECT * FROM products WHERE pDesc like '%" . $aKeyword[0] . "%'  OR pName like '%" . $aKeyword[0] . "%' ";
				  $newArray = array();
				 for($i = 1; $i < count($aKeyword); $i++) {
					if(!empty($aKeyword[$i])) {
						$query .= " OR pDesc like '%" . $aKeyword[$i] . "%'";
						$query .= " OR pName like '%" . $aKeyword[$i] . "%'";
					}
				  }
				 
				 $result = $conn->query($query);
				 //echo "<br>You have searched for keywords: " . $_GET['keyword'];
								 
				 if(mysqli_num_rows($result) > 0) 
				 {	
					$i = 1;
					While($row = $result->fetch_assoc()) 
					{
						$product = $row['pName']." ".$row['pDesc'];
						$count = 0;
						for($j = 0; $j < count($aKeyword); $j++) {
							if(!empty($aKeyword[$j])) {
								if (strpos($product,$aKeyword[$j]) !== false) {
									//echo strpos($product,$aKeyword[$j])." ";
									$count++;
									$newArray[$row['id'].''] = $count;
								}
							}
						  }
						
						$i++;
					}
					print_r($newArray);
					arsort($newArray);
					print_r($newArray);
				} 
			?>