<?php 

$db=mysqli_connect("localhost","root","","social");
if (!$db) {
    echo "Fail to Connect to DB :".mysqli_connect_error();
}

?>