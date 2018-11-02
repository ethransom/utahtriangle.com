<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php login_check() ?>
<?php admin_check() ?>
<?php 
    $CM_primary = find_CM_by_ID(1);
    $CM_link = find_CM_by_ID(2);
    $CM_popup_title = find_CM_by_ID(3);
    $CM_popup_body = find_CM_by_ID(4);
    $user_set = find_all_users();
    $email_set = find_all_newsletters();
    $vote_set = find_all_votes();
    $candidate_set = find_all_candidates();
    $donate_set = find_all_donations();

    if(isset($_GET['type']) && !empty($_GET['type'])){
        if($_GET['type'] == "deleteElection"){
            $id = mysql_prep($_GET['eID']);
            $vote = get_vote_by_id($id);
            $people_array = explode(",", $vote['people']);
            foreach($people_array as &$people){
                $person_array = explode("-", $people);
                $candidate_id = $person_array[0];
                $query  = "DELETE FROM candidates WHERE id = '{$candidate_id}'";
                mysqli_query($connection, $query);
                $query  = "DROP TABLE `candidate{$candidate_id}`";
                mysqli_query($connection, $query);
                echo $query;
            }
            $query  = "DELETE FROM vote WHERE id = '{$id}'";
            $result = mysqli_query($connection, $query);
            if($result){
                redirect_to("/admin");
            } else {
                echo $query;
            }
        }
        if($_GET['type'] == "closeElection"){
            $db_vote = get_vote_by_id($_GET['eID']);
            $vote_raw_array = explode(",", $db_vote['people']);
            if($db_vote['type'] == 0){
                $results = array();
                $error = false;
                foreach($vote_raw_array as &$valueA){
                    $num = 0;
                    $pass = 0;
                    $deny = 0;
                    $name_points_array = explode("-", $valueA);
                    if(!isset($name_points_array[1])){
                        $_SESSION['message'] = "No votes, can not close election.";
                        redirect_to("/admin");
                    }
                    $points_array = explode("|", $name_points_array[1]);
                    $array = array_count_values($points_array);
                    foreach($array as $keyB => $valueB){
                        $num = $num + $valueB;
                        if($keyB === 1){
                            $pass = $pass + $valueB;
                        }
                        if($keyB === 0){
                            $deny = $deny + $valueB;
                        }
                    }
                    $result = $pass / $num;
                    $id = mysql_prep($name_points_array[0]);
                    $winner = mysql_prep($result);
                    $query  = "UPDATE candidates SET ";
                    $query .= "approve = '{$pass}', ";
                    $query .= "deny = '{$deny}', ";
                    $query .= "votes = '{$num}', ";
                    $query .= "result = '{$result}' ";
                    $query .= "WHERE id = '{$id}' ";
                    $query .= "LIMIT 1";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        $error = true;
                    }
                }
                if($result){
                    $id = mysql_prep($_GET['eID']);
                    $query  = "UPDATE vote SET ";
                    $query .= "result = 'COMPLETE' ";
                    $query .= "WHERE id = {$id} ";
                    $query .= "LIMIT 1";
                    $result = mysqli_query($connection, $query);
                    if($result){
                        redirect_to("/admin");
                    } else {
                        $_SESSION['message'] = "Oh know! There seems to have been an error, please try again.";
                        redirect_to("/admin");
                    }
                } else {
                    $_SESSION['message'] = "Oh know! There seems to have been an error, please try again.";
                    redirect_to("/admin");
                }
            } else {
                $results = array();
                foreach($vote_raw_array as &$valueA){
                    $num = 0;
                    $name_points_array = explode("-", $valueA);
                    if(!isset($name_points_array[1])){
                        $_SESSION['message'] = "No votes, can not close election.";
                        redirect_to("/admin");
                    }
                    $points_array = explode("|", $name_points_array[1]);
                    $array = array_count_values($points_array);
                    foreach($array as $keyB => $valueB){
                        $num = $num + ($valueB / $keyB);
                    }
                    array_push($results, $num);
                }
                $max = max($results);
                $result = null;
                foreach($vote_raw_array as &$valueA){
                    $num = 0;
                    $name_points_array = explode("-", $valueA);
                    $points_array = explode("|", $name_points_array[1]);
                    $array = array_count_values($points_array);
                    foreach($array as $keyB => $valueB){
                        $num = $num + ($valueB / $keyB);
                    }
                    if($num == $max){
                        if($result == null){
                            $result = $name_points_array[0];
                        } else {
                            $result = $result . " & " . $name_points_array[0];
                        }
                    }
                }
                $id = mysql_prep($_GET['eID']);
                $winner = mysql_prep($result);
                $query  = "UPDATE vote SET ";
                $query .= "result = '{$winner}' ";
                $query .= "WHERE id = {$id} ";
                $query .= "LIMIT 1";
                $result = mysqli_query($connection, $query);
                if($result){
                    redirect_to("/admin");
                } else {
                    echo $query;
                }
            }
        }
    }
?>
<?php include("../includes/layouts/header.php") ?>
<style>
    .user-table {
        max-height: 500px;
        overflow-y: scroll;
    }
    .valid-users th,
    .valid-users td {
        padding: 5px 5px;
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
    .candidates input{
        margin: 0;
    }
    .candidates textarea {
        margin: 0;
        margin-top: 5px !important;
    }
    .candidate-picture {
        margin: 0;
        margin-top: 5px !important;
    }
    
    .candidates hr {
        margin: 0;
        top: -8px;
        position: relative;
        background-color: #E5C300;
        border-color: #E5C300;
    }
</style>
    
    <?php include("../includes/layouts/nav.php") ?>
    
    <section class="section align-center">
        <div class="container">
            <div class="col-sm-12">
                <h1>Site Dashboard</h1>
                <h3>Users</h3>
                <div class="user-table">
                    <table width="100%" class="valid-users">
                        <tr>
                            <th class="align-center"></th>
                            <th class="align-center">Google ID</th>
                            <th class="align-center">Name</th>
                            <th class="align-center">Email</th>
                            <th class="align-center">Member Status</th>
                        </tr>
                        <?php $i = 1; while($user = mysqli_fetch_assoc($user_set)) { ?>
                        <tr style="border-bottom:0;">
                            <td class="align-center"><img src="<?php echo htmlentities($user["img"]); ?>" /></td>
                            <td class="align-center"><div class="label-table"><label><?php echo htmlentities($user["google_id"]); ?></label></div></td>
                            <td class="align-center"><div class="label-table"><label><?php echo htmlentities($user["name"]); ?></label></div></td>
                            <td class="align-center"><div class="label-table"><label><?php echo htmlentities($user["email"]); ?></label></div></td>
                            <td class="align-center">
                              <?php if($user['google_id'] == "104908626036546174717"){ ?>
                              <div class="label-table"><label>Site Admin</label></div>
                              <?php } else { ?>
                               <select id="access_update<?php echo $i ?>" class="access_update" >
                                   <option data-user="<?php echo $user['id']; ?>" value="0"<?php if($user['access'] == 0){ echo " selected"; } ?>>Non-affiliated</option>
                                   <option data-user="<?php echo $user['id']; ?>" value="1"<?php if($user['access'] == 1){ echo " selected"; } ?>>PNM</option>
                                   <option data-user="<?php echo $user['id']; ?>" value="5"<?php if($user['access'] == 5){ echo " selected"; } ?>>Pledge</option>
                                   <option data-user="<?php echo $user['id']; ?>" value="2.1"<?php if($user['access'] == 2.1){ echo " selected"; } ?>>Triangle Alumni Member</option>
                                   <option data-user="<?php echo $user['id']; ?>" value="2.2"<?php if($user['access'] == 2.2){ echo " selected"; } ?>>Triangle Active Member</option>
                                   <option data-user="<?php echo $user['id']; ?>" value="6"<?php if($user['access'] == 6){ echo " selected"; } ?>>Utah Active Member</option>
                                   <option data-user="<?php echo $user['id']; ?>" value="3"<?php if($user['access'] == 3){ echo " selected"; } ?>>Utah Alumni Member</option>
                                   <option data-user="<?php echo $user['id']; ?>" value="9"<?php if($user['access'] == 9){ echo " selected"; } ?>>Site Admin</option>
                               </select>
                               <?php $i++; } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" align="center" style="padding:0 0 10px;">
                               <?php
                                $donate_show = false;
                                while($donate = mysqli_fetch_assoc($donate_set)) {
                                    if($donate['user_id'] == $user["google_id"]){
                                        $donate_show = true;
                                    }
                                } mysqli_data_seek($donate_set, 0);
                                if($donate_show == true){ ?>
                                <a class="btn btn-xs" onclick="$('#donate_<?php echo $user['id']; ?>').slideToggle();$(this).toggleClass('border-sharp')">Donations</a>
                                <div id="donate_<?php echo $user['id']; ?>" style="display:none">
                                    <table width="90%" style="border:solid #929292 2px;">
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
                                        </tr>
                                        <?php while($donate = mysqli_fetch_assoc($donate_set)) { if($donate['user_id'] == $user["google_id"]){ ?>
                                        <tr>
                                            <td><?php echo htmlentities($donate['date']); ?></td>
                                            <td><?php echo htmlentities($donate['name']); ?></td>
                                            <td><?php echo htmlentities($donate['email']); ?></td>
                                            <td><?php echo htmlentities($donate['affiliation']); ?></td>
                                            <td><?php echo htmlentities($donate['chapter']); ?></td>
                                            <td><?php echo htmlentities($donate['budget']); ?></td>
                                            <td><?php
                                                if($donate['recurring_int'] == 1){
                                                    $interval = "Indefinate";
                                                } else {
                                                    $interval = $donate['recurring_int'];
                                                }   
                                                if($donate['recurring_type'] == 0){
                                                    echo "One-time";
                                                } else if($donate['recurring_type'] == 1){
                                                    echo "Monthly: " . $interval;
                                                } else if($donate['recurring_type'] == 2){
                                                    echo "Annually: " . $interval;
                                                }
                                            ?></td>
                                            <td>$<?php echo htmlentities($donate['amount']); ?></td>
                                            <td><?php echo htmlentities($donate['comments']); ?></td>
                                        </tr>
                                        <?php } } mysqli_data_seek($donate_set, 0); ?>
                                    </table>
                                </div>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } mysqli_data_seek($user_set, 0); ?>
                        <?php
                            $donate_show = false;
                            while($donate = mysqli_fetch_assoc($donate_set)) {
                                if($donate['user_id'] == -1){
                                    $donate_show = true;
                                }
                            } mysqli_data_seek($donate_set, 0);
                            if($donate_show == true){
                        ?>
                        <tr style="border-bottom:0">
                           <td colspan="5" align="center">
                                <a class="btn btn-xs" onclick="$('#donate_other').slideToggle();$(this).toggleClass('border-sharp')">Other Donations</a>
                                <div id="donate_other" style="display:none">
                                    <table width="90%" style="border:solid #929292 2px;">
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
                                        </tr>
                                        <?php while($donate = mysqli_fetch_assoc($donate_set)) { if($donate['user_id'] == -1){ ?>
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
                                        </tr>
                                        <?php } } mysqli_data_seek($donate_set, 0); ?>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="section align-center">
        <div class="container">
            <div class="col-sm-6">
               <h3>Election</h3>
                <a id="create_new_vote" data-modal-link="popup-election" class="btn btn-sm">Create New Election</a>
                <table width="100%" class="valid-users">
                  <tr>
                      <th width="35px"></th>
                      <th class="text-left">Title</th>
                      <th class="text-center">Participants</th>
                      <th class="text-center">Votes</th>
                      <th class="text-center">Result</th>
                  </tr>
                   <?php
                    while($vote = mysqli_fetch_assoc($vote_set)) {
                        $num = 0;
                        $num_total = 0;
                        $users_array = explode(",", $vote['users']);
                        $groups_array = explode(",", $vote['groups']);
                        foreach($users_array as &$value){
                            if($value !== ""){
                                $num++;
                            }
                        }
                        
                        $groups = "";
                        foreach($groups_array as &$value){
                            if($groups !== ""){ $groups .= ", "; }
                            if($value == 0){ $groups .= "Non-affiliated Members"; }
                            if($value == 1){ $groups .= "PNMs"; }
                            if($value == 5){ $groups .= "Pledges"; }
                            if($value == 6){ $groups .= "Active Members"; }
                            if($value == 3){ $groups .= "Alumni Members"; }
                        }
                        
                        while($temp_user = mysqli_fetch_assoc($user_set)) {
                            foreach($groups_array as &$value){
                                if($value == $temp_user['access']){
                                    $num_total++;
                                }
                            }
                            if($temp_user['access'] == 9){
                                $num_total++;
                            }
                        }
                        mysqli_data_seek($user_set, 0);
                        $precent = ($num / $num_total) * 100;
                        $precent_format = number_format($precent, 0, '.', '');
                    ?>
                    <tr>
                        <td>
                            <a href="/admin?type=deleteElection&eID=<?php echo $vote['id']; ?>"><span class="fa fa-remove text-rose"></span></a>
                            <a data-modal-link="popup-election" class="edit-election" vote-id="<?php echo $vote['id']; ?>"><span class="fa fa-pencil text-green"></span></a>
                            <?php if(!empty($vote['result'])){ ?>
                            <a onclick="$('.result-box').hide();$('#result<?php echo $vote['id']; ?>').show();$('.close-box').hide();$('.open-box').show();$(this).hide();$('#close<?php echo $vote['id']; ?>').show();" id="open<?php echo $vote['id']; ?>" class="open-box"><span class="fa fa-caret-square-o-down text-green"></span></a>
                            <a onclick="$('#result<?php echo $vote['id']; ?>').hide();$('#open<?php echo $vote['id']; ?>').show();$(this).hide();" id="close<?php echo $vote['id']; ?>" style="display:none" class="close-box"><span class="fa fa-caret-square-o-up text-yellow"></span></a>
                            <?php } ?>
                        </td>
                        <td class="align-left"><div class="label-table"><label><?php echo htmlentities($vote['title']); ?></label></div></td>
                        <td class="align-center"><?php echo $groups; ?></td>
                        <td class="align-center"><?php echo $num."/".$num_total." (".$precent_format."%)"; ?></td>
                        <td class="align-center"><div class="label-table"><label><?php if(empty($vote['result'])){ ?><a class="btn btn-xs" href="/admin?type=closeElection&eID=<?php echo $vote['id']; ?>">Close Election</a><?php } else { if($vote['type'] == 1){ $candidate = find_candidate_by_id($vote['result']); echo $candidate['name']; } else { echo "<a data-modal-link='popup-{$vote['id']}'>See Results</a>"; } } ?></label></div></td>
                    </tr>
                    <?php if(!empty($vote['result'])){ ?>
                    <tbody class="result-box" id="result<?php echo $vote['id']; ?>" style="display:none">
                        <tr>
                            <td colspan="5">
                                <table>
                                   <?php
                                        $vote_raw_array = explode(",", $vote['people']);
                                        foreach($vote_raw_array as &$valueA){
                                    ?>
                                    <tr>
                                       <?php 
                                            $name_points_array = explode("-", $valueA);
                                            $points_array = explode("|", $name_points_array[1]);
                                            $candidate = find_candidate_by_id($name_points_array[0]);
                                            echo "<td>".$candidate['name']."</td>";
                                            foreach($points_array as &$value){
                                        ?>
                                        <td><?php echo $value ?></td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                    <?php } } mysqli_data_seek($vote_set, 0); ?>
                </table>
                <a href="admin?type=hideResualts">Hide Resualts</a>
            </div>
            <div class="col-sm-6">
               <h3>Newsletter</h3>
                <a class="btn btn-sm" data-modal-link="popup-newsletter">View Email List</a>
            </div>
        </div>
    </section>
    <section class="section align-center">
        <div class="container">
            <div class="col-sm-12">
                <h3>Boards</h3>
                <div class="row">
                    <div class="col-sm-12">
                        <h6>Recruitment</h6>
                        <form action="/data?board=rec" method="post" form-reset="false">
                            <fieldset class="text-right">
                                <textarea name="body"><?php echo $CM_primary['recruitment']; ?></textarea>
                                <input type="submit" name="submit" class="btn btn-xs" value="Update">
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <h6>President</h6>
                        <form action="/data?board=pres" method="post" form-reset="false">
                            <fieldset class="text-right">
                                <textarea name="body"><?php echo $CM_primary['president']; ?></textarea>
                            </fieldset>
                            <fieldset class="text-left">
                                <label for="popup">Popup Title</label>
                                <input type="text" name="popup-title" value="<?php echo htmlentities($CM_popup_title['president']); ?>" />
                            </fieldset>
                            <fieldset class="text-left">
                                <label for="popup-body">Popup Body</label>
                                <textarea name="popup-body"><?php echo htmlentities($CM_popup_body['president']); ?></textarea>
                            </fieldset>
                            <fieldset class="text-right">
                                <input type="submit" name="submit" class="btn btn-xs" value="Update">
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <h6>Vice President</h6>
                        <form action="/data?board=vp" method="post" form-reset="false">
                            <fieldset class="text-right">
                                <textarea name="body"><?php echo $CM_primary['vicePresident']; ?></textarea>
                            </fieldset>
                            <fieldset class="text-left">
                                <label for="popup">Popup Title</label>
                                <input type="text" name="popup-title" value="<?php echo htmlentities($CM_popup_title['vicePresident']); ?>" />
                            </fieldset>
                            <fieldset class="text-left">
                                <label for="popup-body">Popup Body</label>
                                <textarea name="popup-body"><?php echo htmlentities($CM_popup_body['vicePresident']); ?></textarea>
                            </fieldset>
                            <fieldset class="text-right">
                                <input type="submit" name="submit" class="btn btn-xs" value="Update">
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <h6>Brotherhood</h6>
                        <form action="/data?board=ia" method="post" form-reset="false">
                            <fieldset class="text-right">
                                <textarea name="body"><?php echo $CM_primary['brotherhood']; ?></textarea>
                            </fieldset>
                            <fieldset class="text-left">
                                <label for="popup">Popup Title</label>
                                <input type="text" name="popup-title" value="<?php echo htmlentities($CM_popup_title['brotherhood']); ?>" />
                            </fieldset>
                            <fieldset class="text-left">
                                <label for="popup-body">Popup Body</label>
                                <textarea name="popup-body"><?php echo htmlentities($CM_popup_body['brotherhood']); ?></textarea>
                            </fieldset>
                            <fieldset class="text-right">
                                <input type="submit" name="submit" class="btn btn-xs" value="Update">
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <h6>Administration</h6>
                        <form action="/data?board=admin" method="post" form-reset="false">
                            <fieldset class="text-right">
                                <textarea name="body"><?php echo $CM_primary['administration']; ?></textarea>
                            </fieldset>
                            <fieldset class="text-left">
                                <label for="popup">Popup Title</label>
                                <input type="text" name="popup-title" value="<?php echo htmlentities($CM_popup_title['administration']); ?>" />
                            </fieldset>
                            <fieldset class="text-left">
                                <label for="popup-body">Popup Body</label>
                                <textarea name="popup-body"><?php echo htmlentities($CM_popup_body['administration']); ?></textarea>
                            </fieldset>
                            <fieldset class="text-right">
                                <input type="submit" name="submit" class="btn btn-xs" value="Update">
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <h6>Treasury</h6>
                        <form action="/data?board=tre" method="post" form-reset="false">
                            <fieldset class="text-right">
                                <textarea name="body"><?php echo $CM_primary['treasury']; ?></textarea>
                            </fieldset>
                            <fieldset class="text-left">
                                <label for="popup">Popup Title</label>
                                <input type="text" name="popup-title" value="<?php echo htmlentities($CM_popup_title['treasury']); ?>" />
                            </fieldset>
                            <fieldset class="text-left">
                                <label for="popup-body">Popup Body</label>
                                <textarea name="popup-body"><?php echo htmlentities($CM_popup_body['treasury']); ?></textarea>
                            </fieldset>
                            <fieldset class="text-right">
                                <input type="submit" name="submit" class="btn btn-xs" value="Update">
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <h6>External Affairs</h6>
                        <form action="/data?board=ea" method="post" form-reset="false">
                            <fieldset class="text-right">
                                <textarea name="body"><?php echo $CM_primary['externalAffairs']; ?></textarea>
                            </fieldset>
                            <fieldset class="text-left">
                                <label for="popup">Popup Title</label>
                                <input type="text" name="popup-title" value="<?php echo htmlentities($CM_popup_title['externalAffairs']); ?>" />
                            </fieldset>
                            <fieldset class="text-left">
                                <label for="popup-body">Popup Body</label>
                                <textarea name="popup-body"><?php echo htmlentities($CM_popup_body['externalAffairs']); ?></textarea>
                            </fieldset>
                            <fieldset class="text-right">
                                <input type="submit" name="submit" class="btn btn-xs" value="Update">
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <h6>Message from the President</h6>
                        <form action="/data?board=pn" method="post" form-reset="false">
                            <fieldset class="text-right">
                                <textarea name="body"><?php echo $CM_primary['presidentNote']; ?></textarea>
                            </fieldset>
                            <fieldset class="text-right">
                               <input type="hidden" name="popup-title" value="">
                               <input type="hidden" name="popup-body" value="">
                                <input type="submit" name="submit" class="btn btn-xs" value="Update">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="modal-window" data-modal="popup-newsletter" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated donate-box" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight">Newsletter Email List</span></h5>
        <div class="col-sm-12 text-center email-list">
            <p><a href="/data?newsletter=download">Download Email List</a></p>
            <?php while($email = mysqli_fetch_assoc($email_set)) { ?>
            <p><?php echo $email['email']; ?></p>
            <?php } ?>
        </div>
    </div>
</div>

<div class="modal-window" data-modal="popup-election" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated" data-animation="zoomIn" data-duration="700" style="top:10px !important;">
        <span class="close-btn icon icon-office-52"></span>

        <h5 class="align-center"><span id="election_box_title" class="highlight">Create New Election</span></h5>
        <form id="form_election" class="form registration-form align-center" action="/data?form=election" method="post" modal-close="true" form-reset="true" data-note="Create Vote" enctype="multipart/form-data">
            <fieldset class="col-sm-12" style="margin-bottom:10px;">
               <label for="election-type">Election Type</label><br>
                <input type="radio" id="election_type_1" name="election-type" value="1" onclick="$('.pass').hide();" checked>Ranking &nbsp;&nbsp;&nbsp; 
                <input type="radio" id="election_type_0" name="election-type" value="0" onclick="$('.pass').show();">Binary
            </fieldset>
            <fieldset class="col-sm-12">
                <label for="election-name">Election Name</label>
                <input type="text" id="election_title" name="election-name" maxlength="50">
            </fieldset>
            <fieldset class="col-sm-12">
                <label for="election-description">Election Description</label>
                <textarea id="election_body" name="election-body"></textarea>
            </fieldset>
            <fieldset class="col-sm-12 candidates-includes" style="margin-bottom:5px;">
            </fieldset>
            <h5><small>Candidates</small></h5>
            <fieldset class="col-sm-12 candidates-includes" style="margin-bottom:15px;">
                <label for="election-type">Additional Information</label><br>
                <input type="checkbox" id="candidate_description">candidate Desciption<br>
                <input type="checkbox" id="candidate_picture">candidate Picture<br>
                <input type="checkbox" id="candidate_comments" name="candidate_discussion" value="1">Allow Discussion
            </fieldset>
            <fieldset class="col-sm-12 candidates">
                <div id="candidates_container">
                    <?php for($x = 1; $x <= 5; $x++){ ?>
                    <input type="text" id="candiate_name_<?php echo $x ?>" class="candidate" placeholder="John Smith" onkeyup="people_loop();" maxlength="50">
                    <textarea class="candidate-description" id="candiate_desc_<?php echo $x ?>" style="display:none;" onkeyup="people_loop();" maxlength="1000"></textarea>
                    <input type="text" id="candiate_pic_<?php echo $x ?>" class="candidate-picture" placeholder="http://site.com/image.jpg" style="display:none" onkeyup="people_loop();" maxlength="250">
                    <hr />
                    <?php } ?>
                </div>
                <input type="hidden" id="input_count" value="5">
                <a class="btn btn-xs btn-add-candidates">+5 More Candidates</a>
            </fieldset>
            <input type="hidden" id="people" name="people" value="">
            <input type="hidden" id="description" name="description" value="">
            <input type="hidden" id="picture" name="picture" value="">
            <input type="hidden" id="description_show" value="none">
            <input type="hidden" id="picture_show" value="none">
            <h5><small>Election Participants</small></h5>
            <fieldset class="col-sm-12 groups">
                <a id="button_group_non" class="btn btn-xs election-group" data-name="group_non">Non-affiliates</a>
                <a id="button_group_pnm" class="btn btn-xs election-group" data-name="group_pnm">PNMs</a>
                <a id="button_group_pledge" class="btn btn-xs election-group" data-name="group_pledge">Pledges</a>
                <a id="button_group_active" class="btn btn-xs election-group active" data-name="group_active">Active Members</a>
                <a id="button_group_alumni" class="btn btn-xs election-group" data-name="group_alumni">Alumni Members</a>
                <input type="hidden" class="election-group" id="group_non" name="Non-affiliates" value="false">
                <input type="hidden" class="election-group" id="group_pnm" name="PNMs" value="false">
                <input type="hidden" class="election-group" id="group_pledge" name="Pledges" value="false">
                <input type="hidden" class="election-group" id="group_active" name="Actives" value="true">
                <input type="hidden" class="election-group" id="group_alumni" name="Alumnis" value="false">
            </fieldset>
            <fieldset class="col-sm-12 text-center" style="margin-top:20px;">
                <p id="election_update_notice" class="text-rose" style="display:none;"><i class="fa fa-warning" style="font-size:25px;"></i><br> <span class="text-bold">ATTENTION:</span> Updating an election <br> will delete all recorded votes.</p>
                <input type="submit" id="election_submit" name="submit" value="Create Election" class="btn" />
                <input type="hidden" name="form-id" id="form_id" value="null">
            </fieldset>
        </form>
    </div>
</div>

<?php while($vote = mysqli_fetch_assoc($vote_set)) { if($vote['result'] == "COMPLETE"){ ?>
<div class="modal-window" data-modal="popup-<?php echo $vote['id'] ?>" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated" data-animation="zoomIn" data-duration="700" style="top:10px !important;">
        <span class="close-btn icon icon-office-52"></span>

        <h5 class="align-center"><span class="highlight">Results: <?php echo $vote['title'] ?></span></h5>
        
        <table class="results" width="100%">
            <tr>
                <th width="40%" class="text-center"></th>
                <th width="15%" class="text-center"><label>For</label></th>
                <th width="15%" class="text-center"><label>Against</label></th>
                <th width="15%" class="text-center"><label>Votes</label></th>
                <th width="15%" class="text-center"><label>Result</label></th>
            </tr>
        <?php while($candidate = mysqli_fetch_assoc($candidate_set)) {
                $people_set = explode(",", $vote['people']);
                foreach($people_set as $people) {
                    $person = explode("-", $people);
                    if($person[0] == $candidate['id']){
                ?>
        <tr>
            <td style="border-right:1px solid #51545b;">
                <label class="name text-right"><span class="highlight"><?php echo $candidate['name'] ?></span></label>
            </td>
            <td class="text-center">
                <label class="result text-green"><?php echo $candidate['approve'] ?></label>
            </td>
            <td class="text-center">
                <label class="result text-rose"><?php echo $candidate['deny'] ?></label>
            </td>
            <td class="text-center">
                <label class="result"><?php echo $candidate['votes'] ?></label>
            </div>
            <td class="text-center">
                <label class="result"><?php echo $candidate['result'] * 100 ?>%</label>
            </td>
        </tr>
        <?php } } } mysqli_data_seek($candidate_set, 0); ?>
        </table>
    </div>
</div>
<?php }  ?>
<?php } ?>

   
    <?php include("../includes/layouts/footer.php") ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#candidate_description").click(function(){
            $(".candidate-description").toggle();
            if(document.getElementById("description_show").value == "none"){
                $("#description_show").val("box");
            } else {
                $("#description_show").val("none");
            }
        });
        $("#candidate_picture").click(function(){
            $(".candidate-picture").toggle();
            if(document.getElementById("picture_show").value == "none"){
                $("#picture_show").val("box");
            } else {
                $("#picture_show").val("none");
            }
        });
    })
    function adminPage(input, user, text){
        $.post("/data",
        {
            dataID: "Access Update",
            user: user,
            access: input,
            membership: text
        },
        function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            //alert("Data: " + data + "\nStatus: " + status);
            //$("#message").html("Data: " + data + "<br>Status: " + status)
        });
    }
    
    function people_loop() {
        var people = "";
        var description = "";
        var picture = "";
        $('.candidates .candidate').each(function () {
            if(people == ""){
                people = this.value;
            } else {
                people = people + "," + this.value;
            }
            /*if(this.value !== ""){
                if(people == ""){
                    people = this.value;
                } else {
                    people = people + "," + this.value;
                }
            }*/
        });
        $("#people").val(people);
        $('.candidates .candidate-description').each(function () {
            if(description == ""){
                description = this.value;
            } else {
                description = description + "," + this.value;
            }
        });
        $("#description").val(description);
        $('.candidates .candidate-picture').each(function () {
            if(picture == ""){
                picture = this.value;
            } else {
                picture = picture + "," + this.value;
            }
        });
        $("#picture").val(picture);
    }
    
    $(".edit-election").click(function(){
        var id = $(this).attr("vote-id");
        $("#create_new_vote").hide();
        $("#election_submit").val("Update Election");
        $("#election_box_title").text("Update Election");
        $("#election_update_notice").show();
        election_data(id, returnData);
    });
    
    function returnData(param) {
        var split = param.split("&SPLIT;");
        console.log(param);
        split.forEach(function(item, index){
            // Election Id
            if(index == 0){ $("#form_id").val(item); }
            
            // Election Type Select
            if(index == 1){
                if(item == 1){
                    $("#election_type_1").prop("checked", true);
                } else {
                    $("#election_type_0").prop("checked", true);
                }
            }
            
            // Election Title
            if(index == 2){ $("#election_title").val(item); }
            
            // Election Description
            if(index == 3){ $("#election_body").val(item); }
            
            // Election Candiates
            if(index == 4){
                var candidate_split = item.split("&CAND;");
                var x = 0;
                var build = "";
                candidate_split.forEach(function(item2, index2){
                    var candidate = item2.split("&INFO;");
                    x++;
                    build += '<input type="text" id="candiate_name_' + x + '" class="candidate" placeholder="John Smith" onkeyup="people_loop();" maxlength="50" value="';
                    build += candidate[1];
                    build += '" /><textarea class="candidate-description" id="candiate_desc_' + x + '" style="display:none;" onkeyup="people_loop();" maxlength="1000">'
                    build += candidate[2];
                    build += '</textarea><input type="text" id="candiate_pic_' + x + '" class="candidate-picture" placeholder="http://site.com/image.jpg" style="display:none" onkeyup="people_loop();" maxlength="250" value="'
                    build += candidate[3];
                    build += '" /><hr />';
                });
                $("#input_count").val(x);
                $("#candidates_container").html(build);
            }
            
            // Election Groups
            if(index == 5){
                var split = item.split(",");
                $(".election-group").removeClass("active");
                $(".election-group").val("false");
                split.forEach(function(item2, index2){
                    if(item2 == 0){ $("#group_non").val("true"); $("#button_group_non").addClass("active"); }
                    if(item2 == 1){ $("#group_pnm").val("true"); $("#button_group_pnm").addClass("active"); }
                    if(item2 == 5){ $("#group_pledge").val("true"); $("#button_group_pledge").addClass("active"); }
                    if(item2 == 6){ $("#group_active").val("true"); $("#button_group_active").addClass("active"); }
                    if(item2 == 3){ $("#group_alumni").val("true"); $("#button_group_alumni").addClass("active"); }
                });
            }
            
            // Election Comments
            if(index == 8){
                if(item == 1){
                    $("#candidate_comments").prop("checked", true);
                } else {
                    $("#candidate_comments").prop("checked", false);
                }
            }
            
        });
        people_loop();
    }
    
    function election_data(id, callback){
        $.post("/data",
        {
            dataID: "Election Details",
            id: id,
        },
        function(data, status){
            callback(data);
        });
    }
</script>
</body>
</html>