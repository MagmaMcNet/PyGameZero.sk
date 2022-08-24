var $builtinmodule = function(name) {
    //
    var parm = new URLSearchParams(window.location.search).get("ID");
    mod = {}
    mod.SetID = new Sk.builtin.func(function(FilezId) {
        parm = Sk.ffi.remapToJs(FilezId);
    })
    mod.fread = new Sk.builtin.func(function(filename) {
        return Sk.ffi.remapToPy(
            JSON.parse(
                $.ajax({
                    type: "GET",
                    url: "../../Modules/filez/filez.php?filez=read&filename=" + filename.v + "&ID=" + parm,
                    async: false
                }).responseText)
        )
    });
    mod.fwrite = new Sk.builtin.func(function(filename, content, type) {
        var data = new FormData();
        data.append("filename", filename.v);
        data.append("content", content.v);
        data.append("type", type.v);
        data.append("filez", "write");
        data.append("ID", parm);
        var xhr = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
        xhr.open('post', '../../Modules/filez/filez.php', true);
        xhr.send(data);
    });
    mod.scan = new Sk.builtin.func(function(folder) {
        var scannedfolder = $.ajax({
            type: "GET",
            url: "../../Modules/filez/filez.php?filez=scan&filename=" + folder.v + "&ID=" + parm,
            async: false
        }).responseText
        scannedfolder.replace(/\[|\]/g, '').split(',')
        return Sk.ffi.remapToPy(JSON.parse(scannedfolder))

    });
    const clsMap = [
        [/^".*:$/, "key"],
        [/^"/, "string"],
        [/true|false/, "boolean"],
        [/null/, "key"],
        [/.*/, "number"],
    ]
    mod.send = new Sk.builtin.func(function(file, value, key = "null", type = "=", stringit = false) {
        var readfile = JSON.parse($.ajax({
            type: "GET",
            url: "../../Modules/filez/filez.php?filez=read&filename=" + file.v + "&ID=" + parm,
            async: false
        }).responseText);
        if (key == "null") {
            readfile = value.v;
        } else {
            if (type.v == "=") {
                readfile[key.v] = value.v;
            } else if (type.v == "+") {
                if (stringit) {
                    readfile[key.v] = String(parseInt(readfile[key.v]) + parseInt(value.v));
                } else {
                    readfile[key.v] = parseInt(readfile[key.v]) + parseInt(value.v);
                }

            } else if (type.v == "-") {
                readfile[key.v] = parseInt(readfile[key.v]) - parseInt(value.v);
            }

        }


        var data = new FormData();
        data.append("filename", file.v);
        data.append("content", JSON.stringify(readfile));
        data.append("type", "c");
        data.append("filez", "write");
        data.append("ID", parm);
        var xhr = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
        xhr.open('post', '../../Modules/filez/filez.php', true);
        xhr.send(data);
        if (key == "null") {
            return readfile;
        } else {
            return readfile[key.v];
        }
    });
    mod.deletes = new Sk.builtin.func(function(filename) {
        var data = new FormData();
        data.append("filename", filename.v);
        data.append("filez", "delete");
        data.append("ID", parm);
        var xhr = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
        xhr.open('post', '../../Modules/filez/filez.php', true);
        xhr.send(data);
    });
    return mod;
}