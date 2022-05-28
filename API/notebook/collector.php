<?php
include $_SERVER['DOCUMENT_ROOT'].'\API\connect.php';
$dbh=connect();
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
if(isset($_POST["input_search"])){
    echo $POST["input_search"]; 
    
    $res=$dbh->prepare("SELECT id,FNP,COMP,PHONE,Email,BirthDay,img FROM book 
    WHERE id LIKE CONCAT( '%',?,'%') or FNP LIKE CONCAT( '%',?,'%') or COMP LIKE CONCAT( '%',?,'%') or PHONE LIKE CONCAT( '%',?,'%') or Email LIKE CONCAT( '%',?,'%') or BirthDay LIKE CONCAT( '%',?,'%') or img LIKE CONCAT( '%',?,'%')");
    $res->bind_param("sssssss",$_POST["input_search"],$_POST["input_search"],$_POST["input_search"],$_POST["input_search"],$_POST["input_search"],$_POST["input_search"],$_POST["input_search"]);
    $res->execute();
    $res=$res->get_result();
    if(intval($res->num_rows) >0){
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
    }else{echo "<p class='OHno'>Nothing was found :(</p>";}
}
?>