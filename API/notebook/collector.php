<?php
include $_SERVER['DOCUMENT_ROOT'].'\API\connect.php';
$dbh=connect();
if(isset($_POST["input_id"]))
{
    $id=htmlspecialchars($_GET["id"]);
    $res=$dbh->prepare("SELECT FNP,COMP,PHONE,Email,BirthDay,img FROM book WHERE id=?");
    $res->bind_param("s",$id);
    $res->execute();
    $res=$res->get_result();
    $res=$res->fetch_assoc();
    $res="<div>"."<div></div>"."<div>"."<p>".$res["FNP"]."</p><br>"."<p>".$res["COMP"]."</p><br>".$res["PHONE"]."</p><br>".$res["Email"]."</p><br>".$res["BirthDay"]."</p>"."</div>";
    echo $res;
}
if(isset($_POST["input_all"])){
    $res=$dbh->prepare("SELECT id,FNP,COMP,PHONE,Email,BirthDay,img FROM book");
    $res->execute();
    $res=$res->get_result();
    for($i=0;$i<=$res->num_rows-1;$i++)
    {
        $value=$res->fetch_assoc();
        $result[$i]="<div id=".$value["id"]." class='phone'><div><div></div><div class='phoneIMG' style='background-image:url(".strval($value["img"]).")'></div><div></div></div><div>";
        if(!empty($value["img"])){
        }
        if(!empty($value["FNP"])){
            $result[$i]=$result[$i]."<p>ФИО:".$value["FNP"]."</p><br>";
        }
        if(!empty($value["BirthDay"])){
            $result[$i]=$result[$i]."<p>дата рождения:".$value["BirthDay"]."</p><br>";
        }
        if(!empty($value["COMP"])){
            $result[$i]=$result[$i]."<p>Компания:".$value["COMP"]."</p><br>";
        }
        if(!empty($value["PHONE"])){
            $result[$i]=$result[$i]."<p>Номер Телефона:".$value["PHONE"]."</p><br>";
        }
        if(!empty($value["Email"])){
            $result[$i]=$result[$i]."<p>E-mail:".$value["Email"]."</p><br>";
        }
        $result[$i]=$result[$i]."</div></div>";
    }
    $endgame="";
    foreach($result as $val)
    {
        $endgame=$endgame.$val;
    }
    echo $endgame;
}
?>