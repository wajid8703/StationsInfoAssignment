<?php

// take an array with some elements
$array = array(1, 10, 2, 6, 5, 3);
// get the size of array
$count = count($array);
echo "<pre>";
// Print array elements before sorting
print_r($array);
for ($i = 0; $i < $count; $i++) {
    for ($j = $i + 1; $j < $count; $j++) {
        if ($array[$i] < $array[$j]) {
            $temp = $array[$i];
            $array[$i] = $array[$j];
            $array[$j] = $temp;
        }
    }
}
echo "Sorted Array:" . "<br/>";
print_r($array);

$numbers_to_multiply = 3;
$total = 1;
for($i = 0; $i < $numbers_to_multiply; $i++){
	$total = $total * $array[$i];
}

echo "Result of highest " . $numbers_to_multiply. " Numbers: <br/>";
print_r($total);

?>