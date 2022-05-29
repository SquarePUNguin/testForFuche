
$("header>div div>button:nth-child(1)").click(function () {//вызывается при нажатии кнопки создать
    location.href="create.html"
})
$("header>div div>button:nth-child(2)").click(function () {//вызывается при нажатии кнопки Вывести Список 
    $("header>div div>button:nth-child(2)").prop("disabled",true);
    $(".dropmenu>div button").prop("disabled",true);//6-7:деактивируют кнопку поиска и Вывод списка
    let pullit = new AJAXpigeon("all","all","API/notebook/collector.php");
    let ISgrid=$("main>.dropmenu").slideToggle(function(){//setTimeout для активации кнопок
        setTimeout(function(){$("header>div div>button:nth-child(2)").prop("disabled",false);$(".dropmenu>div button").prop("disabled",false);},100);
    })//SLideToggle функция встроенная в jquery отображает или скрывает элемент с красивой анимацией 
    ISgrid=ISgrid.css("display");//запоминаем свойство display
    if(ISgrid=="block")//SlideToggle для отображения приравнивает display к block...
    {//...но элемент $(".treurnPHONES") должен иметь display:grid вместо block
        $("main>.dropmenu").css("display","grid");//display:grid
        pullit.ANSWARE(function(res){//мы хотим что-бы телефоны выводились при открытии шторки
            $(".returnPHONES").append(res);
        })
    }else{};
})
$("main>div button").click(function(){//вызывается по нажатию кнопки поиска 
    let search = new AJAXpigeon($("main>div input").val(),"search","API/notebook/collector.php");
    search.ANSWARE(function(res){//запрос на фильтрованный вывод контактов
        $(".returnPHONES").empty();//очистка поля вывода
        $(".returnPHONES").append(res);//полученную информацию выводим на страницу
    })
})
$("input").focus(function(){//вызывается когда пользователь нажимает на полу ввода
    let text=$(this).attr("placeholder");//запоминаем placeholder
    $(this).attr("placeholder"," ");//сменяем его на пустой текст
    $(this).blur(function(){//вызывается когда пользователь уходит с поля ввода
        $(this).attr("placeholder",text);//возвращает текст обратно
    });
})
$(".returnPHONES").on("click",".phone",function(){//вызывается когда пользователь кликает на контакт
    window.location.href="API/notebook/monoDISPLAY.php?id="+$(this).attr("id")+"";//переносит пользователя на страницу контакта
})
