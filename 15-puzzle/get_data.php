<?php 

//session_start();

$name = $_POST[name];
$time = $_POST[time];
//echo $name, $time;

$arr1 = array('key' => $name);
$arr2 = array('value' => $time);

// if($_POST[name]){
//     array_push($arr1, $name);
// }else if($_POST[time]){
//     array_push($arr2, $time);
// }

function Combine($arr1, $arr2){
    return(array_combine($arr1, $arr2));
}
print_r(Combine($arr1, $arr2));

// $result = array('name' => $name, 'time' => $time);
// print_r($result);


// $result = [];
// array_push($result, $name, $time);
// echo $result;


// $name = $_POST[name];
// //$time = $_POST[time];
// var_dump($name);

// $merge[] = json_decode($name, true);
// $merge[] = json_decode($time, true);
// $result = json_encode($merge);
// echo $result;
// echo $name, $time;

// $arr = array('name' => $_POST[name], 'time' => $_POST[time]);
// echo json_encode($arr);

// $arr = ['name' => $_POST[name], 'time' => $_POST[time]];
// echo json_encode($arr);
