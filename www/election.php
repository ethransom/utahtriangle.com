<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php
    
    if(isset($_POST['submit'])){
        $title = mysql_prep($_SESSION['election-name']);
        $body = mysql_prep($_SESSION['election-description']);
        $people = mysql_prep($_SESSION['email']);
        $groups = mysql_prep($_SESSION['email']);
        $query  = "INSERT INTO users (";
        $query .= "google_id, name, email";
        $query .= ") VALUES (";
        $query .= "{$id}, '{$name}', '{$email}'";
        $query .= ")";
        $result = mysqli_query($connection, $query);
        if($result){
            redirect_to("/".$_SESSION['redirect']);
        } else {
            echo $query;
        }
    }