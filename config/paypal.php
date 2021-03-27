<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID', 'AVh1rYPKR3AsZ_efDlrXq0WRe_GprJj6mmcwqFVFpJnKsLQiIwBmTENUdLcA_Zx59CiGVHZ81uUpVoya'),
        'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET', 'ELuIdlk59HE2volLABykGPCs0QF81DYnxsVqiQGsSI80TTHs20Iew4XUfe_-O_aEuzkHuDniRhbuDFAV'),
        'app_id'            => 'APP-80W284485P519543T',
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', 'AXJfTJ49uEW_6HfjAaxOn-ct_QXkeQ-CNIvJswqJhW5NDDpabuvNOwr-SGprPzs309IXn08owp36NTb9'),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', 'EJ82FmbgZnI4x7h0kiyOm0c4T90EHuyfd5Asp2tNbIDEuBN8WkUfrH9GyhCh4-Hyltp996lbua2mKU4o'),
        'app_id'            => '',
    ],
    'settings' => [
        'mode' => env('PAYPAL_MODE', 'live'),
        'http.ConnectionTimeOut' => 30,
        'shipping_preference' => 'NO_SHIPPING'
    ],
    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'EUR'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
    'locale'         => env('PAYPAL_LOCALE', 'es_ES'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
