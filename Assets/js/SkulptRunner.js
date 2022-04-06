var pygame_basepath = './Modules/Pygame/';
Sk.externalLibraries = {
    'Cookies': {
        path: './Modules/Cookies.js',
    },
    'JsForPy': {
        path: './Modules/JsForPy.js',
    },
    'Sounds': {
        path: './Modules/Sounds.js',
    },
    'json': {
        path: './Modules/Json/Json.js',
        dependencies: [
            './Modules/Json/Stringify.js'
        ]
    },
    'pygame': {
        path: pygame_basepath + 'pygame.js',
    },
    'pygame.display': {
        path: pygame_basepath + 'display.js',
    },
    'pygame.draw': {
        path: pygame_basepath + 'draw.js',
    },
    'pygame.event': {
        path: pygame_basepath + 'event.js',
    },
    'pygame.font': {
        path: pygame_basepath + 'font.js',
    },
    'pygame.image': {
        path: pygame_basepath + 'image.js',
    },
    'pygame.key': {
        path: pygame_basepath + 'key.js',
    },
    'pygame.mouse': {
        path: pygame_basepath + 'mouse.js',
    },
    'pygame.time': {
        path: pygame_basepath + 'time.js',
    },
    'pygame.transform': {
        path: pygame_basepath + 'transform.js',
    },
    'pygame.version': {
        path: pygame_basepath + 'version.js',
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