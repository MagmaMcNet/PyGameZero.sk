var isloaded = true;
var $builtinmodule = function(name) {
    mod = {}

    mod.go = new Sk.builtin.func(function() {
        console.log("pgzero loaded")
    });
    return mod
};