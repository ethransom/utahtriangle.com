<?php require_once("../../includes/session.php"); ?>
<?php 
require __DIR__ . '/../../bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

if(isset($_GET['agreement']) && $_GET['agreement'] == 'confirm') {
    $paymentId = $_SESSION['paymentID'];
    $payment = Payment::get($paymentId, $apiContext);
    
    $execution = new PaymentExecution();
    $execution->setPayerId($_SESSION['PayerID']);
    
    $result = $payment->execute($execution, $apiContext);
    
    if($result){
        $_SESSION['agreement'] = true;
        header("Location: /data?rent=success");
        exit;
    } else {
        $_SESSION['message'] = "We were unable to process your payment, please try again.  If you continue having issues please contact us at info@utahtriangle.com.";
        header("Location: /index");
        exit;
    }
}

if(isset($_SESSION['paymentID']) && !empty($_SESSION['paymentID'])){
    $i = rand(1,4);
?>
<?php include("../../includes/layouts/header.php") ?>
<style>
    body {
        background-color: #262627;
    }
    .col-sm-6 {
        background-color: #fff;
        padding: 5px;
    }
    table td{
        padding: 0 5px;
        vertical-align: middle;
    }
</style>
<body>
    <section class="section">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3 text-center">
                <img src="/assets/img/emailHeader<?php echo $i ?>.png">
                <h6 style="margin-top:20px;">Rent Review</h6>
                <table width="100%">
                    <tr>
                        <td class="text-right" width="50%"><label>Name:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities($_SESSION['name']); ?></label><br></td>
                    </tr>
                    <tr>
                        <td class="text-right"><label>Email:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities($_SESSION['email']); ?></label><br></td>
                    </tr>
                    <tr>
                        <td class="text-right"><label>Amount:</label></td>
                        <td class="text-left"><label class="text-rose">$<?php echo htmlentities($_SESSION['rent_total']); ?></label><br></td>
                    </tr>
                </table>
                <p>This is an payment to Triangle Fraternity - Utah. I hereby acknowledge and agree that payments made are NON-REFUNDABLE.  Utah Triangle is a 501c7 social club, therefore donations to Triangle Fraternity - Utah are not tax deductible.</p>
                <p><a onclick="$('.process-overlay').show();$('.proccessing').show();" href="ExecuteRentPayment?agreement=confirm" class="btn btn-sm">Confirm Payment</a></p>
                <p><a href="/member">Cancel Payment</a></p>
            </div>
        </div>
    </section>
</body>
<?php //include("../../includes/layouts/footer.php") ?>
<script type="text/javascript" src="/assets/js/jquery-2.1.4.min.js?ver=1"></script>
<?php } else {
    $_SESSION['message'] = "We were unable to process your payment, please try again.  If you continue having issues please contact us at info@utahtriangle.com.";
    header("Location: /index");
    exit;
} ?>