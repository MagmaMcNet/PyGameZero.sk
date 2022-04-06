<script type="text/javascript">

function removeElementsByClass(className) {
    const elements = document.getElementsByClassName(className);
    while (elements.length > 0) {
        elements[0].parentNode.removeChild(elements[0]);
    }
}

function removeElementsById(IdName) {
    const elements = document.getElementById(IdName);
    while (elements.length > 0) {
        elements[0].parentNode.removeChild(elements[0]);
    }
}

function close_force() {
    document.getElementById("main").className = ""
    document.getElementById("mycanvas").innerHTML = ""
    removeElementsByClass("modal-backdrop in")
}
var editor = ace.edit("editor");
editor.setTheme("ace/theme/twilight");
editor.session.setMode("ace/mode/python");

document.getElementById("editor").style['height'] = 0.9 * window.innerHeight;
document.getElementById("editor").style['width'] = 0.45 * window.innerWidth;
document.getElementById("editor").style['margin'] = "0 auto";
document.getElementById("output").style['height'] = 0.4 * window.innerHeight;
document.getElementById("output").style['width'] = 0.5 * window.innerWidth;
</script>
<script>
var basePath = './Modules/Pygame/';
Sk.externalLibraries = {
    'Cookies': {
        path: './Modules/Cookies.js',
    },
    'JsForPy': {
        path: './Modules/JsForPy.js',
    },
    'Sounds': {
        path: './Share/'+Cookies.get("ID")+'/Audio.js',
    },
    'json': {
        path: './Modules/Json/Json.js',
        dependencies: [
            './Modules/Json/Stringify.js'
        ]
    },
    'pygame': {
        path: basePath + 'pygame.js',
    },
    'pygame.display': {
        path: basePath + 'display.js',
    },
    'pygame.draw': {
        path: basePath + 'draw.js',
    },
    'pygame.event': {
        path: basePath + 'event.js',
    },
    'pygame.font': {
        path: basePath + 'font.js',
    },
    'pygame.image': {
        path: basePath + 'image.js',
    },
    'pygame.key': {
        path: basePath + 'key.js',
    },
    'pygame.mouse': {
        path: basePath + 'mouse.js',
    },
    'pygame.time': {
        path: basePath + 'time.js',
    },
    'pygame.transform': {
        path: basePath + 'transform.js',
    },
    'pygame.version': {
        path: basePath + 'version.js',
    },
};

function resetTarget() {
    var selector = Sk.TurtleGraphics.target;
    var target = typeof selector === "string" ? document.getElementById(selector) : selector;
    // clear canvas container
    while (target.firstChild) {
        target.removeChild(target.firstChild);
    }
    return target;
}

function createArrows(div) {
    var arrows = new Array(4);
    var direction = ["left", "right", "up", "down"];
    $(div).addClass("d-flex justify-content-center");
    for (var i = 0; i < 4; i++) {
        arrows[i] = document.createElement("span");
        div.appendChild(arrows[i]);
        $(arrows[i]).addClass("btn btn-primary btn-arrow");
        var ic = document.createElement("i");
        $(ic).addClass("fas fa-arrow-" + direction[i]);
        arrows[i].appendChild(ic);
    }


    var swapIcon = function(id) {
        $(arrows[id].firstChild).removeClass("fa-arrow-" + direction[id]).addClass("fa-arrow-circle-" + direction[id]);
    }

    var returnIcon = function(id) {
        $(arrows[id].firstChild).removeClass("fa-arrow-circle-" + direction[id]).addClass("fa-arrow-" + direction[id]);
    }

    $(arrows[0]).on('mousedown', function() {
        Sk.insertEvent("left");
        swapIcon(0);
    });
    $(arrows[0]).on('mouseup', function() {
        returnIcon(0);
    });
    $(arrows[1]).on('mousedown', function() {
        Sk.insertEvent("right");
        swapIcon(1);
    });
    $(arrows[1]).on('mouseup', function() {
        returnIcon(1);
    });
    $(arrows[2]).on('mousedown', function() {
        Sk.insertEvent("up");
        swapIcon(2);
    });
    $(arrows[2]).on('mouseup', function() {
        returnIcon(2);
    });
    $(arrows[3]).on('mousedown', function() {
        Sk.insertEvent("down");
        swapIcon(3);
    });
    $(arrows[3]).on('mouseup', function() {
        returnIcon(3);
    });

    $(document).keydown(function(e) {
        switch (e.which) {
            case 37:
                swapIcon(0);
                break;
            case 38:
                swapIcon(2);
                break;
            case 39:
                swapIcon(1);
                break;
            case 40:
                swapIcon(3);
                break;
        }
    });

    $(document).keyup(function(e) {
        switch (e.which) {
            case 37:
                returnIcon(0);
                break;
            case 38:
                returnIcon(2);
                break;
            case 39:
                returnIcon(1);
                break;
            case 40:
                returnIcon(3);
                break;
        }
    });
};

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
    $(Sk.main_canvas).css("border", "5px solid #0e0e0e");
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

    $(btn1).on('click', function(){
        Sk.insertEvent("quit")
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

function download() {
    <?php
    download();
    ?>
    window.location.href = "Zip/"+Cookies.get("ID")+".zip"
}

function runCode() {
    var output = document.getElementById("output");
    output.innerHTML = '';
    Sk.configure({
        output: outf
    });
    Sk.main_canvas = document.createElement("canvas");
    Sk.quitHandler = function() {
        $('.modal').modal('hide');
    };
    addModal();

    function top() {
        return $.ajax({
            type: "GET",
            url: "./Base/Mapper_Top.py",
            async: false
        }).responseText;
    }

    function low() {
        return $.ajax({
            type: "GET",
            url: "./Base/Mapper_Bottom.py",
            async: false
        }).responseText;
    }
    var prog = editor.getValue();
    Sk.misceval.asyncToPromise(function() {
        try {
            return Sk.importMainWithBody("<stdin>", false, top() + prog + low(), true);
        } catch (e) {
            e.traceback[0].lineno -= 1856;
            console.log(e)
            alert(e)
            location.reload();

        }
    })

}

(Sk.TurtleGraphics || (Sk.TurtleGraphics = {})).target = 'mycanvas';
Sk.configure({
    read: builtinRead,
    output: printString
});
$("#runbutton").click(function() {
    runCode();
});
editor.setValue($.ajax({type: "GET", url: "Share/"+Cookies.get("ID")+"/main.py",async: false}).responseText);
</script>