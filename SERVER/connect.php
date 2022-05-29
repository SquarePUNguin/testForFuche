<?php
session_start();
function connect()//данная функция создана для установки соединения с сервером 
{
$host='localhost';
$database='enter_test_fuche';
$user='root';
$pswd=''; 
$dbh = new mysqli($host, $user, $pswd,$database) or die("Не могу соединиться с MySQL.");
return $dbh;
}
function imageUPLOAD($data)
{
    $dest="API/notebook/PB_img";
    if(intval($data["error"][0])!=0){
        return $data["error"];
    }else{//если файл загрузился без ошибок то
        $tmp_name=$data["tmp_name"][0];//получае путь временного хранения
        $name=basename($data["name"][0]);//получаем имя файла
        if(move_uploaded_file($tmp_name,"$dest/$name")){//переносим файл если получилось то выводим его путь на сервере
        return "$dest/$name";
        }else{return NULL;}//или NULL
    }
}
?>