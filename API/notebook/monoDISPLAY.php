<!DOCTYPE html>
<html>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<?php
include $_SERVER['DOCUMENT_ROOT'].'\API\connect.php';
$dbh=connect();
$id=($_GET["id"]);
$res=$dbh->prepare("SELECT FNP,COMP,PHONE,Email,BirthDay,img FROM book WHERE id=?");
    $res->bind_param("s",$id);
    $res->execute();
    $res=$res->get_result();
    $res=$res->fetch_assoc();
    $res["id"]=$id;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/STYLES/all.css" rel="stylesheet">
    <link href="/STYLES/mono.CSS" rel="stylesheet">
    <title>
        <? echo $res["FNP"]; ?>
    </title>
</head>

<body>
    <header>
        <img src='<? echo'/'.$res["img"]?>' alt='user image'></img>
        <div id="<? echo $id ?>">
            <? 
                if(!empty($res["FNP"])){echo "<p>".$res["FNP"]."</p>";}
                if(!empty($res["PHONE"])){echo "<p>".$res["PHONE"]."</p>";}
                if(!empty($res["COMP"])){echo "<p>".$res["COMP"]."</p>";}
                if(!empty($res["Email"])){echo "<p>".$res["Email"]."</p>";} 
                if(!empty($res["BirthDay"])){echo "<p>".$res["BirthDay"]."</p>";} 
            ?>
        </div>
    </header>
    <footer>
        <button>редактировать</button>
        <p style='display:none'><? echo json_encode($res)?></p>
    </footer>
    <script src="/SCRIPTS_CLIENT/ajax.js"></script>
    <script>
        $("footer button").click(function(){
            var value =JSON.parse($('footer>p').text());
            $("header>div").empty();
            let PHolder=`<form class="redact" name='redact' enctype="multipart/form-data">
            <input placeholder='`+value["FNP"]+`' name='input_edit[FNP]'>:ФИО<br>
            <input placeholder='`+value["PHONE"]+`' name='input_edit[PHONE]'>:Телефон<br>
            <input placeholder='`+value["COMP"]+`' name='input_edit[COMP]'>:Компания<br>
            <input placeholder='`+value["Email"]+`' name='input_edit[Email]'>:E-mail<br>
            <input type="date" placeholder='`+value["BirthDay"]+`' name='input_edit[BirthDay]'>:Дата рождения<br>
            <input placeholder='`+value["img"]+`' type='file' accept='image/*' name='img'>:Изображение<br>
            <button>Отправить</button>
            </form>`;
            $("header>div").append(PHolder);

        })
        $("header>div").on("submit",".redact",function(){
            var data = new FormData($("form.redact")[0]);
            console.log(data);
            $.ajax({
                url:"/API/notebook/manipulator.php",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType : 'json',
                data:data
            })
            return false;
        })
    </script>
    
</body>