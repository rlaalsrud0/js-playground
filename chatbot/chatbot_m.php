<?php
$ch = curl_init();
$url = 'http://apis.data.go.kr/1360000/VilageFcstInfoService_2.0/getVilageFcst'; /*URL*/
$queryParams = '?' . urlencode('ServiceKey') . '=XvksfMzK5mJmpIcQS5gcvO0bMyOZsXfk%2FYGJJkt%2Buc6DZ5PJQmNwVceuN2BfU3JIPmKhIU3Ejwnj9OIKhhdMSQ%3D%3D'; /*Service Key*/
//$queryParams = '?' . urlencode('ServiceKey') . '=XvksfMzK5mJmpIcQS5gcvO0bMyOZsXfk/YGJJkt+uc6DZ5PJQmNwVceuN2BfU3JIPmKhIU3Ejwnj9OIKhhdMSQ=='; /*Service Key*/
$queryParams .= '&' . urlencode('pageNo') . '=' . urlencode('1'); /**/
$queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode('10'); /**/
$queryParams .= '&' . urlencode('dataType') . '=' . urlencode('XML'); /**/
$queryParams .= '&' . urlencode('base_date') . '=' . urlencode('20210730'); /**/
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

//echo $r['header']['resultCode'].'<br/>';
$a = $r['body']['items']['item'];
//print_r($a)."\n";
$date = $r['body']['items']['item'][0]['baseDate'];
$tmp = $r['body']['items']['item'][0]['fcstValue'];
$pop = $r['body']['items']['item'][7]['fcstValue'];
$result = '날짜 : '.$date.', 기온 : '.$tmp.', 강수확률 : '.$pop.'%';
print_r($result);
echo '<br/>';

// foreach($r['body']['items']['item'] as $vresult){
//     echo $result['fcstValue'];
// }

// $wData = $r['body']['category'][0];
// print_r($wData);

// foreach($r['body']['category'] as $wData){
//     echo '날씨 : '.$wData['fcstTime'];
//     echo '<br/>';
// }