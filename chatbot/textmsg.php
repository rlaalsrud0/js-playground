<?php

$token = file_get_contents('storeToken.json');


$url = "https://kapi.kakao.com/v2/api/talk/memo/default/send";

$header = json_encode(array("Content-Type" => "application/x-www-form-urlencoded", "Authorization" => "Bearer " . $token));
echo $header;

$post =  json_encode(array(
  "object_type" => "text",
  "text" => "hello,world",
  "link" => array(
    "web_url" => "www.naver.com"
  )
));
echo $post;

$data = json_encode(array("template_object" => $post));
// $response = file_get_contents($url, $header = $header,$data = $data);
//  print($response);

$ch = curl_init();  //curl초기화
curl_setopt($ch, CURLOPT_URL, $url); //url지정
curl_setopt($ch, CURLOPT_HEADER, $header); //header지정

//  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //요청 결과를문자열로 반환
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POST, true); //결과가 true시 post전송

curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //전송할데이터 
$response  = curl_exec($ch);

curl_close($ch);
