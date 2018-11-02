<?php require_once("../../includes/session.php"); ?>
<?php 
require __DIR__ . '/../../bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

if(isset($_GET['donation']) && $_GET['donation'] == 'confirm') {
    $paymentId = $_SESSION['paymentID'];
    $payment = Payment::get($paymentId, $apiContext);
    
    $execution = new PaymentExecution();
    $execution->setPayerId($_SESSION['PayerID']);
    
    $result = $payment->execute($execution, $apiContext);
    
    if($result){
        $_SESSION['donation'] = true;
        header("Location: /data?donation=success");
        exit;
    } else {
        $_SESSION['message'] = "We were unable to process your payment, please try again.  If you continue having issues please contact us at info@utahtriangle.com.";
        header("Location: /index");
        exit;
    }
}

if(isset($_GET['success']) && $_GET['success'] == 'true') {
    $_SESSION['paymentID'] = $_GET['paymentId'];
    $_SESSION['PayerID'] = $_GET['PayerID'];
    $_SESSION['paymentToken'] = $_GET['token'];
    if(isset($_SESSION['agreement_type']) && $_SESSION['agreement_type'] == "60Day"){
        header("Location: /paypal/ExecuteMemberPayment");
        exit;
    } else if(isset($_SESSION['agreement_name']) && $_SESSION['agreement_name'] == "Chapter House Rent"){
        header("Location: /paypal/ExecuteRentPayment");
        exit;
    } else {
        header("Location: /paypal/ExecutePayment");
        exit;
    }
}

if(isset($_SESSION['paymentID']) && !empty($_SESSION['paymentID'])){
    $i = rand(1,4);
    $data = explode("|", $_SESSION['donation_data']);
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
                <h6 style="margin-top:20px;">Donation Review</h6>
                <table width="100%">
                    <tr>
                        <td class="text-right"><label>Name:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities($data[5]); ?></label><br></td>
                    </tr>
                    <tr>
                        <td class="text-right"><label>Email:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities($data[6]); ?></label><br></td>
                    </tr>
                    <tr>
                        <td width="50%" class="text-right"><label>Budget:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities($data[0]); ?></label><br></td>
                    </tr>
                    <tr>
                        <td class="text-right"><label>Amount:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities($data[1]); ?></label><br></td>
                    </tr>
                    <tr>
                        <td class="text-right"><label>Recurring:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities(ucfirst($data[2])); ?></label><br></td>
                    </tr>
                    <tr>
                        <td class="text-right"><label>Affiliation:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities($data[7]); ?></label><br></td>
                    </tr>
                    <?php if(!empty($data[8])){ ?>
                    <tr>
                        <td class="text-right"><label>Chapter:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities($data[8]); ?></label><br></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($data[9])){ ?>
                    <tr>
                        <td class="text-right"><label>Money Use:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities($data[9]); ?></label></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($data[10])){ ?>
                    <tr>
                        <td class="text-right"><label>Comments:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities($data[10]); ?></label></td>
                    </tr>
                    <?php } ?>
                </table>
                <p>Though reasonable efforts will be made to use donations as designated, all donations become the Fraternity’s property and will be used at the Fraternity’s sole discretion to further the Fraternity's overall mission.  Utah Triangle is a 501c7 social club, therefore donations to Triangle Fraternity - Utah are not tax deductible.</p>
                <p><a onclick="$('.process-overlay').show();$('.proccessing').show();" href="ExecutePayment?donation=confirm" class="btn btn-sm">Confirm Donation</a></p>
                <p><a href="/index">Cancel Donation</a></p>
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