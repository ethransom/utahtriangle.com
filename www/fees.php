<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php login_check() ?>
<?php permission_check(5) ?>
<?php
    
    $fee_set = find_all_fees();

?>
<?php include("../includes/layouts/header.php") ?>
<style>
    
    th {
        text-align: center;
        font-size: 24px;
        color: #44546a;
        padding: 5px;
    }
    
    table td {
        padding: 2px;
    }
    
    tr td:first-child {
        font-weight: bold;
        text-align: right;
        width: 50%;
    }
    
    .total-funds {
        color: #38761d;
        font-size: 32px;
        padding: 5px;
        text-align: center !important;
    }
    
</style>
<?php include("../includes/layouts/nav.php") ?>
<section class="section">
    <div class="container">
        <div class="col-sm-12 align-center">
            <h1 style="margin-bottom:0;" class="text-grey">Chapter Fees</h1>
            <hr style="margin:0;">
            <h4 style="margin-bottom:50px;" class="text-grey">Fees</h4>
        </div>
        <div class="col-sm-3">
            <table width="100%">
                <tr>
                    <th colspan="2">Chapter</th>
                </tr>
                <?php while($fee = mysqli_fetch_assoc($fee_set)) { if($fee['type'] == "Chapter"){ ?>
                <tr>
                    <td><?php echo $fee['fee'] ?></td>
                    <td><?php if($fee['amount'] < 0){$amount = "-$" . number_format(($fee['amount']  * -1), 2, '.', ' '); } else { $amount = "$" . number_format(($fee['amount']), 2, '.', ' '); } echo $amount; ?></td>
                </tr>
                <?php } } mysqli_data_seek($fee_set, 0); ?>
            </table>
        </div>
        <div class="col-sm-3">
            <table width="100%">
                <tr>
                    <th colspan="2">Nationals</th>
                </tr>
                <?php while($fee = mysqli_fetch_assoc($fee_set)) { if($fee['type'] == "Nationals"){ ?>
                <tr>
                    <td><?php echo $fee['fee'] ?></td>
                    <td><?php if($fee['amount'] < 0){$amount = "-$" . number_format(($fee['amount']  * -1), 2, '.', ' '); } else { $amount = "$" . number_format(($fee['amount']), 2, '.', ' '); } echo $amount; ?></td>
                </tr>
                <?php } } mysqli_data_seek($fee_set, 0); ?>
            </table>
        </div>
        <div class="col-sm-3">
            <table width="100%">
                <tr>
                    <th colspan="2">IFC</th>
                </tr>
                <?php while($fee = mysqli_fetch_assoc($fee_set)) { if($fee['type'] == "IFC"){ ?>
                <tr>
                    <td><?php echo $fee['fee'] ?></td>
                    <td><?php if($fee['amount'] < 0){$amount = "-$" . number_format(($fee['amount']  * -1), 2, '.', ' '); } else { $amount = "$" . number_format(($fee['amount']), 2, '.', ' '); } echo $amount; ?></td>
                </tr>
                <?php } } mysqli_data_seek($fee_set, 0); ?>
            </table>
        </div>
        <div class="col-sm-3">
            <table width="100%">
                <tr>
                    <th colspan="2">Donations</th>
                </tr>
                <?php while($fee = mysqli_fetch_assoc($fee_set)) { if($fee['type'] == "Donations"){ ?>
                <tr>
                    <td><?php echo $fee['fee'] ?></td>
                    <td><?php if($fee['amount'] < 0){$amount = "-$" . number_format(($fee['amount']  * -1), 2, '.', ' '); } else { $amount = "$" . number_format(($fee['amount']), 2, '.', ' '); } echo $amount; ?></td>
                </tr>
                <?php } } mysqli_data_seek($fee_set, 0); ?>
            </table>
        </div>
        <div class="col-sm-3">
            <table width="100%">
                <tr>
                    <th colspan="2">Other</th>
                </tr>
                <?php while($fee = mysqli_fetch_assoc($fee_set)) { if($fee['type'] == "Other"){ ?>
                <tr>
                    <td><?php echo $fee['fee'] ?></td>
                    <td><?php if($fee['amount'] < 0){$amount = "-$" . number_format(($fee['amount']  * -1), 2, '.', ' '); } else { $amount = "$" . number_format(($fee['amount']), 2, '.', ' '); } echo $amount; ?></td>
                </tr>
                <?php } } mysqli_data_seek($fee_set, 0); ?>
            </table>
        </div>
        <div class="col-sm-12 text-center">
            <hr style="margin:0;">
            <h4 style="margin-bottom:50px;" class="text-grey">Stats</h4>
        </div>
        <div class="col-sm-3">
            <table width="100%">
                <tr>
                    <th colspan="2">Membership Funds</th>
                </tr>
                <tr>
                    <td>Actives Members</td>
                    <td><?php
                        
                        $amount = 0;
                        while($fee = mysqli_fetch_assoc($fee_set)) {
                            if($fee['type'] == "Chapter" && $fee['fee'] == "Dues"){
                                $amount = $amount + $fee['amount'];
                            }
                            if($fee['type'] == "Nationals"){
                                if($fee['fee'] == "Active Membership"){
                                    $amount = $amount + $fee['amount'];
                                }
                                if($fee['fee'] == "Insurance Fee"){
                                    $amount = $amount + $fee['amount'];
                                }
                            }
                            if($fee['type'] == "IFC"){
                                if($fee['fee'] == "Active Membership"){
                                    $amount = $amount + $fee['amount'];
                                }
                            }
                        } mysqli_data_seek($fee_set, 0);
                        if($fee['amount'] < 0){
                            $amount = "-$" . number_format(($amount  * -1), 2, '.', ' ');
                        } else {
                            $amount = "$" . number_format($amount, 2, '.', ' ');
                        }
                        echo $amount;
                        ?></td>
                </tr>
                <tr>
                    <td>New Members</td>
                    <td><?php
                        
                        $amount = 0;
                        while($fee = mysqli_fetch_assoc($fee_set)) {
                            if($fee['type'] == "Chapter" && $fee['fee'] == "Dues"){
                                $amount = $amount + $fee['amount'];
                            }
                            if($fee['type'] == "Nationals"){
                                if($fee['fee'] == "New Membership"){
                                    $amount = $amount + $fee['amount'];
                                }
                                if($fee['fee'] == "Insurance Fee"){
                                    $amount = $amount + $fee['amount'];
                                }
                            }
                            if($fee['type'] == "IFC"){
                                if($fee['fee'] == "New Membership"){
                                    $amount = $amount + $fee['amount'];
                                }
                            }
                        } mysqli_data_seek($fee_set, 0);
                        if($fee['amount'] < 0){
                            $amount = "-$" . number_format(($amount  * -1), 2, '.', ' ');
                        } else {
                            $amount = "$" . number_format($amount, 2, '.', ' ');
                        }
                        echo $amount;
                        ?></td>
                </tr>
            </table>
        </div>
        <div class="col-sm-3">
            <table width="100%">
                <tr>
                    <th colspan="2">Chapter Funds</th>
                </tr>
                <tr>
                    <td>Actives Members</td>
                    <td><?php
                        
                        $activeCount = 0;
                        $amount = 0;
                        
                        while($fee = mysqli_fetch_assoc($fee_set)) {
                            if($fee['type'] == "Chapter" && $fee['fee'] == "Dues"){
                                $amount = $amount + $fee['amount'];
                            }
                            if($fee['type'] == "Nationals"){
                                if($fee['fee'] == "Active Membership"){
                                    $amount = $amount + $fee['amount'];
                                }
                                if($fee['fee'] == "Insurance Fee"){
                                    $amount = $amount + $fee['amount'];
                                }
                            }
                            if($fee['type'] == "IFC"){
                                if($fee['fee'] == "Active Membership"){
                                    $amount = $amount + $fee['amount'];
                                }
                            }
                            if($fee['type'] == "Member Count" && $fee['fee'] == "Active"){
                                $activeCount = $fee['amount'];
                            }
                        } mysqli_data_seek($fee_set, 0);
                        $activeCount = number_format($activeCount, 0, '', ' ');
                        $amount = $amount * $activeCount;
                        
                        if($fee['amount'] < 0){
                            $amount = "-$" . number_format(($amount  * -1), 2, '.', ',');
                        } else {
                            $amount = "$" . number_format($amount, 2, '.', ',');
                        }
                        
                        echo $amount;
                        ?></td>
                </tr>
                <tr>
                    <td>New Members</td>
                    <td><?php
                        
                        $activeCount = 0;
                        $amount = 0;
                        
                        while($fee = mysqli_fetch_assoc($fee_set)) {
                            if($fee['type'] == "Chapter" && $fee['fee'] == "Dues"){
                                $amount = $amount + $fee['amount'];
                            }
                            if($fee['type'] == "Nationals"){
                                if($fee['fee'] == "New Membership"){
                                    $amount = $amount + $fee['amount'];
                                }
                                if($fee['fee'] == "Insurance Fee"){
                                    $amount = $amount + $fee['amount'];
                                }
                            }
                            if($fee['type'] == "IFC"){
                                if($fee['fee'] == "New Membership"){
                                    $amount = $amount + $fee['amount'];
                                }
                            }
                            if($fee['type'] == "Member Count" && $fee['fee'] == "New"){
                                $activeCount = $fee['amount'];
                            }
                        } mysqli_data_seek($fee_set, 0);
                        $activeCount = number_format($activeCount, 0, '', ' ');
                        $amount = $amount * $activeCount;
                        
                        if($fee['amount'] < 0){
                            $amount = "-$" . number_format(($amount  * -1), 2, '.', ',');
                        } else {
                            $amount = "$" . number_format($amount, 2, '.', ',');
                        }
                        
                        echo $amount;
                        ?>0</td>
                </tr>
            </table>
        </div>
        <div class="col-sm-3">
            <table width="100%">
                <tr>
                    <th colspan="2">Members</th>
                </tr>
                <tr>
                    <td>Actives Members</td>
                    <td><?php
                        
                        $amount = 0;
                        while($fee = mysqli_fetch_assoc($fee_set)) {
                            if($fee['type'] == "Member Count" && $fee['fee'] == "Active"){
                                $amount = $fee['amount'];
                            }
                        } mysqli_data_seek($fee_set, 0);
                        $amount = number_format($amount, 0, '', ' ');
                        echo $amount;
                        ?></td>
                </tr>
                <tr>
                    <td>New Members</td>
                    <td><?php
                        
                        $amount = 0;
                        while($fee = mysqli_fetch_assoc($fee_set)) {
                            if($fee['type'] == "Member Count" && $fee['fee'] == "New"){
                                $amount = $fee['amount'];
                            }
                        } mysqli_data_seek($fee_set, 0);
                        $amount = number_format($amount, 0, '', ' ');
                        echo $amount;
                        ?></td>
                </tr>
            </table>
        </div>
        <div class="col-sm-3">
            <table width="100%">
                <tr>
                    <th colspan="2">Total Funds</th>
                </tr>
                <tr>
                    <td colspan="2" class="total-funds"><?php
                        
                        $newCount = 0;
                        $NewAmount = 0;
                        
                        $activeCount = 0;
                        $ActiveAmount = 0;
                        
                        $donations = 0;
                        
                        while($fee = mysqli_fetch_assoc($fee_set)) {
                            // New Amount
                            if($fee['type'] == "Chapter" && $fee['fee'] == "Dues"){
                                $NewAmount = $NewAmount + $fee['amount'];
                            }
                            if($fee['type'] == "Nationals"){
                                if($fee['fee'] == "New Membership"){
                                    $NewAmount = $NewAmount + $fee['amount'];
                                }
                                if($fee['fee'] == "Insurance Fee"){
                                    $NewAmount = $NewAmount + $fee['amount'];
                                }
                            }
                            if($fee['type'] == "IFC"){
                                if($fee['fee'] == "New Membership"){
                                    $NewAmount = $NewAmount + $fee['amount'];
                                }
                            }
                            if($fee['type'] == "Member Count" && $fee['fee'] == "New"){
                                $newCount = $fee['amount'];
                            }
                            // Active Amount
                            if($fee['type'] == "Chapter" && $fee['fee'] == "Dues"){
                                $ActiveAmount = $ActiveAmount + $fee['amount'];
                            }
                            if($fee['type'] == "Nationals"){
                                if($fee['fee'] == "Active Membership"){
                                    $ActiveAmount = $ActiveAmount + $fee['amount'];
                                }
                                if($fee['fee'] == "Insurance Fee"){
                                    $ActiveAmount = $ActiveAmount + $fee['amount'];
                                }
                            }
                            if($fee['type'] == "IFC"){
                                if($fee['fee'] == "Active Membership"){
                                    $ActiveAmount = $ActiveAmount + $fee['amount'];
                                }
                            }
                            if($fee['type'] == "Member Count" && $fee['fee'] == "Active"){
                                $activeCount = $fee['amount'];
                            }
                            
                            //Chapter Fee
                            if($fee['type'] == "Nationals" && $fee['fee'] == "Chapter Fee"){
                                $chapter_fee = $fee['amount'];
                            }
                            
                            //Donations
                            if($fee['type'] == "Donations"){
                                $donations = $donations + $fee['amount'];
                            }
                            
                        } mysqli_data_seek($fee_set, 0);
                        
                        $newCount = number_format($newCount, 0, '', ' ');
                        $NewAmount = $NewAmount * $newCount;
                        $activeCount = number_format($activeCount, 0, '', ' ');
                        $ActiveAmount = $ActiveAmount * $activeCount;
                        
                        $amount = $NewAmount + $ActiveAmount + $chapter_fee + $donations;
                        
                        if($fee['amount'] < 0){
                            $amount = "-$" . number_format(($amount  * -1), 2, '.', ',');
                        } else {
                            $amount = "$" . number_format($amount, 2, '.', ',');
                        }
                        
                        echo $amount;
                        ?></th>
                </tr>
            </table>
        </div>
    </div>
</section>
<?php include("../includes/layouts/footer.php") ?>
</body>
</html>