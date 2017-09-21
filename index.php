<!DOCTYPE html>
<html>
    <head>
        <title>PB WEB CRAWLERTASK</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            input{
               padding:8px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='row'>
                <div class='col-xs-12 col-sm-12'>
                    <div id="content" style="margin-top:100px;height:100%;">
                        <center><h1>Web Crawler</h1></center>
                        <br>
                        <center><form action="action.php" method="POST">
                                URL : <input name="url" size="35" placeholder="https://www.google.co.in"/>
                                <input type="submit" name="submit" value="Start"/>
                            </form>
                        </center>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
