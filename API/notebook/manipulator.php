<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include $_SERVER['DOCUMENT_ROOT'].'\API\connect.php';
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
            if($path!=null){
                $command=$dbh->prepare("UPDATE book SET img=? WHERE id=?");
                if($path!=NULL){$command->bind_params("ss",$path,$id);}
                else{$path="API/notebook/PB_img/NONE.img";}
                $command->execute();
            }
    }
    if(isset($_POST["input_edit"]))
    {
            $dbh=connect();
            $data=$_POST["input_edit"];
            foreach($data as $key => $val)
            {
                $data[$key]=htmlspecialchars($val);
                if($val=="")
                {
                    $data[$key]=NULL;
                }
            }
            var_dump($data);
            $command = $dbh ->prepare("UPDATE book Set FNP=IFNULL(?,FNP),COMP=IFNULL(?,COMP),PHONE=IFNULL(?,PHONE),Email=IFNULL(?,Email),BirthDAY=IFNULL(?,BirthDay) WHERE id=?");
            $command->bind_param("ssssss",$data["FNP"],$data["COMP"],$data["PHONE"],$data["Email"],$data["BirthDay"],$data["id"]);
            $command->execute();    
            $path=imageUPLOAD($_FILES["img"],$data["id"]);
            if($path!=null){
                $command=$dbh->prepare("UPDATE book SET img = ? WHERE id=?");
                $command->bind_param("ss",$path,$data["id"]);
                $command->execute();
            }else{echo "fail";}
    }
    if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
        $data=file_get_contents('php://input');
        echo $data;
        
    }
?>