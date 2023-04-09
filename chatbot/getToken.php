<?php

    $url = "https://kauth.kakao.com/oauth/token";
    $data = json_encode(array(
        "grant_type" => "authorization_code",
        "client_id" => "afda81cab2f7733040f290be14511bdf",
        "redirect_uri" => "https://goodforme.dothome.co.kr/min/chatbot/chatbot_m.php",
        "code" => "dy8PxKEMiNuTzK9yxWC5Bo163OGi2Xaxt6xNkKfEzh6h7fNUweiusEZKmIaUFta41t3JYQopyNoAAAF7BcvaCA",
        "client_secret" => "dlmctHnjUeHWoSSHjRg9YylJr1mWD0Oz"
    ));

    function curl($url, $method, $data){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt($ch, CURLOPT_HEADER, 0); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if($method = 'POST'){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }else{
            curl_setopt($ch, CURLOPT_GET, true);
            curl_setopt($ch, CURLOPT_GETFIELDS, $data);
        }
        // curl_setopt($ch, CURLOPT_POST, true); //결과가 true시 post전송
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        $tokens = json_decode(urldecode($response));
        var_dump($tokens);
        //var_dump($response);
        if(file_exists('./a.json')){
            $open = file_get_contents('a.json');
            $tempArray = json_decode($open, true);
            file_put_contents('a.json', $response);
        } 
        // else {
        //     echo '파일이 존재하지 않음';
        // }
    }

    $get = curl($url, 'GET', $data);
    var_dump($get);
    $post = curl($url, 'POST', $data);
    var_dump($post);

    // $response = requests.post($url, $data = $data);
    // $tokens = $response.json();
    // print($tokens);

    //curl($url, 'POST', $data);

    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_URL, $url);

    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
    // curl_setopt($ch, CURLOPT_HEADER, 0); 
    // // curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 

    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    // curl_setopt($ch, CURLOPT_POST, true); //결과가 true시 post전송
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//전송할데이터 

    // $response = curl_exec($ch);
    // $tokens = json_decode(urldecode($response));
    // var_dump($response);

    // if(file_exists('./a.json')){
    //     $open = file_get_contents('a.json');
    //     $tempArray = json_decode($open, true);
    //         file_put_contents('a.json', $response);
    // } else {
    //     echo '파일이 존재하지 않음';
    // }