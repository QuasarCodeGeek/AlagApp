<?php
    require("_connector.php");
    
        $type = $_REQUEST['type'];
        $part = $_REQUEST['part'];
        $symptom = $_REQUEST['symptom'];
        
        $find = "SELECT * FROM alagapp_db.tbl_symptom
            WHERE pettype LIKE '".$type."'
            AND bodypart LIKE '%".$part."%'
            AND symptom LIKE '%".$symptom."%' ";
        
            $checkfind = $connect->prepare($find);
            $checkfind->execute();

            if($checkfind->rowCount()>0) {
                $k=1;
                while($row = $checkfind->fetch(PDO::FETCH_ASSOC)){
                    echo "
                        <div class='m-2 card card-body'>
                            <div>
                                <label><strong>".$row['diagnosis']."</strong></label><br>
                                <label>".$row['description']."</label>
                            </div>
                        </div>";
                    $k++;
                }
            }
    
?>