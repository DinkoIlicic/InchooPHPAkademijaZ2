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
asort($filArray);

// This function task is to get sum all values inside the array and divide it with the number of values to get arithmetic mean
function arithmeticMean($array) {
    $sum = 0;
    foreach($array as $value) {
        $sum += $value;
    }
    $divNum = count($array);
    $mean = $sum / $divNum;
    return ($mean);
}

$mean = arithmeticMean($filArray);

function tableSize ($array) {
    $maxNum = max($array);
    $sqrt = sqrt($maxNum);
    $roundNum = floor($sqrt);
    $size = $roundNum + 1;
    return $size;
}


