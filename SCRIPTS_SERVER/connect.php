<?php
session_start();
function connect()//данная функци создана для установки соединения с сервером 
{
$host='localhost'; 
$database='enter_test';
$user='internet_clients';
$pswd='123'; 
$dbh = new mysqli($host, $user, $pswd,$database) or die("Не могу соединиться с MySQL.");
return $dbh;
}
function HASHIT($pass)//а это wrapper для password_hash() 
{
    return password_hash($pass,PASSWORD_DEFAULT);
}
function HASHIT($pass,$hash)//ещё однин wrapper но для password_verify();
{
    return password_verify($pass,$hash);
}
?>