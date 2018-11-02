<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php login_check() ?>
<?php permission_check(5) ?>
<?php
    if(isset($_SESSION['google_id']) && !empty($_SESSION['google_id'])){
        $user = get_user_by_google_id($_SESSION['google_id']);
        if(!$user){
            $_SESSION['message'] = "Oh know! There seems to have been an error, please try again.";
            redirect_to("/member");
        }
        $user_rent = get_user_rent_by_google_id($_SESSION['google_id']);
        if(!$user_rent){
            $_SESSION['message'] = "Oh know! There seems to have been an error, please try again..";
            redirect_to("/member");
        }
        $invoice = get_invoice_by_id($user_rent['invoice_id']);
        if(!$invoice){
            $_SESSION['message'] = "Oh know! There seems to have been an error, please try again...";
            redirect_to("/member");
        }
        if(isset($_GET['pay']) && $_GET['pay'] == true){
            $_SESSION['agreement_name'] = "Chapter House Rent";
            $sku = $invoice['id'] . $user_rent['id'];
            $_SESSION['rent_id'] = $user_rent['id'];
            require("paypal/CreatePaymentUsingPayPal.php");
            $paypal = CreatePaymentUsingPayPal($sku, $_SESSION['rent_total']);
            if($paypal != false){
                redirect_to($paypal);
            }
        }
    } else {
        redirect_to("/member");
    }

    $rent_extras_set = find_all_rent_extras();

    $sub_total = $user_rent['price'];
    
?>
<?php include("../includes/layouts/header.php") ?>
<style>

    h2 {
        font-family: roboto;
        color: #990033;
        font-weight: 400;
        font-size: 20pt;
        margin: 0;
        letter-spacing: 0;
    }
    h2.invoice-title {
        font-size: 34pt;
        font-weight: bold;
    }
    h2.invoice-total {
        font-size: 20pt;
        font-weight: bold;
    }
    h2.invoice-paid {
        font-size: 28pt;
        font-weight: bold;
        color: #38761d;
    }
    h3 {
        font-family: roboto;
        color: #666666;
        font-weight: 200;
        font-size: 10pt;
        margin-bottom: 20px;
    }
    h4 {
        font-family: roboto;
        color: #4a86e8;
        font-size: 12pt;
        letter-spacing: 0;
    }
    h5 {
        font-family: roboto;
        color: #434343;
        font-size: 12pt;
        letter-spacing: 0;
        margin: 0;
    }
    p {
        font-family: roboto;
        color: #666666;
        font-size: 10pt;
        letter-spacing: 0;
        margin: 0;
    }
    
    .row {
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .invoice-table .row{
        padding: 3px;
    }
    .invoice-table .row:nth-child(even) {
        background-color: #eee;
    }
    .invoice-table .row:last-child {
        border-bottom: 1px solid #666;
    }
</style>
<?php include("../includes/layouts/nav.php") ?>

<section class="section">
    <div class="container">
        <div class="col-sm-12 align-center">
            <h1 style="margin-bottom:0;" class="text-grey">Chapter House Rent</h1>
            <hr style="margin:0;margin-bottom:50px;">
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h2>Utah Triangle Chapter</h2>
                <h3>1474 Federal Way<br>Salt Lake City, UT 84102<br>(385) 887 2370</h3>
                <?php if(!empty($user_rent['paid'])){ ?>
                <h2 class="invoice-title text-green">Receipt</h2>
                <h4>Received on <?php
                    $date_split = explode("-", $user_rent['paid']);
                    echo $date_split[1] . "/" . $date_split[2] . "/" . $date_split[0];
                    ?></h4>
                <?php } else { ?>
                <h2 class="invoice-title">Invoice</h2>
                <h4>Submitted on <?php
                    $full_date_split = explode(" ", $invoice['date']);
                    $date_split = explode("-", $full_date_split[0]);
                    echo $date_split[1] . "/" . $date_split[2] . "/" . $date_split[0];
                    ?></h4>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-sm-offset-2">
                <?php if(!empty($user_rent['paid'])){ ?>
                <h5>Receipt for</h5>
                <?php } else { ?>
                <h5>Invoice for</h5>
                <?php } ?>
                <p><?php echo htmlentities($user['name']); ?></p>
                <p><?php echo htmlentities($user['email']); ?></p>
            </div>
            <div class="col-sm-2">
                <?php if(!empty($user_rent['paid'])){ ?>
                <h5>Paid to</h5>
                <?php } else { ?>
                <h5>Payable to</h5>
                <?php } ?>
                <p>Utah Triangle</p>
                <br>
                <h5>Term</h5>
                <p><?php
                    
                    $due_date = $invoice['due_date'];
                    $date_split = explode("/", $due_date);
                    $month = $date_split[0];
                    $year = $date_split[2];
                    if($month>=1 && $month<=5){
                        echo "Spring";
                    } else if($month>=6 && $month<=8){
                        echo "Summer";
                    } else if($month>=9 && $month<=12){
                        echo "Fall";
                    }
                    echo " " . $year;
                    ?></p>
            </div>
            <div class="col-sm-2">
                <h5>Invoice #</h5>
                <p><?php echo $invoice['id'] . $user['id']; ?></p>
                <br>
                <h5>Due date</h5>
                <?php if(!empty($user_rent['paid'])){ ?>
                <p class="text-bold text-green">Paid!</p>
                <?php } else { ?>
                <p class="text-bold text-rose"><?php echo $due_date ?></p>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <hr style="margin:0;margin-bottom:50px;">
            </div>
        </div>
        <div class="row" style="margin-bottom:0;">
            <div class="col-sm-8 col-sm-offset-2 invoice-table">
                <div class="row">
                    <div class="col-xs-6">
                        <h5 class="text-rose">Description</h5>
                    </div>
                    <div class="col-xs-2">
                        <h5 class="text-rose">Qt.</h5>
                    </div>
                    <div class="col-xs-2">
                        <h5 class="text-rose text-right">Unit Price</h5>
                    </div>
                    <div class="col-xs-2">
                        <h5 class="text-rose text-right">Total Price</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <p>Rent (<?php echo htmlentities($user_rent['name']); ?>)</p>
                    </div>
                    <div class="col-xs-2">
                        <p>1</p>
                    </div>
                    <div class="col-xs-2">
                        <p class="text-right">$<?php echo htmlentities($user_rent['price']); ?></p>
                    </div>
                    <div class="col-xs-2">
                        <p class="text-right">$<?php echo htmlentities($user_rent['price']); ?></p>
                    </div>
                </div>
                <?php while($rent_extra = mysqli_fetch_assoc($rent_extras_set)) {
                $sub_total = $sub_total + $rent_extra['price']; 
                ?>
                <div class="row">
                    <div class="col-xs-6">
                        <p><?php echo htmlentities($rent_extra['name']); ?></p>
                    </div>
                    <div class="col-xs-2">
                        <p>1</p>
                    </div>
                    <div class="col-xs-2">
                        <p class="text-right">$<?php echo htmlentities($rent_extra['price']); ?></p>
                    </div>
                    <div class="col-xs-2">
                        <p class="text-right">$<?php echo htmlentities($rent_extra['price']); ?></p>
                    </div>
                </div>
                <?php } mysqli_data_seek($rent_extras_set, 0); ?>
                <div class="row">
                    <div class="col-xs-6">
                        <p>Convenience Fee</p>
                    </div>
                    <div class="col-xs-2">
                        <p>1</p>
                    </div>
                    <div class="col-xs-2">
                        <p class="text-right">$<?php echo number_format(($sub_total * 0.028) + 0.30, 2, '.', ''); ?></p>
                    </div>
                    <div class="col-xs-2">
                        <p class="text-right">$<?php echo number_format(($sub_total * 0.028) + 0.30, 2, '.', ''); ?></p>
                    </div>
                    <?php $sub_total = $sub_total + ($sub_total * 0.028) + 0.30; $sub_total = number_format(($sub_total), 2, '.', '') ?>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:0;">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="col-xs-1">
                        <p>Notes:</p>
                    </div>
                    <div class="col-xs-7">
                        <p></p>
                    </div>
                    <div class="col-xs-2">
                        <p class="text-rose text-right" style="margin:3px 0;">Subtotal</p>
                        <p class=" text-green text-right" style="margin:3px 0;">Adjustments</p>
                    </div>
                    <div class="col-xs-2">
                        <p class="text-bold text-right" style="margin:3px 0;">$<?php echo $sub_total ?></p>
                        <p class="text-bold text-green text-right" style="margin:3px 0;">-$<?php
                            if(!empty($user_rent['paid'])){
                                echo $sub_total;
                            } else {
                                echo htmlentities($user_rent['adjust']);
                            }
                        ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-8 text-right">
                        <?php if(!empty($user_rent['paid'])){ ?>
                        <h2 class="invoice-total text-right">$0.00</h2>
                        <?php } else { ?>
                        <h2 class="invoice-total text-right">$<?php echo $sub_total - $user_rent['adjust']; $_SESSION['rent_total'] = $sub_total - $user_rent['adjust']; ?></h2>
                        <?php } ?>
                        <br>
                        <?php if(!empty($user_rent['paid'])){ ?>
                            <h2 class="invoice-paid">Paid!</h2>
                        <?php } else { ?>
                        <a href="rent?pay=true" class="btn btn-sm" style="margin:0; margin-top:5px;">Pay Rent</a><br>
                        <img src="/assets/img/pay-secu.png" style="height:40px; margin-top:5px;">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("../includes/layouts/footer.php") ?>
</body>
</html>