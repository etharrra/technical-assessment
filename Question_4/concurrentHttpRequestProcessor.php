<?php

function ConcurrentHttpRequestProcessor($requests, $concurrent_limit = 5)
{
    $queue = array_chunk($requests, $concurrent_limit);
    $results = [];
    $mh = curl_multi_init();

    foreach ($queue as $batch) {
        $handles = [];

        // build the multi-curl handle
        foreach ($batch as $key => $request) {
            $ch = curl_init();

            curl_setopt_array($ch, array(
                CURLOPT_URL => $request['url'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_CUSTOMREQUEST => $request['method'],
            ));

            if (!empty($request['headers'])) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $request['headers']);
            }

            if (!empty($request['body']) && in_array(strtoupper($request['method']), ['POST', 'PUT', 'PATCH'])) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $request['body']);
            }

            curl_multi_add_handle($mh, $ch);
            $handles[$key] = $ch;
        }

        // execute all queries simultaneously
        do {
            $status = curl_multi_exec($mh, $active);
            curl_multi_select($mh);
        } while ($active && $status == CURLM_OK);

        foreach ($handles as $key => $ch) {
            $results[$key] = [
                'response' => curl_multi_getcontent($ch),
                'error' => curl_error($ch),
                'info' => curl_getinfo($ch),
            ];

            curl_multi_remove_handle($mh, $ch);
            curl_close($ch);
        }
    }
    curl_multi_close($mh);

    return $results;
}

// Example Usage
$requests = [
    [
        'url' => 'https://httpbin.org/get',
        'method' => 'GET',
        'headers' => ['Accept: application/json'],
    ],
    [
        'url' => 'https://reqres.in/api/users/2',
        'method' => 'GET',
        'headers' => ['Accept: application/json'],
    ],
    [
        'url' => 'https://httpbin.org/post',
        'method' => 'POST',
        'headers' => ['Content-Type: application/json'],
        'body' => json_encode(['title' => 'foo', 'body' => 'bar', 'userId' => 1]),
    ],

];
$concurrent_limit = 10;

$results = ConcurrentHttpRequestProcessor($requests, $concurrent_limit);

// Output results
foreach ($results as $key => $result) {
    echo "Request $key:\n";
    echo "Response: " . $result['response'] . "\n";
    echo "Error: " . ($result['error'] ?: 'None') . "\n";
    echo "HTTP Code: " . $result['info']['http_code'] . "\n\n";
}
