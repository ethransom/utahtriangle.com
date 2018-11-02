<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php 
    login_check();
    admin_check();

    if(isset($_POST['submit'])){
        if(isset($_GET['type']) && !empty($_GET['type'])){
            if($_GET['type'] == "candidate"){
                $name = mysql_prep($_POST['name']);
                $body = mysql_prep($_POST['body']);
                $image = mysql_prep($_POST['image']);
                $id = mysql_prep($_GET['id']);

                $query  = "UPDATE candidates SET ";
                $query .= "name = '{$name}', ";
                $query .= "description = '{$body}', ";
                $query .= "picture = '{$image}' ";
                $query .= "WHERE id = '{$id}' ";
                $query .= "LIMIT 1";
            }
            if($_GET['type'] == "vote"){
                $type = mysql_prep($_POST['type']);
                $title = mysql_prep($_POST['title']);  
                $body = mysql_prep($_POST['body']);
                $people = mysql_prep($_POST['people']);
                $groups = mysql_prep($_POST['groups']);
                $users = mysql_prep($_POST['users']);  
                $result = mysql_prep($_POST['result']);
                $comments = mysql_prep($_POST['comments']);
                $id = mysql_prep($_GET['id']);
            
                $query  = "UPDATE candidates SET ";
                $query .= "type = '{$type}', ";
                $query .= "title = '{$title}', ";
                $query .= "body = '{$body}', ";
                $query .= "people = '{$people}', ";
                $query .= "groups = '{$groups}', ";
                $query .= "users = '{$users}', ";
                $query .= "result = '{$result}', ";
                $query .= "comments = '{$comments}' ";
                $query .= "WHERE id = '{$id}' ";
                $query .= "LIMIT 1";
            }
        } else {
            $query = "{$_POST['query']}";
        }
        $result = mysqli_query($connection, $query);
        if($result){
            redirect_to("/php_admin");
        } else {
            echo mysqli_errno($connection) . ": " . mysqli_error($connection) . "<br>";
        }
    }
    
    if($_SESSION['google_id'] !== "104908626036546174717"){
        redirect_to("/index");
    } else {
        
        if(isset($_GET['type']) && $_GET['type']){
            if($_GET['type'] == "delete"){
                $id = $_GET['id'];
                $query  = "DROP TABLE `{$id}`";
                mysqli_query($connection, $query);
                redirect_to("/php_admin");
            }
        }

        $query = "SHOW TABLES";
        $result = mysqli_query($connection, $query);    
        $vote_set = find_all_votes();
        $candidate_set = find_all_candidates();
?>
<style>
    body {
        font-family: sans-serif;
    }
    label {
        font-weight: bold;
    }
</style>
<table border="1" cellpadding="5">
    <tr>
        <td colspan="2">
            <h1 style="margin:0;">DB Tables</h1>
        </td>
    </tr>
    <?php while ($row = mysqli_fetch_row($result)) { ?>
    <tr>
        <td>
            <?php echo $row[0]; ?>
        </td>
        <td><a href="php_admin?type=delete&id=<?php echo $row[0] ?>">Delete Table</a></td>
    </tr>
    <?php } ?>
</table>
<table border="1" cellpadding="5">
    <tr>
        <td colspan="5">
            <h1 style="margin:0;">Vote Table</h1>
        </td>
    </tr>
    <tr>
        <th>id</th>
        <th>type</th>
        <th>title</th>
        <th>body</th>
        <th>people</th>
        <th>groups</th>
        <th>users</th>
        <th>result</th>
        <th>comments</th>
        <th>Action</th>
    </tr>
    <?php while($vote = mysqli_fetch_assoc($vote_set)) {?>
    <form action="php_admin?type=vote&id=<?php echo $vote['id']; ?>" method="post">
        <tr>
            <td><?php echo $vote['id']; ?></td>
            <td><input type="text" name="type" value="<?php echo $vote['type']; ?>" /></td>
            <td><input type="text" name="title" value="<?php echo $vote['title']; ?>" /></td>
            <td><input type="text" name="body" value="<?php echo $vote['body']; ?>" /></td>
            <td><input type="text" name="people" value="<?php echo $vote['people']; ?>" /></td>
            <td><input type="text" name="groups" value="<?php echo $vote['groups']; ?>" /></td>
            <td><input type="text" name="users" value="<?php echo $vote['users']; ?>" /></td>
            <td><input type="text" name="result" value="<?php echo $vote['result']; ?>" /></td>
            <td><input type="text" name="comments" value="<?php echo $vote['comments']; ?>" /></td>
            <td><input type="submit" name="submit" value="Update" /></td>
        </tr>
    </form>
    <?php } mysqli_data_seek($vote_set, 0); ?>
</table>

<table border="1" cellpadding="5">
    <tr>
        <td colspan="5">
            <h1 style="margin:0;">Candidates Table</h1>
        </td>
    </tr>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>description</th>
        <th>picture</th>
        <th>Action</th>
    </tr>
    <?php while($candidate = mysqli_fetch_assoc($candidate_set)) {?>
    <form action="php_admin?type=candidate&id=<?php echo $candidate['id']; ?>" method="post">
        <tr>
            <td><?php echo $candidate['id']; ?></td>
            <td><input type="text" name="name" value="<?php echo $candidate['name']; ?>" /></td>
            <td><input type="text" name="body" value="<?php echo $candidate['description']; ?>" /></td>
            <td><input type="text" name="image" value="<?php echo $candidate['picture']; ?>" /></td>
            <td><input type="submit" name="submit" value="Update" /></td>
        </tr>
    </form>
    <?php } ?>
</table>

<form action="/php_admin" method="post">
    <h1>SQL Query</h1>
    <p><label>Random ID: </label> <?php echo generateRandomString(15); ?></p>
    <p><label>Candidate Comment Table: </label>CREATE TABLE `{ TABLE NAME }` ( `id` INT NOT NULL AUTO_INCREMENT , `comment` TEXT NOT NULL , `user_id` VARCHAR(75) NOT NULL , `date` VARCHAR(75) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;</p>
    <p><label>Candidate Table: </label>INSERT INTO candidates (	id, name, description, picture) VALUES ('{$id}', '{$value}', '{$desc}', '{$pic}')</p>
    <p><label>Update Vote:</label> UPDATE vote SET people = '{$user}' WHERE id = {$id} LIMIT 1</p>
    <?php while($vote = mysqli_fetch_assoc($vote_set)) { ?>
    <p><label>Vote <?php echo $vote['title']; ?> (<?php echo $vote['id']; ?>): </label><?php echo $vote['people']; ?></p>
    <p><label>Voters: </label><?php
        $array = explode(",", $vote['users']);
        foreach($array as &$value){
            $temp_user = get_user_by_google_id($value);
            echo $temp_user['name'] . ", ";
        }
        ?></p>
    <?php } ?>
    <textarea cols="150" name="query"></textarea>
    <input type="submit" name="submit" value="Submit">
</form>
<?php } ?>
