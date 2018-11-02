<?php 

require __DIR__ . '/../../bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;


function CreatePaymentUsingPayPal($budget, $total) {
    global $apiContext;
    if(!isset($_SESSION['agreement_name']) || empty($_SESSION['agreement_name'])){
        $_SESSION['agreement_name'] = "Utah Triangle Donation";
    }
    
    $payer = new Payer();
    $payer->setPaymentMethod("paypal");
    
    $items = array();
    $item = new Item();
    $item->setName("{$_SESSION['agreement_name']}")
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setSku("{$budget}")
        ->setPrice($total);
    array_push($items, $item);
    
    $itemList = new ItemList();
    $itemList->setItems($items);

    $amount = new Amount();
    $amount->setCurrency("USD")
        ->setTotal($total);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
       ->setItemList($itemList)
        ->setDescription("Payment description")
        ->setInvoiceNumber(uniqid());

    $baseUrl = getBaseUrl();
    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl("$baseUrl/paypal/ExecutePayment.php?success=true")
        ->setCancelUrl("$baseUrl/paypal/ExecutePayment.php?success=false");

    $payment = new Payment();
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));

    $request = clone $payment;

    $result = $payment->create($apiContext);

    if($result){
        $approvalUrl = $payment->getApprovalLink();
        return $approvalUrl;
    } else {
        return false;
    }
}