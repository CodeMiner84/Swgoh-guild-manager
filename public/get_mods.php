<?php

$path = 'img/mods/';
ini_set('display_errors', 1);
try {
    for ($i = 1; $i <= 8; ++$i) {
        for ($j = 1; $j <= 6; ++$j) {
            $img = file_get_contents('https://swgoh.gg/static/img/assets/tex.statmodmystery_'.$i.'_'.$j.'.png');
            $filename = 'mod_'.$i.'_'.$j.'.png';
            file_put_contents($path.$filename, $img) or die();
        }
    }
} catch (Exception $e) {
    var_dump($e->getMessage());
    die;
}
