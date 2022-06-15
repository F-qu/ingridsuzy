<?php
// Cache the contents to a cache file
$cached = fopen($cachefile, 'w');
fwrite($cached, ob_get_contents());
fclose($cached);
ob_end_flush(); // Send the output to the browser

//If a cached file named $cachefile isn’t found on your server, 
//this code will be executed and will create the cache file itself.

?>
