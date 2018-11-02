<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php
if(isset($_POST["dataID"])){

    if($_POST["dataID"] == "Master Budget Update"){
        login_check();
        permission_check(9);
        $departmentIDs = explode("|", $_POST['departmentIDs']);
        $i = 0;
        foreach($departmentIDs as &$value){
            $types = explode("|", $_POST['types']);
            $amounts = explode("|", $_POST['amounts']);
            $safe_type = mysql_prep($types[$i]);
            $safe_amount = mysql_prep($amounts[$i]);
            $safe_id = mysql_prep($value);
            $query  = "UPDATE departments SET ";
            $query .= "type = '{$safe_type}', ";
            $query .= "amount = '{$safe_amount}' ";
            $query .= "WHERE id = {$safe_id} ";
            $query .= "LIMIT 1";
            $result = mysqli_query($connection, $query);
            $i++;
        }
        echo "ok";
    }
    if($_POST["dataID"] == "Budget Update"){
        login_check();
        permission_check(9);
        $safe_department = mysql_prep($_POST['department']);
        $post_type_set = explode("|", $_POST['post_type']);
        $i = 0;
        foreach($post_type_set as &$value){
            $IDs = explode("|", $_POST['IDs']);
            $categories = explode("|", $_POST['categories']);
            $types = explode("|", $_POST['types']);
            $amounts = explode("|", $_POST['amounts']);
            if($value == "current"){
                $safe_id = mysql_prep($IDs[$i]);
                if($categories[$i] == ""){
                    $query  = "DELETE FROM budget WHERE id = '{$safe_id}'";
                    $result = mysqli_query($connection, $query);
                } else {
                    $safe_category = mysql_prep($categories[$i]);
                    $safe_type = mysql_prep($types[$i]);
                    $safe_amount = mysql_prep($amounts[$i]);
                    $query  = "UPDATE budget SET ";
                    $query .= "category = '{$safe_category}', ";
                    $query .= "type = '{$safe_type}', ";
                    $query .= "amount = '{$safe_amount}' ";
                    $query .= "WHERE id = {$safe_id} ";
                    $query .= "LIMIT 1";
                    $result = mysqli_query($connection, $query);
                }
            } else {
                if(isset($categories[$i]) && !empty($categories[$i])){
                    $safe_id = mysql_prep($IDs[$i]);
                    $safe_category = mysql_prep($categories[$i]);
                    $safe_type = mysql_prep($types[$i]);
                    $safe_amount = mysql_prep($amounts[$i]);
                    $query  = "INSERT INTO budget (";
                    $query .= "	department, category, type, amount";
                    $query .= ") VALUES (";
                    $query .= "'{$safe_department}', '{$safe_category}', '{$safe_type}', '{$safe_amount}'";
                    $query .= ")";
                    $result = mysqli_query($connection, $query);
                }
            }
            $i++;
        }
        echo "ok";
    }

    if($_POST["dataID"] == "Access Update"){

        // User Check
        if(isset($_SESSION['google_id']) && !empty($_SESSION['google_id'])){
            $user = get_user_by_google_id($_SESSION['google_id']);

            // Check Token
            //if($user['token'] == $_SESSION['token']){

                // Admin Check
                if($user['access'] == 9){
                    $id = mysql_prep($_POST['user']);
                    $temp_user = get_user_by_id($id);
                    $access = mysql_prep($_POST['access']);
                    $query  = "UPDATE users SET ";
                    $query .= "access = '{$access}' ";
                    $query .= "WHERE id = {$id} ";
                    $query .= "LIMIT 1";
                    $result = mysqli_query($connection, $query);

                    $name = $temp_user['name'];
                    $google_id = $temp_user['google_id'];
                    $email = $temp_user['email'];
                    $membership = $_POST['membership'];


                    if(!isset($_SESSION["{$google_id}"]) || empty($_SESSION["{$google_id}"])){
                        $_SESSION["{$google_id}"] = "";
                    }

                    if($_SESSION["{$google_id}"] != $membership){
                        $_SESSION["{$google_id}"] = $membership;
                        if($access != 0){
                            require_once("../includes/sendmail.php");
                            require_once("../includes/phpMailer/class.phpmailer.php");
                            require_once("../includes/phpMailer/class.smtp.php");
                            require_once("../includes/phpMailer/language/phpmailer.lang-en.php");
                            membershipChange($name, $email, $membership);
                            if(!$result){
                                echo "There was an Error.";
                            }
                        }
                    }

                } else {
                    echo "Invalid User.";
                }
            /*} else {
                echo "Invalid User.";
            }*/
        } else {
            echo "Invalid User.";
        }
    }

    if($_POST["dataID"] == "Election Details"){
        $vote = get_vote_by_id($_POST['id']);
        $i = 0;
        foreach($vote as $key => $value){
            if($i == 0){
                echo $value;
            } else {
                if($key == "people"){
                    echo "&SPLIT;";
                    $candidate_ids = explode(",", $value);
                    $c = 0;
                    foreach($candidate_ids as $candidate){
                        if(strpos($candidate, "-") !== false){
                            $remove_votes = explode("-", $candidate);
                            $candidate = $remove_votes[0];
                        }
                        $temp_candidate = find_candidate_by_id($candidate);
                        if($c !== 0){
                            echo "&CAND;";
                        }
                        $build = $temp_candidate['id'];
                        $build .= "&INFO;";
                        $build .= $temp_candidate['name'];
                        $build .= "&INFO;";
                        $build .= $temp_candidate['description'];
                        $build .= "&INFO;";
                        $build .= $temp_candidate['picture'];
                        $build .= "&INFO;";
                        echo $build;
                        $c++;
                    }
                } else {
                    echo "&SPLIT;" . $value;
                }
            }
            $i++;
        }
    }

    if($_POST["dataID"] == "voteComment"){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $id = mysql_prep($_POST['id']);
            $comment = mysql_prep($_POST['comment']);
            $user_id = $_SESSION['google_id'];
            $date = date('m/d h:i A');

            $query  = "INSERT INTO candidate{$id} (";
            $query .= "	comment, user_id, date";
            $query .= ") VALUES (";
            $query .= "'{$comment}', '{$user_id}', '{$date}'";
            $query .= ")";
            $result = mysqli_query($connection, $query);
            if($result){
                echo "ok";
            } else {
                $_SESSION['message'] = "Oh know! There seems to have been an error, please try again.";
                //redirect_to("/admin");
                //echo $query;
            }
        }
    }

}

if(isset($_POST['submit'])){
    if(isset($_GET['board']) && !empty($_GET['board'])){
        $board = $_GET['board'];
        if($board == "rec"){ $col = "recruitment"; }
        if($board == "pres"){ $col = "president"; }
        if($board == "vp"){ $col = "vicePresident"; }
        if($board == "ia"){ $col = "brotherhood"; }
        if($board == "admin"){ $col = "administration"; }
        if($board == "tre"){ $col = "treasury"; }
        if($board == "ea"){ $col = "externalAffairs"; }
        if($board == "pn"){ $col = "presidentNote"; }
        $body = mysql_prep($_POST['body']);
        $popup_title = mysql_prep($_POST['popup-title']);
        $popup_body = mysql_prep($_POST['popup-body']);
        $query  = "UPDATE cm SET {$col} = '{$body}' WHERE id = 1 LIMIT 1";
        mysqli_query($connection, $query);
        $query  = "UPDATE cm SET {$col} = '{$popup_title}' WHERE id = 3 LIMIT 1";
        mysqli_query($connection, $query);
        $query  = "UPDATE cm SET {$col} = '{$popup_body}' WHERE id = 4 LIMIT 1";
        mysqli_query($connection, $query);
        echo "ok";
    }

    if(isset($_GET['form']) && !empty($_GET['form'])){

        if($_GET['form'] == "approval"){
            if(isset($_GET['token']) && !empty($_GET['token'])){
                $transaction = find_transaction_by_token($_GET['token']);
                if($transaction){
                    $safe_token = mysql_prep($_GET['token']);
                    $query  = "DELETE FROM transactions WHERE token = '{$safe_token}'";
                    $result = mysqli_query($connection, $query);
                    if($result){
                        require_once("../includes/sendmail.php");
                        require_once("../includes/phpMailer/class.phpmailer.php");
                        require_once("../includes/phpMailer/class.smtp.php");
                        require_once("../includes/phpMailer/language/phpmailer.lang-en.php");
                        sendTransactionToReject($transaction['name'], $transaction['email'], $transaction['phone'], $transaction['transation_date'], $transaction['expense'], $transaction['merchant'], $transaction['department'], $transaction['category'], $transaction['description'], $transaction['account'], $transaction['documentation'], $_POST['reason']);
                        $_SESSION["success"] = "Reimbursement Rejected";
                        die("ok");
                   } else {
                        $_SESSION["message"] = "Oh darn, we seem to have encountered an error.  Please contact treasury@utahtriangle.com.";
                        redirect_to("/transactions");
                    }
                }
            }
        }
        if($_GET['form'] == "nameUpdate"){
            $id = $_SESSION['google_id'];
            $name = mysql_prep($_POST['name']);
            $query  = "UPDATE users SET ";
            $query .= "name = '{$name}' ";
            $query .= "WHERE google_id = {$id} ";
            $query .= "LIMIT 1";
            mysqli_query($connection, $query);
            $_SESSION['name'] = $name;
            echo "ok";
        }

        if($_GET['form'] == "newsletter"){
            $email = mysql_prep($_POST['NewsletterEmail']);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_check = find_newsletter_by_email($email);
                if(!$email_check){
                    $query  = "INSERT INTO newsletter (";
                    $query .= "email";
                    $query .= ") VALUES (";
                    $query .= "'{$email}'";
                    $query .= ")";
                    $result = mysqli_query($connection, $query);
                    if($result){
                        echo "ok";
                    } else {
                        echo "An error occured. Please try again later.";
                    }
                } else {
                    echo "Email address is already subscribed to our newsletter.";
                }
            }
        }
        if($_GET['form'] == "election"){
            $group = array();
            if($_POST['Non-affiliates'] == "true"){array_push($group, 0); }
            if($_POST['PNMs'] == "true"){array_push($group, 1); }
            if($_POST['Alumnis'] == "true"){array_push($group, 3); }
            if($_POST['Pledges'] == "true"){array_push($group, 5); }
            if($_POST['Actives'] == "true"){array_push($group, 6); }
            $groups = "";
            foreach($group as $id){
                if($groups == ""){
                    $groups .= $id;
                } else {
                    $groups .= ",".$id;
                }
            }

            $type = mysql_prep($_POST['election-type']);
            $title = mysql_prep($_POST['election-name']);
            $body = mysql_prep($_POST['election-body']);
            $comments = mysql_prep($_POST['candidate_discussion']);
            if($comments == "1"){
                $comments = 1;
            } else {
                $comments = 0;
            }

            $people = mysql_prep($_POST['people']);
            $description = mysql_prep($_POST['description']);
            $picture = mysql_prep($_POST['picture']);

            $array = explode(",", $people);
            $description_array = explode(",", $description);
            $picture_array = explode(",", $picture);
            $index = 0;
            $error = false;
            foreach($array as &$value){
                if(!empty($value)){
                    $id = generateRandomString(15);
                    if(empty($people_IDs)){
                        $people_IDs = $id;
                    } else {
                        $people_IDs = $people_IDs . "," . $id;
                    }

                    if(!empty($description)){
                        $desc = $description_array[$index];
                    } else {
                        $desc = null;
                    }
                    if(!empty($picture)){
                        $pic = $picture_array[$index];
                    } else {
                        $pic = null;
                    }

                    $query  = "INSERT INTO candidates (";
                    $query .= "	id, name, description, picture";
                    $query .= ") VALUES (";
                    $query .= "'{$id}', '{$value}', '{$desc}', '{$pic}'";
                    $query .= ")";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        $error = true;
                        echo "Oh know! There seems to have been an error, please try again.";
                        exit;
                    }

                    $query = "CREATE TABLE `candidate{$id}` ( `id` INT NOT NULL AUTO_INCREMENT , `comment` TEXT NOT NULL , `user_id` VARCHAR(75) NOT NULL , `date` VARCHAR(75) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;";
                    mysqli_query($connection, $query);

                }
                $index++;
            }
            //echo $query;
            if($error){
               // $_SESSION['message'] = "Oh know! There seems to have been an error, please try again.";
                //redirect_to("/admin");
            } else {
                $query  = "INSERT INTO vote (";
                $query .= "	title, type, body, people, groups, comments";
                $query .= ") VALUES (";
                $query .= "'{$title}', '{$type}', '{$body}', '{$people_IDs}', '{$groups}', '{$comments}'";
                $query .= ")";
                $result = mysqli_query($connection, $query);
                if($result){
                    echo "ok";
                } else {
                    //$_SESSION['message'] = "Oh know! There seems to have been an error, please try again.";
                    //redirect_to("/admin");
                    echo $query;
                }
            }
        }

        if($_GET['form'] == "income"){
            $income_name = mysql_prep($_POST['income_name']);
            $income_date = mysql_prep($_POST['income_date']);
            $income_amount = mysql_prep($_POST['income_amount']);
            $income_merchant = mysql_prep($_POST['income_merchant']);
            $income_department = mysql_prep($_POST['income_department']);
            $income_category = mysql_prep($_POST['income_type']);
            $income_description = mysql_prep($_POST['income_description']);
            $income_method = mysql_prep($_POST['income_method']);

            if(empty($income_department)){
                $income_department = "General";
            }

            $file_path = mysql_prep($_POST['file_path']);

            $income_date = new DateTime($income_date);
            $unix_timestamp = $income_date->getTimestamp();
            $mysql_timestamp = date('Y-m-d H:i:s',$unix_timestamp);
            $date_now = date('Y-m-d H:i:s');

            $currency_clean = preg_replace("/\\$/", "", $income_amount);

            login_check();
            permission_check(9);

            $query  = "INSERT INTO transactions (";
            $query .= "	transation_date, income, department, category, merchant, name, description, documentation, account, 	treasury_status";
            $query .= ") VALUES (";
            $query .= " '{$mysql_timestamp}', '{$currency_clean}', '{$income_department}', '{$income_category}', '{$income_merchant}', '{$income_name}', '{$income_description}', '{$file_path}', '{$income_method}', '{$date_now}'";
            $query .= ")";
            $result = mysqli_query($connection, $query);
            if($result){
                echo "ok";
            } else {
                //$_SESSION['message'] = "Oh know! There seems to have been an error, please try again.";
                //redirect_to("/admin");
                echo "Oh know! There seems to have been an error, please try again.";
            }
        }

        if($_GET['form'] == "reimbursement"){
            $reimbursement_name = mysql_prep($_POST['reimbursement_name']);
            $reimbursement_email = mysql_prep($_POST['reimbursement_email']);
            $reimbursement_phone = mysql_prep($_POST['reimbursement_phone']);
            $transaction_date = mysql_prep($_POST['transaction_date']);
            $transaction_amount = mysql_prep($_POST['transaction_amount']);
            $transaction_merchant = mysql_prep($_POST['transaction_merchant']);
            $transaction_department = mysql_prep($_POST['transaction_department']);
            $transaction_category = mysql_prep($_POST['transaction_category']);
            $transaction_description = mysql_prep($_POST['transaction_description']);
            $refund_method = mysql_prep($_POST['refund_method']);
            $venmo = mysql_prep($_POST['refund_venmo']);
            $token = generateRandomString(50);

            $file_path = mysql_prep($_POST['file_path']);

            $transaction_date = new DateTime($transaction_date);
            $unix_timestamp = $transaction_date->getTimestamp();
            $mysql_timestamp = date('Y-m-d H:i:s',$unix_timestamp);

            $currency_clean = preg_replace("/\\$/", "", $transaction_amount);

            login_check();
            permission_check(5);

            $query  = "INSERT INTO transactions (";
            $query .= "	transation_date, expense, department, category, merchant, name, email, phone, description, documentation, account, venmo, token";
            $query .= ") VALUES (";
            $query .= " '{$mysql_timestamp}', '{$currency_clean}', '{$transaction_department}', '{$transaction_category}', '{$transaction_merchant}', '{$reimbursement_name}', '{$reimbursement_email}', '{$reimbursement_phone}', '{$transaction_description}', '{$file_path}', '{$refund_method}', '{$venmo}', '{$token}'";
            $query .= ")";
            $result = mysqli_query($connection, $query);
            if($result){
                require_once("../includes/sendmail.php");
                require_once("../includes/phpMailer/class.phpmailer.php");
                require_once("../includes/phpMailer/class.smtp.php");
                require_once("../includes/phpMailer/language/phpmailer.lang-en.php");
                sendTransactionToDepartment($reimbursement_name, $reimbursement_email, $reimbursement_phone, $unix_timestamp, $transaction_amount, $transaction_merchant, $transaction_department, $transaction_category, $transaction_description, $refund_method, $file_path, $token);
                echo "ok";
            } else {
                //$_SESSION['message'] = "Oh know! There seems to have been an error, please try again.";
                //redirect_to("/admin");
                echo "Oh know! There seems to have been an error, please try again.";
            }
        }

        if($_GET['form'] == "vote"){
            if(isset($_GET['id']) && !empty($_GET['id'])){
                if(isset($_POST['order']) && !empty($_POST['order'])){
                    $index = 0;
                    $id = $_GET['id'];
                    $vote = get_vote_by_id($id);
                    $people = explode("," , $vote['people']);
                    $names = explode(",", mysql_prep($_POST['order']));
                    $post = "";

                    $user = get_user_by_google_id($_SESSION['google_id']);
                    $access_array = explode(",", $vote['groups']);
                    $access = false;
                    foreach($access_array as &$value){
                        if($user['access'] == $value){
                            $access = true;
                        }
                    }
                    if($user['access'] == 9){ $access = true; }

                    $vote_array = explode(",", $vote['users']);
                    $voted = false;
                    foreach($vote_array as &$value){
                        if($user['google_id'] == $value){
                            $voted = true;
                        }
                    }
                    if($access == false){
                        echo "You do not have acces to vote in this election.";
                    } else if($voted == true){
                        echo "You have already voted in this election";
                    } else {
                        foreach($people as &$value){
                            $rawName = explode("-", $value);
                            $previousVotes = "-";
                            if(isset($rawName[1])){ $previousVotes = "-" . $rawName[1] . "|"; }
                            $baseName = $rawName[0];
                            $num = 1;
                            foreach($names as &$name){
                                if($_POST['formType'] == "binary"){
                                    $binary_array = explode("-", $name);
                                    $binary_name = $binary_array[0];
                                    if(isset($binary_array[1])){
                                        $num = $binary_array[1];
                                    }
                                    if($binary_name == $baseName){
                                        if($post == ""){
                                            $post .= $binary_name.$previousVotes.$num;
                                        } else {
                                            $post .= ",".$binary_name.$previousVotes.$num;
                                        }
                                    }
                                } else {
                                    if($name == $baseName){
                                        if($post == ""){
                                            $post .= $name.$previousVotes.$num;
                                        } else {
                                            $post .= ",".$name.$previousVotes.$num;
                                        }
                                    }
                                }
                            $index++;
                            $num++;
                            }
                        }
                        // USER Insert
                        $cuurentUsers = $vote['users'];
                        if($cuurentUsers == ""){
                            $user = $_SESSION['google_id'];
                        } else {
                            $user = $cuurentUsers . "," . $_SESSION['google_id'];
                        }

                        $query  = "UPDATE vote SET ";
                        $query .= "people = '{$post}', ";
                        $query .= "users = '{$user}' ";
                        $query .= "WHERE id = {$id} ";
                        $query .= "LIMIT 1";
                        $result = mysqli_query($connection, $query);
                        if($result){
                            echo "ok";
                        } else {
                            $_SESSION['message'] = "Oh know! There seems to have been an error, please try again.";
                            redirect_to("/index");
                            //echo $query;
                        }
                    }
                } else {
                    echo "You need to vote for at least on candidate.";
                }
            }
        }
        
        if($_GET['form'] == "setRent"){
            
            //upate existing rent
            $rent_set = find_all_rents();
            while($rent = mysqli_fetch_assoc($rent_set)) {
                $name = mysql_prep($_POST['name_' . $rent['id']]);
                $price = mysql_prep($_POST['price_' . $rent['id']]);
                $adjust = mysql_prep($_POST['adjust_' . $rent['id']]);
                $user = mysql_prep($_POST['user_' . $rent['id']]);

                $query  = "UPDATE rent SET ";
                $query .= "name = '{$name}', ";
                $query .= "price = '{$price}', ";
                $query .= "adjust = '{$adjust}', ";
                $query .= "user = '{$user}' ";
                $query .= "WHERE id = {$rent['id']} ";
                $query .= "LIMIT 1";
                $result = mysqli_query($connection, $query);
                if($result){
                    echo "ok";
                } else {
                    die($query);
                }
            } mysqli_data_seek($rent_set, 0);
            
            //add new rent
            if(isset($_POST['new_name']) && !empty($_POST['new_name'])){
                $name = mysql_prep($_POST['new_name']);
                $price = mysql_prep($_POST['new_price']);
                $user = mysql_prep($_POST['new_user']);
                $adjust = mysql_prep($_POST['new_adjust']);
                
                if(empty($price)){
                    $price = 0.00;
                }
                if(empty($adjust)){
                    $adjust = 0.00;
                }
            
                $query  = "INSERT INTO rent (";
                $query .= "name, price, adjust, user";
                $query .= ") VALUES (";
                $query .= "'{$name}', '{$price}', '{$adjust}', '{$user}'";
                $query .= ");";
                $result = mysqli_query($connection, $query);
                if($result){
                    echo "ok";
                } else {
                    die($query);
                }
            }
            
            //update existing extras
            $rent_extras_set = find_all_rent_extras();
            while($rent_extras = mysqli_fetch_assoc($rent_extras_set)) {
                $name = mysql_prep($_POST['extra_name_' . $rent_extras['id']]);
                $price = mysql_prep($_POST['extra_price_' . $rent_extras['id']]);

                $query  = "UPDATE rent_extras SET ";
                $query .= "name = '{$name}', ";
                $query .= "price = '{$price}' ";
                $query .= "WHERE id = {$rent_extras['id']} ";
                $query .= "LIMIT 1";
                $result = mysqli_query($connection, $query);
                if($result){
                    echo "ok";
                } else {
                    die($query);
                }
            }
            
            //add existing extras
            if(isset($_POST['extra_new_name']) && !empty($_POST['extra_new_name'])){
                $name = mysql_prep($_POST['extra_new_name']);
                $price = mysql_prep($_POST['extra_new_price']);
                
                if(empty($price)){
                    $price = 0.00;
                }
            
                $query  = "INSERT INTO rent_extras (";
                $query .= "name, price";
                $query .= ") VALUES (";
                $query .= "'{$name}', '{$price}'";
                $query .= ");";
                $result = mysqli_query($connection, $query);
                if($result){
                    echo "ok";
                } else {
                    die($query);
                }
            }
            
            //post rent
            if(isset($_GET['post']) && !empty($_GET['post'])){
                //create invoice
                $month = mysql_prep($_POST['month']);
                $year = mysql_prep($_POST['year']);
                $notes = mysql_prep($_POST['notes']);

                $due_date = $month . "/5/" . $year;

                $query  = "INSERT INTO invoice (";
                $query .= "due_date, notes";
                $query .= ") VALUES (";
                $query .= "'{$due_date}', '{$notes}'";
                $query .= ");";
                $result = mysqli_query($connection, $query);
                if($result){
                    //get insert id
                    $last_id = $connection->insert_id;
                } else {
                    die($query);
                }
                
                $query  = "UPDATE rent SET ";
                $query .= "invoice_id = '{$last_id}', ";
                $query .= "paid = NULL";
                $result = mysqli_query($connection, $query);
                if($result){
                    echo "ok";
                } else {
                    die($query);
                }
                
                while($rent = mysqli_fetch_assoc($rent_set)) {
                    $temp_user = get_user_by_google_id($rent['user']);
                    if($temp_user){
                        require_once("../includes/sendmail.php");
                        require_once("../includes/phpMailer/class.phpmailer.php");
                        require_once("../includes/phpMailer/class.smtp.php");
                        require_once("../includes/phpMailer/language/phpmailer.lang-en.php");
                        sendRent($temp_user['name'], $temp_user['email'], $rent['price']);
                    }
                } mysqli_data_seek($rent_set, 0);
                
            }
        }
    }
}

if(isset($_GET['newsletter']) && !empty($_GET['newsletter'])){
    if($_GET['newsletter'] == "download"){
        $email_set = find_all_newsletters();
        $emails = array();
        while($email = mysqli_fetch_assoc($email_set)) {
            $row = array($email['email']);
            array_push($emails, $row);
        }

        $fp = fopen('newsletter-emails.csv', 'w');

        foreach ($emails as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);
        $_SESSION['newsletter-file'] = "true";
        redirect_to("newsletter-emails.csv");
    }
}

if(isset($_GET['form']) && !empty($_GET['form'])){
    if($_GET['form'] == "deleteAccount"){
        if(isset($_GET['token']) && !empty($_GET['token'])){
            if($_SESSION['token'] == $_GET['token']){
                $query  = "DELETE FROM users WHERE google_id = '{$_SESSION['google_id']}'";
                $result = mysqli_query($connection, $query);
                if($result){
                    $_SESSION['success'] = "Account has been deleted.";
                    redirect_to("/google?logout");
                } else {
                    $_SESSION['message'] = "Oh no, something went wrong.. we were unable to process your request.  Please try again later or contact us at info@utahtriangle.com";
                    redirect_to("/member");
                }
            } else {
                $_SESSION['message'] = "Oh no, something went wrong.. we were unable to process your request.  Please try again later or contact us at info@utahtriangle.com";
                redirect_to("/member");
            }
        } else {
            $_SESSION['message'] = "Oh no, something went wrong.. we were unable to process your request.  Please try again later or contact us at info@utahtriangle.com";
            redirect_to("/member");
        }
    }
    if($_GET['form'] == "donate"){
        $donate_budget = mysql_prep($_POST["donate_budget"]);
        $amount = floatval("{$_POST["donate_amount"]}");
        $donate_amount = number_format($amount,2,'.','');
        $donate_recurring = mysql_prep($_POST["donate_recurring"]);
        $donate_recurring_type = mysql_prep($_POST["donate_recurring_type"]);
        $donate_recurring_number = mysql_prep($_POST["donate_recurring_number"]);
        $donate_name = mysql_prep($_POST["donate_name"]);
        $donate_email = mysql_prep($_POST["donate_email"]);
        $doante_affiliation = mysql_prep($_POST["doante_affiliation"]);
        $donate_chater = mysql_prep($_POST["donate_chater"]);
        $donate_budget_other = mysql_prep($_POST["donate_budget_other"]);
        $comments = mysql_prep($_POST["comments"]);

        $_SESSION['cycles'] = $donate_recurring_number;
        $_SESSION['total'] = $donate_amount;
        $_SESSION['recurring_type'] = $donate_recurring_type;

        $_SESSION['donation_data'] = "{$donate_budget}|{$donate_amount}|{$donate_recurring}|{$donate_recurring_type}|{$donate_recurring_number}|{$donate_name}|{$donate_email}|{$doante_affiliation}|{$donate_chater}|{$donate_budget_other}|{$comments}";

        if($donate_recurring == "yes"){
            $sessionEnd = time() + 2592000;
            $_SESSION['sessionEnd'] = $sessionEnd;
            require("paypal/CreateBillingAgreementWithPayPal.php");
            $payment = CreateBillingAgreementWithPayPal($donate_budget, $donate_amount);
            print "<pre>";
            print_r($_SESSION);
            print "/<pre>";
        } else {
            require("paypal/CreatePaymentUsingPayPal.php");
            $payment = CreatePaymentUsingPayPal($donate_budget, $donate_amount);
        }
        if($payment != false){
            redirect_to($payment);
        }
    }
    if($_GET['form'] == "MemberAgreement"){
        $_SESSION['agreement_type'] = $_GET['type'];
        $_SESSION['legal_name'] = $_GET['name'];
        if($_GET['type'] == "15Day"){
            $date = date('m-d-Y h:i:sA T');
            $name = $_SESSION['legal_name'];
            $email = $_SESSION['email'];
            require_once("../includes/sendmail.php");
            require_once("../includes/phpMailer/class.phpmailer.php");
            require_once("../includes/phpMailer/class.smtp.php");
            require_once("../includes/phpMailer/language/phpmailer.lang-en.php");
            sendAgreement($date, $name, $email);
            $_SESSION['success'] = "Agreement has been recorded!";
            unset($_SESSION['donation']);
            redirect_to("/index");
        }
        if($_GET['type'] == "60Day"){
            $_SESSION['agreement_name'] = "Utah Triangle Membership Fee";
            $donate_budget = "Membership";
            $total = 10;
            require("paypal/CreatePaymentUsingPayPal.php");
            $payment = CreatePaymentUsingPayPal($donate_budget, $total);
            if($payment != false){
                redirect_to($payment);
            }
        }
        if($_GET['type'] == "Monthly"){
            $sessionEnd = time() + 2592000;
            $_SESSION['sessionEnd'] = $sessionEnd;
            $_SESSION['cycles'] = 3;
            $_SESSION['total'] = 155;
            $_SESSION['recurring_type'] = "Monthly";
            $_SESSION['agreement_name'] = "Utah Triangle Membership Fee";
            require("paypal/CreateBillingAgreementWithPayPal.php");
            $payment = CreateBillingAgreementWithPayPal();
            if($payment != false){
                redirect_to($payment);
            }
        }
    }
}

if(isset($_GET['agreement']) && !empty($_GET['agreement'])){
    if($_SESSION['agreement'] == true){
        unset($_SESSION['paymentID']);
        unset($_SESSION['PayerID']);
        unset($_SESSION['paymentToken']);
        unset($_SESSION['token']);
        $date = date('m-d-Y h:i:sA T');
        $name = $_SESSION['legal_name'];
        $email = $_SESSION['email'];
        require_once("../includes/sendmail.php");
        require_once("../includes/phpMailer/class.phpmailer.php");
        require_once("../includes/phpMailer/class.smtp.php");
        require_once("../includes/phpMailer/language/phpmailer.lang-en.php");
        sendAgreement($date, $name, $email);
        $_SESSION['success'] = "Agreement has been set up!";
        unset($_SESSION['donation']);
        redirect_to("/index");
    }
}

if(isset($_GET['rent']) && !empty($_GET['rent'])){
    if($_SESSION['agreement'] == true){
        
        $query  = "UPDATE rent SET ";
        $query .= "paid = CURRENT_TIMESTAMP ";
        $query .= "WHERE id = {$_SESSION['rent_id']} ";
        $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);
        
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        require_once("../includes/sendmail.php");
        require_once("../includes/phpMailer/class.phpmailer.php");
        require_once("../includes/phpMailer/class.smtp.php");
        require_once("../includes/phpMailer/language/phpmailer.lang-en.php");
        sendRentReceipt($name, $email);
        $_SESSION['success'] = "Thank you for your payment!";
        redirect_to("/rent");
    }
}

if(isset($_GET['donation']) && !empty($_GET['donation'])){
    if($_SESSION['donation'] == true){
        unset($_SESSION['paymentID']);
        unset($_SESSION['PayerID']);
        unset($_SESSION['paymentToken']);
        unset($_SESSION['token']);
        $data = explode("|", $_SESSION['donation_data']);

        if(isset($_SESSION['google_id']) && !empty($_SESSION['google_id'])){
            $id = mysql_prep($_SESSION['google_id']);
        } else {
            $id = -1;
        }
        $date = date('m-d-Y h:i:sA T');
        $name = $data[5];
        $email = $data[6];
        $budget = $data[0];
        $amount = $data[1];
        $affiliation = $data[7];
        $chapter = $data[8];
        if($data[2] == "yes"){
            if($data[3] == "Monthly"){
                $recurring_type = 1;
            $recurring = "Monthly";
            } else {
                $recurring_type = 2;
            $recurring = "Annually";
            }
        } else {
            $recurring_type = 0;
            $recurring = "One-time";
        }
        $recurring_int = $data[4];

        if(!empty($data[9])){
            $use = "Money Use: " . $data[9] . "; ";
        } else {
            $use = "";
        }
        $comments = $use.$data[10];
        $query  = "INSERT INTO donations (";
        $query .= "user_id, date, name, email, affiliation, chapter, budget, amount, recurring_type, recurring_int, comments";
        $query .= ") VALUES (";
        $query .= "{$id}, '{$date}', '{$name}', '{$email}', '{$affiliation}', '{$chapter}', '{$budget}', '{$amount}', {$recurring_type}, {$recurring_int}, '{$comments}'";
        $query .= ")";
        $result = mysqli_query($connection, $query);
        if($result){
            require_once("../includes/sendmail.php");
            require_once("../includes/phpMailer/class.phpmailer.php");
            require_once("../includes/phpMailer/class.smtp.php");
            require_once("../includes/phpMailer/language/phpmailer.lang-en.php");
            sendDonation($date, $name, $email, $affiliation, $chapter, $budget, $recurring, $recurring_int, $amount, $comments);
            $_SESSION['success'] = "Thank you for your donation!";
            unset($_SESSION['donation']);
            redirect_to("/index");
        } else {
            $_SESSION['message'] = "Oh know! There seems to have been an error, please try again.";
            redirect_to("/index");
            //echo $query;
        }
    }
}
?>
