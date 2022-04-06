function serverReachable() {
    var s = $.ajax({
        type: "HEAD",
        url: window.location.href.split("?")[0] + "?" + Math.random(),
        async: false
    }).status;
    return s >= 200 && s < 300 || s === 304;
};