<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php
    $reject = false;
    if(isset($_GET['exec']) && !empty($_GET['exec'])){
        if(isset($_GET['approval']) && !empty($_GET['approval'])){
            if(isset($_GET['token']) && !empty($_GET['token'])){
                $transaction = find_transaction_by_token($_GET['token']);
                if($transaction){
                    if($_GET['approval'] == "approve"){
                        $date = date('Y-m-d H:i:s');
                        $safe_token = mysql_prep($_GET['token']);
                        $query  = "UPDATE transactions SET ";
                        $query .= "treasury_status = '{$date}', ";
                        $query .= "token = '' ";
                        $query .= "WHERE token = '{$safe_token}' ";
                        $query .= "LIMIT 1";
                        $result = mysqli_query($connection, $query);
                        if($result){
                            require_once("../includes/sendmail.php");
                            require_once("../includes/phpMailer/class.phpmailer.php");
                            require_once("../includes/phpMailer/class.smtp.php");
                            require_once("../includes/phpMailer/language/phpmailer.lang-en.php");
                            sendTransactionToApprove($transaction['name'], $transaction['email'], $transaction['phone'], $transaction['transation_date'], $transaction['expense'], $transaction['merchant'], $transaction['department'], $transaction['category'], $transaction['description'], $transaction['account'], $transaction['documentation']);
                            $_SESSION["success"] = "Reimbursement Approved";
                            redirect_to("/transactions");
                       } else {
                            $_SESSION["message"] = "Oh darn, we seem to have encountered an error.  Please contact info@utahtriangle.com.";
                            redirect_to("/transactions");
                        }
                    } else if($_GET['approval'] == "reject"){
                        $reject = true;
                    }
                } else {
                    $_SESSION["message"] = "Oh darn, this token no longer exists.  Please contact info@utahtriangle.com.";
                    redirect_to("/transactions");
                }
            }
        }
    }
    if(isset($_GET['approval']) && !empty($_GET['approval'])){
        if(isset($_GET['token']) && !empty($_GET['token'])){
            $transaction = find_transaction_by_token($_GET['token']);
            if($transaction){
                if($_GET['approval'] == "approve"){
                    $date = date('Y-m-d H:i:s');
                    $token = generateRandomString(50);
                    $safe_token = mysql_prep($_GET['token']);
                    $query  = "UPDATE transactions SET ";
                    $query .= "department_status = '{$date}', ";
                    $query .= "token = '{$token}' ";
                    $query .= "WHERE token = '{$safe_token}' ";
                    $query .= "LIMIT 1";
                    $result = mysqli_query($connection, $query);
                    if($result){
                        require_once("../includes/sendmail.php");
                        require_once("../includes/phpMailer/class.phpmailer.php");
                        require_once("../includes/phpMailer/class.smtp.php");
                        require_once("../includes/phpMailer/language/phpmailer.lang-en.php");
                        sendTransactionToTreasury($transaction['name'], $transaction['email'], $transaction['phone'], $transaction['transation_date'], $transaction['expense'], $transaction['merchant'], $transaction['department'], $transaction['category'], $transaction['description'], $transaction['account'], $transaction['documentation'], $token);
                        $_SESSION["success"] = "Reimbursement Approved";
                        redirect_to("/");
                   } else {
                        $_SESSION["message"] = "Oh darn, we seem to have encountered an error.  Please contact treasury@utahtriangle.com.";
                        redirect_to("/transactions");
                    }
                } else if($_GET['approval'] == "reject"){
                    $reject = true;
                }
            } else {
                $_SESSION["message"] = "Oh darn, this token no longer exists.  Please contact treasury@utahtriangle.com.";
                redirect_to("/transactions");
            }
        }
    }
    
?>
<?php login_check() ?>
<?php permission_check(5) ?>
<?php
    
    $transaction_set = find_all_transactions();
    $balance = 0;
    $current_balance = 0;
?>
<?php include("../includes/layouts/header.php") ?>
<style>
    
    th, td {
        padding: 2px 5px;
        text-align: center;
        vertical-align: middle;
        font-weight: 200;
    }
    
    th {
        background-color: #000;
        color: #fff;
        font-weight: bold;
        border-bottom: #d9d9d9 solid 3px;
    }
    
    tr:nth-child(odd){
        background-color: #efefef;
    }
    
    td, th {
        border-left: #d9d9d9 solid 1px;
    }
    td:first-child, th:first-child {
        border-left: none;
    }
    
    .expense {
        background-color:#f4cccc;
    }
    tr:nth-child(odd) .expense:nth-child(odd) {
        background-color:#ea9999;
    }
    
    .income {
        background-color:#b7e1cd;
    }
    tr:nth-child(odd) .income {
        background-color:#acd4c1;
    }
    
    .balance {
        background-color: #434343;
        font-weight: bold;
    }
    
    .positive {
        color: #00ff00;
    }
    
    .negative {
        color: #ff0000;
    }
    
    .current {
        font-weight: 100;
        color: #d9d9d9;
        font-size: 9px;
        font-style: italic;
    }
    
    .pending td {
        font-style: italic;
        font-weight: 100;
    }
    
</style>
<?php echo message() ?>
<?php include("../includes/layouts/nav.php") ?>
<section class="section">
    <div class="container">
        <div class="col-sm-12 align-center">
            <h1 style="margin-bottom:0;" class="text-grey">Chapter Transactions</h1>
            <hr style="margin:0;">
            <h4 style="margin-bottom:50px;" class="text-grey">Fall 2017</h4>
        </div>
        <div class="col-sm-12">
            <table width="100%">
                <tr>
                    <th>File Date</th>
                    <th>Transaction Date</th>
                    <th>Expense</th>
                    <th>Income</th>
                    <th>Department</th>
                    <th>Catagory</th>
                    <th>Merchant</th>
                    <th>Payer/Payee</th>
                    <th>Transaction Description</th>
                    <th>Documentation</th>
                    <th>Payment Method</th>
                    <th>Balance</th>
                </tr>
                <?php while($transaction = mysqli_fetch_assoc($transaction_set)) { ?>
                <tr class="<?php if(empty($transaction['treasury_status'])){ echo "pending"; } ?>">
                    <td class="text-bold"><?php
                        if(empty($transaction['treasury_status'])){
                            if(empty($transaction['department_status'])){
                                $exec = find_department_by_exec($transaction['department']);
                                if($exec){
                                    if($exec['exec'] == $_SESSION['google_id']){
                                        echo "<a href=\"/transactions?exec=treasury&approval=reject&token={$transaction['token']}\" style=\"color:#8a1538;text-decoration:none;\">Reject</a> &nbsp; <a href=\"/transactions?exec=treasury&approval=approve&token={$transaction['token']}\" style=\"color:#75b93f;text-decoration:none;\">Approve</a>";
                                    } else {
                                        echo "Pending Approval";
                                    }
                                } else {
                                    echo "Pending Approval";
                                }
                            } else {
                                $exec = find_department_by_exec("Treasury");
                                if($exec){
                                    if($exec['exec'] == $_SESSION['google_id']){
                                        echo "<a href=\"http://utahtriangle/transactions?exec=treasury&approval=reject&token={$transaction['token']}\" style=\"color:#8a1538;text-decoration:none;\">Reject</a> &nbsp; <a href=\"http://utahtriangle/transactions?exec=treasury&approval=approve&token={$transaction['token']}\" style=\"color:#75b93f;text-decoration:none;\">Approve</a>";
                                    } else {
                                        echo "Pending Approval";
                                    }
                                } else {
                                    echo "Pending Approval";
                                }
                            }
                        } else {
                            echo $transaction['treasury_status'];
                        }
                    ?></td>
                    <td><?php echo $transaction['transation_date']; ?></td>
                    <td class="expense"><?php if(!empty($transaction['expense'])){ echo "$" . $transaction['expense']; } ?></td>
                    <td class="income"><?php if(!empty($transaction['income'])){ echo "$" . $transaction['income']; } ?></td>
                    <td><?php echo $transaction['department']; ?></td>
                    <td><?php echo $transaction['category']; ?></td>
                    <td><?php echo $transaction['merchant']; ?></td>
                    <td><?php echo $transaction['name']; ?></td>
                    <td><?php echo $transaction['description']; ?></td>
                    <td><?php if(!empty($transaction['documentation'])){ ?><a data-modal-link="documantation" onclick="$('#doc_iframe').attr('src', '<?php echo $transaction['documentation']; ?>');">Receipt</a><?php } else { echo "-"; }
                                                                                  
                    $exec = find_department_by_exec("Treasury");
                    if($exec['exec'] == $_SESSION['google_id']){
                        echo " <a onclick=\"$('#file_{$transaction['id']}').click();$('#upload_{$transaction['id']}').show();\"><i class='fa fa-pencil'></i></a>";
                        echo "<div style='display:none'><input id='file_{$transaction['id']}' type='file' name='file'></div>";
                        echo "<div id='upload_{$transaction['id']}' style='display:none'><i class='fa fa-upload'></i></div>";
                    }
                    ?></td>
                    <td><?php
                        if($transaction['account'] == 2){
                            echo "Checkings";
                        } else if($transaction['account'] == 1){
                            echo "Venmo";
                        } else if($transaction['account'] == 3){
                            echo "Savings";
                        } else if($transaction['account'] == 4){
                            echo "PayPal";
                        } else if($transaction['account'] == 5){
                            echo "Square";
                        }
                    ?></td>
                    <td class="balance"><?php
                        $balance = $balance + $transaction['income'] - $transaction['expense'];
                        if($balance > 0){
                            echo "<span class='positive'>$" . number_format($balance, 2, '.', ',') . "</span>";
                        } else {
                            echo "<span class='negative'>$" . number_format($balance, 2, '.', ',') . "</span>";
                        }
                        if(!empty($transaction['treasury_status'])){
                            $current_balance = $current_balance + $transaction['income'] - $transaction['expense'];
                        }
                        //echo "<br><span class='current'>$" . number_format($current_balance, 2, '.', ',') . "</span>";
                    ?></td>
                </tr>
                <?php } mysqli_data_seek($transaction_set, 0); ?>
            </table>
        </div>
    </div>
</section>
<?php include("../includes/layouts/footer.php") ?>
<div class="modal-window" data-modal="documantation" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box large animated reimbursement" data-animation="zoomIn" data-duration="700">
        <iframe width="100%" height="100%" id="doc_iframe" src=""></iframe>
    </div>
</div>
<?php if($reject == true){ ?>
<a id="approval" data-modal-link="approval" style="display:none;">test</a>
<div class="modal-window" data-modal="approval" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated reimbursement" data-animation="zoomIn" data-duration="700">
        <h5 class="align-center"><span class="highlight">Reject Reimbursement</span></h5>
        
        <form action="/data?form=approval&token=<?php echo $_GET['token']; ?>" method="post" data-note="reject">
            
            <fieldset class="col-xs-12 text-center">
                <label for="reason">Reason For Rejecting Reimbursement</label>
                <textarea name="reason" id="reason"></textarea>
            </fieldset>
            
            <fieldset class="col-xs-12 text-center">
                <input type="submit" name="submit" value="submit" class="btn">
            </fieldset>
            
        </form>
    </div>
</div>
<script>$("#approval").click();</script>
<?php } ?>
</body>
</html>