<?php
// +1. satırdan +37. satıra, burada mail domaini alınıyor.



$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://9d818fbe82d6ab7751f028ff2966ab20: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@achteck.myshopify.com/admin/api/2021-07/orders.json",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "authorization: Basic ZTA5NWRmYWE5NWU4YWYzYzY2MjJkYWZhNTNlMWExZjI6c2hwcGFfMmVhZTg1NjhmYTVhMmZiNzllNTNhNzU0ZTk0Nzk2OGU=",
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 5832ef3b-376d-3c26-646c-0e9298122f4d"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

$decoded = json_decode($response, true);

$time = $decoded['orders'][0]['created_at'];
$orderId = $decoded['orders'][0]['id'];
$tags = $decoded['orders'][0]['tags'];



$timeArr = explode('T',$time,2);
$plusSpot = strpos($timeArr[1],"+");
$timeArr[1] = substr($timeArr[1], 0, $plusSpot);
$time = $timeArr[1];
$time = substr($time,0,2);

echo "BURASI".$time;
if($time<6){
    $time = "Night";
}

elseif ($time >= 6 && $time < 12){
    $time = "Morning";
}

elseif ($time >= 12 && $time < 18){
    $time = "Afternoon";
}

elseif ($time >= 18 && $time < 24){
    $time = "Evening";
}

//night 0-6
//morning 6-12
//afternoon 12-18
//evening 18-24


curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo "ilkresponse"."<br>";

}


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://9d818fbe82d6ab7751f028ff2966ab20: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@achteck.myshopify.com/admin/api/2021-07/orders/".$orderId.".json",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => "{\n    \"order\": {\n        \"tags\": \"$tags, $time\"\n    }\n}",
    CURLOPT_HTTPHEADER => array(
        "authorization: Basic ZTA5NWRmYWE5NWU4YWYzYzY2MjJkYWZhNTNlMWExZjI6c2hwcGFfMmVhZTg1NjhmYTVhMmZiNzllNTNhNzU0ZTk0Nzk2OGU=",
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: fb75c3a6-641c-4935-8fdb-30a724b85e12"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
