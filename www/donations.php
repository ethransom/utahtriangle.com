<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php login_check(); ?>
<?php
    $donate_set = find_all_donations();
?>
<?php include("../includes/layouts/header.php") ?>
<style>
    .valid-users th,
    .valid-users td {
        padding: 5px 5px;
        text-align: center;
    }
    .valid-users tr {
        /*border-top: 1px solid #51545b;*/
        border-bottom: 1px solid #51545b;
    }
    .valid-users td input {
        padding: 2px 5px;
        height: 18px;
        font-size: 14px;
        margin: 0;
    }
    
    .text-green {
        color: green;
    }
    
    .valid-users a{
        margin: 0;
    }
    .valid-users .label-table label {
        font-size: 14px;
        font-weight: 100;
        vertical-align: middle;
        margin: 0;
    }
    .valid-users img {
        border-radius: 100px;
        height: 40px;
        vertical-align: middle;
    }
    .pseudo-select {
        vertical-align: middle;
    }
    .row {
        margin-bottom: 25px;
    }
    .row textarea {
        height: 150px;
    }
    .section {
        padding: 40px 0 !important;
    }
    .email-list p {
        margin: 0;
    }
    .pseudo-select .pseudo-select-field,
    .nav-current {
        margin: 0;
    }
    .border-sharp {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
</style>
    
<?php include("../includes/layouts/nav.php") ?>
    
    <section class="section align-center">
        <div class="container">
            <div class="col-sm-12">
                <h3>Donations</h3>
                <table width="100%" class="valid-users">
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Affiliation</th>
                        <th>Chapter</th>
                        <th>Budget</th>
                        <th>Recurring</th>
                        <th>Amount</th>
                        <th>Comments</th>
                        <th>Action</th>
                    </tr>
                    <?php $donation = false; while($donate = mysqli_fetch_assoc($donate_set)) { if($donate['user_id'] == $_SESSION['google_id']){ $donation = true; ?>
                    <tr>
                        <td><?php echo htmlentities($donate['date']); ?></td>
                        <td><?php echo htmlentities($donate['name']); ?></td>
                        <td><?php echo htmlentities($donate['email']); ?></td>
                        <td><?php echo htmlentities($donate['affiliation']); ?></td>
                        <td><?php echo htmlentities($donate['chapter']); ?></td>
                        <td><?php echo htmlentities($donate['budget']); ?></td>
                        <td><?php if($donate['recurring_type'] == 0){ echo "One-time"; } else if($donate['recurring_type'] == 1){ echo "Monthly"; } else if($donate['recurring_type'] == 2){ echo "Annually"; } ?></td>
                        <td>$<?php echo htmlentities($donate['amount']); ?></td>
                        <td><?php echo htmlentities($donate['comments']); ?></td>
                        <td><?php if($donate['recurring_type'] != 0){ echo "<a href='https://www.paypal.com/cgi-bin/webscr?cmd=_manage-paylist' target='_blank' class='text-yellow'>Manage Agreement</a>"; } ?></td>
                    </tr>
                    <?php } } ?>
                </table>
            </div>
            <div class="col-sm-12 text-center">
                <a class="btn" style="margin-top:25px;" data-modal-link="popup-donate">Donate Now</a>
            </div>
        </div>
    </section>
    
<?php include("../includes/layouts/footer.php"); ?>
</body>
</html>