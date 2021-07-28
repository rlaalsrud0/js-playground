<?php 

$time = $_POST['time'];
$name = $_POST['name'];

var_dump($time);
var_dump($name);

$data = array($time => $name);

//echo $time, $name;
//var_dump($data);


//$data[] = array($time => $name);

if(file_exists('./test.json')){
    $open = file_get_contents('test.json');
    $tempArray = json_decode($open, true);
    //var_dump($tempArray);
    if(0 == filesize('test.json')){
        $tempArray = array();
        // array_push($tempArray, $data);
        $tempArray = array_merge($tempArray, $data);
        $jsonData = json_encode($tempArray, JSON_UNESCAPED_UNICODE);
        var_dump($jsonData);
        //die;
        file_put_contents('test.json', $jsonData);
    }else{
        // array_push($tempArray, $data);
        $arr = array_merge($tempArray, $data);
        $jsonData = json_encode($arr, JSON_UNESCAPED_UNICODE);
        var_dump($jsonData);
        //die;
        file_put_contents('test.json', $jsonData);
    }
} else {
    echo '파일이 존재하지 않음';
}

// $arr1 = array('key' => $time);
// $arr2 = array('value' => $name);
// function Combine($arr1, $arr2){
//     return(array_combine($arr1, $arr2));
// }
// print_r(Combine($arr1, $arr2));
// var_dump(Combine($arr1, $arr2));

// $open = fopen('test.json', 'a');
// fwrite($open, $time);
// fwrite($open, $name);
// fclose($open);