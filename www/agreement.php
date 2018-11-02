<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php login_check() ?>
<?php permission_check(5) ?>
<?php
    if(isset($_GET['type']) && !empty($_GET['type'])){
        $agreement_type = $_GET['type'];
    } else {
        redirect_to("/member");
    }
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
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php include("../includes/layouts/nav.php") ?>
<section class="section">
    <div class="container">
        <div class="col-sm-12 align-center">
            <h1 style="margin-bottom:0;" class="text-grey">Utah Triangle Promissory Note</h1>
            <hr style="margin:0;margin-bottom:50px;">
        </div>
        <div class="col-sm-6 col-sm-offset-3" id="div_name">
            <label for="name">Legal Name</label>
            <input type="text" name="name" id="name" value="<?php echo $_SESSION['name']; ?>">
            <p class="text-rose text-bold text-center" id="name_error" style="display:none">Please input your legal name.</p>
            <a class="btn btn-sm" id="name_next">Continue</a>
        </div>
        <div class="col-sm-10 col-sm-offset-1" id="div_note" style="display:none">
            <p>ON THIS
                <?php echo date('d'); ?> of
                <?php echo date('F') . " " . date('Y'); ?>,
                <span id="text_name"><?php echo strtoupper($_SESSION['name']); ?></span> hereinafter known as the "Borrower" promises to pay to Utah Triangle Fraternity, hereinafter known as the "Lender", the principal sum of Four Hundred and Fifty Dollars ($450).</p>

           <?php if($agreement_type == "15Day"){ ?>
            <p>1. PAYMENT: Borrower shall pay the principal in the amount of Four Hundred and Fifty Dollars ($450), no later than the 26th of February 2018.</p>
           <?php } else if($agreement_type == "60Day"){ ?>
            <p>1. PAYMENT: Borrower shall pay the principal in the amount of Four Hundred and Fifty Dollars ($450), no later than the 19th of March 2018.</p>
           <?php } else { ?>
            <p>1. PAYMENTS: Borrower shall pay INSTALLMENTS, via PayPal, of principal in the amount of One Hundred and Fifty Five Dollars ($155.00), such installment payment shall be due and payable on this day of every month beginning today, with a deposit of One Hundred and Fifty Five Dollars ($155.00) due today.</p>
            <?php } ?>

            <p>2. DUE DATE: The full balance on this Note, including any accrued late fees, is due and payable on the 1st of May 2018.</p>

            <p>3. ALLOCATION OF PAYMENTS: Payments shall be first credited any late fees due and any remainder will be credited to principal. </p>

            <p>4. PREPAYMENT: Borrower may pre-pay this Note without penalty.</p>

            <p>5. LATE FEES: If the Lender receives any installment payment more than 5 days after the first day of the month or the day the payment is due, then a late payment fee of Twenty-Five Dollars ($25.00), shall be payable with the scheduled installment payment.</p>

            <p>6. ACCELERATION: If the Borrower is in default under this Note, and such default is not cured within 30 days after written notice of such default, then Lender may, at its option, declare all outstanding sums owed on this Note to be immediately due and payable, in addition to any other rights or remedies that Lender may have under the security instrument or state and federal law.</p>

            <p>7. ATTORNEYS' FEES AND COSTS: Borrower shall pay all costs incurred by Lender in collecting sums due under this Note after a default, including reasonable attorneys' fees. If Lender or Borrower sues to enforce this Note or obtain a declaration of its rights hereunder, the prevailing party in any such proceeding shall be entitled to recover its reasonable attorneys' fees and costs incurred in the proceeding (including those incurred in any bankruptcy proceeding or appeal) from the non-prevailing party.</p>

            <p>8. WAIVER OF PRESENTMENTS: Borrower waives presentment for payment, notice of dishonor, protest and notice of protest.</p>

            <p>9. NON-WAIVER: No failure or delay by Lender in exercising Lender's rights under this Note shall be considered a waiver of such rights.</p>

            <p>10. SEVERABILITY: In the event that any provision herein is determined to be void or unenforceable for any reason, such determination shall not affect the validity or enforceability of any other provision, all of which shall remain in full force and effect.</p>

            <p>11. INTEGRATION: There are no verbal or other agreements which modify or affect the terms of this Note. This Note may not be modified or amended except by written agreement signed by Borrower and Lender.</p>

            <p>12. CONFLICTING TERMS: In the event of any conflict between the terms of this Note and the terms of any security instrument securing payment of this Note, the terms of this Note shall prevail.</p>

            <p>13. NOTICE: Any notices required or permitted to be given hereunder shall be given in writing and shall be delivered (a) in person, (b) by certified mail, postage prepaid, return receipt requested, (c) by facsimile, or (d) by a commercial overnight courier that guarantees next day delivery and provides a receipt, and such notices shall be made to the parties at the addresses listed below.</p>

            <p>14. EXECUTION: The Borrower executes this Note as a principal and not as a surety. If there is more than one Borrower, each Borrower shall be jointly and severally liable under this Note.</p>
            </p>

            <p><input type="checkbox" name="agree" onclick="$('.submit-agreement').toggle();">I hereby agree to all the above terms and conditions.</p>

            <?php if($agreement_type == "15Day"){ ?>
                <a class="btn btn-sm submit-agreement submit-btn" style="display:none">Submit</a>
            <?php } else if($agreement_type == "60Day"){ ?>
               <p class="submit-agreement" style="display:none"><span class="highlight">IMPORTANT:</span> You will be redirect to PayPal to pay the $10 set-up fee.  You must finish the next step to complete your agreement.  If you fail to pay the set-up fee, the full amount of $450 will be due by 12pm on January 19th 2018.</p>
                <a class="btn btn-sm submit-agreement submit-btn" style="display:none">Continue</a>
            <?php } else { ?>
               <p class="submit-agreement" style="display:none"><span class="highlight">IMPORTANT:</span> You will be redirect to PayPal to set up a payment plan.  You must finish the next step to complete your agreement.  If you fail to set up a payment plan via PayPal, the full amount of $450 will be due by 8pm on February 12th 2018.</p>
                <a class="btn btn-sm submit-agreement submit-btn" style="display:none">Continue</a>
            <?php } ?>
        </div>
    </div>
</section>
<?php include("../includes/layouts/footer.php") ?>
<script type="text/javascript">
$("#name_next").click(function(){
    if(document.getElementById("name").value !== ""){
        $("#name_error").hide();
        var name = $("#name").val().toUpperCase();
        $("#text_name").text(name);
        $("#div_name").slideUp();
        $("#div_note").slideDown();
    } else {
        $("#name_error").show();
    }
});

    $(".submit-btn").click(function(){
        $(".process-overlay").show();
        $(".proccessing").show();
        var name = $("#name").val();
        window.location = "/data?form=MemberAgreement&type=<?php echo $agreement_type ?>&name=" + name;
    })
</script>
</body>

</html>
