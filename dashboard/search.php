<?php
if(!empty($_POST))
{

include("dbconnect.php");
      $aKeyword = explode(" ", $_POST['keyword']);
      $query ="SELECT * FROM products WHERE pDesc like '%" . $aKeyword[0] . "%'  OR pName like '%" . $aKeyword[0] . "%' ";
      
     for($i = 1; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
            $query .= " OR pDesc like '%" . $aKeyword[$i] . "%'";
            $query .= " OR pName like '%" . $aKeyword[$i] . "%'";
        }
      }
     
     $result = $conn->query($query);
     echo "<br>You have searched for keywords: " . $_POST['keyword'];
                     
     if(mysqli_num_rows($result) > 0) {
        $row_count=0;
        echo "<br>Result Found: ";
        echo "<br><table border='1'>";
        While($row = $result->fetch_assoc()) {   
            $row_count++;                         
            echo "<tr><td> ROW ".$row_count." </td><td>". $row['pDesc'] . "</td></tr>";
        }
        echo "</table>";
    }
    else {
        echo "<br>Result Found: NONE";
    }
}

?>
<form action="search.php" method="post" >
    <h3>Search Keywords:</h3>
    <input type="text" name="keyword">
    <input type="submit" value="Search">
</form>