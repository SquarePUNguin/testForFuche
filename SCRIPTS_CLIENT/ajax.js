
class AJAXpigeon {
    static #CreateRequest() {//создаёт объект типа XMLHttpRequest для AJAX запроса
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
    constructor(a, b, c, type) {
        if (a != undefined || b != undefined || c != undefined) {
            this.massage = a;
            this.title = b;
            this.destination = c;
            this.fly = this.Newdestination(this.massage, this.title, this.destination);
        } else { }
    }
    Newdestination(victim, name, destination, type) {
        if (victim != undefined) { this.massage = victim; }
        if (name != undefined) { this.title = name; }
        if (destination != undefined) { this.destination = destination; }
        this.fly = AJAXpigeon.#CreateRequest();
        this.fly.open("POST", this.destination);
        this.fly.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        this.massage = encodeURIComponent(this.massage);
        this.fly.responseType = "text";
        this.fly.send("input_" + this.title + "=" + this.massage);
        return this.fly;
    }
    ANSWARE(func) {
        let res = this.fly
        res.onreadystatechange = function () {
            if (res.readyState == 4 && res.status == 200) {
                if (typeof func === 'function') {
                    res = res.responseText;
                    func(res);
                } else {
                    res = res.responseText;
                    return res.responseText;
                }
            }

        }
    }
    GetFLY() {
        return this.fly;
    }
}