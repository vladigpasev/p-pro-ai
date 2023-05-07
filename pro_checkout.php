<?php
require ('autoexec.php');
require '../vendor/autoload.php';

\Stripe\Stripe::setApiKey('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'); // Replace with your secret key

header('Content-Type: application/json');

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price' => 'price_1N4qGBKy2Ki2xcvjVsiw0fxq', // Replace with your monthly subscription Price ID
            'quantity' => 1,
        ]],
        'mode' => 'subscription',
        'success_url' => 'https://p-pro.eu/ai/dashboard.php?newplan_success=true', // Replace with your success page URL
        'cancel_url' => 'https://p-pro.eu/ai/dashboard.php?newplan_success=error', // Replace with your cancel page URL
        'customer_email' => $email_addr,
    ]);
    
    

    echo json_encode(['id' => $checkout_session->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
