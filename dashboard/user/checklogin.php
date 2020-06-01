<?php

if(!isset($_SESSION['uid']))
{
echo '<script type="text/javascript">window.location="login.php"; </script>';
}

?>