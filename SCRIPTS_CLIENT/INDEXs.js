
$("header>div div>button:nth-child(1)").click(function () {
    //редактировать
})
$("header>div div>button:nth-child(2)").click(function () {
    //выводить
    $("header>div div>button:nth-child(2)").prop("disabled",true);
    $(".dropmenu>div button").prop("disabled",true);
    let pullit = new AJAXpigeon("all","all","API/notebook/collector.php","POST");
    let ISgrid=$("main>.dropmenu").slideToggle(function(){
        setTimeout(function(){$("header>div div>button:nth-child(2)").prop("disabled",false);$(".dropmenu>div button").prop("disabled",false);},100);
    })
    ISgrid=ISgrid.css("display");
    if(ISgrid=="block")
    {
        $("main>.dropmenu").css("display","grid");
        pullit.ANSWARE(function(res){
            $(".returnPHONES").append(res);
        })
    }else{};
    $(".dropmenu>div button").click(function(){
        console.log("lol")
    });
})
