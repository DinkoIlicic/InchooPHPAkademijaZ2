<?php
/**
 * Created by PhpStorm.
 * User: dinko
 * Date: 19.01.19.
 * Time: 11:37
 */

$unfilString = $_POST['num'];

$unfilArray = explode(',', $unfilString);
var_dump ($unfilArray);
echo "<hr />";

function numCheck($array) {
    $i = 0;
    foreach($array as $value) {

        if(!is_numeric($value)) {
            unset($array[$i]);
        }
        $i++;
    }
    return ($array);
}

$filArray = numCheck($unfilArray);
var_dump($filArray);


