<?php
    require("../connector.php");

    if(isset($_POST["Update"])){
        $vid = $_POST["vaxid"];
        $name = $_POST["name"];
        $type = $_POST["type"];
        $brand = $_POST["brand"];
        $usage = $_POST["usage"];
        
        if($name=="" || $type=="" || $brand=="" || $usage==""){
            echo "<script>alert('Please complete the fields required!');
            window.location='../../account.php'</script>";
        } else {
            $sql = "UPDATE alagapp_db.tbl_vaxxinfo SET
                vaxname = :vaxname,
                vaxtype = :vaxtype,
                vaxbrand = :vaxbrand,
                vaxused = :vaxused

                WHERE vaxid = :vaxid";

            $values = array(
                ":vaxid"=>$vid,
                ":vaxname"=>$name,
                ":vaxtype"=>$type,
                ":vaxbrand"=>$brand,
                ":vaxused"=>$usage
            );

            $result = $connect->prepare($sql);
            $result->execute($values);

            if($result->rowCount()>0) {
               echo "<script>alert('Record has been updated!');
               window.location='../../account.php'</script>";
            } else {
                echo "<script>alert('Unable to update record!')
                window.location='../../account.php'</script>";
            }
        }
    }
?>
        <form action="editData/vaxx_edit.php" method="POST">
<?php
    $vid = $_REQUEST["id"];
    $sql_vaxx = "SELECT * FROM alagapp_db.tbl_vaxxinfo WHERE vaxid = :vaxid";

    try{
        $vaxx_res = $connect->prepare($sql_vaxx);
        $value = array("vaxid"=>$vid);
        $vaxx_res->execute($value);

        $name = "";
        $type = "";
        $brand = "";
        $usage = "";
        
        if($vaxx_res->rowCount()==1){
            $vaxx_row = $vaxx_res->fetch(PDO::FETCH_ASSOC);

            $name = $vaxx_row["vaxname"];
            $type = $vaxx_row["vaxtype"];
            $brand = $vaxx_row["vaxbrand"];
            $usage = $vaxx_row["vaxused"];
        }
    } catch(PDOException $e){
        die("An error has occured!");
    }
?>
                <input type='hidden' name='vaxid' value="<?php echo $vid; ?>">
                <h1>Vaccine Information</h1><br>
                <div class="input-group">
                    <label class="input-group-text">Name</label>
                    <input class='form-control' type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $name; ?>">
                    <label class="input-group-text">Type</label>
                    <input class='form-control' type="text" class="form-control" placeholder="Type" name="type" value="<?php echo $type; ?>">
                    <label class="input-group-text">Brand</label>
                    <input class='form-control' type="text" class="form-control" placeholder="Brand" name="brand" value="<?php echo $brand; ?>">
                    <label class="input-group-text">Usage</label>
                    <input class='form-control' type="text" class="form-control" placeholder="Usage" name="usage" value="<?php echo $usage; ?>">
                </div><br>
                <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button id='submitVaccineEdit' type='submit' name='submit' class='btn btn-primary'>Save changes</button>
            </div>
        </form>