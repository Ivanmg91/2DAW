<?php
function Permutaciones(&$V) {

    $N = count($V); 

    for ($i = 0; $i < floor($N / 2); $i++) {
        
        $temporal = $V[$i];
        $V[$i] = $V[$N - 1 - $i];
        $V[$N - 1 - $i] = $temporal;
    }
}

$vector = [1, 2, 3, 4, 5, 6, 7];
Permutaciones($vector);

print_r($vector);
?>
