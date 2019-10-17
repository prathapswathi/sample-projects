<?php

$file = 'crishal.txt';

if(!is_file($file)){
    $contents = 'This is a test!';           // Some simple example content.
    file_put_contents($file, $contents);     // Save our content to the file.
}

?>