<?php

// clear content to 0 bits
$url  = "https://transport.tallinn.ee/gps.txt";  // Site URL.
$site = file_get_contents($url);

echo $site;
?>