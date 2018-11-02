<?php
namespace PayWithAmazon;

session_start();

require_once 'PayWithAmazon/Client.php';

$config =array( 'merchant_id'   => 'MERCHANT_ID',
                'access_key'    => 'ACCESS_KEY',
                'secret_key'    => 'SECRET_KEY',
                'client_id'     => 'CLIENT_ID',
                'currency_code' => 'usd',
                'region'        => 'us',
                'sandbox'   => true);

// Instantiate the client object with the configuration
$client = new Client($config);
$requestParameters = array();

// Create the parameters array to set the order
$requestParameters['amazon_order_reference_id'] = 'AMAZON_ORDER_REFERENCE_ID';
$requestParameters['amount']            = '175.00';
$requestParameters['currency_code']     = 'USD';
$requestParameters['seller_note']   = 'Love this sample';
$requestParameters['seller_order_id']   = '123456-TestOrder-123456';
$requestParameters['store_name']        = 'Saurons collectibles in Mordor';

// Set the Order details by making the SetOrderReferenceDetails API call
$response = $client->SetOrderReferenceDetails($requestParameters);

// If the API call was a success Get the Order Details by making the GetOrderReferenceDetails API call
if($client->success)
{
    $requestParameters['address_consent_token'] = null;
    $response = $client->GetOrderReferenceDetails($requestParameters);
}
// Pretty print the Json and then echo it for the Ajax success to take in
$json = json_decode($response->toJson());
echo json_encode($json, JSON_PRETTY_PRINT);    
    
?>
<?php confirm_logged_in(); ?>
<?php

?>