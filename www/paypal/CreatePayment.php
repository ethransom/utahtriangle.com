<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment. Please note that direct 
// credit card payment and related features using the 
// REST API is restricted in some countries.
// API used: /v1/payments/payment

require __DIR__ . '/../../../../bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\CreditCard;
use PayPal\Api\Details;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;

function CreatePaymentUsingCreditCard($cardType, $cardNumber, $expireMonth, $expireYear, $cvv, $firstName, $lastName) {
    global $apiContext;
    /*$cardType = "visa";
    $cardNumber = "4032036410307647";
    $expireMonth = "11";
    $expireYear = "2020";
    $cvv = "000";
    $firstName = "Ryan";
    $lastName = "Clayton";*/
    
    // ### CreditCard
    // A resource representing a credit card that can be
    // used to fund a payment.
    $card = new CreditCard();
    $card->setType("{$cardType}")
        ->setNumber("{$cardNumber}")
        ->setExpireMonth("{$expireMonth}")
        ->setExpireYear("{$expireYear}")
        ->setCvv2("{$cvv}")
        ->setFirstName("{$firstName}")
        ->setLastName("{$lastName}");

    // ### FundingInstrument
    // A resource representing a Payer's funding instrument.
    // For direct credit card payments, set the CreditCard
    // field on this object.
    $fi = new FundingInstrument();
    $fi->setCreditCard($card);

    // ### Payer
    // A resource representing a Payer that funds a payment
    // For direct credit card payments, set payment method
    // to 'credit_card' and add an array of funding instruments.
    $payer = new Payer();
    $payer->setPaymentMethod("credit_card")
        ->setFundingInstruments(array($fi));

    // ### Itemized information
    // (Optional) Lets you specify item wise
    // information
    /*$item1 = new Item();
    $item1->setName('Ground Coffee 40 oz')
        ->setDescription('Ground Coffee 40 oz')
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setTax(0.3)
        ->setPrice(7.50);
    $item2 = new Item();
    $item2->setName('Granola bars')
        ->setDescription('Granola Bars with Peanuts')
        ->setCurrency('USD')
        ->setQuantity(5)
        ->setTax(0.2)
        ->setPrice(2);

    $itemList = new ItemList();
    $itemList->setItems(array($item1, $item2));*/

    // ### Additional payment details
    // Use this optional field to set additional
    // payment information such as tax, shipping
    // charges etc.
    $details = new Details();
    $details->setShipping(1.2)
        ->setTax(1.3)
        ->setSubtotal(17.5);

    // ### Amount
    // Lets you specify a payment amount.
    // You can also specify additional details
    // such as shipping, tax.
    $amount = new Amount();
    $amount->setCurrency("USD")
        ->setTotal(20)
        ->setDetails($details);

    // ### Transaction
    // A transaction defines the contract of a
    // payment - what is the payment for and who
    // is fulfilling it. 
    $transaction = new Transaction();
    $transaction->setAmount($amount)
        //->setItemList($itemList)
        ->setDescription("Payment description")
        ->setInvoiceNumber(uniqid());

    // ### Payment
    // A Payment Resource; create one using
    // the above types and intent set to sale 'sale'
    $payment = new Payment();
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setTransactions(array($transaction));

    // For Sample Purposes Only.
    $request = clone $payment;

    try {
        $payment->create($apiContext);
        return $payment->state;
    } catch (PayPal\Exception\PPConnectionException $ex) {
        return false;
    }
}
