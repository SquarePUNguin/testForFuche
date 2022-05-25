
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
    constructor(a, b, c) {
        if (a != undefined || b != undefined || c != undefined) {
            this.massage = a;
            this.title = b;
            this.destination = c;
            this.fly = this.Newdestination(this.massage, this.title, this.destination);
        }else{}
    }
    Newdestination(victim, name, destination) {
        data = victim;
        rec = AJAXpigeon.#CreateRequest();
        rec.open("POST", destination);
        rec.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        data = encodeURIComponent(data);
        rec.responseType = "text";
        rec.send("input_" + name + "=" + data);
        return rec;
    }
    RETURN(func) {
        this.fly.onreadystatechange = function () {
            if (this.fly.readyState == 4 && this.fly.status == 200) {
                this.fly = this.fly.responseText;
                func();
            }
        }
    }
    Getthisfly() {
        return this.fly;
    }
}