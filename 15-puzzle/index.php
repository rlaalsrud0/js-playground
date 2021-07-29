<?php

$Json = file_get_contents("word.json");
$words = json_decode($Json, true);

foreach ($words as $value) {
    echo $value.PHP_EOL;
}
?>