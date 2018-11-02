<?php

session_start();

// SESSION TIMEOUT

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


/*if (!isset($_SESSION["history"])) {
    $_SESSION["history"] = "<br>START";
}
if (!isset($_SESSION["last_page"])) {
    $_SESSION["last_page"] = null;
}


$last_page = $_SESSION['last_page'];
$page = basename($_SERVER['REQUEST_URI']);

if( $last_page !== $page ) {
    $_SESSION["history"] = $_SESSION["history"] . " -> " . $page;
}
$_SESSION['last_page'] = $page;
echo $_SESSION["history"];*/


function message() {
    if (isset($_SESSION["message"])) {
        $output = "<div id=\"toast-container\" class=\"toast-top-full-width\"><div class=\"toast toast-error\"><div class=\"toast-message\">";
        $output .= htmlentities($_SESSION["message"]);
        $output .= "</div></div></div>";

        // clear message after use
        $_SESSION["message"] = null;

        return $output;
    }
    if (isset($_SESSION["success"])) {
        $output = "<div id=\"toast-container\" class=\"toast-top-full-width\"><div class=\"toast toast-success\"><div class=\"toast-message\">";
        $output .= $_SESSION["success"];
        $output .= "</div></div></div>";

        // clear message after use
        $_SESSION["success"] = null;

        return $output;
    }
}

function errors() {
    if (isset($_SESSION["errors"])) {
        $errors = $_SESSION["errors"];

        // clear message after use
        $_SESSION["errors"] = null;

        return $errors;
    }
}

?>
