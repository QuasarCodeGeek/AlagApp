<?php
    require("../_connector.php");
    
        $type = $_REQUEST['type'];
        $part = $_REQUEST['part'];
        $symptom = $_REQUEST['symptom'];
        
        $find = "SELECT * FROM alagapp_db.tbl_symptom
            WHERE pettype = '".$type."'
            AND bodypart LIKE '%".$part."%'
            AND symptom LIKE '%".$symptom."%' ";
        
            $checkfind = $connect->prepare($find);
            $checkfind->execute();

            if($checkfind->rowCount()>0) {
                $k=1;
                while($row = $checkfind->fetch(PDO::FETCH_ASSOC)){
                    echo "
                        <div class='card m-2' >
                            <div class='card-body'
                                <h5 class='card-title'><b>".$row['diagnosis']."</b></h5>
                                <p class='card-text'>".$row['description']."</p>
                            </div>
                        </div>";
                    $k++;
                }
            }
    
?>