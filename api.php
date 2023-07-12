<?php
// Path to the file storing the request count
$countFilePath = 'request_count.txt';

// Function to fetch the request count from the file
function getRequestCount() {
    global $countFilePath;

    // Read the count from the file
    $count = (int) file_get_contents($countFilePath);

    return $count;
}

// Function to increment and save the request count
function incrementRequestCount() {
    global $countFilePath;

    // Read the current count from the file
    $count = (int) file_get_contents($countFilePath);

    // Increment the count
    $count++;

    // Save the updated count to the file
    file_put_contents($countFilePath, $count);
}

// Check if the request is coming from the specified URL
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] === 'https://borowka503.github.io/layer7-dstat/hit') {
    // Increment the request count
    incrementRequestCount();
}

// API endpoint to return the request count
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Set the response content type to JSON
    header('Content-Type: application/json');

    // Get the request count
    $count = getRequestCount();

    // Prepare the response data
    $response = array('count' => $count);

    // Send the JSON response
    echo json_encode($response);
} else {
    // Handle invalid HTTP methods
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>
