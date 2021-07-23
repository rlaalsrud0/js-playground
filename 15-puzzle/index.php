<?php

$Json = file_get_contents("word.json");
$words = json_decode($Json, true);

//JSON_UNESCAPED_UNICODE

//print_r($words); 
// echo $words['iphone'];
// echo $words['samsung'];

foreach ($words as $value) {
    echo $value.PHP_EOL;
}
?>