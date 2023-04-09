<?php
if(file_exists('./test.php')){
    $open = file_get_contents('test.php');
    $tempArray = json_decode($open, true);
    if(0 == filesize('test.php')){
        $tempArray = array();
        $tempArray = array_merge($tempArray, $data);
        $jsonData = json_encode($tempArray, JSON_UNESCAPED_UNICODE);
        var_dump($jsonData);
        file_put_contents('test.php', $jsonData);
    }else{
        $arr = array_merge($tempArray, $data);
        $jsonData = json_encode($arr, JSON_UNESCAPED_UNICODE);
        var_dump($jsonData);
        file_put_contents('test.php', $jsonData);
    }
} else {
    echo '파일이 존재하지 않음';
}