# Concurrent HTTP Request Processor

This PHP script defines a function `ConcurrentHttpRequestProcessor` that processes multiple HTTP requests concurrently. The function supports custom HTTP methods, headers, and request bodies. It handles errors gracefully and returns results for all requests, including successful and failed ones.

## Features

-   Supports concurrent processing of HTTP requests.
-   Allows custom HTTP methods, headers, and request bodies.
-   Handles timeouts and errors.
-   Returns detailed responses, including HTTP status codes and errors.

## Code Explanation

### 1. **Function Definition**

The `ConcurrentHttpRequestProcessor` function takes two parameters:

-   `$requests`: An array of requests where each request is an associative array with keys `url`, `method`, `headers`, and `body`.
-   `$concurrent_limit`: The maximum number of concurrent requests to process (default is 5).

### 2. **Chunking Requests**

The `array_chunk` function divides the list of requests into smaller batches based on the concurrency limit. Each batch is processed separately to avoid overwhelming the server.

### 3. **Setting Up cURL Multi Handle**

A cURL multi-handle (`curl_multi_init`) is used to manage multiple cURL sessions simultaneously. Each request in a batch is initialized with `curl_init` and configured using `curl_setopt_array`.

### 4. **Executing Requests**

The `curl_multi_exec` function executes all requests in the batch concurrently. The script loops until all requests are completed.

### 5. **Collecting Results**

Responses are collected using `curl_multi_getcontent` and include the following details:

-   `response`: The HTTP response body.
-   `error`: Any error message from cURL.
-   `info`: Metadata about the request, including the HTTP status code.

### 6. **Cleanup**

Each cURL handle is removed from the multi-handle using `curl_multi_remove_handle` and closed using `curl_close`. Finally, the multi-handle itself is closed with `curl_multi_close`.

### Example Usage

The following example demonstrates how to use the `ConcurrentHttpRequestProcessor` function:

```php
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
```

## Example Output

```
Request 0:
Response: {"args":{},"headers":{...}}
Error: None
HTTP Code: 200

Request 1:
Response: {"data":{"id":2,"first_name":"Janet"...}}
Error: None
HTTP Code: 200

Request 2:
Response: {"json":{"title":"foo","body":"bar"...}}
Error: None
HTTP Code: 200
```

## Requirements

-   PHP 7.0 or higher
-   cURL extension enabled

## Notes

-   Ensure URLs include valid protocols (`http://` or `https://`).
-   Requests exceeding the concurrency limit are queued and processed in batches.

