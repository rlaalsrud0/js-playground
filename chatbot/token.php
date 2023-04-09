<?php

include('chatbot_m.php');
    // 공통적으로 쓰이는 값
    $freshcode = $_GET['code'];
    $client_id = 'afda81cab2f7733040f290be14511bdf';
    //$client_secret = 'NWLCJ7CbsW7QVk5zpyH6IrivHKBV1mi3';

    // 사용자 유입경로 체크
    if(empty($freshcode) || is_null($freshcode)){
            echo '<a href="https://kauth.kakao.com/oauth/authorize?client_id=afda81cab2f7733040f290be14511bdf&response_type=code&redirect_uri=https://goodforme.dothome.co.kr/min/chatbot/token.php">
            meow</a>'; 

    // if(empty($freshcode) || is_null($freshcode)){
    //     echo "<script>
    //     location.href = 'https://kauth.kakao.com/oauth/authorize?client_id=afda81cab2f7733040f290be14511bdf&response_type=code&redirect_uri=https://testmann.cafe24.com/chatbot/token.php'
    //     </script>";
    //     $head = array("Authorization: Bearer ".$access_token);
    //     $urll = "https://kapi.kakao.com/v2/api/talk/memo/default/send";
    //     $method = 'POST';
    //     $body = array("template_object" => json_encode(array(
    //         "object_type" => "text",
    //         "text" => $result,
    //         "link" => array( 
    //             "web_url"=> "https://developers.kakao.com",
    //             "mobile_web_url"=> "https://developers.kakao.com"
    //         ),
    //         "button_title" => "바로 확인"
    //     )));
    //     $send = curlll($head, $method, $urll, $body);
    //     var_dump($send);
    //     //header("Location: https://kauth.kakao.com/oauth/authorize?client_id=afda81cab2f7733040f290be14511bdf&response_type=code&redirect_uri=https://testmann.cafe24.com/chatbot/token.php");
    // } else {
        
        // 토큰 가져오기
        $header = array('Content-Type: application/x-www-form-urlencoded;charset=utf-8');
        $url = 'https://kauth.kakao.com/oauth/token';
        $method = 'POST';
        $data = array('grant_type' => 'authorization_code', 'client_id' => $client_id, 'redirect_uri' => 'https://goodforme.dothome.co.kr/min/chatbot/token.php', 'code' => $freshcode);

        $tokenData = curlll($header, $method, $url, $data);
        var_dump($tokenData);
        // if(0 == filesize('accesstoken.json')){
        //     file_put_contents('accesstoken.json', 'access token : '.$access_token.'  expires in : '.$expires_in);
        // }

        $a = json_decode($tokenData, true);
        $access_token = $a['access_token'];
        $refresh_token = $a['refresh_token'];
        $expires_in = $a['expires_in'];
        $refresh_tokenEx = $a['refresh_token_expires_in'];

        $TokenArray = json_encode(array('accessToken' => $access_token, 'refreshToken' => $refresh_token));


            if(0 == filesize('accesstoken.json')){
                file_put_contents('accesstoken.json', $TokenArray);
            }else{
                $getExpire = json_decode(file_get_contents('accesstoken.json'), true);
                
                $InfoTokenHeader = array('Authorization: Bearer '.$getExpire["accessToken"], 'Content-Type: application/x-www-form-urlencoded;charset=utf-8'); 
                //$refreshTokenheader = array('Content-Type: application/x-www-form-urlencoded;charset=utf-8', 'Authorization: Bearer '.$access_token);
                $InfoTokenUrl = 'https://kapi.kakao.com/v1/user/access_token_info';
                //$refreshTokenUrl = 'https://kauth.kakao.com/oauth/token';
                $InfoTokenMethod = 'GET';
                //$refrechTokenType = 'POST';
                $InfoToken = json_decode(cu($InfoTokenHeader, $InfoTokenMethod, $InfoTokenUrl), true);
                var_dump('토큰 정보 : '.$InfoToken);
                if($InfoToken["expires_in"] == 0){
                    $reToken = renewToken($getExpire["refreshToken"]);
                    $reTokenArray = array('accessToken' => $InfoToken["access_token"], 'refreshToken' => $InfoToken["refreshToken"]);
                    file_put_contents('accesstoken.json', $reTokenArray);
                }
                // $refreshTokendata = array(
                //     'grant_type' => 'refresh_token', 
                //     'client_id' => $client_id,
                //     'refresh_token' => $refresh_token, 
                // );
                //$renewToken = curlll($refreshTokenheader,$refrechTokenType,$refreshTokenUrl,$refreshTokendata);
                //var_dump('토큰 갱신하기 : '.$renewToken);
            }
            echo $getExpire["accessToken"];

        // 날씨 메시지 전송
        // include('chatbot_m.php');
        $head = array("Authorization: Bearer ".$access_token);
        $urll = "https://kapi.kakao.com/v2/api/talk/memo/default/send";
        $method = 'POST';
        $body = array("template_object" => json_encode(array(
            "object_type" => "text",
            "text" => $result,
            "link" => array( 
                "web_url"=> "https://developers.kakao.com",
                "mobile_web_url"=> "https://developers.kakao.com"
            ),
            "button_title" => "바로 확인"
        )));
        $send = curlll($head, $method, $urll, $body);
        var_dump($send);

    }


    // 이미 저장되어있는 토큰인지 확인 / 저장되어있지 않다면 저장

    // 토큰 시간이 만료되었으면 토큰 갱신하기
    // $getToken = json_decode(file_get_contents('accesstoken.json'), true);
    // $ex = $getToken['expires in'];
    // var_dump($ex);
    function renewToken($refresh_token){
        //file_put_contents('accesstoken.json', 'access token : '.$access_token.'  expires in : '.$expires_in);
        $refreshTokenheader = array('Content-Type: application/x-www-form-urlencoded;charset=utf-8', 'Authorization: Bearer '.$access_token);
        $refreshTokenUrl = 'https://kauth.kakao.com/oauth/token';
        $refrechTokenType = 'POST';
        $refreshTokendata = array(
            'grant_type' => 'refresh_token', 
            'client_id' => $client_id,
            'refresh_token' => $refresh_token, 
        );
        $renewToken = curlll($refreshTokenheader,$refrechTokenType,$refreshTokenUrl,$refreshTokendata);
        var_dump('토큰 갱신하기 : '.$renewToken);
        return $renewToken;
    }

        // 리프레시 시점 기록

    // 토큰 정보 보기 
    // $tokenInfoHeader = array('Authorization: Bearer '.$access_token, 'Content-type: application/x-www-form-urlencoded;charset=utf-8');
    // $tokenInfoUrl = 'https://kapi.kakao.com/v1/user/access_token_info';
    // $tokenInfoType = 'GET';
    // $tokenInfo = cu($tokenInfoHeader,$tokenInfoType,$tokenInfoUrl);
    // $x = json_decode($tokenInfo);
    // var_dump($tokenInfo);
    function cu($header, $method, $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $data);
        $response = curl_exec($ch);
        return $response;
    }

    // 토큰 갱신하기
    // if($expires_in == 0){
    //     $refreshTokenheader = array('Content-Type: application/x-www-form-urlencoded;charset=utf-8', 'Authorization: Bearer '.$access_token);
    //     $refreshTokenUrl = 'https://kauth.kakao.com/oauth/token';
    //     $refrechTokenType = 'POST';
    //     $refreshTokendata = array(
    //         'grant_type' => 'refresh_token', 
    //         'client_id' => $client_id,
    //         'refresh_token' => $refresh_token, 
    //     );
    //     $renewToken = curlll($refreshTokenheader,$refrechTokenType,$refreshTokenUrl,$refreshTokendata);
    //     var_dump('토큰 갱신하기 : '.$renewToken);
    // }

    // curl 요청
    // header = array, method = string, url = string, data = array
    function curlll($header, $method, $url, $data){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $data);
        $response = curl_exec($ch);
        return $response;
    }

    /*

    
//curl_setopt($ch, CURLOPT_GET, true);
if(file_exists('./token.json')){
    $open = file_get_contents('token.json');
    $tempArray = json_decode($open, true);
    file_put_contents('token.json', $response);
} 
$response = curl_exec($ch);
var_dump($response);
$tokens = json_decode(urldecode($response));
var_dump($tokens);
if($tokens = true){
    // 날씨 띄워주기
    include('chatbot_m.php');
}else{
    // 카카오 로그인 버튼
    header("Location: https://kauth.kakao.com/oauth/authorize?client_id=afda81cab2f7733040f290be14511bdf&response_type=code&redirect_uri=https://testmann.cafe24.com/chatbot_m.php");
}
//var_dump($response);


function get($request){
    try{
        $data = json_encode(array(
            $code => $request.GET.get("code"),
            $client_id => "afda81cab2f7733040f290be14511bdf",
            $redirect_uri => "https://testmann.cafe24.com/chatbot_m.php",
            $token_request => $request.get(
                "https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id=".$client_id."&redirect_uri=".$redirect_uri."&code=".$code
            )
            // "code" => $request.GET.get("code"),
            // "client_id" => "afda81cab2f7733040f290be14511bdf",
            // "redirect_uri" => "https://testmann.cafe24.com/chatbot_m.php",
            // "token_request" => $request.get(
            //     "https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id={client_id}&redirect_uri={redirect_uri}&code={code}"
            // )
        ));
        if(file_exists('./code.json')){
            $open = file_get_contents('code.json');
            $tempArray = json_decode($open, true);
            file_put_contents('code.json', $request.GET.get("code"));
        } 
    // $a = json_encode($data);
    // $b = json_decode($a, true);
    // var_dump($b);
}catch(Exception $e){
        echo "exception error";
    }
}

//get();

$token = file_get_contents('a.json');
 */