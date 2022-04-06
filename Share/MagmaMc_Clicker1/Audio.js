background = new Audio("../../Share/MagmaMc_Clicker1/sounds/background.wav")
click = new Audio("../../Share/MagmaMc_Clicker1/sounds/click.wav")
click.zip = new Audio("../../Share/MagmaMc_Clicker1/sounds/click.zip.wav")
function audio_stopall() {
background.currentTime=0;
background.pause();
click.currentTime=0;
click.pause();
click.zip.currentTime=0;
click.zip.pause();
};
var $builtinmodule = function (name) {
mod={}
mod["background"] = new Sk.builtin.func(function () {return "a"});
mod["background"].play = new Sk.builtin.func(function () {background.play()});
mod["background"].stop = new Sk.builtin.func(function () {background.currentTime=0, background.pause()});
mod["click"] = new Sk.builtin.func(function () {return "a"});
mod["click"].play = new Sk.builtin.func(function () {click.play()});
mod["click"].stop = new Sk.builtin.func(function () {click.currentTime=0, click.pause()});
mod["click.zip"] = new Sk.builtin.func(function () {return "a"});
mod["click.zip"].play = new Sk.builtin.func(function () {click.zip.play()});
mod["click.zip"].stop = new Sk.builtin.func(function () {click.zip.currentTime=0, click.zip.pause()});
return mod;
};