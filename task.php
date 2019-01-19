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
$unfilArray = array_filter($unfilArray);

// Check every value in array, if it is not a number, remove them and return filtered array
// After checking if its a number, the function will perform additional check to see if the number is integer (whole number).
function numCheck($array) {
    $i = 0;
    foreach($array as $value) {

        if(!is_numeric($value)) {
            unset($array[$i]);
            $i++;
            continue;
        }
        $test = floor($value);

        if(($test-$value) != 0) {
            unset($array[$i]);
        }
        $i++;
    }
    return ($array);
}

// Performed the function and got a filtered array
$filArray = numCheck($unfilArray);

if(empty($filArray)){
    echo "Please fill out the form the correct way in <a href=\"index.html\">Index.html</a>";
    exit();
}

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

// This function takes the array, checks biggest number, squares it with 2, rounds the square to lower int number.
// To get the size, we add +1 and return the number for our table
function tableSize ($array) {
    $maxNum = max($array);
    $sqrt = sqrt($maxNum);
    $roundNum = floor($sqrt);
    $size = $roundNum + 1;
    return $size;
}

$tableSize = tableSize($filArray);

// This function creates new Array with only even numbers
function onlyEvenNumbers ($array){
    $newArray = [];
    foreach($array as $value) {
        if($value % 2 !== 0) {
            continue;
        }
        array_push($newArray, $value);
    }
    return $newArray;
}

$evenArray = onlyEvenNumbers($filArray);

// Function that takes 2 parameters, Array with ascending sorted numbers and mean variable with a number.
// Function checks the first number bigger than the mean number
function firstNumBiggerThanMean ($array, $mean) {
    foreach ($array as $value){
        if($value > $mean){
            return $value;
        }
    }
    return false;
}

$numBiggerThanMean = firstNumBiggerThanMean($evenArray, $mean);

// Creating table with size according to squared size of $tableSize^2.
// Table will take numbers from $evenArray and put them in according position from left up to right down order.
// The first bigger number than mean will be bolded. The number is hold in $numBiggerThanMean.

?>
<table border="1">

    <tbody><?php

        // $i represents rows in table, $j represents cell
        for($i = 0; $i <=$tableSize; $i++) {?>

            <tr><?php

                for($j = 0; $j <=$tableSize; $j++) {?>

                    <td style="height: 30px; min-width: 30px; text-align: right" ><?php

                        // Checking current position of cell
                        $numInside = ($i * $tableSize) + $j + 1;

                        // Checking if the number exists in array
                        if(in_array($numInside, $evenArray)) {

                            if($numInside != $numBiggerThanMean) {

                                echo $numInside;

                            } else {

                                echo "<strong>" . $numInside . "</strong>";
                            }

                        }?>

                    </td><?php

                }?>

            </tr><?php

        }?>
    </tbody>
</table>
