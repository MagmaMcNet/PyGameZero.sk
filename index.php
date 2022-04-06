<html lang="en" manifest="/offline.manifest">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>MagmaMc - pgzero online</title>
    <meta name="author" content="MagmaMc">
    <meta name="description" content="Runs python code online">
    <meta name="keywords" content="Skulpt, pygame, pyzero, online, pygame-zero">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="🌐 MagmaMc - pgzero online">
    <meta name="twitter:description" content="Runs python code online">
    <meta name="twitter:site" content="@SMLkaiellis">
    <meta name="twitter:creator" content="@SMLkaiellis">
    <meta name="twitter:image" content="./logo.gif">

    <meta property="og:title" content="🌐 MagmaMc - pgzero online">
    <meta property="og:description" content="Runs python code online">
    <meta property="og:url" content="http://magma-mc.net/">
    <meta property="og:site_name" content="magma-mc.net">
    <meta property="og:type" content="website">
    <meta content="#306998" data-react-helmet="true" name="theme-color">
    <meta property="og:image" content="./logo.gif">

    <meta property="fb:app_id" content="100075697834863">
    <meta http-equiv="Cache-control" content="no-cache">
    <!-- Import -->
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2295738695724894" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="./Base/Skulpt/skulpt.min.js" type="text/javascript"></script>
    <script src="./Base/Skulpt/skulpt-stdlib.js" type="text/javascript"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.1/ace.js" type="text/javascript"></script>
    <script src="./Base/main.js" type="text/javascript"></script>
    <script src="./Modules/Audio/GetAudio.php?ID=<?php echo $_GET["ID"]; ?>" type="text/javascript"></script>
    <link rel="stylesheet" href="./Assets/css.css"> 

</head>
<script type="text/javascript">
    var isloaded = false;
    var istouchin = false;
    var touch_x = 1234
    var touch_y = 1234
        
<?php
if(isset($_GET["ID"])){
    ?>
        id = new URLSearchParams(window.location.search).get('ID')
        if(Cookies.get("ID") != id) {
            
            Cookies.set("ID", id)
        }

    <?php
	if(!is_dir("Share/".$_GET["ID"])){
		mkdir("Share/".$_GET["ID"], 0777, true);
		mkdir("Share/".$_GET["ID"]."/images", 0777, true);
		mkdir("Share/".$_GET["ID"]."/sounds", 0777, true);
		mkdir("Share/".$_GET["ID"]."/files", 0777, true);
		$mainfile = fopen("Share/".$_GET["ID"]."/main.py", "c");
		fclose($mainfile);
		$OwnerFile = fopen("Share/".$_GET["ID"]."/ownerList.ini", "a+");
        fwrite($OwnerFile, $_COOKIE["UserID"].",\n");
		fclose($mainfile);
        echo 'location.reload()';
	} else {
		$OwnerFile = fopen("Share/".$_GET["ID"]."/ownerList.ini", "c+");
        $owners = fread($OwnerFile, filesize("Share/".$_GET["ID"]."/ownerList.ini"));
        fclose($OwnerFile);
    }
	
} else {
	?>
		window.location.href = "?ID="+UserID(10);
	<?php
}
?>
</script>
<embed type="text/html" src="nav_home.html"  width="100%" height="14%">
<body id="main" style="background: #1c1c1c; color: white; text-align: center;" oncontextmenu="return false" onselectstart="return false" ondragstart="return false">

    <div class="col-md-8">

        <div id="mycanvas">

        </div>
    </div>

    <div class="row">
        <div class="col-xs-6" id="editorsplace">
            <div id=editor style="border: 1px solid black; border: 0px;"></div>
        </div>
        <div class="col-xs-6" id="editorsplace"></div>

        <div class="output">
            <?php
            if(isset($_COOKIE["UserID"])) {
                if (strpos($owners, $_COOKIE["UserID"])  !== false or strpos($owners, "Global") !== false) {
                ?>
                    <button class="btn btn-warning" id="download" onclick="download()" title="Download">Download <span class="glyphicon glyphicon-download-alt"></span></button>
                    <a class="btn btn-success" id="file" target="_blank" href="fileexplorer.php" title="File Explorer">File Explorer <span class="glyphicon glyphicon-folder-open"></span></a>
                <?php
                }else {
                ?>
                    <button class="btn btn-danger" onclick="alert('changes will be pulled from server and not saved\nfileexplorer disabled\ndownload button disabled')">You are currently in viewing mode</button>
                <?php
                }
            }else {
            ?>
                <button class="btn btn-danger" onclick="alert('changes will be pulled from server and not saved\nfileexplorer disabled\ndownload button disabled')">You are currently in viewing mode</button>
            <?php
            }
            ?>
            <pre id="output" class="text-left" style="background-color: #141414; color:#f8f8f8; border: 0px;"></pre>
            <a class="btn btn-primary" id="runbutton" title="Run">Run code <span class="glyphicon glyphicon-play"></span></a>
        <a class="btn btn-info" id="file" href="Share/?ID=<?php echo $_GET["ID"]; ?>" title="Share">Share <span class="glyphicon glyphicon-share"></span></a>

        </div>
    </div>
    <div id="backdrop"></div>
    
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

function windows() {
    document.getElementById("editor").style['height'] = 0.75 * window.innerHeight;
    document.getElementById("editor").style['width'] = 0.6 * window.innerWidth;
    document.getElementById("editor").style['margin'] = "0 auto";
    document.getElementById("output").style['height'] = 0.4 * window.innerHeight;
    document.getElementById("output").style['width'] = 0.4 * window.innerWidth;
}
windows()
setInterval(windows, 1000);

</script>
<script>
var basePath = './Modules/Pygame/';
Sk.externalLibraries = {
    'pgzrun': {
        path: './Modules/pgzrun.js',
    },
    'filez': {
        path: './Modules/filez/filez.js', // Write and read files
    },
    'Cookies': {
        path: './Modules/Cookies.js', // Set and Get Cookies
    },
    'JsForPy': {
        path: './Modules/JsForPy.js', // Some Js functions
    },
    'Sounds': {
        path: './Share/'+id+'/Audio.js', // Sounds Module Used For pgzero
    },
    'json': {
        path: './Modules/Json/Json.js',
        dependencies: [
            './Modules/Json/Stringify.js'
        ]
    },
    'numpy': {
        path: './Modules/numpy/numpy.js',
        dependencies: [
            './Modules/numpy/random.js'
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
    var target = document.getElementById("mycanvas");
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
    var currentTarget = resetTarget();

    var div1 = document.createElement("div");
    currentTarget.appendChild(div1);
    $(div1).addClass("modal");
    $(div1).addClass(" tab-content");
    $(div1).css("text-align", "center");

    var btn1 = document.createElement("span");
    $(btn1).addClass("btn btn-primary btn-sm pull-right");
    var ic = document.createElement("i");
    $(ic).addClass("fas fa-times");
    btn1.appendChild(ic);


    var header = document.createElement("h5");
    Sk.title_container = header;
    $(header).addClass("modal-title");

    div1.appendChild(header);
    div1.appendChild(btn1);

    var div_buttons = document.createElement("div");
    div1.appendChild(div_buttons);
    $(div_buttons).addClass("tab");

    var button1 = document.createElement("button");
    div1.appendChild(div_buttons);
    $(div_buttons).addClass("tab");
    $(div_buttons).attr("onclick", "tabs(event, 'output')");


    $(btn1).on('click', function(){
        
        if(isloaded == true) {
            isloaded = false;
            audio_stopall();
            Sk.insertEvent("quit")
        } else {
            $('.modal').modal('hide');
        }
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

    var nav_tab = document.createElement("ul");
    $(nav_tab).addClass("nav nav-pills");
    div4.appendChild(nav_tab);

    var li_game = document.createElement("li");
    $(li_game).addClass("active");
    nav_tab.appendChild(li_game);

    var li_console = document.createElement("li");
    nav_tab.appendChild(li_console);
    
    var a_game = document.createElement("a");
    $(a_game).attr("data-toggle", "pill");
    $(a_game).attr("href", "#game");
    $(a_game).text("Game");
    
    var a_console = document.createElement("a");
    $(a_console).attr("data-toggle", "pill");
    $(a_console).attr("href", "#console");
    $(a_console).text("Console");


    li_game.appendChild(a_game);
    li_console.appendChild(a_console);

    var div5 = document.createElement("div");
    $(div5).addClass("tab-pane fade in active");
    $(div5).attr("id", "game")
    $(div5).attr("ontouchmove", 'gametouch(event)')

    var div6 = document.createElement("div");
    $(div6).addClass("modal-footer");
    $(div6).css("border-color", "#151515");
    var div7 = document.createElement("div");
    $(div7).addClass("col-md-8");
    var div8 = document.createElement("div");
    $(div8).addClass("col-md-4");

    var div9 = document.createElement("div");
    $(div9).addClass("tab-pane fade");
    $(div9).attr("id", "console");

    var console = document.createElement("pre");
    $(console).attr("id", "console_output");
    div9.appendChild(console);


    div3.appendChild(div4);
    div3.appendChild(div5);
    div3.appendChild(div6);
    div3.appendChild(div9);

    
    //div7.appendChild(header);
    //div8.appendChild(btn1);

    div5.appendChild(Sk.main_canvas);

    createArrows(div6);
    $(div1).modal({
        backdrop: 'static',
        keyboard: false
    });
}

function outf(text) {
    var output = document.getElementById("console_output");
    var output2 = document.getElementById("output");
    text = text.replace(/</g, '&lt;');
    output.innerHTML = output.innerHTML + text;
    output2.innerHTML = output2.innerHTML + text;
}

function download() {
    <?php
    download();
    ?>
    window.location.href = "Zip/"+id+".zip"
}

function runCode() {
    <?php
    if(isset($owners)) {
        if (strpos($owners, $_COOKIE["UserID"]) !== false or strpos($owners, "Global") !== false) {
    ?>
            savecode(true)
    <?php
        }
    }
    ?>
    var output = document.getElementById("output");
    output.innerHTML = '';
    Sk.configure({
        inputfun: function (prompt) {
            return window.prompt(prompt);
        },
        inputfunTakesPrompt: true,
        output: outf,
        read: builtinRead
    });
    Sk.main_canvas = document.createElement("canvas");
    Sk.quitHandler = function() {
        $('.modal').modal('hide');
    };
    addModal();
    function getcode() {
        var basecode = editor.getValue();
        
        <?php
        $code = file_get_contents("Share/".$_GET["ID"]."/main.py");
        if(strpos($code, "import pgzrun")  !== false and strpos($code, "pgzrun.go()") !== false) {
            ?>
            return top() + getcustommodules() + basecode + low()
            <?php
        } else {
            ?>
            return getcustommodules() + basecode
            <?php
        }
        ?>
    }
    (Sk.TurtleGraphics || (Sk.TurtleGraphics = {})).target = 'game';
    function top() {
        var bb = $.ajax({
            type: "GET",
            url: "./Base/Mapper_Top.py",
            async: false
        }).responseText;
        console.log(bb);
        return bb
    }

    function low() {
        return $.ajax({
            type: "GET",
            url: "./Base/Mapper_Bottom.py",
            async: false
        }).responseText;
    }
    function getcustommodules() {
        <?php
        $folder = "./Share/".$_GET["ID"]."/files/";
        $scanned_directory = array_diff(scandir($folder), array('..', '.'));
        echo 'return `';
        $ba = 0;
        foreach($scanned_directory as $filename){
            echo file_get_contents($folder.$filename)."\n";
            $ba += count(file($folder.$filename));
        }
        echo '`';
        ?>
    }

    Sk.misceval.asyncToPromise(function() {
        try {
            return Sk.importMainWithBody("<stdin>", false, getcode(), true);
        } catch (e) {
            e.traceback[0].lineno -= <?php echo count(file("./Base/Mapper_Top.py")) ?>+ <?php echo $ba ?>;
            console.log(e)
            alert(e)
            location.reload(true);

        }
    })

}


$("#runbutton").click(function() {
    runCode();
});
<?php
if(isset($owners)) {
    if (strpos($owners, $_COOKIE["UserID"])  !== false) {
        echo 'editor.setValue($.ajax({type: "GET", url: "Share/"+id+"/main.py",async: false}).responseText);';
    } else {
        echo 'editor.setValue($.ajax({type: "GET", url: "Share/"+id+"/main.py",async: false}).responseText);';
    }
} else {
    echo 'location.reload(true)';
}

?>

</script>
<div id="saving">Saving...</div>
</body>
<footer class="footer">
    <div class="container">
        <span class="text-muted">
            <button type="button" class="btn btn-info" onclick="window.location.href = 'https://mail.magma-mc.net'">HTML Form Mailer</button>
        </span>
        <span class="text-muted">
            <button type="button" class="btn btn-warning" onclick="window.location.href = 'https://www.curseforge.com/minecraft/mc-mods/magma-world'">Magma World</button>
        </span>
        <span class="text-muted">
            <p>©2021-2022 - kaicycle, inc.</p>
        </span>
    </div>
</footer>


</html>

<script async type="text/javascript">
    <?php
    if(isset($owners)) {
        ?>
        $('body').on('touchstart', function(e) {
            istouchin = true;
            var offset = $("#game").offset();
            var t = e.targetTouches.length > 0 ? e.targetTouches.item(0) : e.touches.item(0); 
            touch_x = t.pageX - offset.left;
            touch_y = t.pageY - offset.top;
            $(".position").val("afaf");
        });
        $('body').on('touchend', function(e) {
            istouchin = false;
        });
        function gametouch(e) {
            var offset = $("#game").offset();
            var t = e.targetTouches.length > 0 ? e.targetTouches.item(0) : e.touches.item(0); 
            touch_x = t.pageX - offset.left;
            touch_y = t.pageY - offset.top;
        }
        <?php
        if (strpos($owners, $_COOKIE["UserID"]) !== false or strpos($owners, "Global") !== false) {
        ?>
        function savecode(xx=false) {
            if (editor.getValue() != $.ajax({type: "GET",  url: "Share/"+id+"/main.py", async: false}).responseText) {
                var x = document.getElementById("saving");
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2600);
                var data = new FormData();
                data.append("data" , editor.getValue());
                data.append("ID" , id);
                var xhr = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
                xhr.open('post', 'write.php', true);
                xhr.send(data);
                setTimeout(function(){ x.innerHTML = "Saved"}, 1000);

            }
        }
        var timer = null;
        $('#editor').keydown(function(){
            clearTimeout(timer);
            timer = setTimeout(savecode, 3000)
        });

        <?php
        } else {
            ?>
            function savecode() {
                editor.setValue($.ajax({type: "GET", url: "Share/"+id+"/main.py",async: false}).responseText);
                setTimeout(savecode, 5000);
            }
            <?php
        }
        ?>
        savecode()
        <?php
    } else {
        echo "location.reload(true)";
    }
    ?>
</script>
<?php 
// Create ZIP file

function download() {
	$filename = "Zip/".$_GET["ID"].".zip";
	$zip = new ZipArchive();
	if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
	    exit("cannot open <$filename>\n");
	}
	
	$dir = "Share/".$_GET["ID"]."/";
	
	// Create zip
	createZip($zip,$dir);
	$zip->close();
}
// Create zip
function createZip($zip,$dir){
    if (is_dir($dir)){

        if ($dh = opendir($dir)){
            while (($file = readdir($dh)) !== false){
                // If file
                if (is_file($dir.$file)) {
                    if($file != '' && $file != '.' && $file != '..'){
                        
                        $zip->addFile($dir.$file);
                    }
                }else{
                    // If directory
                    if(is_dir($dir.$file) ){

                        if($file != '' && $file != '.' && $file != '..'){

                            // Add empty directory
                            $zip->addEmptyDir($dir.$file);
                            $folder = $dir.$file.'/';
                            
                            // Read data of the folder
                            createZip($zip,$folder);
                        }
                    }
                    
                }
                    
            }
            closedir($dh);
        }
    }
}



?>