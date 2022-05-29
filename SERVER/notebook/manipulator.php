<?php
    include $_SERVER['DOCUMENT_ROOT'].'\API\connect.php';
    session_start();
    if(isset($_POST["input_create"]))//если прибыл запрос на создание то
    {
        $dbh=connect();//соединяемся с сервером
        $data=$_POST["input_create"];//запроминаем данные от запроса 
        foreach($data as $key => $val)
        {
            $data[$key]=htmlspecialchars($val);//срезаем все возможные html тэги 
            if($val=="")
            {
                $data[$key]=NULL;//если значение пустая строка то приравниваем к NULL
            }
        }
        $path=imageUPLOAD($_FILES["img"]);//пытаемся загрузить файл на сервер
        $command = $dbh ->prepare("INSERT INTO book(FNP,COMP,PHONE,Email,BirthDay,img) VALUES(?,?,?,?,?,?)");//запрос на создание
        $command->bind_param("ssssss",$data["FNP"],$data["COMP"],$data["PHONE"],$data["Email"],$data["BirthDay"],$path);
        $command->execute();
    }
    if(isset($_POST["input_edit"]))//если запрос на редакцию то
    {
            $dbh=connect();//соединяемся с сервером
            $data=$_POST["input_edit"];//запоминаем данные
            foreach($data as $key => $val)
            {
                $data[$key]=htmlspecialchars($val);//срезаем все возможные html тэги 
                if($val=="")
                {
                    $data[$key]=NULL;//если значение пустая строка то приравниваем к NULL
                }
            }
            $command = $dbh ->prepare("UPDATE book Set FNP=IFNULL(?,FNP),COMP=IFNULL(?,COMP),PHONE=IFNULL(?,PHONE),Email=IFNULL(?,Email),BirthDAY=IFNULL(?,BirthDay) WHERE id=?");
            $command->bind_param("ssssss",$data["FNP"],$data["COMP"],$data["PHONE"],$data["Email"],$data["BirthDay"],$data["id"]);
            $command->execute(); 
            $path=imageUPLOAD($_FILES["img"]);
            if($path!=null){//если путь не равен NULL то 
                $command=$dbh->prepare("UPDATE book SET img = ? WHERE id=?");
                $command->bind_param("ss",$path,$data["id"]);
                $command->execute();//обновляем путь до новой фотограйии профиля
            }else{echo "fail";}
    }
    if($_SERVER['REQUEST_METHOD'] === 'DELETE'){//если запрос на удоление то
        $dbh=connect();//связываемся с сервером
        $data=file_get_contents('php://input');//получаем данные из запроса
        $command=$dbh->prepare("DELETE FROM book WHERE id=?");
        $command->bind_param("s",$data);
        $command->execute();//удаляем данные
    }
?>