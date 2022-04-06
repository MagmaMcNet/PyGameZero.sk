<?php
	$files = array();
	if ($handle = opendir("../../Share/".$_GET["ID"]."/sounds/")) {
	    while (false !== ($entry = readdir($handle))) {
	        if ($entry != "." && $entry != "..") {
	            $files[] = str_replace(".wav", "", $entry);
	        }
	    }
	    closedir($handle);
	}
	$json = json_encode($files);
	$json = json_decode($json,true);
if(is_file("../../Share/".$_GET["ID"]."/Audio.js")) {
	unlink("../../Share/".$_GET["ID"]."/Audio.js");
}
$a = fopen("../../Share/".$_GET["ID"]."/Audio.js", "c");
foreach ($json as $item) {
fwrite($a,$item.' = new Audio("../../Share/'.$_GET["ID"].'/sounds/'.$item.'.wav")');
fwrite($a,"\n");
}
fwrite($a, 'function audio_stopall() {');
	fwrite($a,"\n");
	foreach ($json as $item) {
		fwrite($a, $item.'.currentTime=0;');
		fwrite($a,"\n");
		fwrite($a, $item.'.pause();');
		fwrite($a,"\n");
	}
	fwrite($a, "};");
	fwrite($a,"\n");
fwrite($a,'var $builtinmodule = function (name) {');
fwrite($a,"\n");
fwrite($a,"mod={}\n");
foreach ($json as $item) {
	fwrite($a, 'mod["'.$item.'"] = new Sk.builtin.func(function () {return "a"});');
	fwrite($a,"\n");
	fwrite($a, 'mod["'.$item.'"].play = new Sk.builtin.func(function () {'.$item.'.play()});');
	fwrite($a,"\n");
	fwrite($a, 'mod["'.$item.'"].stop = new Sk.builtin.func(function () {'.$item.'.currentTime=0, '.$item.'.pause()});');
	fwrite($a,"\n");


	
}

fwrite($a,'return mod;');
fwrite($a,"\n");
fwrite($a,"};");
fclose($a);
