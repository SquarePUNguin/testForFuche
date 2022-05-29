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
function HASHIT($pass,$hash)//а это wrapper для password_hash() и password_verify();
{
    if($hash == undefined){
        return password_verify($pass,$hash);
    }
    else{
    return password_hash($pass,PASSWORD_DEFAULT);}  
}
function imageUPLOAD($data)
{
    $dest="PB_img";
    if(intval($data["error"][0])!=0){
        return $data["error"];
    }else{
        $tmp_name=$data["tmp_name"][0];
        $name=basename($data["name"][0]);
        if(move_uploaded_file($tmp_name,"$dest/$name")){
        return "API/notebook/"."$dest/$name";
        }else{return NULL;}
    }
}
?>