<html lang="en" encoding="UTF-8">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <title>MagmaMc - Help</title>
        <meta name="author" content="MagmMc">
        <meta name="description" content="Docs">
        <meta name="keywords" content="docs, help">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="🌐 MagmaMc - pgzero online">
        <meta name="twitter:description" content="Runs python code online">
        <meta name="twitter:site" content="@SMLkaiellis">
        <meta name="twitter:creator" content="@SMLkaiellis">
        <meta name="twitter:image" content="./logo.gif">

        <meta property="og:title" content="🌐 MagmaMc - Help">
        <meta property="og:description" content="Docs">
        <meta property="og:url" content="http://magma-mc.net/">
        <meta property="og:site_name" content="magma-mc.net">
        <meta property="og:type" content="website">
        <meta content="#306998" data-react-helmet="true" name="theme-color">
        <meta property="og:image" content="./logo.gif">

        <meta property="fb:app_id" content="100075697834863">
        <meta http-equiv="Cache-control" content="no-cache">
        <!-- Import -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="./Base/main.js" type="text/javascript"></script>
        <link rel="stylesheet" href="./Assets/css.css"> 

    </head>
    <body style="background: #1c1c1c; color: white;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand">magma-mc.net</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link " onclick="window.parent.location.href = '../' ">Home</a>
                <a class="nav-item nav-link " onclick="window.parent.location.href = 'help.php' ">Docs</a>
                <a class="nav-item nav-link active">Your Projects</a>
            </div>
        </div>
    </nav>
    <script>
        function prom(prompt){
            b = window.prompt(prompt)
            if (b !== null) {
                if (b.length > 8) {
                    window.parent.location.href = "../?ID="+b;

                }else {
                    alert("Needs to be longer then 8 characters");
                    prom(prompt)
                }
            }
        }
    </script>
    <header style="text-align: center;" >
        <h1>Projects You Own</h1>
        <button type="button" class="btn btn-primary" onclick="prom('ProjectName')">Create A Project</button>
    </header>

<?php
$a = array("primary", "danger", "success", "warning", "info", "secondary");
$b = rand(0,5);
if ($handle = opendir('Share/')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {
            if ($entry !== "index.php" and $entry !== "ownerList.ini") {
                $OwnerFile = fopen("./Share/".$entry."/ownerList.ini", "c+");
                $owners = fread($OwnerFile, filesize("./Share/".$entry."/ownerList.ini"));
                fclose($OwnerFile);
                if (strpos($owners, $_COOKIE["UserID"]) !== false) {
                    $b += 1;
                    if ($b == 6){
                        $b = 0;
                    }
                    echo "<button class='btn btn-".$a[$b] ."' onclick='window.location.href =`../?ID=$entry`'>$entry</button></br>";
                }
            }
        }
    }

    closedir($handle);
}

?>

</html>