<?php

$API_KEY = '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'; // Replace with your actual Hugging Face API Key
$API_URL = 'https://api-inference.huggingface.co/models/runwayml/stable-diffusion-v1-5';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$prompt = $input['prompt'] ?? '';

if (empty($prompt)) {
    http_response_code(400);
    echo json_encode(['error' => 'Prompt is required']);
    exit();
}

$headers = [
    "Authorization: Bearer $API_KEY",
    "Content-Type: application/json"
];

$payload = json_encode(['inputs' => $prompt]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $API_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if ($http_code === 503) {
    http_response_code(503);
    echo json_encode(['error' => 'Model is loading. Please try again later.']);
    exit();
}

if ($http_code !== 200) {
    http_response_code($http_code);
    echo json_encode(['error' => 'Failed to generate image']);
    exit();
}

// Set content type to image and directly output the image data
header('Content-Type: image/png');
echo $response;
