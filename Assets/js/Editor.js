var editor = ace.edit("editor");
editor.setTheme("ace/theme/twilight");
editor.session.setMode("ace/mode/python");

document.getElementById("editor").style['height'] = 0.6 * window.innerHeight;
document.getElementById("editor").style['margin'] = "0 auto";
document.getElementById("output").style['height'] = 0.4 * window.innerHeight;

function printString(text) {
    var output = document.getElementById("output");
    text = text.replace(/</g, '&lt;');
    output.innerHTML = output.innerHTML + text;
}

function clearOutput() {
    var output = document.getElementById("output");
    output.innerHTML = '';
}

function builtinRead(x) {
    if (Sk.builtinFiles === undefined || Sk.builtinFiles["files"][x] === undefined)
        throw "File not found: '" + x + "'";
    return Sk.builtinFiles["files"][x];
}

function addModal() {
    $(Sk.main_canvas).css("border", "2px solid #0e0e0e");
    $(Sk.main_canvas).css("background", "#191919");
    var currentTarget = resetTarget();

    var div1 = document.createElement("div");
    currentTarget.appendChild(div1);
    $(div1).addClass("modal");
    $(div1).css("text-align", "center");

    var btn1 = document.createElement("span");
    $(btn1).addClass("btn btn-primary btn-sm pull-right");
    var ic = document.createElement("i");
    $(ic).addClass("fas fa-times");
    btn1.appendChild(ic);

    $(btn1).on('click', function(e) {
        Sk.insertEvent("quit");
    });

    var div2 = document.createElement("div");
    $(div2).addClass("modal-dialog modal-lg");
    $(div2).css("display", "inline-block");
    $(div2).width(self.width + 42);
    $(div2).attr("role", "document");
    div1.appendChild(div2);

    var div3 = document.createElement("div");
    $(div3).addClass("modal-content");
    $(div3).css("background", "#191919");
    div2.appendChild(div3);

    var div4 = document.createElement("div");
    $(div4).addClass("modal-header d-flex justify-content-between");
    $(div4).css("border-color", "#151515");
    var div5 = document.createElement("div");
    $(div5).addClass("modal-body");
    var div6 = document.createElement("div");
    $(div6).addClass("modal-footer");
    $(div6).css("border-color", "#151515");
    var div7 = document.createElement("div");
    $(div7).addClass("col-md-8");
    var div8 = document.createElement("div");
    $(div8).addClass("col-md-4");
    var header = document.createElement("h5");
    Sk.title_container = header;
    $(header).addClass("modal-title");


    div3.appendChild(div4);
    div3.appendChild(div5);
    div3.appendChild(div6);

    div4.appendChild(header);
    div4.appendChild(btn1);
    // div7.appendChild(header);
    // div8.appendChild(btn1);

    div5.appendChild(Sk.main_canvas);

    createArrows(div6);
    $(div1).modal({
        backdrop: 'static',
        keyboard: false
    });
}

function outf(text) {
    var output = document.getElementById("output");
    text = text.replace(/</g, '&lt;');
    output.innerHTML = output.innerHTML + text;
}