<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include '*/API/connect.php';
    session_start();
        if(isset($_POST["input_create"]))
        {
            $dbh=connect();
            $data=json_decode($_POST["input_create"],true);
            foreach($data as $key => $val)
            {
                $data[$key]=htmlspecialchars($val);
            }
            $command = $dbh ->prepare("INSERT into book(FNP,COMP,PHONE,Email,BirthDAY) VALUES(?,?,?,?,?);SELECT LAST_INSERT_ID();");
            $command->bind_param("sssss",$data["FNP"],$data["COMP"],$data["PHONE"],$data["Email"],$data["BirthDAY"]);
            $command->execute();
            $command->get_result();
            $command->fetch_assoc();
            $id=$command["id"];
            $path=imageUPLOAD($_FILE["img"]);
                $command=$dbh->prepare("UPDATE book SET img=? WHERE id=?");
                if($path!=NULL){$command->bind_params("ss",$path,$id);}
                else{$path="API/notebook/PB_img/NONE.img";}
                $command->execute();
        }
        if(isset($_POST["input_edit"]))
        {
            $dbh=connect();
            $data=json_decode($_POST["input_create"],true);
            foreach($data as $key => $val)
            {
                $data[$key]=htmlspecialchars($val);
            }
            $command = $dbh ->prepare("UPDATE book Set FNP=?,COMP=?,PHONE=?,Email=?,BirthDAY=? WHERE id=?");
            $command->bind_param("ssssss",$data["FNP"],$data["COMP"],$data["PHONE"],$data["Email"],$data["BirthDAY"],$data["id"]);
            $command->execute();
        }
?>