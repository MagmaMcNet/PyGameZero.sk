var $builtinmodule = function(name) {
    mod = {}

    function openInNewTab(href) {
        Object.assign(document.createElement('a'), {
            target: '_blank',
            href: href,
        }).click();
    }
    mod.console = new Sk.builtin.func(function() {
        console.info(console);
        return console
    });
    mod.newtab = new Sk.builtin.func(function(value) {
        openInNewTab(value.v)
    });

    // 

    mod.location = new Sk.builtin.func(function() {
        return window.location
    });

    mod.location.href = new Sk.builtin.func(function(value) {
        if (value !== undefined) {
            window.location.href = value.v;
        }

        return window.Location.href
    });


    mod.console.log = new Sk.builtin.func(function(value) {
        console.log(value.v);
    });
    mod.console.error = new Sk.builtin.func(function(value) {
        console.error(value.v);
    });
    mod.console.warn = new Sk.builtin.func(function(value) {
        console.warn(value.v);
    });
    mod.console.info = new Sk.builtin.func(function(value) {
        console.info(value.v);
    });
    mod.alert = new Sk.builtin.func(function(value) {
        alert(value.v);
    });
    mod.prompt = new Sk.builtin.func(function(value) {
        prompt(value.v);
    });

    return mod
};