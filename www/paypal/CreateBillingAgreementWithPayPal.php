<?php require_once("../includes/session.php"); ?>
<?php

$createdPlan = require 'UpdatePlan.php';

use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\ShippingAddress;

function CreateBillingAgreementWithPayPal() {
    global $apiContext;
    global $createdPlan;
    $time = gmdate("Y-m-d\TH:i:s\Z", $_SESSION['sessionEnd']);
    if(!isset($_SESSION['agreement_name']) || empty($_SESSION['agreement_name'])){
        $_SESSION['agreement_name'] = "Utah Triangle Donation";
    }
    
    /* Create a new instance of Agreement object
    {
        "name": "Base Agreement",
        "description": "Basic agreement",
        "start_date": "2015-06-17T9:45:04Z",
        "plan": {
          "id": "P-1WJ68935LL406420PUTENA2I"
        },
        "payer": {
          "payment_method": "paypal"
        },
        "shipping_address": {
            "line1": "111 First Street",
            "city": "Saratoga",
            "state": "CA",
            "postal_code": "95070",
            "country_code": "US"
        }
    }*/
    $agreement = new Agreement();

    $agreement->setName("Utah Triangle Donation")
        ->setDescription("{$_SESSION['agreement_name']} Agreement")
        ->setStartDate("{$time}");

    // Add Plan ID
    // Please note that the plan Id should be only set in this case.
    $plan = new Plan();
    $plan->setId($createdPlan->getId());
    $agreement->setPlan($plan);

    // Add Payer
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');
    $agreement->setPayer($payer);
    

    $agreement = $agreement->create($apiContext);
    if($agreement){
        $approvalUrl = $agreement->getApprovalLink();
        return $approvalUrl;
    } else {
        return false;
    }
}
