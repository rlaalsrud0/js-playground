<?php 

$time = $_POST['time'];
$name = $_POST['name'];

var_dump($time);
var_dump($name);

$data = array($time => $name);

if(file_exists('./test.json')){
    $open = file_get_contents('test.json');
    $tempArray = json_decode($open, true);
    if(0 == filesize('test.json')){
        $tempArray = array();
        $tempArray = array_merge($tempArray, $data);
        $jsonData = json_encode($tempArray, JSON_UNESCAPED_UNICODE);
        var_dump($jsonData);
        file_put_contents('test.json', $jsonData);
    }else{
        $arr = array_merge($tempArray, $data);
        $jsonData = json_encode($arr, JSON_UNESCAPED_UNICODE);
        var_dump($jsonData);
        file_put_contents('test.json', $jsonData);
    }
} else {
    echo '파일이 존재하지 않음';
}