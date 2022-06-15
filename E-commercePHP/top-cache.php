<?php
$url = $_SERVER["SCRIPT_NAME"];
$break = Explode('/', $url);
$file = $break[count($break) - 1];
$cachefile = 'cached-'.substr_replace($file ,"",-4).'.html';
$cachetime = 18000;

// Serve from the cache if it is younger than $cachetime
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
    echo "<!-- Cached copy, generated ".date('H:i', filemtime($cachefile))." -->\n";
    readfile($cachefile);
    exit;
}
ob_start(); // Start the output buffer



//The first five lines create the cached file name according to the current PHP file.

//So, if you’re using a file named list.php, the web page created by the page caching will be named cached-list.html.

//Line six creates a $cachetime variable, which determines the life of our simple cache (Cachefile time).

//Lines nine to thirteen are a conditional statement which looks for a cache file named $cachefile.

//If the file is found, a comment is inserted (line ten) and the $cachefile file is included.

//Then, the exit statement stops the execution of the script and the file is sent to the client browser. This means that if a static file is found, no PHP is interpreted by the server.

//Line 14 creates a buffer if the $cachefile file isn’t found. That’s all for the top-cache.php file.
?>