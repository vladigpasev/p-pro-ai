<?php
date_default_timezone_set("Europe/Sofia");
session_start();
require ('autoexec.php');
require '../vendor/autoload.php';


\Stripe\Stripe::setApiKey('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'); // Replace with your secret key

$customer_email = $email_addr; // Replace with the customer's email

// Вземете клиента по имейл
$customers = \Stripe\Customer::all([
    'email' => $customer_email,
    'limit' => 1,
]);

if (count($customers->data) > 0) {
    $customer = $customers->data[0];

    // Вземете абонаментите за клиента
    $subscriptions = \Stripe\Subscription::all([
        'customer' => $customer->id,
    ]);

    $active_subscriptions = array_filter($subscriptions->data, function ($subscription) {
        return $subscription->status === 'active';
    });

    if (count($active_subscriptions) > 0) {
        // Обходете активните абонаменти и отпечатайте подробностите
        foreach ($active_subscriptions as $subscription) {
            // echo 'Subscription ID: ' . $subscription->id . PHP_EOL;
            // echo 'Plan ID: ' . $subscription->items->data[0]->price->id . PHP_EOL;
            // echo 'Status: ' . $subscription->status . PHP_EOL;
            // echo 'Current period start: ' . date('Y-m-d H:i:s', $subscription->current_period_start) . PHP_EOL;
            // echo 'Current period end: ' . date('Y-m-d H:i:s', $subscription->current_period_end) . PHP_EOL;
            // echo '---' . PHP_EOL;
            $period_start = date('d.m.Y', $subscription->current_period_start);
            $next_billing = date('d.m.Y', $subscription->current_period_end);
            switch ($subscription->items->data[0]->price->id) {
                case 'price_1N4oADKy2Ki2xcvjnDCnQFNT':
                    $plan_status = 'basic';
                    break;
                case 'price_1N4qGBKy2Ki2xcvjVsiw0fxq':
                    $plan_status = 'pro';
                    break;
                case 'price_1N4qIVKy2Ki2xcvjAQy4sn6s':
                    $plan_status = 'premium';
                    break;
                default:
                    $plan_status = 'free';
            }
            
            
        }
    } else {
        $plan_status = 'free';
    }
} else {
    $plan_status = 'free';
}
