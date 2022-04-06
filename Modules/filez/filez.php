<?php
if(isset($_REQUEST['ID'])) {
    $rootfolder = "../../Share/".$_REQUEST['ID']."/__FILEZ__/";
    $folder = $rootfolder.$_REQUEST['filename'];
    
    if(!is_dir($rootfolder)) {
        mkdir($rootfolder, 0777, true);
    }
    if($_REQUEST['filez'] == "write"){
        if( $_REQUEST["type"] != "a") {
            echo $_REQUEST['filename'];
            echo $_REQUEST['content'];
            if(is_file($folder)) {
                unlink($folder);
            }
            $a = fopen($folder, "c+");
            fclose($a);
            
    
            $a = fopen($folder, $_REQUEST["type"]."+");
        } else {
            if(!is_file($folder)) {
                $a = fopen($folder, "c+");
                fclose($a);
            }
            $a = fopen($folder, "a+");
        }
        fwrite($a, $_REQUEST['content']);
        fclose($a);
    } elseif($_REQUEST['filez'] == "read") {
        if(is_file($folder)) {
            $b = fopen($folder, "r");
            echo fread($b, filesize($folder));
            fclose($b);
        } else {
            $b = fopen($folder, "c+");
            fwrite($b, "{}");
            echo "{}";
            fclose($b);
        }
    } elseif($_REQUEST['filez'] == "scan") {
        if (is_dir($folder)) {
            if ($handle = opendir($folder)) {
                $scans = [];

                while (false !== ($entry = readdir($handle))) {

                    if ($entry != "." && $entry != "..") {
                        $scans[] = $entry;
                
                    }
                }
                echo json_encode($scans);
                closedir($handle);
            }
        } else {
            echo "notexist";
        }
    }


}
?>