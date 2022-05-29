
$("header>div div>button:nth-child(1)").click(function () {
    //создать
    location.href="create.html"
})
$("header>div div>button:nth-child(2)").click(function () {
    $("header>div div>button:nth-child(2)").prop("disabled",true);
    $(".dropmenu>div button").prop("disabled",true);
    let pullit = new AJAXpigeon("all","all","API/notebook/collector.php");
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
$("main>div button").click(function(){
    let search = new AJAXpigeon($("main>div input").val(),"search","API/notebook/collector.php");
    search.ANSWARE(function(res){
        $(".returnPHONES").empty();
        $(".returnPHONES").append(res);
    })
})
$("input").focus(function(){
    let text=$(this).attr("placeholder");
    $(this).attr("placeholder"," ");
    $(this).blur(function(){
        $(this).attr("placeholder",text);
    });
})
$(".returnPHONES").on("click",".phone",function(){
    console.log($(this).attr("id"));
    window.location.href="API/notebook/monoDISPLAY.php?id="+$(this).attr("id")+"";
})
