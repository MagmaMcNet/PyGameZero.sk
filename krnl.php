<html>
    <script>
        var start = 5
        var b = 0
        const sleep = ms => new Promise(r => setTimeout(r, ms));

        async function click() {
            button = document.getElementById('btn')
            if(start < 5) {
                if(document.hasFocus()) {
                    start += 1;
                    if (start == 4) {
                        await sleep(1000);
                        document.getElementById('a1').innerHTML = "Enjoy";
                        await sleep(1000);
                        button.click();
                        b = 1
                    }
                    else {
                        button.click();
                    }
                }
            }if (b == 1) {
                await sleep(10);
                if(document.hasFocus()) {
                    await sleep(1000);
                    document.getElementById('a1').innerHTML = "this page can now be closed";
                }
            }
        }
        

        function run() {
            button = document.getElementById('start')
            start = 0
            document.getElementById('a1').innerHTML = "loading";
            document.getElementById('a2').remove()
            button.remove()
        };
        
        setInterval(click, 100);
    </script>

    <head>
        <meta name="author" content="MagmMc">
        <meta name="description" content="krnl skip">
        <meta name="keywords" content="krnl, skip, key, system">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="🌐 MagmaMc - skip krnl keysys">
        <meta name="twitter:description" content="skip krnl key system">
        <meta name="twitter:site" content="@SMLkaiellis">
        <meta name="twitter:creator" content="@SMLkaiellis">
        <meta name="twitter:image" content="./logo.gif">

        <meta property="og:title" content="🌐 MagmaMc - skip krnl keysys">
        <meta property="og:description" content="skip krnl key system">
        <meta property="og:url" content="http://magma-mc.net/">
        <meta property="og:site_name" content="magma-mc.net">
        <meta property="og:type" content="website">
        <meta content="#306998" data-react-helmet="true" name="theme-color">
        <meta property="og:image" content="./logo.gif">
        <title>krnl skipping</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="./Base/main.js" type="text/javascript"></script>
        <link rel="stylesheet" href="./Assets/css.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/styles/atom-one-dark.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/highlight.min.js"></script>
        <script>hljs.highlightAll();</script>
    </head>
    <body style="background: #1c1c1c; color: white;">
    <div style="text-align: center;">
        <header>
            <h1 id="a1">Skip Krnl</h1>
            <p id="a2">Skip Krnl Key-Sytem and it will only take a few seconds</p>
        </header>
    <div class="col-xs-2">
        <button id="start" class="btn btn-primary" type="button" onclick="run()">Start</button>
        
        <a style="color: #1c1c1c" id="btn" href="https://cdn.krnl.ca/getkey.php/" target="_blank">a</a>
    </di>
    </body>
</html