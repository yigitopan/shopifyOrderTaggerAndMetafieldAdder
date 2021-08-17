<?php
// +1. satırdan +37. satıra, burada mail domaini alınıyor.
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://2216e23dfab38a3557765a9782a4c272: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@achteck.myshopify.com/admin/api/2021-07/orders.json",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "authorization: Basic OWQ4MThmYmU4MmQ2YWI3NzUxZjAyOGZmMjk2NmFiMjA6c2hwcGFfZjEzZDYyNmQxZWYyNDA4MzYxNDBhMDhkNTM5OWQwMjA=",
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: af2f7c61-036e-5ac4-4b9f-9d328a1117c9"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
$decoded = json_decode($response, true);

$time = $decoded['orders'][0]['created_at'];
$orderId = $decoded['orders'][0]['id'];
$tags = $decoded['orders'][0]['tags'];

curl_close($curl);



echo $time;
echo $orderId;
echo "<br>";
echo $tags;

if ($err) {
    echo "cURL Error is  #:" . $err;
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
        "authorization: Basic MjIxNmUyM2RmYWIzOGEzNTU3NzY1YTk3ODJhNGMyNzI6c2hwcGFfZDc4MDgwNDM5YTEzOTRiMTI5ZjkzYWUyYmI4ZTg5YmU=",
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 6b3cfbd2-47a7-c5b9-e9fc-889b692f7f1a"
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