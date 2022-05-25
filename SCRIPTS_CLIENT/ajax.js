
class AJAXpigeon {
    static #CreateRequest() {//создаёт объект типа XMLHttpRequest дя AJAX запроса
        var Request = false;
        Request = new XMLHttpRequest();
        if (window.XMLHttpRequest) {
            //Gecko-совместимые браузеры, Safari, Konqueror
            Request = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            //Internet explorer
            try {
                Request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (CatchException) {
                Request = new ActiveXObject("Msxml2.XMLHTTP");
            }
        }
        if (!Request) {
            alert("Невозможно создать XMLHttpRequest");
        }
        return Request;
    }
    constructor(victim, name, destination) {
        var itdata = victim;
        rec = AJAXpigeon.#CreateRequest();
        rec.open("POST", destination);
        rec.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        itdata = encodeURIComponent(itdata);
        rec.responseType = "text";
        rec.send("input_" + name + "=" + itdata);
        DATA=rec;
    }
    Newdestination(victim, name, destination) {
        var itdata = victim;
        rec = AJAXpigeon.#CreateRequest();
        rec.open("POST", destination);
        rec.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        itdata = encodeURIComponent(itdata);
        rec.responseType = "text";
        rec.send("input_" + name + "=" + itdata);
        DATA=rec;
    }
    RETURN(func)
    {
        DATA.onreadystatechange = function()
        {
            if(DATA.readyState ==4 && DATA.status ==200)
            {
                DATA= DATA.responseText;
                func();
            }
        }
    }
    GetDATA()
    {
        return DATA;
    }
}