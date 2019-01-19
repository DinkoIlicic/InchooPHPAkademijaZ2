<?php
/**
 * Created by PhpStorm.
 * User: dinko
 * Date: 19.01.19.
 * Time: 11:37
 */

if(empty($_POST['num'])){
    echo "Please fill out the form in <a href=\"index.html\">Index.html</a>";
    exit();
}

// Convert special characters to HTML entities to avoid potential problems
$unfilString = htmlspecialchars($_POST['num']);

// Explode string into pieces and add them to unfiltered array
$unfilArray = explode(',', $unfilString);

// Check every value in array, if it is not a number, remove them and return filtered array
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

// Performed the function and got a filtered array
$filArray = numCheck($unfilArray);



