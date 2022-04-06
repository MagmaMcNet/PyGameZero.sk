Explosion = new Audio("../../Share/MagmaMc/sounds/Explosion.wav")
jump = new Audio("../../Share/MagmaMc/sounds/jump.wav")
Laser = new Audio("../../Share/MagmaMc/sounds/Laser.wav")
lazer = new Audio("../../Share/MagmaMc/sounds/lazer.wav")
function audio_stopall() {
Explosion.currentTime=0;
Explosion.pause();
jump.currentTime=0;
jump.pause();
Laser.currentTime=0;
Laser.pause();
lazer.currentTime=0;
lazer.pause();
};
var $builtinmodule = function (name) {
mod={}
mod["Explosion"] = new Sk.builtin.func(function () {return "a"});
mod["Explosion"].play = new Sk.builtin.func(function () {Explosion.play()});
mod["Explosion"].stop = new Sk.builtin.func(function () {Explosion.currentTime=0, Explosion.pause()});
mod["jump"] = new Sk.builtin.func(function () {return "a"});
mod["jump"].play = new Sk.builtin.func(function () {jump.play()});
mod["jump"].stop = new Sk.builtin.func(function () {jump.currentTime=0, jump.pause()});
mod["Laser"] = new Sk.builtin.func(function () {return "a"});
mod["Laser"].play = new Sk.builtin.func(function () {Laser.play()});
mod["Laser"].stop = new Sk.builtin.func(function () {Laser.currentTime=0, Laser.pause()});
mod["lazer"] = new Sk.builtin.func(function () {return "a"});
mod["lazer"].play = new Sk.builtin.func(function () {lazer.play()});
mod["lazer"].stop = new Sk.builtin.func(function () {lazer.currentTime=0, lazer.pause()});
return mod;
};