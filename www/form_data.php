<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php require_once("../includes/sendmail.php") ?>
<?php require_once("../includes/phpMailer/class.phpmailer.php"); ?>
<?php require_once("../includes/phpMailer/class.smtp.php"); ?>
<?php require_once("../includes/phpMailer/language/phpmailer.lang-en.php"); ?>
<?php

if(isset($_POST['brother'])) {
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $private_key = '6LdnvigUAAAAAMMnQpvvCmkqYdRn1wo81g3Az_nY';
    
    $response = file_get_contents($url."?secret=".$private_key."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
    $data = json_decode($response);
    
    if(isset($data->success) AND $data->success==true){
        $nameFirst = htmlentities($_POST['first_name']);
        $nameLast = htmlentities($_POST['last_name']);
        $email = htmlentities($_POST['email']);
        $phone = htmlentities($_POST['phone']);
        $major = htmlentities($_POST['major']);
        $academicLevel = htmlentities($_POST['academic_level']);
        $result = sendNewBrother($nameFirst, $nameLast, $email, $phone, $major, $academicLevel);
        if($result){
            echo "ok";
        } else {
            echo "An error occured. Please try again later.";
        }
    } else {
        echo "Please verify that your not a robot.";
    }
}

?>
