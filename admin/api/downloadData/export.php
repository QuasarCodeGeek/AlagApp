<?php
$con=mysqli_connect('localhost', 'root', 'root', 'alagapp_db');

if(mysqli_connect_errno())
{
    echo 'Failed to connect to database'.mysqli_connect_error();
}
?>