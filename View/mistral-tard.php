<?php
// Add this at the beginning of mistral-tard.php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['prompt'])) {
    $prompt = $_POST['prompt'];

    // Your Hugging Face API key
    $apiKey = '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';

    // The API URL for Mistral 7B
    $apiUrl = 'https://api-inference.huggingface.co/models/EleutherAI/gpt-neo-2.7B';

    // Data to be sent in the API request
    $data = ['inputs' => $prompt];

    // Initialize cURL session
    $ch = curl_init($apiUrl);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    ]);

    // Execute the request and capture the response
    $response = curl_exec($ch);

    // Check if the request was successful
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    } else {
        // Decode the JSON response
        $responseData = json_decode($response, true);

        // Adjusted to access the first element of the array and then the 'generated_text' key
        if (isset($responseData[0]['generated_text'])) {
            echo $responseData[0]['generated_text'];
        } else {
            // If 'generated_text' key does not exist, output the whole response to inspect
            echo "The key 'generated_text' does not exist in the response. Here's the full response: ";
            print_r($responseData);
        }
    }

    // Close the cURL session
    curl_close($ch);
    exit; // Ensure no further code is executed
}
?>