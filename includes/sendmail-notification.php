<?php
// Include the PHPMailer classes
// If these are located somewhere else, simply change the path.
require_once("../includes/phpMailer/class.phpmailer.php");
require_once("../includes/phpMailer/class.smtp.php");
require_once("../includes/phpMailer/language/phpmailer.lang-en.php");

function sendNotifcation($nameFirst, $nameLast, $to, $type) {
    // mostly the same variables as before
    // ($to_name & $from_name are new, $headers was omitted) 
    
    $to_name = $nameFirst . " " . $nameLast;
    
    $message = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><html xmlns=\"http://www.w3.org/1999/xhtml\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /><title>Untitled Document</title></head><body style=\"background: #363e3f url(http://dltonlinedev2015-env.elasticbeanstalk.com/public/img/classy_fabric.png);\"><center><table cellpadding=\"0\" cellspacing=\"0\" style=\"width:500px;background-color:#fff\"><tr><td valign=\"middle\" align=\"left\" style=\"background: #363e3f url(http://dltonlinedev2015-env.elasticbeanstalk.com/public/img/classy_fabric.png);\"><img src=\"http://dltonlinedev2015-env.elasticbeanstalk.com/public/img/logo-light.png\" height=\"70px;\"></td></tr><tr><td valign=\"top\" background=\"img/content_bg.gif\"><center><table align=\"center\"><tr><td style=\"padding:15px\"><p><font face=\"Verdana, Geneva, sans-serif\" size=\"-1\" color=\"#666666\">Dear {$nameFirst},</font></p><p><font face=\"Verdana, Geneva, sans-serif\" size=\"-1\" color=\"#666666\">You are recieving this email as notification that your <strong> {$type} </strong> has been changed on your DLT Online account.</font></p><p><font face=\"Verdana, Geneva, sans-serif\" size=\"-1\" color=\"#666666\">If you did not request a change to your {$type} or have any questions, please contact us by using our <a href=\"http://www.dltonline.com/contact.php\"><font color=\"#363e3f\">contact page</font></a> at <a href=\"http://www.dltonline.com/\"><font color=\"#363e3f\">dltonline.com</font></a>, emailing us at <a href=\"mailto:info@discoverleadership.com?subject=Notificatio%20of%20Username%20Change\"><font color=\"#363e3f\">info@discoverleadership.com</font></a>, or calling us at 713-807-9902.</font></p></td></tr></table></center></td></tr><tr><td valign=\"top\" background=\"img/footer.gif\" style=\"padding: 0; margin: 0;\"><center><table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"vertical-align: top;\"><tr><td></td></tr><tr><td align=\"center\" style=\"padding-left:30px;padding-right:30px\"><p><font face=\"Verdana, Geneva, sans-serif\" color=\"#999999\" size=\"-2\"><strong>This email was auto generated. Please do not reply.</strong></font></a></font></p></td></tr></table></center></td></tr></table><p><font face=\"Verdana, Geneva, sans-serif\" color=\"#727778\" size=\"-2\">&copy; 2016 Discover Leadership Training. &copy; 2016 DLT Online.</font></p></center></body></html>";

    $from_name = "DLT Online";
    $from = "no-reply@dltonline.com";
    
    $subject = "DLT Online - Alert";

    // PHPMailer's Object-oriented approach
    $mail = new PHPMailer();

    // Can use SMTP
    // comment out this section and it will use PHP mail() instead
    $mail->IsSMTP();
    $mail->Host     = "email-smtp.us-west-2.amazonaws.com";
    $mail->Port     = 587;
    $mail->SMTPAuth = true;
    $mail->Username = "AKIAJWF22CV2D73A2B2A";
    $mail->Password = "AnGMLFYebL2X65kqd/4w81MMW+fwuXYDWxCasLysTwoG";

    // Could assign strings directly to these, I only used the 
    // former variables to illustrate how similar the two approaches are.
    $mail->ContentType = "text/html";
    $mail->FromName = $from_name;
    $mail->From     = $from;
    $mail->AddAddress($to, $to_name);
    $mail->Subject  = $subject;
    $mail->Body     = $message;

    $result = $mail->Send();
}

?>