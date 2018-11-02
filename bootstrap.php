<?php

// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
require __DIR__  . '/vendor/autoload.php';

// 2. Provide your Secret Key. Replace the given one with your app clientId, and Secret
// https://developer.paypal.com/webapps/developer/applications/myapps
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        // SANDBOX
        //'AVK5h9o1PxhzYCs6CUv_J0o5ttnZnLVGKT7LDXMRb0duI6WVhgrz7wex-QYMLRHWLJg-gpnL-uYjS81w',     // ClientID
        //'EDj1vr_HYElPQ92uqnSBVkPbvknfkVJuyS7xlbVvXbvWfhU9aifAECei9sWCTQwGDQnasYyeNSYlQLK9'      // ClientSecret

        // PRODUCTION
        'AZoEFVBQNeW0ZeEgEYsJ4SYmUzqNGLeWrDTEVlCiZypVMA9OEqTt-SVAcAKSoGobCnpR9F3YekziHNkK',     // ClientID
        'EOh4dVurK3idcUWTgGAid-FOI7MmE1oFZyAywfn0HOaadYa0TWxRSUAEZrRMchlEcfekto6ohQDq9geL'      // ClientSecret
    )
);

// Step 2.1 : Between Step 2 and Step 3
$apiContext->setConfig(
  array(
    //'mode' => 'sandbox',
    'mode' => 'live',
    'log.LogEnabled' => false,
    'log.FileName' => 'PayPal.log',
    'log.LogLevel' => 'DEBUG'
  )
);

?>
