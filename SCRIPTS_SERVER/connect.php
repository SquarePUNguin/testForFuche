<?php
session_start();
function connect()//данная функция создана для установки соединения с сервером 
{
$host='localhost'; 
$database='enter_test';
$user='internet_clients';
$pswd='123'; 
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
?>