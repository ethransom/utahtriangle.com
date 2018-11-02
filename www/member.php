<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php login_check() ?>
<?php permission_check(5) ?>
<?php
    $department_set = find_all_departments();
    $budget_set = find_all_budgets();
    $budget_set2 = find_all_budgets();

    $user_set = find_all_users();
    $rent_set = find_all_rents();
    $rent_extras_set = find_all_rent_extras();

    $user_rent = get_user_rent_by_google_id($_SESSION['google_id']);

    $split = explode("?", $_SESSION['profile_image_url']);
    $photo = $split[0]."?sz=250";
?>
<?php include("../includes/layouts/header.php") ?>
<style>
    .profile-box {
        border: 1px grey solid;
        border-radius: 10px;
        padding: 10px 30px;
    }

    .profile-box h4 {
        color: #51545b;
    }

    .profile-box .photo img {
        max-height: 150px;
        border-radius: 150px;
    }

    .profile-box .name {
        font-size: 20px;
        font-weight: bold;
    }


    .billing .box {
        border: 1px solid grey;
        border-radius: 10px;
        padding: 10px 30px;
    }

    .box .title {
        font-size: 20px;
        font-weight: bold;
    }

    .text-bold {
        font-weight: bold;
    }
    .service {
        border: 1px grey solid;
        padding: 5px;
        border-radius: 10px;
        min-height: 130px;
    }
    .service:hover {
        background-color: rgb(153, 0, 51);
        border-color: rgb(153, 0, 51);
    }
    .service a,
    .service .fa {
        color: #51545b;
        text-decoration: none;
        margin-bottom: 5px;
    }
    .service:hover a,
    .service:hover .fa {
        color: #fff;
    }
    .service .fa {
        font-size: 74px;
        display: block;
    }
    .error-box {
        background-color: #8a1538;
        padding: 5px;
        color: #fff;
    }
    .file-message {
        border: grey solid 1px;
        padding: 5px 15px;
    }
    .sub-line{
        font-size: 10px;
        font-style: italic;
    }
    .delete a {
        font-size: 12px;
        font-style: italic;
        color: #8a1538;
    }
    .btn-rose {
        background-color: #8a1538;
    }
    
    .set-rent-div input{
        height: 25px !important;
        margin-bottom: 0;
    }
    .set-rent-div .row:nth-child(odd) {
        background-color: #eee;
    }
    .set-rent-div .row div{
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .set-rent-div .pseudo-select .pseudo-select-field {
        margin: 0 !important;
        height: 25px !important;
        line-height: 25px !important;
    }
    
    .set-rent-div .pseudo-select{
        padding-top: 0 !important;
    }
    .set-rent-div p {
        padding: 3px 0;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php include("../includes/layouts/nav.php") ?>
<section class="section">
    <div class="container">
        <div class="col-sm-12 align-center">
            <h1 style="margin-bottom:0;" class="text-grey">Member Center</h1>
            <hr style="margin:0;margin-bottom:50px;">
        </div>
        <div class="col-sm-4 col-sm-offset-1">
            <div class="profile-box text-center">
                <h4>Profile</h4>
                <div class="photo"><img src="<?php echo $photo ?>" /></div>
                <div class="name">
                    <?php echo $_SESSION['name'] ?>
                </div>
                <div class="email">
                    <?php echo $_SESSION['email'] ?>
                </div>
                <div class="delete"><a data-modal-link="delete_profile">Delete Profile</a></div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="profile-box text-center">
                <h4>Membership Services</h4>
                <div class="container" style="width:100%">
                   <div class="row">
                        <div class="col-sm-4" style="margin-top:15px;"><div class="service"><a href="https://calendar.google.com/calendar/embed?src=dhddetccgao46pn45qt8gcna2g%40group.calendar.google.com&ctz=America%2FDenver" target="_blank"><i class="fa fa-calendar"></i>Chapter Calendar</a></div></div>
                        <div class="col-sm-4" style="margin-top:15px;"><div class="service"><a data-modal-link="billing-plan"><i class="fa fa-pencil"></i>Set up a billing agreement</a></div></div>
                        <div class="col-sm-4" style="margin-top:15px;"><div class="service"><a data-modal-link="reimbursement"><i class="fa fa-money"></i>File a Reimbursement</a></div></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4" style="margin-top:15px;"><div class="service"><a href="/budget"><i class="fa fa-bank"></i>Chapter Budget</a></div></div>
                        <div class="col-sm-4" style="margin-top:15px;"><div class="service"><a href="/transactions"><i class="fa fa-calculator"></i>Chapter Transactions</a></div></div>
                        <div class="col-sm-4" style="margin-top:15px;"><div class="service"><a href="/fees"><i class="fa fa-exchange"></i>Chapter Fees</a></div></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4" style="margin-top:15px;"><div class="service"><a data-modal-link="family-tree"><i class="fa fa-sitemap"></i>Family Tree</a><div style="color:grey;font-style:italic;font-size:10px">Comming Soon!</div></div></div>
                      </div>
                    <?php if($user_rent){ ?>
                    <h5 style="margin:5px;margin-top:15px;">Chapter House Services</h5>
                    <div class="row">
                        <div class="col-sm-4"><div class="service"><a href="/rent"><i class="fa fa-home"></i>View/ Pay Rent</a></div></div>
                    </div>
                    <?php } ?>
                    <?php
                    $exec = find_department_by_exec("Treasury");
                    if($exec['exec'] == $_SESSION['google_id']){
                    ?>
                    <h5 style="margin:5px;margin-top:15px;">Treasury Services</h5>
                    <div class="row">
                        <div class="col-sm-4"><div class="service"><a data-modal-link="income"><i class="fa fa-line-chart"></i>Income Form</a></div></div>
                        <div class="col-sm-4"><div class="service"><a data-modal-link="rent-treasury"><i class="fa fa-home"></i>Set Rent</a></div></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("../includes/layouts/footer.php") ?>

<div class="modal-window" data-modal="delete_profile" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated reimbursement" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight text-rose">Delete Profile</span></h5>

        <p class="text-center">Are you sure you want to delete your account?</p>

        <div class="text-center">
            <a class="btn btn-small" style="padding:10px;" onclick="$('.close-btn').click();">No</a>
            <a class="btn btn-small btn-rose" style="padding:10px;" href="data?form=deleteAccount&token=<?php echo $_SESSION['token']; ?>">Yes</a>
        </div>
    </div>
</div>

<div class="modal-window" data-modal="income" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated income" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight">Income</span></h5>

        <form action="/data?form=income" method="post" enctype="multipart/form-data" data-note="income">

            <h6 class="text-center">Payer Information</h6>

           <div class="row">
            <fieldset class="col-sm-12">
                <label for="income_name">Full Name</label>
                <input id="income_name" name="income_name" type="text" value="<?php echo $_SESSION['name'] ?>">
            </fieldset>
            </div>
            <h6 class="text-center">Income Information</h6>

           <div class="row">
            <fieldset class="col-sm-6">
                <label for="income_date">Date of Transaction</label>
                <input id="income_date" name="income_date" type="text" placeholder="" class="datepicker">
            </fieldset>

            <fieldset class="col-sm-6">
                <label for="income_amount">Amount</label>
                <input id="income_amount" name="income_amount" type="text" placeholder="" class="money">
            </fieldset>
        </div>
           <div class="row">
            <fieldset class="col-sm-12">
                <label for="income_merchant">Merchant (optional)</label>
                <input id="income_merchant" name="income_merchant" type="text" placeholder="">
            </fieldset>
            </div>
            <div class="row">
            <fieldset class="col-sm-12">
                <label for="income_receipt">Receipt (optional)</label>
                <input type="file" name="fileToUploadIncome" id="fileToUploadIncome" accept=".pdf,.jpg,.jpef,.png,.gif">
                <div class="sub-line" style="margin-bottom:5px;">Accepted formats: PDF, JPG, JPEG, PNG &amp; GIF</div>
                <div class="file-message" style="display:none">Uploading File</div>
                <input type="hidden" id="file_path_income" name="file_path_income">
            </fieldset>
        </div>
           <div class="row" style="margin-top:15px;">
            <fieldset class="col-sm-6">
                <label for="income_type">Type</label>
                <select name="income_type" id="income_type">
                    <option data-type="income type" value="">Select</option>
                    <option data-type="income type" value="Dues">Dues</option>
                    <option data-type="income type" value="Donation">Donation</option>
                    <option data-type="income type" value="Initiation">Initiation</option>
                </select>
            </fieldset>
            <fieldset class="col-sm-6 donation-departments" style="display:none">
                <label for="income_department">Department</label>
                <select name="income_department" id="income_department">
                    <option value="">Select</option>
                    <?php while($department = mysqli_fetch_assoc($department_set)) { ?>
                    <option value="<?php echo $department['department'] ?>"><?php echo $department['department'] ?></option>
                    <?php } mysqli_data_seek($department_set, 0); ?>
                </select>
            </fieldset>
        </div>
           <div class="row">
            <fieldset class="col-sm-12">
                <label for="income_description">Income Description</label>
                <textarea name="income_description" id="income_description"></textarea>
            </fieldset>
        </div>
        <div class="row">
            <fieldset class="col-sm-12">
                <label for="income_method">Transaction Method</label><br>
                <select name="income_method" id="income_method">
                    <option value="">Select</option>
                    <option value="1">Checking</option>
                    <option value="3">Savings</option>
                    <option value="2">Venmo</option>
                    <option value="4">PayPal</option>
                    <option value="5">Square</option>
                </select>
            </fieldset>
            </div>

            <fieldset class="col-sm-12 text-center" style="margin-top:25px">
                <input type="submit" name="submit" id="income_submit" value="Submit" class="btn">
            </fieldset>

        </form>
    </div>
</div>

<div class="modal-window" data-modal="reimbursement" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated reimbursement" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight">Reimbursement</span></h5>

        <div class="col-sm-12 text-center">
            <p><span class="text-bold text-rose">Reimbursements without a receipt will not receive a refund!!</span><br>
            All reimbursements will be reviewed by the department head and the treasurer.
            Reimbursements will be issued upon approval from both.</p>
        </div>

        <form action="/data?form=reimbursement" method="post" enctype="multipart/form-data" data-note="reimbursement">

            <h6 class="text-center">Payee Information</h6>

           <div class="row">
            <fieldset class="col-sm-12">
                <label for="reimbursement_name">Full Name</label>
                <input id="reimbursement_name" name="reimbursement_name" type="text" value="<?php echo $_SESSION['name'] ?>">
            </fieldset>
            </div>
           <div class="row">
            <fieldset class="col-sm-6">
                <label for="reimbursement_email">Email</label>
                <input id="reimbursement_email" name="reimbursement_email" type="text" value="<?php echo $_SESSION['email'] ?>">
            </fieldset>

            <fieldset class="col-sm-6">
                <label for="reimbursement_phone">Phone</label>
                <input id="reimbursement_phone" name="reimbursement_phone" type="text" class="phone">
            </fieldset>
            </div>
            <h6 class="text-center">Transaction Information</h6>

           <div class="row">
            <fieldset class="col-sm-6">
                <label for="transaction_date">Date of Transaction</label>
                <input id="transaction_date" name="transaction_date" type="text" placeholder="" class="datepicker">
            </fieldset>

            <fieldset class="col-sm-6">
                <label for="transaction_amount">Amount</label>
                <input id="transaction_amount" name="transaction_amount" type="text" placeholder="" class="money">
            </fieldset>
        </div>
           <div class="row">
            <fieldset class="col-sm-12">
                <label for="transaction_merchant">Merchant</label>
                <input id="transaction_merchant" name="transaction_merchant" type="text" placeholder="">
            </fieldset>
            </div>
            <div class="row">
            <fieldset class="col-sm-12">
                <label for="transaction_receipt">Receipt</label>
                <input type="file" name="fileToUpload" id="fileToUpload" accept=".pdf,.jpg,.jpef,.png,.gif">
                <div class="sub-line" style="margin-bottom:5px;">Accepted formats: PDF, JPG, JPEG, PNG &amp; GIF</div>
                <div class="file-message" style="display:none">Uploading File</div>
                <input type="hidden" id="file_path" name="file_path">
            </fieldset>
        </div>
           <div class="row" style="margin-top:15px;">
            <fieldset class="col-sm-6">
                <label for="transaction_department">Department</label>
                <select name="transaction_department" id="transaction_department">
                    <option value="">Select</option>
                    <?php while($department = mysqli_fetch_assoc($department_set)) { ?>
                    <option data-type="department change" data-id="<?php echo $department['id'] ?>" value="<?php echo $department['department'] ?>"><?php echo $department['department'] ?></option>
                    <?php } mysqli_data_seek($department_set, 0); ?>
                </select>
            </fieldset>
            <?php while($department = mysqli_fetch_assoc($department_set)) {

                $i = 0;
                $options = "";
                while($category = mysqli_fetch_assoc($budget_set)) {
                    if($category['department'] == $department['department']){
                        $i++;
                        $options .= "<option data-type=\"category change\" value=\"{$category['category']}\">{$category['category']}</option>";
                    }
                } mysqli_data_seek($budget_set, 0);
                if($i == 0){
               ?>
               <fieldset class="col-sm-12 category-dropdown category-<?php echo $department['id'] ?>" style="display:none;">
                   <p class="error-box text-center">The budget for this department has not yet been set up.  You will not be able to submit this reimbursement at this time, please contact the department head for more information.</p>
               </fieldset>
               <?php } else { ?>
            <fieldset class="col-sm-6 category-dropdown category-<?php echo $department['id'] ?>" style="display:none;">
                <label for="transaction_category">Category</label>
                <select>
                    <option data-type="category change" value="">Select</option>
                    <?php echo $options; ?>
                </select>
            </fieldset>
                <?php } ?>
                 <?php } mysqli_data_seek($department_set, 0); ?>
                <input type="hidden" name="transaction_category" id="transaction_category" value="" />
        </div>
           <div class="row">
            <fieldset class="col-sm-12">
                <label for="transaction_description">Transaction Description</label>
                <textarea name="transaction_description" id="transaction_description"></textarea>
            </fieldset>
            </div>
            <h6 class="text-center">Refund Information</h6>

            <fieldset class="col-sm-12">
                <label for="refund_method">Refund Method</label><br>
                <input name="refund_method" type="radio" value="1" onclick="$('#venmo_div').slideDown()"> Venmo
                <input name="refund_method" type="radio" value="2" onclick="$('#venmo_div').slideUp()"> Check
            </fieldset>

            <fieldset class="col-sm-12" id="venmo_div" style="display:none">
                <label for="refund_venmo">Venmo Username</label><br>
                <input name="refund_venmo" type="text">
            </fieldset>

            <fieldset class="col-sm-12 text-center" style="margin-top:25px">
                <input type="submit" name="submit" id="transaction_submit" value="Submit" class="btn" disabled>
            </fieldset>

        </form>

        <div class="col-sm-12 text-center" style="margin-top:25px">If you have any questions please contact <a href="mailto:treasury@utahtriangle.com?subject=Website: Reimbursement Form">treasury@utahtriangle.com</a></div>

    </div>
</div>

<div class="modal-window" data-modal="billing-plan" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box medium animated billing" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight">Billing Agreement</span></h5>
        <p class="text-center">There are now three options for deferring you Utah Triangle membership fees.  Please select which option you would like to set up.</p>
        <div class="col-sm-4 text-center">
            <div class="box">
                <p class="title">15 Day Deferral</p>
                <p class="desc">
                    <ul>
                        <li><span class="text-green text-bold">No Fee</span></li>
                        <li>$450 due in full by due date</li>
                        <li>Due Date: <span class="text-rose text-bold">Feb. 26</span></li>
                    </ul>
                    <a href="/agreement?type=15Day" class="btn btn-xs">Set-up Agreement</a>
                </p>
            </div>
        </div>
        <div class="col-sm-4 text-center">
            <div class="box">
                <p class="title">60 Day Deferral</p>
                <p class="desc">
                    <ul>
                        <li><span class="text-green text-bold">$10 Set-up Fee</span></li>
                        <li>$450 due in full by due date</li>
                        <li>Due Date: <span class="text-rose text-bold">Unavailable</span></li>
                    </ul>
                    <!--<a href="/agreement?type=60Day" class="btn btn-xs">Set-up Agreement</a>-->
                    <span class="text-rose text-bold">Unavailable</span>
                </p>
            </div>
        </div>
        <div class="col-sm-4 text-center">
            <div class="box">
                <p class="title">Monthly Payments (3 Months)</p>
                <p class="desc">
                    <ul>
                        <li><span class="text-green text-bold">$15 Set-up Fee</span></li>
                        <li>$155 due each month</li>
                        <li>Payment Agreement via PayPal</li>
                        <li>Billed Once a Month</li>
                    </ul>
                    <a href="/agreement?type=Monthly" class="btn btn-xs">Set-up Agreement</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal-window" data-modal="rent-treasury" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box medium animated billing" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight">Chapter House Rent</span></h5>
        <form id="rent_form" action="data?form=setRent" method="post">
            <div class="row">
                <div class="col-sm-2 col-sm-offset-4 text-center">
                    <select name="month" id="rent_set_month">
                        <option value="1">Jan</option>
                        <option value="2">Feb</option>
                        <option value="3">Mar</option>
                        <option value="4">Apr</option>
                        <option value="5">May</option>
                        <option value="6">Jun</option>
                        <option value="7">Jul</option>
                        <option value="8">Aug</option>
                        <option value="9">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>
                    </select>
                </div>
                <div class="col-sm-2 text-center">
                    <select name="year">
                        <?php
                        $year = date("Y");
                        for ($x = 0; $x <= 2; $x++) {
                        ?>
                        <option value="<?php echo $year ?>"><?php echo $year ?></option>
                        <?php $year++; } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7 text-center">
                    <div class="box set-rent-div">
                        <p class="title">Set Rent</p>
                        <div class="row">
                            <div class="col-xs-1"><p class="text-center text-bold">Paid</p></div>
                            <div class="col-xs-3"><p class="text-center text-bold">Room</p></div>
                            <div class="col-xs-4"><p class="text-center text-bold">User</p></div>
                            <div class="col-xs-2"><p class="text-center text-bold">Price</p></div>
                            <div class="col-xs-2"><p class="text-center text-bold">Adjustment</p></div>
                        </div>
                        <?php while($rent = mysqli_fetch_assoc($rent_set)) { ?>
                        <div class="row">
                            <div class="col-xs-1">
                                <?php if(!empty($rent['paid'])){ ?>
                                    <p class="text-bold text-green"><i class="fa fa-check text-green"></i></p>
                                <?php } else { ?>
                                    <p class="text-bold text-rose"><i class="fa fa-close text-rose"></i></p>
                                <?php } ?>
                            </div>
                            <div class="col-xs-3"><input type="text" name="name_<?php echo $rent['id'] ?>" value="<?php echo $rent['name'] ?>"></div>
                            <div class="col-xs-4">
                                <select name="user_<?php echo $rent['id'] ?>">
                                    <option value="">Vacant</option>
                                    <?php while($user = mysqli_fetch_assoc($user_set)) { ?>
                                    <option value="<?php echo $user['google_id'] ?>"<?php if($user['google_id'] == $rent['user']){ echo " selected";}?>><?php echo $user['name'] ?></option>
                                    <?php } mysqli_data_seek($user_set, 0); ?>
                                </select>
                            </div>
                            <div class="col-xs-2"><input type="text" name="price_<?php echo $rent['id'] ?>" value="<?php echo $rent['price'] ?>"></div>
                            <div class="col-xs-2"><input type="text" name="adjust_<?php echo $rent['id'] ?>" value="<?php echo $rent['adjust'] ?>"></div>
                        </div>
                        <?php } mysqli_data_seek($rent_set, 0); ?>
                        <div class="row">
                            <div class="col-xs-3 col-xs-offset-1"><input type="text" name="new_name" value=""></div>
                            <div class="col-xs-4">
                                <select name="new_user">
                                    <option value="">Vacant</option>
                                    <?php while($user = mysqli_fetch_assoc($user_set)) { ?>
                                    <option value="<?php echo $user['google_id'] ?>"><?php echo $user['name'] ?></option>
                                    <?php } mysqli_data_seek($user_set, 0); ?>
                                </select>
                            </div>
                            <div class="col-xs-2"><input type="text" name="new_price" value=""></div>
                            <div class="col-xs-2"><input type="text" name="new_adjust" value=""></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 text-center">
                    <div class="box set-rent-div">
                        <p class="title">Set Rent Extras</p>
                        <?php while($rent_extra = mysqli_fetch_assoc($rent_extras_set)) { ?>
                        <div class="row">
                            <div class="col-xs-8"><input type="text" name="extra_name_<?php echo $rent_extra['id'] ?>" value="<?php echo $rent_extra['name'] ?>"></div>
                            <div class="col-xs-4"><input type="text" name="extra_price_<?php echo $rent_extra['id'] ?>" value="<?php echo $rent_extra['price'] ?>"></div>
                        </div>
                        <?php } mysqli_data_seek($rent_extras_set, 0); ?>
                        <div class="row">
                            <div class="col-xs-8"><input type="text" name="extra_new_name" value=""></div>
                            <div class="col-xs-4"><input type="text" name="extra_new_price" value=""></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:10px;">
                <div class="col-sm-4">
                    <p class="text-bold text-right">Notes:</p>
                </div>
                <div class="col-sm-6">
                    <textarea name="notes" style="min-height:60px;"></textarea>
                </div>
                <div class="col-sm-2 text-right">
                    <input type="submit" class="btn btn-xs" id="rent_submit" name="submit" value="Update">&nbsp;
                    <input type="button" class="btn btn-xs" id="post_rent" value="Update & Post Rent">
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#rent_set_month").val("<?php echo date("m") + 1; ?>");
    });
    
    $("#post_rent").click(function(){
        $("#rent_form").attr("action", "data?form=setRent&post=true");
        $("#rent_submit").click();
    });
    
    $("#fileToUpload").change(function(){
        if(this.value != ""){
            var file_data = $('#fileToUpload').prop('files')[0];
            var form_data = new FormData();
            form_data.append('fileToUpload', file_data);
            $(".file-message").show();
            $("#transaction_submit").hide();
            $.ajax({
                url: 'upload.php', // point to server-side PHP script
                dataType: 'text', // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(php_script_response) {
                    var result = php_script_response.split('|'),
                        file_path = result[1];
                    console.log(php_script_response);
                    $("#file_path").val(file_path);
                    $(".file-message").text(result[0]);
                    $("#transaction_submit").show();
                }
            });
        }
    });
</script>
</body>

</html>
