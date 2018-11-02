<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php
    session_start();

    // Actual Process
    if(isset($_REQUEST['logout'])){
        session_unset();
        redirect_to("/index");
    }

    if(!isset($_SESSION['redirect']) || empty($_SESSION['redirect'])){
        $_SESSION['redirect'] = "/index";
    }

    $_SESSION['google_id'] = "104908626036546174717";
    $_SESSION['name'] = "ryan.clayton@me.com";
    $_SESSION['email'] = "ryan.clayton@me.com";
    $_SESSION['profile_image_url'] = "https://lh6.googleusercontent.com/-lu8JuegU5aE/AAAAAAAAAAI/AAAAAAAAABI/QJTRHt6OOm4/photo.jpg?sz=50";
    $_SESSION['cover_image_url'] = "";
    $_SESSION['profile_url'] = "";

    $token = hash('ripemd160', date(date('mdYlhisa')));
    $_SESSION['token'] = $token;

    $user = get_user_by_google_id($_SESSION['google_id']);
    if($user){
        $_SESSION['name'] = $user['name'];
        $id = mysql_prep($_SESSION['google_id']);
        $email = mysql_prep($_SESSION['email']);
        $img = mysql_prep($_SESSION['profile_image_url']);
        $query  = "UPDATE users SET ";
        $query .= "token = '{$token}', ";
        $query .= "email = '{$email}', ";
        $query .= "img = '{$img}' ";
        $query .= "WHERE google_id = {$id} ";
        $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);
        if($result){
            if(preg_match("/.+@.+/",$user['name'])) {
                $_SESSION['name_update'] = true;
            }
            redirect_to($_SESSION['redirect']);
        } else {
            die($query);
        }
    }

    //redirect_to($_SESSION['redirect']);

    // = = = = = = = GOOGLE LOGIN BEGIN = = = = = = //

    // Defining
    require_once '../includes/vendor/autoload.php';
    const CLIENT_ID = '331373270274-5b3rm5laaop6in98p1lh6on7n1gsdv0h.apps.googleusercontent.com';
    const CLIENT_SECRET = 'uI2_TN5tf873dAUBl9SnTs3_';
    const REDIRECT_URI = 'https://utahtriangle.com/google.php';

    // Initializtion
    $client = new Google_Client();
    $client->setClientId(CLIENT_ID);
    $client->setClientSecret(CLIENT_SECRET);
    $client->setRedirectUri(REDIRECT_URI);
    $client->setScopes('email');

    $plus = new Google_Service_Plus($client);

    session_start();


    // Actual Process
    if(isset($_REQUEST['logout'])){
        session_unset();
    }

    if(isset($_GET['code'])){
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();
        //$redirect = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        if(isset($_SESSION['redirect']) && !empty($_SESSION['redirect'])){
            header("Location: " . $_SESSION['redirect']);
            exit;
        } else {
            header('Location: /admin');
            exit;
        }
    }

    if(isset($_SESSION['access_token'])){
        $client->setAccessToken($_SESSION['access_token']);
        $me = $plus->people->get('me');

        $_SESSION['google_id'] = $me['id'];
        if(!empty($me['displayName'])){
            $_SESSION['name'] = $me['displayName'];
        } else {
            $_SESSION['name'] = $me['emails'][0]['value'];
        }
        $_SESSION['email'] = $me['emails'][0]['value'];
        if(!empty($me['image']['url'])){
            $_SESSION['profile_image_url'] = $me['image']['url'];
        } else {
            $_SESSION['profile_image_url'] = "/assets/img/members/blank.png";
        }
        $_SESSION['cover_image_url'] = $me['cover']['coverPhoto']['url'];
        $_SESSION['profile_url'] = $me['url'];

        $user = get_user_by_google_id($_SESSION['google_id']);

        $token = hash('ripemd160', date(date('mdYlhisa')));
        $_SESSION['token'] = $token;
        if(!isset($_SESSION['redirect']) || empty($_SESSION['redirect'])){
            $_SESSION['redirect'] = "/index";
        }

        if($user){
            $_SESSION['name'] = $user['name'];
            $id = mysql_prep($_SESSION['google_id']);
            $email = mysql_prep($_SESSION['email']);
            $img = mysql_prep($_SESSION['profile_image_url']);
            $query  = "UPDATE users SET ";
            $query .= "token = '{$token}', ";
            $query .= "email = '{$email}', ";
            $query .= "img = '{$img}' ";
            $query .= "WHERE google_id = {$id} ";
            $query .= "LIMIT 1";
            $result = mysqli_query($connection, $query);
            if($result){
                if(preg_match("/.+@.+/",$user['name'])) {
                    $_SESSION['name_update'] = true;
                }
                redirect_to($_SESSION['redirect']);
            } else {
                //echo $query;
            }
        } else {
            $id = mysql_prep($_SESSION['google_id']);
            $name = mysql_prep($_SESSION['name']);
            $email = mysql_prep($_SESSION['email']);
            $img = mysql_prep($_SESSION['profile_image_url']);
            $query  = "INSERT INTO users (";
            $query .= "google_id, token, name, email, img";
            $query .= ") VALUES (";
            $query .= "{$id}, '{$token}', '{$name}', '{$email}', '{$img}'";
            $query .= ")";
            $result = mysqli_query($connection, $query);
            if($result){
                require_once("../includes/sendmail.php");
                require_once("../includes/phpMailer/class.phpmailer.php");
                require_once("../includes/phpMailer/class.smtp.php");
                require_once("../includes/phpMailer/language/phpmailer.lang-en.php");
                sendToRyan($name);
                redirect_to($_SESSION['redirect']);
            } else {
                //echo $query;
            }
        }


    } else {
        $authUrl = $client->createAuthUrl();
    }

    // = = = GOOGLE LOGIN FINISH = = = //


    if(isset($_GET['page']) && !empty($_GET['page'])){
        redirect_to($authUrl);
    } else {
        redirect_to('/index');
    }
