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
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/styles/atom-one-dark.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/highlight.min.js"></script>
        <script>hljs.highlightAll();</script>

    </head>
    <body style="background: #1c1c1c; color: white;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand">magma-mc.net</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-item nav-link " onclick="window.parent.location.href = '../?ID='+Cookies.get(`ID`)">Home</a>
                <a class="nav-item nav-link active">Docs</a>
                <a class="nav-item nav-link" onclick="window.parent.location.href = '../Projects.php'">Your Projects</a>
                </div>
            </div>
        </nav>
        <div>
            <header style="text-align: center">
                <h1>Pygame Zero</h1>
            </header>
        </div>
        <div>
            <div class="col-xs-1">
                <h2>Modules</h2>
                <ul>
                    <div id="pygame">
                        <li>
                            <h5>Pygame</h5>
                        </li>
                    </div>

                    <div id="pgzero">
                        <li>
                            <h5>pgzero</h5>
                        </li>
                    </div>

                    <div id="json">
                        <li>
                            <h5>json</h5>
                        </li>
                        <pre>
                            <code class="language-plaintext">please note that json values can not be saved as int/float
                            </code>
                        </pre>
                    </div>
                    <div id="Custom_Modules">
                        <h3>Custom Modules</h3>
                            
                        <div id="Cookies">
                            <li>
                                <h5>Cookies</h5>
                            </li>
                            <pre>
                                <code class="language-python"># Example of Cookies
import Cookies # Please note that Cookies will only change after reload
if Cookies.exists('hello') == False:
&nbsp; &nbsp; Cookies.set('hello', 'world')
else:
&nbsp; &nbsp; print(Cookies.get('hello'))

                                </code>
                            </pre>
                        </div>
                        
                        <div id="JsForPy">
                            <li>
                                <h5>JsForPy</h5>
                            </li>
                            <pre>
                                <code class="language-python"># Example of JsForPy
import JsForPy as js

# Console
js.console.log("Hello There")
js.console.error("Error Message")
js.console.warn("Warn Message")
js.console.info("Info Message")

# Window
js.alert("Hello World")
js.prompt("Hello World")
js.location.href('Url')


                                </code>
                            </pre>
                        </div>
                        
                        <div id="Filez">
                            <li>
                                <h5>filez</h5>
                            </li>
                            <p>Filez is used to save, read and scan files from the Projects Directory.</p>

                            <pre>
                                <code class="language-python"># Example of filez Read
import filez
file = str(filez.fread('AFolder/AFile.txt'))
print(file)
                                </code>
                            </pre>

                            <pre>
                                <code class="language-python"># Example of filez Write
import filez
def Write(file, text):
&nbsp; &nbsp; filez.fwrite('Afolder/'+file, text, "c")

Write('FileA.txt', 'Hello')
Write('FileB.txt', 'There')
file = str(filez.fread('AFolder/FileA.txt'))
file2 = str(filez.fread('AFolder/FileB.txt'))
print(file, file2) # Prints hello There
                                </code>
                            </pre>
                            <pre>
                                <code class="language-python"># Example of filez Scan
import filez

folder = str(filez.scan('Afolder/'))
folder_l = Save_files[1:-1].split(',')
folder_l = [i
&nbsp; &nbsp; .replace(']', '')
&nbsp; &nbsp; .replace('[', '')
&nbsp; &nbsp; .replace('"', '')
&nbsp; &nbsp; .strip() for i in folder_l
]
for file in folder_l:
&nbsp; &nbsp; print(filez.read('Afolder/'+file))
                                </code>
                            </pre>
                        </div>
                    </div>
                </ul>
            </div>
            <div class="col-xs-1">
                <h2>Owners</h2>
                <p>OwnersList is located in the base directory of the project.</p>
                <p>To add people to the OwnersList (gives permission to edit and download the project) open the file called ownersList.ini and add their UserID to the list.</p>
                <p>To make your project editible by anyone add the Word <mark>Global</mark> to ownersList file.</p>

            </div>
        </div>
    </body>
</html>
