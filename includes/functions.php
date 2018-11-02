<?php

//die("Database query failed.");

/*if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}*/

if(isset($_SESSION['google_id']) && !empty($_SESSION['google_id'])){
    $user = get_user_by_google_id($_SESSION['google_id']);
} else {
    $user = null;
}

function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
    //echo $new_location;
    //exit;
}

if(file_exists("newsletter-emails.csv")) {
    unlink('newsletter-emails.csv');
}

// DATE AND TIME STAMPS
date_default_timezone_set("America/Denver");
$date_stamp = date('M d Y');
$time_stamp = date("h:i:sa");
$unix_time_stamp = time();

$domain = $_SERVER['HTTP_HOST'];
$page = $_SERVER['REQUEST_URI'];

// REMOVE PHP FROM URL
$explode_name = explode("?", $page);
if(isset($explode_name[0])){
    $sub_set = "";
    if(isset($explode_name[1])){
        $sub_set = "?" . $explode_name[1];
    }
    $explode_page = explode(".", $explode_name[0]);
    if(isset($explode_page[1]) && $explode_page[0] !== "/google"){
        if($explode_page[1] == "php"){redirect_to($explode_page[0] . $sub_set);}
    }
}

function mysql_prep($string) {
    global $connection;

    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string;
}

function get_user_by_id($id){
    global $connection;

    $safe_id = mysqli_real_escape_string($connection, $id);

    $query  = "SELECT * ";
    $query .= "FROM users ";
    $query .= "WHERE id = '{$safe_id}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);  
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }  
}

function get_user_by_google_id($id){
    global $connection;

    $safe_id = mysqli_real_escape_string($connection, $id);

    $query  = "SELECT * ";
    $query .= "FROM users ";
    $query .= "WHERE google_id = '{$safe_id}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);  
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }  
}

function get_user_rent_by_google_id($id){
    global $connection;

    $safe_id = mysqli_real_escape_string($connection, $id);

    $query  = "SELECT * ";
    $query .= "FROM rent ";
    $query .= "WHERE user = '{$safe_id}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);  
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }  
}

function get_invoice_by_id($id){
    global $connection;

    $safe_id = mysqli_real_escape_string($connection, $id);

    $query  = "SELECT * ";
    $query .= "FROM invoice ";
    $query .= "WHERE id = '{$safe_id}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);  
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }  
}

function get_vote_by_id($id){
    global $connection;

    $safe_id = mysqli_real_escape_string($connection, $id);

    $query  = "SELECT * ";
    $query .= "FROM vote ";
    $query .= "WHERE id = '{$safe_id}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);  
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }  
}

function login_check() {
    if(!isset($_SESSION['google_id']) || empty($_SESSION['google_id'])){
        $string = "";
        if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])){
            $string = "?" . $_SERVER['QUERY_STRING'];
        }
        $_SESSION['redirect'] = $_SERVER['PHP_SELF'] . $string;
        redirect_to("/google?page=" . $_SERVER['PHP_SELF']);
    }
}

function admin_check() {
    $user = get_user_by_google_id($_SESSION['google_id']);
    if($user['access'] != 9){
        redirect_to("/index");
    }
}

function permission_check($i) {
    $user = get_user_by_google_id($_SESSION['google_id']);
    if($user['access'] < $i){
        redirect_to("/index");
    }
}

function confirm_query($result_set) {
    if (!$result_set) {
        die("Database query failed.");
    }
}

function find_CM_by_ID($id) {
    global $connection;

    $safe_id = mysqli_real_escape_string($connection, $id);

    $query  = "SELECT * ";
    $query .= "FROM cm ";
    $query .= "WHERE id = '{$safe_id}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }
}

function find_newsletter_by_email($email) {
    global $connection;

    $safe_email = mysqli_real_escape_string($connection, $email);

    $query  = "SELECT * ";
    $query .= "FROM newsletter ";
    $query .= "WHERE email = '{$safe_email}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }
}

function find_vote_by_id($id) {
    global $connection;

    $safe_id = mysqli_real_escape_string($connection, $id);

    $query  = "SELECT * ";
    $query .= "FROM vote ";
    $query .= "WHERE id = '{$safe_id}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }
}

function find_candidate_by_id($id) {
    global $connection;

    $safe_id = mysqli_real_escape_string($connection, $id);

    $query  = "SELECT * ";
    $query .= "FROM candidates ";
    $query .= "WHERE id = '{$safe_id}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }
}

function find_transaction_by_token($id) {
    global $connection;

    $safe_id = mysqli_real_escape_string($connection, $id);

    $query  = "SELECT * ";
    $query .= "FROM transactions ";
    $query .= "WHERE token = '{$safe_id}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }
}

function find_department_by_exec($id) {
    global $connection;

    $safe_id = mysqli_real_escape_string($connection, $id);

    $query  = "SELECT * ";
    $query .= "FROM departments ";
    $query .= "WHERE department = '{$safe_id}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }
}

function find_all_users() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM users ";
    $query .= "ORDER BY access ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_all_donations() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM donations ";
    $query .= "ORDER BY date DESC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_all_newsletters() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM newsletter ";
    $query .= "ORDER BY id ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_all_votes() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM vote ";
    $query .= "ORDER BY id DESC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_all_candidates() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM candidates ";
    $query .= "ORDER BY id DESC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_all_comments($id) {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM candidate{$id} ";
    $query .= "ORDER BY id ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_all_departments() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM departments ";
    $query .= "ORDER BY id ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_all_budgets() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM budget ";
    $query .= "ORDER BY id ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_all_fees() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM fees ";
    $query .= "ORDER BY id ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_all_transactions() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM transactions ";
    $query .= "ORDER BY transation_date ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_all_rents() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM rent ";
    $query .= "ORDER BY name ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_all_rent_extras() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM rent_extras ";
    $query .= "ORDER BY id ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getBaseUrl()
{
    if (PHP_SAPI == 'cli') {
        $trace=debug_backtrace();
        $relativePath = substr(dirname($trace[0]['file']), strlen(dirname(dirname(__FILE__))));
        echo "Warning: This sample may require a server to handle return URL. Cannot execute in command line. Defaulting URL to http://localhost$relativePath \n";
        return "http://localhost" . $relativePath;
    }
    $protocol = 'https';/*
    if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on')) {
        $protocol .= 's';
    }*/
    $host = $_SERVER['HTTP_HOST'];
    $request = $_SERVER['PHP_SELF'];
    return dirname($protocol . '://' . $host . $request);
}
//$_SESSION['name_update'] = true;
if(isset($_SESSION['name_update']) && $_SESSION['name_update'] == true){
    echo '<div class="process-overlay-dark"></div>';
    echo '<div class="update-name text-center"><h1>Update Profile Name</h1><p>Please enter your first and last name.</p><form action="data?form=nameUpdate" method="post" data-note="Name Update"><input type="text" name="name" autofocus><input type="submit" class="btn btn-sm" name="submit" value="Continue" /></div>';
    $_SESSION['name_update'] = false;
}

?>
