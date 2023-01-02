<?php
    require("../connector.php");

    if(isset($_POST["submit"])){
        $name = $_POST["name"];
        $type = $_POST["type"];
        $brand = $_POST["brand"];
        $description = $_POST["description"];

        if($name=="" || $type=="" || $brand==""){
            echo "<script>alert('Please complete the fields required!');
            window.location='../../dashboard.php'</script>";
        } else {
            $sql = "INSERT INTO alagapp_db.tbl_vaxxinfo(
                vaxname,
                vaxtype,
                vaxbrand,
                vaxdes) VALUES(
                    :vaxname,
                    :vaxtype,
                    :vaxbrand,
                    :vaxdes)";

            $result = $connect->prepare($sql);

            $values = array(
                ":vaxname"=>$name,
                ":vaxtype"=>$type,
                ":vaxbrand"=>$brand,
                ":vaxdes"=>$description
            );

            $result->execute($values);

            if($result->rowCount()>0) {
                echo "<script>alert('Record has been save!');
                window.location='../../dashboard.php'</script>";
             } else {
                 echo "<script>alert('Unable to add record!');
                 window.location='../../dashboard.php'</script>";
             }
        }
    }
echo "
    <form action='api/newData/vaccineNew.php' method='POST'>
        <h1>New Vaccine Information</h1><br>
            <div class='input-group'>
                <label class='input-group-text'>Name</label>
                <input placeholder=\"Name\" type='text' class='form-control' name='name'>
                <label class='input-group-text'>Type</label>
                <input placeholder=\"Type\" type='text' class='form-control' name='type'>
                <label class='input-group-text'>Brand</label>
                <input placeholder=\"Brand\" type='text' class='form-control' name='brand'>
            </div><br>
            <div class='input-group'>
                <label class='input-group-text'>Description</label>
                <input placeholder=\"Enter Description\" type='text' class='form-control' name='description'>
            </div><br>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' name='submit' class='btn btn-primary'>Add Vaccine</button>
        </div>
    </form>";
?>