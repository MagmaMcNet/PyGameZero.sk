var $builtinmodule = function(name) {
    //
    const parm = new URLSearchParams(window.location.search).get("ID");
    mod = {}
    mod.fread = new Sk.builtin.func(function(filename) {
        return $.ajax({ type: "GET", url: "../../Modules/filez/filez.php?filez=read&filename=" + filename.v + "&ID=" + parm, async: false }).responseText
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
        var scannedfolder = $.ajax({ type: "GET", url: "../../Modules/filez/filez.php?filez=scan&filename=" + folder.v + "&ID=" + parm, async: false }).responseText
        console.log(scannedfolder)
        scannedfolder.replace(/\[|\]/g, '').split(',')
        console.log(scannedfolder)
        return Sk.ffi.remapToPy(JSON.parse(scannedfolder))

    });
    const clsMap = [
        [/^".*:$/, "key"],
        [/^"/, "string"],
        [/true|false/, "boolean"],
        [/null/, "key"],
        [/.*/, "number"],
    ]
    mod.send = new Sk.builtin.func(function(file, key, value, type, key2, ji = false, key3 = "nono1") {
        var readfile = JSON.parse($.ajax({ type: "GET", url: "../../Modules/filez/filez.php?filez=read&filename=" + file.v + "&ID=" + parm, async: false }).responseText);
        if (type.v == "=") {
            if (ji.v == true) {
                readfile[key.v][key2.v] = JSON.parse(value.v);
            } else {
                if (key3.v == "nono1") {
                    readfile[key.v][key2.v] = value.v;
                } else {
                    readfile[key.v][key2.v][key3.v] = value.v;
                }
            }
        } else if (type.v == "-") {
            if (key3.v == "nono1") {
                readfile[key.v][key2.v] = toString(parseInt(readfile[key.v][key2.v]) - value.v);
            } else {
                readfile[key.v][key2.v][key3.v] = toString(parseInt(readfile[key.v][key2.v][key3.v]) - value.v);
            }
        } else if (type.v == "+") {
            readfile[key.v][key2.v] = toString(parseInt(readfile[key.v][key2.v]) + value.v);

        }

        var data = new FormData();
        data.append("filename", file.v);
        data.append("content", JSON.stringify(readfile).replaceAll(":{", ":{\n").replaceAll(":[", ":[\n").replaceAll(",", ",\n"));
        data.append("type", "c");
        data.append("filez", "write");
        data.append("ID", parm);
        var xhr = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
        xhr.open('post', '../../Modules/filez/filez.php', true);
        xhr.send(data);
    });
    return mod;
}