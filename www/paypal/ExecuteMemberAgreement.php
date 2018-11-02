<?php require_once("../../includes/session.php"); ?>
<?php

require __DIR__ . '/../../bootstrap.php';

if(time() > $_SESSION['sessionEnd']){
    $_SESSION['message'] = "Session timed out, please try again.";
    header("Location: /index");
    exit;
}

if (isset($_GET['agreement']) && $_GET['agreement'] == 'confirm') {
    $token = $_SESSION['token'];
    $agreement = new \PayPal\Api\Agreement();
    $agreement->execute($token, $apiContext);
    if($agreement){
        $_SESSION['agreement'] = true;
        header("Location: /data?agreement=success");
        exit;
    } else {
        $_SESSION['message'] = "We were unable to process your payment, please try again.  If you continue having issues please contact us at info@utahtriangle.com.";
        header("Location: /index");
        exit;
    }
}

if(isset($_SESSION['token']) && !empty($_SESSION['token'])){
    $i = rand(1,4);
    $agreement_type = $_SESSION['agreement_type'];
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
                <h6 style="margin-top:20px;">Agreement Review</h6>
                <table width="100%">
                    <tr>
                        <td class="text-right" width="50%"><label>Name:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities($_SESSION['legal_name']); ?></label><br></td>
                    </tr>
                    <tr>
                        <td class="text-right"><label>Email:</label></td>
                        <td class="text-left"><label class="text-rose"><?php echo htmlentities($_SESSION['email']); ?></label><br></td>
                    </tr>
                    <tr>
                        <td class="text-right"><label>Amount:</label></td>
                        <td class="text-left"><label class="text-rose">$450</label><br></td>
                    </tr>
                </table>
                <?php if($agreement_type == "60Day"){ ?>
                <?php } else { ?>
                <p style="margin-bottom:0" class="text-rose">You will be charged an amount of $116.25 once a month ($112.5 + $3.75 fee), starting today, for the next 4 months.</p>
                <?php } ?>
                <p>This is an agreement with Triangle Fraternity - Utah. I hereby acknowledge and agree that payments made are NON-REFUNDABLE.  Utah Triangle is a 501c7 social club, therefore donations to Triangle Fraternity - Utah are not tax deductible.</p>
                <p><a onclick="$('.process-overlay').show();$('.proccessing').show();" href="ExecuteMemberAgreement?agreement=confirm" class="btn btn-sm">Confirm Agreement</a></p>
                <p><a href="/member">Cancel Agreement</a></p>
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
