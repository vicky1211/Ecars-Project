


<?php

ob_start();
session_start();
session_unset(); 
session_destroy(); 
echo '<script type="text/javascript">window.location="../../index.html"; </script>';


?>