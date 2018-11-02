<?php

// # Create Plan Sample
//
// This sample code demonstrate how you can create a billing plan, as documented here at:
// https://developer.paypal.com/webapps/developer/docs/api/#create-a-plan
// API used: /v1/payments/billing-plans

require __DIR__ . '/../../bootstrap.php';
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;

$cycles = $_SESSION['cycles'];
$total = $_SESSION['total'];

if($cycles == 1){
    $months = 0;
    $plan_type = "INFINITE";
} else {
    $months = $cycles - 1;
    $plan_type = "FIXED";
}

if($_SESSION['recurring_type'] == "Monthly"){
    $frequency = "Month";
} else {
    $frequency = "Year";
}

// Create a new instance of Plan object
$plan = new Plan();

// # Basic Information
// Fill up the basic information that is required for the plan
$plan->setName("{$_SESSION['agreement_name']}")
    ->setDescription("{$_SESSION['agreement_name']}")
    ->setType("{$plan_type}");

// # Payment definitions for this billing plan.
$paymentDefinition = new PaymentDefinition();

// The possible values for such setters are mentioned in the setter method documentation.
// Just open the class file. e.g. lib/PayPal/Api/PaymentDefinition.php and look for setFrequency method.
// You should be able to see the acceptable values in the comments.
$paymentDefinition->setName('Regular Payments')
    ->setType('REGULAR')
    ->setFrequency("{$frequency}")
    ->setFrequencyInterval("1")
    ->setCycles("{$months}")
    ->setAmount(new Currency(array('value' => $total, 'currency' => 'USD')));

// Charge Models
//$chargeModel = new ChargeModel();
//$chargeModel->setType('SHIPPING')
//    ->setAmount(new Currency(array('value' => 0, 'currency' => 'USD')));

//$paymentDefinition->setChargeModels(array($chargeModel));

$merchantPreferences = new MerchantPreferences();
$baseUrl = getBaseUrl();
// ReturnURL and CancelURL are not required and used when creating billing agreement with payment_method as "credit_card".
// However, it is generally a good idea to set these values, in case you plan to create billing agreements which accepts "paypal" as payment_method.
// This will keep your plan compatible with both the possible scenarios on how it is being used in agreement.
$merchantPreferences->setReturnUrl("$baseUrl/paypal/ExecuteAgreement.php?success=true")
    ->setCancelUrl("$baseUrl/paypal/ExecuteAgreement.php?success=false")
    ->setAutoBillAmount("yes")
    ->setInitialFailAmountAction("CONTINUE")
    ->setMaxFailAttempts("0")
    ->setSetupFee(new Currency(array('value' => ($total), 'currency' => 'USD')));


$plan->setPaymentDefinitions(array($paymentDefinition));
$plan->setMerchantPreferences($merchantPreferences);

$output = $plan->create($apiContext);

return $output;
