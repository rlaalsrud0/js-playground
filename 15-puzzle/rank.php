<?php
$Json = file_get_contents('test.json');
$data = json_decode($Json, true);

//var_dump($data);

ksort($data);
$i = 0;
function rank(){
    $GLOBALS['i']++;
}
foreach($data as $key => $value){
    echo rank().$i.'위 time : '.$key.', name : '.$value.PHP_EOL;
    echo '<br>';
}

// for($i = 0; $i < count($data); $i++){
//     echo ($i+1).'위 ';
//     echo 'time : '.$data[$i].',';
//     foreach($data as $value){
//         echo 'name : '.$value.PHP_EOL;
//         echo '<br>';
//     }
// }