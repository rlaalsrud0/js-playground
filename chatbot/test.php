<?php

  $token = $_GET['token'];
  var_dump($token);
  //$url = "https://kapi.kakao.com/v2/api/talk/memo/default/send";
  $url = "https://kauth.kakao.com/oauth/token";
  $app_key = "afda81cab2f7733040f290be14511bdf";
  $code = "qFsTjNPi-utiWg_lRH5cvs0UCozWinZRabuU0uW2wdsupWgik-h-psc2_EjWqoMcgmxpAQorDR8AAAF7BYLm8g"
  $data = {
      "grant_type" : "authorization_code",
      "client_id" : $app_key,
      "redirect_uri" : "https://testmann.cafe24.com",
      "code" : $code
  }
//   $response = requests.post($url, $data = $data);
//   $tokens = $response.json();
//   print($tokens);

//   $header = json_encode(array("Authorization" => "Bearer ".$token));
//   echo $header;

//   $post =  json_encode(array(
//       "object_type" => "text",
//       "text" => "hello,world",
//       "link"=>array( 
//         "web_url" => "www.naver.com"
//       )
//   ));
//   echo $post;

// $data = json_encode(array("template_object" => $post));
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_HEADER, FALSE);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
// $response = curl_exec($ch);
// curl_close($ch);
// //$response = file_get_contents($url, $header = $header,$data = $data);
// var_dump($response);