<?php
$ch = curl_init();
$url = 'http://apis.data.go.kr/1360000/VilageFcstInfoService_2.0/getVilageFcst'; /*URL*/
$queryParams = '?' . urlencode('ServiceKey') . '=XvksfMzK5mJmpIcQS5gcvO0bMyOZsXfk%2FYGJJkt%2Buc6DZ5PJQmNwVceuN2BfU3JIPmKhIU3Ejwnj9OIKhhdMSQ%3D%3D'; /*Service Key*/
$queryParams .= '&' . urlencode('pageNo') . '=' . urlencode('1'); /**/
$queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode('10'); /**/
$queryParams .= '&' . urlencode('dataType') . '=' . urlencode('XML'); /**/
$dateString = date("Ymd", time());
// print_r($dateString);
$queryParams .= '&' . urlencode('base_date') . '=' . urlencode($dateString); /**/
$queryParams .= '&' . urlencode('base_time') . '=' . urlencode('0500'); /**/
$queryParams .= '&' . urlencode('nx') . '=' . urlencode('60'); /**/
$queryParams .= '&' . urlencode('ny') . '=' . urlencode('127'); /**/
curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$response = curl_exec($ch);
curl_close($ch);
//var_dump($response);

$object = simplexml_load_string($response);
$json = json_encode($object);
$r = json_decode($json, true);
// print_r($r);
// echo '<br/>';
// echo '<br/>';

$a = $r['body']['items']['item'];
//print_r($a)."\n";
//$date = $r['body']['items']['item'][0]['baseDate'];
$tmp = $r['body']['items']['item'][0]['fcstValue'];
$pop = $r['body']['items']['item'][7]['fcstValue'];
//$result = '날짜 : '.$dateString.', 기온 : '.$tmp.', 강수확률 : '.$pop.'%';
//print_r($result);
echo '<br/>';


if($pop >= 60){
    $result = '날짜 : '.$dateString.', 기온 : '.$tmp.', 강수확률 : '.$pop.'%'."\n비 올 확률이 높습니다.";
}else{
    $result = '날짜 : '.$dateString.', 기온 : '.$tmp.', 강수확률 : '.$pop.'%'."\n비 올 확률이 낮습니다.";
}

// $configFile = file_get_contents("../config.json");
// $config = json_decode($configFile, true);

// // apiKey && apiSecret are acquired from solapi.com/credentials
// $apiKey = $config["apiKey"];
// $apiSecret = $config["apiSecret"];

// date_default_timezone_set('Asia/Seoul');
// $date = date('Y-m-d\TH:i:s.Z\Z', time());  // date must be ISO 8361 format
// $salt = uniqid(); // Any random strings with [0-9a-zA-Z]
// $signature = hash_hmac('sha256', $date.$salt, $apiSecret);