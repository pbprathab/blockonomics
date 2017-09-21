<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            @media only screen and (max-width:480px){
                .box {
                    width: 257px;
                    height: 120px;
                    display: inline;
                    float: left;
                    padding: 5px;
                    position: relative;
                    overflow: hidden;
                    left: 0;
                    margin-left: 20px;
                    overflow-x: hidden;
                }
                .box img {  
                    width:300px;
                    /*height:200px;*/
                    position: absolute;  
                    left: 0;  
                    -webkit-transition: all 300ms ease-out;  
                    -moz-transition: all 300ms ease-out;  
                    -o-transition: all 300ms ease-out;  
                    -ms-transition: all 300ms ease-out;  
                    transition: all 300ms ease-out;  
                }  


                .box .caption {  
                    font-family: Tahoma;
                    font-size: 8px;
                    background-color: rgba(0,0,0,0.8);  
                    position: absolute;  
                    color: #fff;  
                    z-index: 100;  
                    -webkit-transition: all 300ms ease-out;  
                    -moz-transition: all 300ms ease-out;  
                    -o-transition: all 300ms ease-out;  
                    -ms-transition: all 300ms ease-out;  
                    transition: all 300ms ease-out;  
                    left: 0;  
                    opacity: 0;  
                    width:300px;
                    height:200px;
                    text-align: left;  
                    padding: 15px;
                    word-wrap: break-word;
                }  

                a{
                    color:#fff;
                    text-decoration: none;
                    text-overflow: ellipsis;
                }
                a:hover{
                    color:yellow;
                    text-decoration:none;
                    text-overflow: ellipsis;
                }

                .box:hover .fade-caption {  
                    opacity: 1;  
                }
            }
            @media only screen and (min-width:481px){
                .box {  
                    margin-left:100px;
                    width:200px;
                    height:236px;
                    display:inline;
                    float:left;
                    padding:5px;
                    position: relative;  
                    overflow: hidden;  
                }  

                .box img {  
                    width:200px;
                    height:200px;
                    position: absolute;  
                    left: 0;  
                    -webkit-transition: all 300ms ease-out;  
                    -moz-transition: all 300ms ease-out;  
                    -o-transition: all 300ms ease-out;  
                    -ms-transition: all 300ms ease-out;  
                    transition: all 300ms ease-out;  
                }  


                .box .caption {  
                    font-family: Tahoma;
                    font-size: 14px;
                    background-color: rgba(0,0,0,0.8);  
                    position: absolute;  
                    color: #fff;  
                    z-index: 100;  
                    -webkit-transition: all 300ms ease-out;  
                    -moz-transition: all 300ms ease-out;  
                    -o-transition: all 300ms ease-out;  
                    -ms-transition: all 300ms ease-out;  
                    transition: all 300ms ease-out;  
                    left: 0;  
                    opacity: 0;  
                    width:200px;
                    height:200px;
                    text-align: left;  
                    padding: 15px;
                    word-wrap: break-word;
                }  

                a{
                    color:#fff;
                    text-decoration: none;
                    text-overflow: ellipsis;
                }
                a:hover{
                    color:yellow;
                    text-decoration:none;
                    text-overflow: ellipsis;
                }

                .box:hover .fade-caption {  
                    opacity: 1;  
                }  
                .main-wrapper{
                    margin-top: 100px;
                }
            }
        </style>
    </head>


    <?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    include("simple_html_dom.php");
    $crawled_urls = array();
    $found_urls = array();

    function rel2abs($rel, $base) {
        if (parse_url($rel, PHP_URL_SCHEME) != '')
            return $rel;
        if ($rel[0] == '#' || $rel[0] == '?')
            return $base . $rel;
        extract(parse_url($base));
        $path = preg_replace('#/[^/]*$#', '', $path);
        if ($rel[0] == '/')
            $path = '';
        $abs = "$host$path/$rel";
        $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
        for ($n = 1; $n > 0; $abs = preg_replace($re, '/', $abs, -1, $n)) {
            
        }
        $abs = str_replace("../", "", $abs);
        return $scheme . '://' . $abs;
    }

    function perfect_url($u, $b) {
        $bp = parse_url($b);
        if (($bp['path'] != "/" && $bp['path'] != "") || $bp['path'] == '') {
            if ($bp['scheme'] == "") {
                $scheme = "http";
            } else {
                $scheme = $bp['scheme'];
            }
            $b = $scheme . "://" . $bp['host'] . "/";
        }
        if (substr($u, 0, 2) == "//") {
            $u = "http:" . $u;
        }
        if (substr($u, 0, 4) != "http") {
            $u = rel2abs($u, $b);
        }
        return $u;
    }

    function crawl_site($u) {
        global $crawled_urls;
        $uen = urlencode($u);
        
        if ((array_key_exists($uen, $crawled_urls) == 0 || $crawled_urls[$uen] < date("YmdHis", strtotime('-25 seconds', time())))) {
            $html = file_get_contents($u);
            print_r($html);
            $crawled_urls[$uen] = date("YmdHis");
            
            ?>

            <div class="main-wrapper">

                <?php
                foreach ($html->find("img") as $li) {
                    $url = perfect_url($li->src, $u);
      print_r($url);
                    $enurl = urlencode($url);
                    $found_urls[$enurl] = 1;
                    ?>
                   
                   <div class="box">
                        <?php
                        echo'<img id="image-3" class="one img-responsive" src="' . $url . '"/>';
                        ?>
                        <span class="caption fade-caption"> 
                            <?php
                            echo "<a class='two' target='_blank' href='" . $url . "'>" . $url . "</a>";
                            ?>
                        </span>
                    </div>
                    
                    <?php
                }
                ?>
            </div>

            <?php
        }
    }

    if (isset($_POST['submit'])) {
        $url = $_POST['url'];
        if ($url == '') {
            echo "<h2>A valid URL please.</h2>";
        } else {
            $f = fopen("url-crawled.html", "a+");
            fwrite($f, "<div><a href='$url'>$url</a> - " . date("Y-m-d H:i:s") . "</div>");
            fclose($f);
            crawl_site($url);
            echo "</div>";
        }
    }
    ?>
</html>