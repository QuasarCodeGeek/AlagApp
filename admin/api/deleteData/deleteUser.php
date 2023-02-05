<?php
require("./../connector.php");

    $id = $_GET['userid'];

    if(isset($_POST['delete'])){
        $del = "DELETE FROM table_name WHERE condition;";
    }
?>