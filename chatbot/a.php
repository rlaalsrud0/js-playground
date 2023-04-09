<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://kapi.kakao.com/v2/api/talk/memo/default/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURL_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURLOPT_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
	//CURLOPT_POSTFIELDS =>"{\n    \"message\": \"This is a test message\",\n    \"to\": \"+355692179931\",\n    \"sender_id\": \"SMS.to\"    \n}",
	CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Accept: application/json",
			"Authorization: Bearer qDJ-YmWA2EIPX0B6_IeidRRwknjtlS5i75bndAorDKYAAAF7BG-p9w"
		),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;