<?php
    include $_SERVER['DOCUMENT_ROOT'].'\API\connect.php';
    session_start();
    if(isset($_POST["input_create"]))
    {
        $dbh=connect();
        $data=$_POST["input_create"];
        foreach($data as $key => $val)
        {
            $data[$key]=htmlspecialchars($val);
            if($val=="")
            {
                $data[$key]=NULL;
            }
        }
        $path=imageUPLOAD($_FILES["img"]);
        $command = $dbh ->prepare("INSERT INTO book(FNP,COMP,PHONE,Email,BirthDay,img) VALUES(?,?,?,?,?,?)");
        $command->bind_param("ssssss",$data["FNP"],$data["COMP"],$data["PHONE"],$data["Email"],$data["BirthDay"],$path);
        $command->execute();
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
            $path=imageUPLOAD($_FILES["img"]);
            if($path!=null){
                $command=$dbh->prepare("UPDATE book SET img = ? WHERE id=?");
                $command->bind_param("ss",$path,$data["id"]);
                $command->execute();
            }else{echo "fail";}
    }
    if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
        $dbh=connect();
        $data=file_get_contents('php://input');
        $command=$dbh->prepare("DELETE FROM book WHERE id=?");
        $command->bind_param("s",$data);
        $command->execute();
    }
?>