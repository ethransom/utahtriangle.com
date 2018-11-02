<?php
// Include the PHPMailer classes
// If these are located somewhere else, simply change the path.


$year = date("Y");
$i = rand(1,4);
$header = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html xmlns=\"http://www.w3.org/1999/xhtml\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /><title>Untitled Document</title><link href=\"http://utahtriangle.com/assets/css/font.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" /></head><body><center><table cellpadding=\"0\" cellspacing=\"0\" style=\"width:600px;\"><tr><td valign=\"middle\" align=\"left\"><img src=\"http://utahtriangle.com/assets/img/emailHeader{$i}.png\" height=\"100px\"></td></tr><tr><td valign=\"top\" style=\"padding-top: 25px;\">";
$footer = "</td></tr><tr><td valign=\"top\" background=\"img/footer.gif\" style=\"padding: 0; margin: 0;\"><center><table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"vertical-align: top;\"><tr><td></td></tr><tr><td align=\"center\" style=\"padding-left:30px;padding-right:30px\"><p><font size=\"-2\"><strong>This email was auto generated. Please do not reply.</strong></font></a></font></p></td></tr></table></center></td></tr></table><p><font size=\"-2\">&copy; {$year} Triangle Fraternity - Utah.</font></p></center></body></html>";

function SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message){

    // PHPMailer's Object-oriented approach
    $mail = new PHPMailer();

    // Can use SMTP
    // comment out this section and it will use PHP mail() instead
    $mail->IsSMTP();
    $mail->Host     = "email-smtp.us-west-2.amazonaws.com";
    $mail->Port     = 587;
    $mail->SMTPAuth = true;
    $mail->Username = "AKIAI7U7M7KW4YO7BCTA";
    $mail->Password = "AqcWcMStpT5YUl3Gtq/b8PhSrdaVLJPyDWs28g6181Dw";

    // Could assign strings directly to these, I only used the
    // former variables to illustrate how similar the two approaches are.
    $mail->ContentType = "text/html";
    $mail->FromName = $from_name;
    $mail->From     = $from;
    $mail->AddAddress($to, $to_name);
    $mail->Subject  = $subject;
    $mail->Body     = $message;

    $result = $mail->Send();

    return $result;
}

function sendToRyan($name){
    global $header;
    global $footer;

    $message = "{$header}<center><h1><font size=\"5\">Account Notification</font></h1><p><font size=\"-1\">{$name} has just created a new account on Utah Triangle.</font></p></center>{$footer}";

    $from_name = "Utah Triangle";
    $from = "no-reply@utahtriangle.com";

    $subject = "New Account";

    $to = "ryan.clayton@me.com";
    $to_name = $name;
    $result = SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message);

    return array($result, $to);
}

function membershipChange($name, $email, $membership){
    global $header;
    global $footer;

    $message = "{$header}<center><h1><font size=\"5\">Account Notification</font></h1><p><font size=\"-1\">Your membership status has been changed, on utahtriangle.com, to: {$membership}.</font></p></center>{$footer}";

    $from_name = "Utah Triangle";
    $from = "no-reply@utahtriangle.com";

    $subject = "Membership Change";

    $to = $email;
    //$to = "ryan.clayton@me.com";
    $to_name = $name;
    $result = SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message);

    return array($result, $to);
}

function sendNewBrother($nameFirst, $nameLast, $email, $phone, $major, $academicLevel) {

    global $header;
    global $footer;

    $message = "{$header}<center><h1><font size=\"5\">Become a Brother Form</font></h1><p><font size=\"-1\">{$nameFirst} is requesting information about becoming a brother.<br>  Please make contact with him as soon as possible.</font></p><center><table><tr><td align=\"right\"><strong>Name</strong></td><td style=\"padding-left:10px\">{$nameFirst} {$nameLast}</td></tr><tr><td align=\"right\"><strong>Email</strong></td><td style=\"padding-left:10px\">{$email}</td></tr><tr><td align=\"right\"><strong>Phone</strong></td><td style=\"padding-left:10px\">{$phone}</td></tr><tr><td align=\"right\"><strong>Feild of Study</strong></td><td style=\"padding-left:10px\">{$major}</td></tr><tr><td align=\"right\"><strong>Academic Level</strong></td><td style=\"padding-left:10px\">{$academicLevel}</td></tr></table></center></center>{$footer}";

    $from_name = "Utah Triangle";
    $from = "no-reply@utahtriangle.com";

    $subject = "Become a Brother Form Submission";

    $to = "recruitment@utahtriangle.com";
    //$to = "info@utahtriangle.com";
    $to_name = "Utah Triangle Recruitment";
    $result = SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message);

    return array($result, $to);
}

function sendTransactionToDepartment($reimbursement_name, $reimbursement_email, $reimbursement_phone, $unix_timestamp, $transaction_amount, $transaction_merchant, $transaction_department, $transaction_category, $transaction_description, $refund_method, $file_path, $token) {

    global $header;
    global $footer;

    $date_today = date("m/d/Y");
    $transaction_date = date("m/d/Y",$unix_timestamp);

    $message = "{$header}<center><h1><font size=\"5\">Reimbursement Approval</font></h1><p><font size=\"-1\">Please review the following reimbursement and either approve or reject it.</font></p><center><table><tr><td align=\"right\"><strong>Submission Date</strong></td><td style=\"padding-left:10px\">{$date_today}</td></tr><tr><td align=\"center\" colspan=\"2\"><h1><font size=\"4\">Payee Information</font></h1></td></tr><tr><td align=\"right\"><strong>Payee Name</strong></td><td style=\"padding-left:10px\">{$reimbursement_name}</td></tr><tr><td align=\"right\"><strong>Payee Email</strong></td><td style=\"padding-left:10px\">{$reimbursement_email}</td></tr><tr><td align=\"right\"><strong>Payee Phone</strong></td><td style=\"padding-left:10px\">{$reimbursement_phone}</td></tr><tr><td align=\"center\" colspan=\"2\"><h1><font size=\"4\">Payee Information</font></h1></td></tr><tr><td align=\"right\"><strong>Date of Transaction</strong></td><td style=\"padding-left:10px\">{$transaction_date}</td></tr><tr><td align=\"right\"><strong>Amount</strong></td><td style=\"padding-left:10px\">{$transaction_amount}</td></tr><tr><td align=\"right\"><strong>Merchant</strong></td><td style=\"padding-left:10px\">{$transaction_merchant}</td></tr><tr><td align=\"right\"><strong>Receipt</strong></td><td style=\"padding-left:10px\"><a href=\"{$file_path}\">View Receipt</a></td></tr><tr><td align=\"right\"><strong>Department</strong></td><td style=\"padding-left:10px\">{$transaction_department}</td></tr><tr><td align=\"right\"><strong>Category</strong></td><td style=\"padding-left:10px\">{$transaction_category}</td></tr><tr><td align=\"right\"><strong>Transaction Description</strong></td><td style=\"padding-left:10px\">{$transaction_description}</td></tr><tr><td align=\"left\"><strong><a href=\"https://utahtriangle.com/transactions\" style=\"color:#E5C300;text-decoration:none;\">Launch Transaction Portal</a></strong></td><td align=\"right\"><strong><a href=\"http://utahtriangle.com/transactions?approval=reject&token={$token}\" style=\"color:#8a1538;text-decoration:none;\">Reject</a> &nbsp; <a href=\"http://utahtriangle.com/transactions?approval=approve&token={$token}\" style=\"color:#75b93f;text-decoration:none;\">Approve</a></strong></td></tr></table></center></center>{$footer}";

    $from_name = "Utah Triangle";
    $from = "no-reply@utahtriangle.com";

    $subject = "ACTION REQUIRED: Reimbursement Approval";

    $exec = find_department_by_exec($transaction_department);
    $exec_email = get_user_by_google_id($exec['exec']);

    $to = $exec_email['email'];
    $to_name = $exec_email['name'];
    $result = SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message);

    return array($result, $to);
}

function sendTransactionToTreasury($reimbursement_name, $reimbursement_email, $reimbursement_phone, $unix_timestamp, $transaction_amount, $transaction_merchant, $transaction_department, $transaction_category, $transaction_description, $refund_method, $file_path, $token) {

    global $header;
    global $footer;

    $date_today = date("m/d/Y");
    $transaction_date = $unix_timestamp;

    $message = "{$header}<center><h1><font size=\"5\">Reimbursement Approval</font></h1><p><font size=\"-1\">Please review the following reimbursement and either approve or reject it.</font></p><center><table><tr><td align=\"right\"><strong>Department Approval Date</strong></td><td style=\"padding-left:10px\">{$date_today}</td></tr><tr><td align=\"center\" colspan=\"2\"><h1><font size=\"4\">Payee Information</font></h1></td></tr><tr><td align=\"right\"><strong>Payee Name</strong></td><td style=\"padding-left:10px\">{$reimbursement_name}</td></tr><tr><td align=\"right\"><strong>Payee Email</strong></td><td style=\"padding-left:10px\">{$reimbursement_email}</td></tr><tr><td align=\"right\"><strong>Payee Phone</strong></td><td style=\"padding-left:10px\">{$reimbursement_phone}</td></tr><tr><td align=\"center\" colspan=\"2\"><h1><font size=\"4\">Payee Information</font></h1></td></tr><tr><td align=\"right\"><strong>Date of Transaction</strong></td><td style=\"padding-left:10px\">{$transaction_date}</td></tr><tr><td align=\"right\"><strong>Amount</strong></td><td style=\"padding-left:10px\">{$transaction_amount}</td></tr><tr><td align=\"right\"><strong>Merchant</strong></td><td style=\"padding-left:10px\">{$transaction_merchant}</td></tr><tr><td align=\"right\"><strong>Receipt</strong></td><td style=\"padding-left:10px\"><a href=\"{$file_path}\">View Receipt</a></td></tr><tr><td align=\"right\"><strong>Department</strong></td><td style=\"padding-left:10px\">{$transaction_department}</td></tr><tr><td align=\"right\"><strong>Category</strong></td><td style=\"padding-left:10px\">{$transaction_category}</td></tr><tr><td align=\"right\"><strong>Transaction Description</strong></td><td style=\"padding-left:10px\">{$transaction_description}</td></tr><tr><td align=\"left\"><strong><a href=\"https://utahtriangle.com/transactions\" style=\"color:#E5C300;text-decoration:none;\">Launch Transaction Portal</a></strong></td><td align=\"right\"><strong><a href=\"http://utahtriangle.com/transactions?exec=treasury&approval=reject&token={$token}\" style=\"color:#8a1538;text-decoration:none;\">Reject</a> &nbsp; <a href=\"http://utahtriangle.com/transactions?exec=treasury&approval=approve&token={$token}\" style=\"color:#75b93f;text-decoration:none;\">Approve</a></strong></td></tr></table></center></center>{$footer}";

    $from_name = "Utah Triangle";
    $from = "no-reply@utahtriangle.com";

    $subject = "ACTION REQUIRED: Reimbursement Approval";

    $to = "treasury@utahtriangle.com";
    $to_name = "Utah Treasury";
    $result = SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message);

    return array($result, $to);
}

function sendTransactionToReject($reimbursement_name, $reimbursement_email, $reimbursement_phone, $unix_timestamp, $transaction_amount, $transaction_merchant, $transaction_department, $transaction_category, $transaction_description, $refund_method, $file_path, $reason) {

    global $header;
    global $footer;

    $date_today = date("m/d/Y");
    $transaction_date = $unix_timestamp;

    $message = "{$header}<center><h1 style=\"color:#8a1538;\"><font size=\"5\">Reimbursement Rejected</font></h1><p><font size=\"-1\">Your reimbursement was rejected for the following reason: <br><span style=\"color:#8a1538;\">{$reason}</span></font></p><center><table><tr><td align=\"right\"><strong>Date</strong></td><td style=\"padding-left:10px\">{$date_today}</td></tr><tr><td align=\"center\" colspan=\"2\"><h1><font size=\"4\">Payee Information</font></h1></td></tr><tr><td align=\"right\"><strong>Payee Name</strong></td><td style=\"padding-left:10px\">{$reimbursement_name}</td></tr><tr><td align=\"right\"><strong>Payee Email</strong></td><td style=\"padding-left:10px\">{$reimbursement_email}</td></tr><tr><td align=\"right\"><strong>Payee Phone</strong></td><td style=\"padding-left:10px\">{$reimbursement_phone}</td></tr><tr><td align=\"center\" colspan=\"2\"><h1><font size=\"4\">Payee Information</font></h1></td></tr><tr><td align=\"right\"><strong>Date of Transaction</strong></td><td style=\"padding-left:10px\">{$transaction_date}</td></tr><tr><td align=\"right\"><strong>Amount</strong></td><td style=\"padding-left:10px\">{$transaction_amount}</td></tr><tr><td align=\"right\"><strong>Merchant</strong></td><td style=\"padding-left:10px\">{$transaction_merchant}</td></tr><tr><td align=\"right\"><strong>Receipt</strong></td><td style=\"padding-left:10px\"><a href=\"{$file_path}\">View Receipt</a></td></tr><tr><td align=\"right\"><strong>Department</strong></td><td style=\"padding-left:10px\">{$transaction_department}</td></tr><tr><td align=\"right\"><strong>Category</strong></td><td style=\"padding-left:10px\">{$transaction_category}</td></tr><tr><td align=\"right\"><strong>Transaction Description</strong></td><td style=\"padding-left:10px\">{$transaction_description}</td></tr></table></center></center>{$footer}";

    $from_name = "Utah Triangle";
    $from = "no-reply@utahtriangle.com";

    $subject = "Reimbursement Rejected";

    $to = $reimbursement_email;
    $to_name = $reimbursement_name;
    $result = SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message);

    return array($result, $to);
}

function sendTransactionToApprove($reimbursement_name, $reimbursement_email, $reimbursement_phone, $unix_timestamp, $transaction_amount, $transaction_merchant, $transaction_department, $transaction_category, $transaction_description, $refund_method, $file_path) {

    global $header;
    global $footer;

    $date_today = date("m/d/Y");
    $transaction_date = $unix_timestamp;

    $message = "{$header}<center><h1 style=\"color:#75b93f;\"><font size=\"5\">Reimbursement Approved</font></h1><p><font size=\"-1\">Your reimbursement has been approved, you should receive your refund within 1-2 business days.</font></p><center><table><tr><td align=\"right\"><strong>Date</strong></td><td style=\"padding-left:10px\">{$date_today}</td></tr><tr><td align=\"center\" colspan=\"2\"><h1><font size=\"4\">Payee Information</font></h1></td></tr><tr><td align=\"right\"><strong>Payee Name</strong></td><td style=\"padding-left:10px\">{$reimbursement_name}</td></tr><tr><td align=\"right\"><strong>Payee Email</strong></td><td style=\"padding-left:10px\">{$reimbursement_email}</td></tr><tr><td align=\"right\"><strong>Payee Phone</strong></td><td style=\"padding-left:10px\">{$reimbursement_phone}</td></tr><tr><td align=\"center\" colspan=\"2\"><h1><font size=\"4\">Payee Information</font></h1></td></tr><tr><td align=\"right\"><strong>Date of Transaction</strong></td><td style=\"padding-left:10px\">{$transaction_date}</td></tr><tr><td align=\"right\"><strong>Amount</strong></td><td style=\"padding-left:10px\">{$transaction_amount}</td></tr><tr><td align=\"right\"><strong>Merchant</strong></td><td style=\"padding-left:10px\">{$transaction_merchant}</td></tr><tr><td align=\"right\"><strong>Receipt</strong></td><td style=\"padding-left:10px\"><a href=\"{$file_path}\">View Receipt</a></td></tr><tr><td align=\"right\"><strong>Department</strong></td><td style=\"padding-left:10px\">{$transaction_department}</td></tr><tr><td align=\"right\"><strong>Category</strong></td><td style=\"padding-left:10px\">{$transaction_category}</td></tr><tr><td align=\"right\"><strong>Transaction Description</strong></td><td style=\"padding-left:10px\">{$transaction_description}</td></tr></table></center></center>{$footer}";

    $from_name = "Utah Triangle";
    $from = "no-reply@utahtriangle.com";

    $subject = "Reimbursement Approved";

    $to = $reimbursement_email;
    $to_name = $reimbursement_name;
    $result = SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message);

    return array($result, $to);
}

function sendDonation($date, $name, $email, $affiliation, $chapter, $budget, $recurring, $recurring_int, $amount, $comments) {

    global $header;
    global $footer;

    if($recurring_int == 1){
        $interval = " (Indefinite)";
    } else if($recurring_int > 1){
        $interval = " (" . $recurring_int . ")";
    } else {
        $interval = "";
    }

    $message = "{$header}<center><h1><font size=\"5\">Utah Triangle Donation</font></h1><p><font size=\"-1\">Your donation has been recorded, thank you for your support!</font></p><center><table><tr><td align=\"right\"><strong>Date</strong></td><td style=\"padding-left:10px\">{$date}</td></tr><tr><td align=\"right\"><strong>Name</strong></td><td style=\"padding-left:10px\">{$name}</td></tr><tr><td align=\"right\"><strong>Email</strong></td><td style=\"padding-left:10px\">{$email}</td></tr><tr><td align=\"right\"><strong>Budget</strong></td><td style=\"padding-left:10px\">{$budget}</td></tr><tr><td align=\"right\"><strong>Amount</strong></td><td style=\"padding-left:10px\">\${$amount}</td></tr><tr><td align=\"right\"><strong>Recurring</strong></td><td style=\"padding-left:10px\">{$recurring}{$interval}</td></tr><tr><td align=\"right\"><strong>Affiliation</strong></td><td style=\"padding-left:10px\">{$affiliation}</td></tr><tr><td align=\"right\"><strong>Chapter</strong></td><td style=\"padding-left:10px\">{$chapter}</td></tr><tr><td align=\"right\"><strong>Comments:</strong></td><td style=\"padding-left:10px\">{$comments}</td></tr></table></center></center>{$footer}";

    $from_name = "Utah Triangle";
    $from = "no-reply@utahtriangle.com";

    $subject = "Utah Triangle Donation";

    //$to = "recruitment@utahtriangle.com";
    $to = $email;
    $to_name = $name;
    $result = SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message);

    return array($result, $to);
}

function sendRent($name, $email, $rent) {

    global $header;
    global $footer;

    $message = "{$header}<h1 style=\"color:#8a1538;\"><font size=\"5\">You've been charged \${$rent} for \"Chapter House Rent\".</font></h1><p><font size=\"-1\">This balance is owed to the Utah Triangle. Please make your payment by clicking on the button below.</font></p><p><font size=\"-1\"><a href=\"https:/utahtriangle.com/rent\">View/ Pay Rent</a></font></p><p><font size=\"-1\">Thanks,</font><br><font size=\"-1\">Utah Triangle Treasury</font></p>{$footer}";

    $from_name = "Utah Triangle";
    $from = "no-reply@utahtriangle.com";

    $subject = "Chapter House Rent";

    //$to = "recruitment@utahtriangle.com";
    $to = $email;
    $to_name = $name;
    $result = SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message);

    return array($result, $to);
}

function sendRentReceipt($name, $email) {

    global $header;
    global $footer;

    $message = "{$header}<center><h1 style=\"color:#8a1538;\"><font size=\"5\">Rent Recieved!</font></h1><p style=\"font-weight: bold;\"><font size=\"-1\">Thank you for your Payment.</span></font></p></center>{$footer}";

    $from_name = "Utah Triangle";
    $from = "no-reply@utahtriangle.com";

    $subject = "Chapter House Rent Payment";

    //$to = "recruitment@utahtriangle.com";
    $to = $email;
    $to_name = $name;
    $result = SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message);

    return array($result, $to);
}

function sendAgreement($date, $name, $email) {

    global $header;
    global $footer;

    $agreement_type = $_SESSION['agreement_type'];

    $message = "{$header}<center><h1><font size=\"5\">Utah Triangle Agreement</font></h1><p><font size=\"-1\">Your agreement has been recorded.</font></p><center><table><tr><td align=\"right\"><strong>Date</strong></td><td style=\"padding-left:10px\">{$date}</td></tr><tr><td align=\"right\"><strong>Name</strong></td><td style=\"padding-left:10px\">{$name}</td></tr><tr><td align=\"right\"><strong>Email</strong></td><td style=\"padding-left:10px\">{$email}</td></tr></table></center><p><strong>Agreement Details</strong></p></center><p style=\"line-height: normal;\"><font size=\"-2\">ON THIS ";

    $message .= date('d');

    $message .= " of ";

    $message .= date('F');

    $message .= " ";

    $message .= date('Y');

    $message .= ", ";

    $message .= strtoupper($name);

    $message .= " hereinafter known as the \"Borrower\" promises to pay to Utah Triangle Fraternity, hereinafter known as the \"Lender\", the principal sum of Four Hundred and Fifty Dollars ($450).</font></p>";

    if($agreement_type == "15Day"){
        $message .= "<p style=\"line-height: normal;\"><font size=\"-2\">1. PAYMENT: Borrower shall pay the principal in the amount of Four Hundred and Fifty Dollars ($450), no later than the 26th of February 2018.</font></p>";
    } else if($agreement_type == "60Day"){
        $message .= "<p style=\"line-height: normal;\"><font size=\"-2\">1. PAYMENT: Borrower shall pay the principal in the amount of Four Hundred and Fifty Dollars ($450), no later than the 19th of March 2018.</font></p>";
    } else {
        $message .= "<p style=\"line-height: normal;\"><font size=\"-2\">1. PAYMENTS: Borrower shall pay INSTALLMENTS, via PayPal, of principal in the amount of One Hundred and Fifty Five Dollars ($155.00), such installment payment shall be due and payable on this day of every month beginning today, with a deposit of One Hundred and Fifty Five Dollars ($155.00) due today.</font></p>";
    }

    $message .= "<p style=\"line-height: normal;\"><font size=\"-2\">2. DUE DATE: The full balance on this Note, including any accrued late fees, is due and payable on the 1st of May 2018.</font></p><p style=\"line-height: normal;\"><font size=\"-2\">3. ALLOCATION OF PAYMENTS: Payments shall be first credited any late fees due and any remainder will be credited to principal. </font></p><p style=\"line-height: normal;\"><font size=\"-2\">4. PREPAYMENT: Borrower may pre-pay this Note without penalty.</font></p><p style=\"line-height: normal;\"><font size=\"-2\">5. LATE FEES: If the Lender receives any installment payment more than 5 days after the first day of the month or the day the payment is due, then a late payment fee of Twenty-Five Dollars ($25.00), shall be payable with the scheduled installment payment.</font></p><p style=\"line-height: normal;\"><font size=\"-2\">6. ACCELERATION: If the Borrower is in default under this Note, and such default is not cured within 30 days after written notice of such default, then Lender may, at its option, declare all outstanding sums owed on this Note to be immediately due and payable, in addition to any other rights or remedies that Lender may have under the security instrument or state and federal law.</font></p><p style=\"line-height: normal;\"><font size=\"-2\">7. ATTORNEYS' FEES AND COSTS: Borrower shall pay all costs incurred by Lender in collecting sums due under this Note after a default, including reasonable attorneys' fees. If Lender or Borrower sues to enforce this Note or obtain a declaration of its rights hereunder, the prevailing party in any such proceeding shall be entitled to recover its reasonable attorneys' fees and costs incurred in the proceeding (including those incurred in any bankruptcy proceeding or appeal) from the non-prevailing party.</font></p><p style=\"line-height: normal;\"><font size=\"-2\">8. WAIVER OF PRESENTMENTS: Borrower waives presentment for payment, notice of dishonor, protest and notice of protest.</font></p><p style=\"line-height: normal;\"><font size=\"-2\">9. NON-WAIVER: No failure or delay by Lender in exercising Lender's rights under this Note shall be considered a waiver of such rights.</font></p><p style=\"line-height: normal;\"><font size=\"-2\">10. SEVERABILITY: In the event that any provision herein is determined to be void or unenforceable for any reason, such determination shall not affect the validity or enforceability of any other provision, all of which shall remain in full force and effect.</font></p><p style=\"line-height: normal;\"><font size=\"-2\">11. INTEGRATION: There are no verbal or other agreements which modify or affect the terms of this Note. This Note may not be modified or amended except by written agreement signed by Borrower and Lender.</font></p><p style=\"line-height: normal;\"><font size=\"-2\">12. CONFLICTING TERMS: In the event of any conflict between the terms of this Note and the terms of any security instrument securing payment of this Note, the terms of this Note shall prevail.</font></p><p style=\"line-height: normal;\"><font size=\"-2\">13. NOTICE: Any notices required or permitted to be given hereunder shall be given in writing and shall be delivered (a) in person, (b) by certified mail, postage prepaid, return receipt requested, (c) by facsimile, or (d) by a commercial overnight courier that guarantees next day delivery and provides a receipt, and such notices shall be made to the parties at the addresses listed below.</font></p><p style=\"line-height: normal;\"><font size=\"-2\">14. EXECUTION: The Borrower executes this Note as a principal and not as a surety. If there is more than one Borrower, each Borrower shall be jointly and severally liable under this Note.</font></p></font></p>{$footer}";

    $from_name = "Utah Triangle";
    $from = "no-reply@utahtriangle.com";

    $subject = "Utah Triangle Agreement";

    //$to = "recruitment@utahtriangle.com";
    $to = $email;
    $to_name = $name;
    $result = SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message);

    $to = "treasury@utahtriangle.com";
    $to_name = "Treasury";
    $result = SEND_MAIL($from_name, $from, $to, $to_name, $subject, $message);

    return array($result, $to);
}
?>
