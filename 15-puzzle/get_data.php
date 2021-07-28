<?php 
//session_start();

$time = $_POST['time'];
$name = $_POST['name'];
$data[] = array($time => $name);
//echo $time, $name;
var_dump($data);

//var_dump($new_data);
//die;

//$data[] = array($time => $name);



if(file_exists('./test.json')){
    $open = file_get_contents('test.json');
    $tempArray = json_decode($open);
    //var_dump($tempArray);
    if(0 == filesize('test.json')){
        $tempArray = array();
        array_push($tempArray, $data);
        $jsonData = json_encode($tempArray, JSON_UNESCAPED_UNICODE);
        var_dump($jsonData);
        //die;
        file_put_contents('test.json', $jsonData);
    }else{
        array_push($tempArray, $data);
        $jsonData = json_encode($tempArray, JSON_UNESCAPED_UNICODE);
        var_dump($jsonData);
        //die;
        file_put_contents('test.json', $jsonData);
    }
} else {
    echo '파일이 존재하지 않음';
}

// $json = file_get_contents('test.json');
// $data = json_decode($json);
// $data[] = array($time => $name);
// file_put_contents('test.json', json_encode($data));


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


// $Json = file_put_contents("test.json");
// $data = json_decode($Json, true);
// foreach ($data as $value) {
//     print_r($value.PHP_EOL);
// }

// $a = file_put_contents('data.php', $open, true);
// $b = json_decode($a, true);
//echo $b;
// foreach ($b as $value) {
//     echo $value.PHP_EOL;
// }


// $name = $_POST[name];
//$time = $_POST[time];
// var_dump($name);

