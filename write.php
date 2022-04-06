<?php
if(!empty($_POST['data'] and !empty($_POST["ID"]))){
	unlink("Share/".$_POST["ID"]."/main.py");
    $file = fopen("Share/".$_POST["ID"]."/main.py", 'c+');
    fwrite($file, $_POST['data']);
    fclose($file);
    }
?>