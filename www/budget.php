<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php login_check() ?>
<?php permission_check(5) ?>
<?php

    $department_set = find_all_departments();
    $budget_set = find_all_budgets();
    $budget_set2 = find_all_budgets();
    $fee_set = find_all_fees();
    $transaction_set = find_all_transactions();
    $transaction_set2 = find_all_transactions();

    while($departments = mysqli_fetch_assoc($department_set)) {
        if($departments['department'] == "President"){ $President = $departments['exec']; }
        if($departments['department'] == "Vice President"){ $VicePresident = $departments['exec']; }
        if($departments['department'] == "Treasury"){ $Treasury = $departments['exec']; }
        if($departments['department'] == "Administration"){ $Administration = $departments['exec']; }
        if($departments['department'] == "Internal"){ $Internal = $departments['exec']; }
        if($departments['department'] == "External"){ $External = $departments['exec']; }
        if($departments['department'] == "Recruitment"){ $Recruitment = $departments['exec']; }
    } mysqli_data_seek($department_set, 0);

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

    $master_amount = $amount;
?>
<?php include("../includes/layouts/header.php") ?>
<style type="text/css">
    th, td {
        padding: 5px;
    }
    
    .table-header th{
        text-align: center;
        font-size: 24px;
        color: rgb(68, 84, 106);
    }
    
    .table-sub-header th{
        text-align: center;
        font-size: 18px;
        color: rgb(68, 84, 106);
        border-bottom: rgb(68, 84, 106) solid 1px;
    }
    
    .table-department td {
        font-weight: bold;
        font-size: 18px;
    }
    
    .table-category td {
        padding: 2px 5px;
    }
    
    .table-department.President td { color: #38761d; }
    .table-department.Vice.President td { color: #1155cc; }
    .table-department.Formal td { color: #134f5c; }
    .table-department.Treasury td { color: #bf9000; }
    .table-department.Administration td { color: #a61c00; }
    .table-department.Internal td { color: #351c75; }
    .table-department.External td { color: #134f5c; }
    .table-department.Recruitment td { color: #38761d; }
    .table-department.Chapter td { color: #85200c; }
    
    .text-right {
        text-align: right !important;
    }
    
    .master-budget {
        font-size: 24px;
        color: #38761d;
        font-weight: bold;
    }
    
    .set-amount {
        border: #44546a dashed 1px;
        padding: 5px;
        height: 52px;
        background-color: #d8d8d8;
    }
    
    .percent_warning {
        border: #E5C300 dashed 1px;
        padding: 5px;
        height: 52px;
        background-color: #fce8b2;
    }
    
    .percent_error {
        border: #8a1538 dashed 1px;
        padding: 5px;
        height: 52px;
        background-color: #f4c7c3;
    }
    
    .percent_good {
        border: #38761d dashed 1px;
        padding: 5px;
        height: 52px;
        background-color: #d9ead3;
    }
    
    .error-box{
        border: #8a1538 solid 1px;
        background-color: #f4c7c3;
        color: #8a1538;
        padding: 15px;
    }
    
    .discharge {
        background-color: #f4c7c3;
        color: #980000 !important;
    }
    .discharge.top { border-top: 1px dashed #980000; }
    .discharge.left { border-left: 1px dashed #980000; }
    .discharge.right { border-right: 1px dashed #980000; }
    .discharge.bottom { border-bottom: 1px dashed #980000; }
    
    .defend {
        background-color: #d9ead3;
        color: #274e13 !important;
    }
    .defend.top { border-top: 1px dashed #274e13; }
    .defend.left { border-left: 1px dashed #274e13; }
    .defend.right { border-right: 1px dashed #274e13; }
    .defend.bottom { border-bottom: 1px dashed #274e13; }
    
</style>
<?php include("../includes/layouts/nav.php") ?>
<section class="section">
    <div class="container">
        <div class="col-sm-12 align-center">
            <h1 style="margin-bottom:0;" class="text-grey">Chapter Budget</h1>
            <hr style="margin:0;">
            <h4 style="margin-bottom:50px;" class="text-grey">Fall 2017</h4>
        </div>
        <div class="col-sm-10 col-sm-offset-1 align-center">
            <table width="100%">
                <tr class="table-header">
                    <th></th>
                    <th colspan="2">Resources</th>
                    <th colspan="2">Discharged</th>
                    <th colspan="2">Defended</th>
                </tr>
                <tr class="table-sub-header">
                    <th class="text-right">Department</th>
                    <th>Percent</th>
                    <th>Amount</th>
                    <th class="discharge left top">Amount</th>
                    <th class="discharge right top">Percent</th>
                    <th class="defend left top">Amount</th>
                    <th class="defend right top">Percent</th>
                </tr>
                <?php
                $master_set_amount = 0;
                while($departments = mysqli_fetch_assoc($department_set)) {
                    if($departments['type'] == 0){
                        $master_set_amount = $master_set_amount + $departments['amount'];
                    }
                } mysqli_data_seek($department_set, 0);
                while($departments = mysqli_fetch_assoc($department_set)) {
                $master_total = (($master_amount - $master_set_amount) * ($departments['amount'] / 100));
                $master_total_text = "$" . number_format($master_total, 2, '.', ',');
                ?>
                <tr class="table-department <?php echo $departments['department']; ?>">
                    <td class="text-right"><?php echo $departments['department']; ?></td>
                    <td><?php if($departments['type'] == 0){ echo "-"; } else { echo $departments['amount'] . "%"; } ?></td>
                    <td><?php if($departments['type'] == 0){ $master_total = $departments['amount']; echo "$" . $departments['amount']; } else { echo $master_total_text; } ?></td>
                    <td class="discharge left"><?php
                        $expense_master = 0;
                        while($transaction = mysqli_fetch_assoc($transaction_set)) {
                            if($transaction['department'] == $departments['department']){
                                $expense_master += $transaction['expense'];
                            }
                        } mysqli_data_seek($transaction_set, 0);
                        echo "$" . number_format($expense_master, 2, '.', ',');
                    ?></td>
                    <td class="discharge right"><?php if($master_total != 0){ $percent_add = ($expense_master / $master_total) * 100; echo number_format($percent_add, 2, '.', ' ') . "%" ; } else { echo "0.00%"; } ?></td>
                    <td class="defend left"><?php $income_master = $master_total - $expense_master; echo "$" . number_format($income_master, 2, '.', ','); ?></td>
                    <td class="defend right"><?php if($master_total != 0){ echo number_format((($income_master / $master_total) * 100), 2, '.', ',') . "%"; } else { echo "0.00%"; } ?></td>
                </tr>
                <?php
                while($budget = mysqli_fetch_assoc($budget_set)) {
                if($budget['department'] == $departments['department']){
                    $set_amount = 0;
                    while($budget2 = mysqli_fetch_assoc($budget_set2)) {
                        if($budget2['department'] == $departments['department']){
                            if($budget2['type'] == 0){
                                $set_amount = $set_amount + $budget2['amount'];
                            }
                        }
                    } mysqli_data_seek($budget_set2, 0);
                    $total = (($master_total - $set_amount) * ($budget['amount'] / 100));
                    $total_text = "$" . number_format($total, 2, '.', ',');
                ?>
                <tr class="table-category <?php echo $budget['category']; ?>">
                    <td class="text-right"><?php echo $budget['category']; ?></td>
                    <td><?php if($budget['type'] == 0){ echo "-"; } else { echo $budget['amount'] . "%"; } ?></td>
                    <td><?php if($budget['type'] == 0){ $total = $budget['amount']; echo "$" . $budget['amount']; } else { echo $total_text; } ?></td>
                    <td class="discharge left"><?php
                        $expense = 0;
                        while($transaction = mysqli_fetch_assoc($transaction_set)) {
                            if($transaction['department'] == $budget['department']){
                                if($transaction['category'] == $budget['category']){
                                    $expense += $transaction['expense'];
                                }
                            }
                        } mysqli_data_seek($transaction_set, 0);
                        echo "$" . number_format($expense, 2, '.', ',');
                    ?></td>
                    <td class="discharge right"><?php if($total != 0){ $percent_add = ($expense / $total) * 100; echo number_format($percent_add, 2, '.', ' ') . "%" ; } else { echo "0.00%"; } ?></td>
                    <td class="defend left"><?php $income = $total - $expense; echo "$" . number_format($income, 2, '.', ','); ?></td>
                    <td class="defend right"><?php if($total != 0){ echo number_format((($income / $total) * 100), 2, '.', ',') . "%"; } else { echo "0.00%"; } ?></td>
                </tr>
                
                <?php } } mysqli_data_seek($budget_set, 0); ?>
                <?php if($_SESSION['google_id'] == $departments['exec'] || $_SESSION['google_id'] == $Treasury){ ?>
                <tr>
                    <td class="text-right"><a data-modal-link="<?php echo $departments['id']; ?>">Edit Budget</a></td>
                    <td></td>
                    <td></td>
                    <td class="discharge left"></td>
                    <td class="discharge right"></td>
                    <td class="defend left"></td>
                    <td class="defend right"></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="discharge left">&nbsp;</td>
                    <td class="discharge right">&nbsp;</td>
                    <td class="defend left">&nbsp;</td>
                    <td class="defend right">&nbsp;</td>
                </tr>
                <?php } mysqli_data_seek($department_set, 0); ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="discharge left bottom"></td>
                    <td class="discharge right bottom"></td>
                    <td class="defend left bottom"></td>
                    <td class="defend right bottom"></td>
                </tr>
                <?php if($_SESSION['google_id'] == $Treasury){ ?>
                <tr>
                    <td class="text-right"><a data-modal-link="MasterBudget">Edit Master Budget</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</section>
<?php include("../includes/layouts/footer.php") ?>
<?php if($_SESSION['google_id'] == $Treasury){ ?>
<div class="modal-window" data-modal="MasterBudget" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box medium animated reimbursement" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight">Master Budget</span></h5>
        
        <h5 class="text-green text-center"><?php
    
                        if($fee['amount'] < 0){
                            $amount = "-$" . number_format(($master_amount  * -1), 2, '.', ',');
                        } else {
                            $amount = "$" . number_format($master_amount, 2, '.', ',');
                        }
                        
                        echo $amount;
                        ?></h5>
        
       <div class="row">
            <fieldset class="col-xs-4 text-center">
                <label>Department</label>
            </fieldset>
            <fieldset class="col-xs-3 text-center">
                <label>Type</label>
            </fieldset>
            <fieldset class="col-xs-3 text-center">
                <label>Amount</label>
            </fieldset>
            <fieldset class="col-xs-2">
                <label>Total</label>
            </fieldset>
        </div>
        
        <?php 
            $category_set = array();
            $type_set = array();
            $amount_set = array();
            $total_set = array();
            while($department = mysqli_fetch_assoc($department_set)) {
            ?>
       <div class="row">
           <div id="row_<?php echo $department['id'] ?>" class="<?php if($department['type'] == 0){ echo "set-amount"; } ?>">
                <fieldset class="col-xs-4" style="padding:11px;">
                    <?php echo $department['department']; ?>
                </fieldset>
                <fieldset class="col-xs-3">
                    <select id="type_<?php echo $department['id'] ?>" input-id="<?php echo $department['id']; ?>">
                        <option value="1" data-id="<?php echo $department['id'] ?>" data-type="master budget current remove" <?php if($department['type'] == 1){ echo "selected"; } ?>>Percentage (%)</option>
                        <option value="0" data-id="<?php echo $department['id'] ?>" data-type="master budget current add" <?php if($department['type'] == 0){ echo "selected"; } ?>>Set Amount ($)</option>
                    </select>
                </fieldset>
                <fieldset class="col-xs-3">
                    <input id="amount_<?php echo $department['id'] ?>" type="text" value="<?php echo $department['amount'] ?>" class="intOnly masterReCount">
                </fieldset>
                <fieldset class="col-xs-2">
                    <div id="total_<?php echo $department['id'] ?>" class="master-budget" style="padding: 11px;"></div>
                </fieldset>
           </div>
        </div>
        <?php
        array_push($category_set, "{$department['id']}");
        array_push($type_set, "type_{$department['id']}");
        array_push($amount_set, "amount_{$department['id']}");
                
        }  mysqli_data_seek($department_set, 0); ?>
        <fieldset class="col-xs-12 text-center">
            <input id="master_submit" name="master_submit" type="button" value="Update Budget" class="btn">
            <div id="error" class="error-box" style="display:none;"></div>
        </fieldset>
    </div>
</div>
<script>
    $("#master_submit").click(function(){
        var IDs = "";
        var post_type = "";
        var categories = "";
        var types = "";
        var amounts = "";
        <?php 
        $i = 0; 
        foreach($category_set as &$value){
            if($i == 0){
                echo "categories = '{$value}';\n";
                echo "types = $('#type_{$value}').val();\n";
                echo "amounts = $('#amount_{$value}').val();\n";
            } else {
                echo "categories = categories + '|' + '{$value}';\n";
                echo "types = types + '|' +$('#type_{$value}').val();\n";
                echo "amounts = amounts + '|' +$('#amount_{$value}').val();\n";
            }
            $i++;
        }
        ?>
        $.post("/data",
        {
            dataID: "Master Budget Update",
            departmentIDs: categories,
            types: types,
            amounts: amounts
        },
        function(data, status){
            //console.log("Data: " + data + "\nStatus: " + status);
            //alert("Data: " + data + "\nStatus: " + status);
            //$("#message").html("Data: " + data + "<br>Status: " + status)
            if(data == "ok"){
                location.reload();
            }
        });
    });
    
    masterReCount();
    $(".masterReCount").on("keyup", function(){
        masterReCount();
    });

    function masterReCount() {
        var department_total = <?php echo $master_amount ?>;
        var set_amount = 0;
        var set_percent = 0;
        var category_set = 0;
        var master_total = 0;
        var error = false;
        <?php while($department = mysqli_fetch_assoc($department_set)) { ?>
        
        if (document.getElementById('type_<?php echo $department['id'] ?>').value == 0) {
            set_amount = set_amount + Number($('#amount_<?php echo $department['id'] ?>').val());
        } else {
            set_percent = set_percent + Number($('#amount_<?php echo $department['id'] ?>').val());
        }
        
        <?php }  mysqli_data_seek($department_set, 0); ?>
        <?php while($department = mysqli_fetch_assoc($department_set)) { ?>
        
        if (document.getElementById('type_<?php echo $department['id'] ?>').value == 0) {
            var total = Number($('#amount_<?php echo $department['id'] ?>').val());
        } else {
            var total = Number(department_total - set_amount) * (Number($('#amount_<?php echo $department['id'] ?>').val()) / 100);
            $('#row_<?php echo $department['id'] ?>').removeClass('percent_good');
            $('#row_<?php echo $department['id'] ?>').removeClass('percent_warning');
            $('#row_<?php echo $department['id'] ?>').removeClass('percent_error');
            if (set_percent == 100) {
                $('#row_<?php echo $department['id'] ?>').addClass('percent_good');
            } else if (set_percent < 100) {
                $('#row_<?php echo $department['id'] ?>').addClass('percent_warning');
                $('#error').text('Percentages must add up to 100%.  Current percentage: ' + set_percent + '%');
                error = true;
            } else if (set_percent > 100) {
                $('#row_<?php echo $department['id'] ?>').addClass('percent_error');
                $('#error').text('Percentages must add up to 100%.  Current percentage: ' + set_percent + '%');
                error = true;
            }
        }
        master_total = master_total + total;
        $('#total_<?php echo $department['id'] ?>').text('$' + total.toFixed(2));
        
        <?php }  mysqli_data_seek($department_set, 0); ?>
        
        if (master_total > department_total) {
            $('#master_submit').hide();
            error = true;
            $('#error').text('You are over the master budget.  Please adjust your budget.');
        }

        if (error == true) {
            $('#error').show();
            $('#master_submit').hide();
        } else {
            $('#error').hide();
            $('#master_submit').show();
        }
    }
</script>
<?php } ?>

<?php while($departments = mysqli_fetch_assoc($department_set)) {
if($_SESSION['google_id'] == $departments['exec'] || $_SESSION['google_id'] == $Treasury){
?>
<div class="modal-window" data-modal="<?php echo $departments['id']; ?>" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box medium animated reimbursement" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight"><?php echo $departments['department']; ?></span></h5>
        
        <h6 class="text-center">Master Budget</h6>
        <div class="col-xs-12 master-budget text-center" style="margin-bottom:20px;">$<?php
                if($departments['type'] == 0){
                    $department_total = $departments['amount'];
                    echo $department_total;
                } else {
                    $set_amount = 0;
                    $department_total = (($master_amount - $master_set_amount) * ($departments['amount'] / 100));
                    $total = number_format($department_total, 2, '.', ',');
                    echo $total;
                }
            ?></div>

        <h6 class="text-center">Budget</h6>
       <div class="row">
            <fieldset class="col-xs-4 text-center">
                <label>Category</label>
            </fieldset>
            <fieldset class="col-xs-3 text-center">
                <label>Type</label>
            </fieldset>
            <fieldset class="col-xs-3 text-center">
                <label>Amount</label>
            </fieldset>
            <fieldset class="col-xs-2">
                <label>Total</label>
            </fieldset>
        </div>

      <?php 
            $category_set = array();
            $type_set = array();
            $amount_set = array();
            $total_set = array();
            while($budget = mysqli_fetch_assoc($budget_set)) {
            if($budget['department'] == $departments['department']){
            ?>
       <div class="row">
           <div id="row_<?php echo $departments['id'] ?>_current_<?php echo $budget['id'] ?>" class="<?php if($budget['type'] == 0){ echo "set-amount"; } ?>">
                <fieldset class="col-xs-4">
                    <input id="category_<?php echo $departments['id'] ?>_current_<?php echo $budget['id'] ?>" type="text" value="<?php echo $budget['category']; ?>" class="reCount<?php echo $departments['id'] ?>">
                </fieldset>
                <fieldset class="col-xs-3">
                    <select id="type_<?php echo $departments['id'] ?>_current_<?php echo $budget['id'] ?>" input-id="<?php echo $budget['id']; ?>">
                        <option value="1" data-id="<?php echo $budget['id'] ?>" budget-id="<?php echo $departments['id'] ?>" data-type="budget current remove" <?php if($budget['type'] == 1){ echo "selected"; } ?>>Percentage (%)</option>
                        <option value="0" data-id="<?php echo $budget['id'] ?>" budget-id="<?php echo $departments['id'] ?>" data-type="budget current add" <?php if($budget['type'] == 0){ echo "selected"; } ?>>Set Amount ($)</option>
                    </select>
                </fieldset>
                <fieldset class="col-xs-3">
                    <input id="amount_<?php echo $departments['id'] ?>_current_<?php echo $budget['id'] ?>" type="text" value="<?php echo $budget['amount'] ?>" class="intOnly reCount<?php echo $departments['id'] ?>">
                </fieldset>
                <fieldset class="col-xs-2">
                    <div id="total_<?php echo $departments['id'] ?>_current_<?php echo $budget['id'] ?>" class="master-budget" style="padding: 11px;"></div>
                </fieldset>
           </div>
        </div>
        <?php

            array_push($category_set, "category_{$departments['id']}_current_{$budget['id']}");
            array_push($type_set, "type_{$departments['id']}_current_{$budget['id']}");
            array_push($amount_set, "amount_{$departments['id']}_current_{$budget['id']}");
            array_push($total_set, "total_{$departments['id']}_current_{$budget['id']}");

            } } mysqli_data_seek($budget_set, 0); ?>
        <?php for($i=1; $i <= 5; $i++){ ?>
       <div class="row">
           <div id="row_<?php echo $departments['id'] ?>_new_<?php echo $i ?>">
                <fieldset class="col-xs-4">
                    <input id="category_<?php echo $departments['id'] ?>_new_<?php echo $i ?>" name="category_add_<?php echo $i ?>" type="text" value="" class="reCount<?php echo $departments['id'] ?>">
                </fieldset>
                <fieldset class="col-xs-3">
                    <select id="type_<?php echo $departments['id'] ?>_new_<?php echo $i ?>" name="category_add_<?php echo $i ?>">
                        <option  value="1" data-id="<?php echo $i ?>" budget-id="<?php echo $departments['id'] ?>" data-type="budget new remove">Percentage (%)</option>
                        <option value="0" data-id="<?php echo $i ?>" budget-id="<?php echo $departments['id'] ?>" data-type="budget new add">Set Amount ($)</option>
                    </select>
                </fieldset>
                <fieldset class="col-xs-3">
                    <input id="amount_<?php echo $departments['id'] ?>_new_<?php echo $i ?>" name="category_add_<?php echo $i ?>" type="text" value="" class="intOnly reCount<?php echo $departments['id'] ?>">
                </fieldset>
                <fieldset class="col-xs-2">
                    <div id="total_<?php echo $departments['id'] ?>_new_<?php echo $i ?>" class="master-budget" style="padding: 11px;">$0</div>
                </fieldset>
           </div>
        </div>
        <?php 
            array_push($category_set, "category_{$departments['id']}_new_{$i}");
            array_push($type_set, "type_{$departments['id']}_new_{$i}");
            array_push($amount_set, "amount_{$departments['id']}_new_{$i}");
            array_push($total_set, "total_{$departments['id']}_new_{$i}");
        }  ?>
        <fieldset class="col-xs-12 text-center">
            <input id="submit_<?php echo $departments['id'] ?>" name="submit" type="button" value="Update Budget" class="btn">
            <div id="error_<?php echo $departments['id'] ?>" class="error-box" style="display:none;"></div>
        </fieldset>

        <script type="text/javascript">
            
            $("#submit_<?php echo $departments['id'] ?>").click(function(){
                var IDs = "";
                var post_type = "";
                var categories = "";
                var types = "";
                var amounts = "";
                <?php 
                $i = 0; 
                foreach($category_set as &$value){
                    $tag = explode("_", $value);
                    if($i == 0){
                        echo "IDs = '{$tag[3]}';\n";
                        echo "post_type = '{$tag[2]}';\n";
                        echo "categories = $('#category_{$tag[1]}_{$tag[2]}_{$tag[3]}').val();\n";
                        echo "types = $('#type_{$tag[1]}_{$tag[2]}_{$tag[3]}').val();\n";
                        echo "amounts = $('#amount_{$tag[1]}_{$tag[2]}_{$tag[3]}').val();\n";
                    } else {
                        echo "IDs = IDs + '|' + '{$tag[3]}';\n";
                        echo "post_type = post_type + '|' + '{$tag[2]}';\n";
                        echo "categories = categories + '|' +$('#category_{$tag[1]}_{$tag[2]}_{$tag[3]}').val();\n";
                        echo "types = types + '|' +$('#type_{$tag[1]}_{$tag[2]}_{$tag[3]}').val();\n";
                        echo "amounts = amounts + '|' +$('#amount_{$tag[1]}_{$tag[2]}_{$tag[3]}').val();\n";
                    }
                    $i++;
                }
                ?>
                $.post("/data",
                {
                    dataID: "Budget Update",
                    department:  "<?php echo $departments['department']; ?>",
                    IDs:  IDs,
                    post_type: post_type,
                    categories: categories,
                    types: types,
                    amounts: amounts
                },
                function(data, status){
                    //console.log("Data: " + data + "\nStatus: " + status);
                    //alert("Data: " + data + "\nStatus: " + status);
                    //$("#message").html("Data: " + data + "<br>Status: " + status)
                    if(data == "ok"){
                        location.reload();
                    }
                });
            });
            
            reCount<?php echo $departments['id'] ?>();
            $(".reCount<?php echo $departments['id'] ?>").on("keyup", function(){
                reCount<?php echo $departments['id'] ?>();
            });
            
            function reCount<?php echo $departments['id'] ?>() {
                var department_total = <?php echo $department_total ?>;
                var set_amount = 0;
                var set_percent = 0;
                var category_set = 0;
                var master_total = 0;
                var error = false;

                <?php                                                                 
                foreach($category_set as &$value){
                    $tag = explode("_", $value);
                    echo "if(document.getElementById('category_{$tag[1]}_{$tag[2]}_{$tag[3]}').value != ''){ ";
                    echo "category_set++;";
                    echo "$('#amount_{$tag[1]}_{$tag[2]}_{$tag[3]}').prop('disabled', false);";
                    echo " } else { ";
                    echo "$('#amount_{$tag[1]}_{$tag[2]}_{$tag[3]}').val('');";
                    echo "$('#amount_{$tag[1]}_{$tag[2]}_{$tag[3]}').prop('disabled', true);";
                    echo " }\n";
                }

                foreach($type_set as &$value){
                    $tag = explode("_", $value);
                    echo "if(document.getElementById('type_{$tag[1]}_{$tag[2]}_{$tag[3]}').value == 0){ ";
                    echo "set_amount = set_amount + Number($('#amount_{$tag[1]}_{$tag[2]}_{$tag[3]}').val());";
                    echo " } else { ";
                    echo "set_percent = set_percent + Number($('#amount_{$tag[1]}_{$tag[2]}_{$tag[3]}').val());";
                    echo " }\n";
                }

                foreach($total_set as &$value){
                    $tag = explode("_", $value);
                    echo "if(document.getElementById('type_{$tag[1]}_{$tag[2]}_{$tag[3]}').value == 0){ ";
                    echo "var total = Number($('#amount_{$tag[1]}_{$tag[2]}_{$tag[3]}').val());";
                    echo " } else { ";
                    echo "var total = Number(department_total - set_amount) * (Number($('#amount_{$tag[1]}_{$tag[2]}_{$tag[3]}').val()) / 100);";

                    echo "$('#row_{$tag[1]}_{$tag[2]}_{$tag[3]}').removeClass('percent_good');";
                    echo "$('#row_{$tag[1]}_{$tag[2]}_{$tag[3]}').removeClass('percent_warning');";
                    echo "$('#row_{$tag[1]}_{$tag[2]}_{$tag[3]}').removeClass('percent_error');";

                    echo "if(document.getElementById('category_{$tag[1]}_{$tag[2]}_{$tag[3]}').value != ''){ ";
                    echo "if(set_percent == 100){ ";
                    echo "$('#row_{$tag[1]}_{$tag[2]}_{$tag[3]}').addClass('percent_good');";
                    echo " } else if(set_percent < 100){ ";
                    echo "$('#row_{$tag[1]}_{$tag[2]}_{$tag[3]}').addClass('percent_warning');";
                    echo "$('#error_{$tag[1]}').text('Percentages must add up to 100%.  Current percentage: ' + set_percent + '%');";
                    echo "error = true;";
                    echo " } else if(set_percent > 100){ ";
                    echo "$('#row_{$tag[1]}_{$tag[2]}_{$tag[3]}').addClass('percent_error');";
                    echo "$('#error_{$tag[1]}').text('Percentages must add up to 100%.  Current percentage: ' + set_percent + '%');";
                    echo "error = true;";
                    echo " }";
                    echo " }";
                    echo " }\n";
                    echo "master_total = master_total + total;\n";
                    echo "$('#{$value}').text('$'+total.toFixed(2));\n";
                }
                ?>
                if(category_set == 0){
                    $('#submit_<?php echo $departments['id'] ?>').hide();
                    error = true;
                    $('#error_<?php echo $departments['id'] ?>').text('Please fill out the above budget.');
                }
                if(master_total > department_total){
                    $('#submit_<?php echo $departments['id'] ?>').hide();
                    error = true;
                    $('#error_<?php echo $departments['id'] ?>').text('You are over the master budget.  Please adjust your budget.');
                }

                if(error == true){
                    $('#error_<?php echo $departments['id'] ?>').show();
                    $('#submit_<?php echo $departments['id'] ?>').hide();
                } else {
                    $('#error_<?php echo $departments['id'] ?>').hide();
                    $('#submit_<?php echo $departments['id'] ?>').show();
                }
            }

        </script>
    </div>
</div>
<?php } } ?>
    </body>
</html>