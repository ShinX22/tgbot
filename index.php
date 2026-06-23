<?php
// Securely store your token
$botToken = "8050343582:AAFWdZq1Zvgoc_QFP3Dt0tjUecV7xZkaVEI";
$website = "https://api.telegram.org/bot" . $botToken;

// Capture incoming webhook data sent by Telegram
$content = file_get_contents("php://input");
$update = json_decode($content, true);

// Extract the chat ID and incoming text message
$chatId = $update["message"]["chat"]["id"] ?? null;
$message = $update["message"]["text"] ?? '';

if ($chatId) {
    // Determine the response text based on the user command
    if (strpos($message, "/start") === 0) {
        $reply = "Hello! Welcome to your PHP-powered Telegram Bot. Type /help to see options.";
    } elseif (strpos($message, "/help") === 0) {
        $reply = "I am a simple echo bot. Send me any text and I will repeat it back to you!";
    } else {
        $reply = "You said: " . $message;
    }

    // Prepare parameters for the API request
    $url = $website . "/sendMessage?chat_id=" . $chatId . "&text=" . urlencode($reply);
    
    // Execute the request to send the response back
    file_get_contents($url);
}
?>
