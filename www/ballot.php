<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php login_check() ?>
<?php
    
    if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['candidate']) && !empty($_GET['candidate'])){
    
    $vote_set = find_all_votes();
    $user_set = find_all_users();
    $candidate_set = find_all_candidates();
    $vote = find_vote_by_id($_GET['id']);
        
        
   $people = explode(",", $vote['people']);
    $user = get_user_by_google_id($_SESSION['google_id']);
    $access_array = explode(",", $vote['groups']);
    $access = false;
    foreach($access_array as &$value){
        if($user['access'] == $value){
            $access = true;
        }
    }
    if($user['access'] == 9){ $access = true; }
    if($access == true){

        $vote_array = explode(",", $vote['users']);
        $voted = false;
        foreach($vote_array as &$value){
            if($user['google_id'] == $value){
                $voted = true;
            }
        }
        
    } else {
        redirect_to("/vote");
    }
    
?>
<?php include("../includes/layouts/header.php") ?>
<style>
    .sortable {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .sortable li {
        margin: 0 3px 3px 3px;
        padding: 0.4em;
        padding-left: 1.5em;
        font-size: 1.4em;
        height: auto;
        cursor: move;
    }
    
    .sortable li:active {
        cursor: grabbing;
    }

    .sortable li span {
        position: absolute;
        margin-left: -1.3em;
    }
    
    h4 {
        margin: 0
    }
    
    .voted {
        padding: 25px;
        width: 100%;
        border: 2px solid #8a1538;
        margin: 25px 0 20px 0;
    }
    
    .description {
        font-size: 12px;
        text-align: center;
    }
    
    .picture {
        text-align: center;
        margin: 10px;
        height: 75px;
        overflow: hidden;
    }
    
    .picture img {
        border-radius: 75px;
    }
    
    .binary-box {
        border: 1px solid #c5c5c5;
        background: #f6f6f6;
        font-weight: normal;
        color: #454545;
        margin: 0 3px 3px 3px;
        padding: 0.4em;
        padding-left: 1.5em;
        font-size: 1.4em;
        height: auto;
        cursor: default;
        vertical-align: baseline;
    }
    
    .binary-box .deny {
        background: transparent;
        border: 1px solid #8a1538;
    }
    
    .binary-box .approve {
        background: transparent;
        border: 1px solid #75b93f;
    }
    
    .binary-box .deny:hover {
        background-color: #8a1538 !important;
        color: #fff !important;
    }
    
    .binary-box .approve:hover {
        background-color: #75b93f !important;
        color: #fff !important;
    }
    
    .deny-box {
        background-color: #F6DBD7;
        border-color: #8a1538;
    }
    
    .approve-box {
        background-color: #D1F6CC;
        border-color: #75b93f;
    }
    
    .outline-deny {
        background-color: #8a1538 !important;
    }
    
    .outline-approve {
        background-color: #75b93f !important;
    }

</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php include("../includes/layouts/nav.php") ?>
<section class="section">
    <div class="container">
      <div class="col-sm-12 align-center">
          <h1 style="margin-bottom:0;" class="text-grey"><?php echo $vote['title']; ?></h1>
          <hr style="margin:0;">
          <p style="margin:0;margin-bottom:50px;"><?php echo $vote['body']; ?></p>
      </div>
        <div class="col-sm-4 align-center" style="margin-bottom:25px;">
            <?php if(isset($vote['result']) && !empty($vote['result'])){ ?>
            <div class="voted">
                <h5 class="text-rose" style="margin:0">Election Closed</h5>
                <h5 style="font-size:18px;margin:0;"><span class="text-grey">Winner:</span> <span class="text-green"><?php $candidate = find_candidate_by_id($vote['result']); echo $candidate['name']; ?></span></h5>
            </div>
            <h5 style="font-size:15px;margin:0;line-height:0" class="text-grey">Participants</h5>
            <hr style="margin:0;">                
            <?php
            $users_array = explode(",", $vote['users']);
            while($users = mysqli_fetch_assoc($user_set)) {
                $temp_access = false;
                foreach($access_array as &$value){
                    if($users['access'] == $value){
                        $temp_access = true;
                    }
                }
                if($users['access'] == 9){ $temp_access = true; }
                if($temp_access == true){
                    $temp_voted = "Withheld";
                    $temp_voted_color = "rose";
                    foreach($vote_array as &$value){
                        if($users['google_id'] == $value){
                            $temp_voted = "Voted";
                            $temp_voted_color = "green";
                        }
                    }
                    echo "<div class=\"col-sm-6\">{$users['name']} (<span class=\"text-{$temp_voted_color}\">{$temp_voted}</span>)</div>";
                }
            }
            mysqli_data_seek($user_set, 0);
            ?>
            <?php } else if($voted == true) { ?>
            <div class="voted">
                <h5 style="margin:0"><span class="text-rose">Vote Submitted</span></h5>
                <h5 style="font-size:18px;margin:0;"><span class="text-grey">Election is still open.</span></h5>
            </div>
            <h5 style="font-size:15px;margin:0;line-height:0" class="text-grey">Participants</h5>
            <hr style="margin:0;">                
            <?php
            $users_array = explode(",", $vote['users']);
            while($users = mysqli_fetch_assoc($user_set)) {
                $temp_access = false;
                foreach($access_array as &$value){
                    if($users['access'] == $value){
                        $temp_access = true;
                    }
                }
                if($users['access'] == 9){ $temp_access = true; }
                if($temp_access == true){
                    $temp_voted = "Pending";
                    $temp_voted_color = "yellow";
                    foreach($vote_array as &$value){
                        if($users['google_id'] == $value){
                            $temp_voted = "Voted";
                            $temp_voted_color = "green";
                        }
                    }
                    echo "<div class=\"col-sm-6\">{$users['name']} (<span class=\"text-{$temp_voted_color}\">{$temp_voted}</span>)</div>";
                }
            }
            ?>
            <?php } else { ?>
            <div id="div_form_id_<?php echo $vote['id']; ?>">
                <?php if($vote['type'] == 1){ ?>
                <p style="margin:0;font-size:10px;"><i>Arrange candidates in order of preference.</i></p>
                <form action="/data?form=vote&id=<?php echo $vote['id']; ?>" method="post" form-rest="false" data-note="vote">
                <ul class="sortable" id="canidates_form_id_<?php echo $vote['id']; ?>">
                   <?php
                        $num = 0;
                        foreach($people as &$person){
                            $split = explode("-", $person);
                            $id = $split[0];
                            $candidate = find_candidate_by_id($id);
                            $num++;
                            
                    ?>
                    <li class="ui-state-default" data-id="<?php echo $id; ?>"><?php echo $candidate['name']; ?><div class="description"><?php if(!empty($candidate['picture'])){ echo "<div class='picture'><a href='{$candidate['picture']}' target='_blank'><img src='{$candidate['picture']}' width='75px' /></a></div>"; }?><?php echo $candidate['description']; ?></div></li>
                    <?php } ?>
                </ul>
                <input type="hidden" name="formType" value="range"/>
                <input type="hidden" name="order" id="list_form_id_<?php echo $vote['id']; ?>"/>
                <br>
                <input type="submit" name="submit" value="Cast Vote" class="btn" />
            </div>
            <script>
                $(function() {
                    $("#canidates_form_id_<?php echo $vote['id']; ?>").sortable();
                    $("#canidates_form_id_<?php echo $vote['id']; ?>").disableSelection();
                    var listItem = [];
                    $("#canidates_form_id_<?php echo $vote['id']; ?> li").each(function(){
                        listItem.push($(this).attr("data-id"));
                    });
                    $("#list_form_id_<?php echo $vote['id']; ?>").val(listItem);
                    var $sortableList = $("#canidates_form_id_<?php echo $vote['id']; ?>");

                    var sortEventHandler = function(event, ui){
                        var listItem = [];
                        $("#canidates_form_id_<?php echo $vote['id']; ?> li").each(function(){
                            listItem.push($(this).attr("data-id"));
                        });
                        $("#list_form_id_<?php echo $vote['id']; ?>").val(listItem);
                    };

                    $sortableList.sortable({
                        stop: sortEventHandler
                    });

                    // You can also set the event handler on an already existing Sortable widget this way:

                    $sortableList.on("sortchange", sortEventHandler);

                });

            </script>
            </form>
            <?php } else { ?>
            <p style="margin:0;font-size:10px;"><i>Click submit once you have voted for each candidate.</i></p>
            <form action="/data?form=vote&id=<?php echo $vote['id']; ?>" method="post" form-rest="false" data-note="vote">
              <div class="form_<?php echo $vote['id']; ?>">
               <?php
                    $num = 0;
                    foreach($people as &$person){
                        $split = explode("-", $person);
                        $id = $split[0];
                        $candidate = find_candidate_by_id($id);
                        $num++;
                ?>
                <div class="binary-box <?php echo $id ?>">
                    <?php echo $candidate['name']; ?><div class="description"><?php if(!empty($candidate['picture'])){ echo "<div class='picture'><a href='{$candidate['picture']}' target='_blank'><img src='{$candidate['picture']}' width='75px' /></a></div>"; }?><?php echo $candidate['description']; ?></div>
                    <a class="btn btn-xs deny text-rose" data-id="<?php echo $id ?>" form-id="<?php echo $vote['id']; ?>">Oppose</a><a class="btn btn-xs approve text-green" data-id="<?php echo $id ?>" form-id="<?php echo $vote['id']; ?>">Accept</a>
                    <?php if($vote['comments'] == 1){ ?>
                    <a style="text-decoration: none;" href="/ballot?id=<?php echo $vote['id']; ?>&candidate=<?php echo $candidate['id']; ?>"><i class="fa fa-comments-o"></i></a>
                    <?php } ?>
                    <input type="hidden" class="input_candidate" id="input_<?php echo $vote['id']; ?>_<?php echo $id ?>">
                </div>
                <?php } ?>
                <input type="hidden" name="order" id="list_form_id_<?php echo $vote['id']; ?>" />
                <input type="hidden" name="formType" value="binary"/>
                <br>
                <input type="submit" name="submit" value="Submit Votes" class="btn" />
                </div>
            </form>
        </div>
            
            <?php } } } ?>
            
        </div>
    </div>
</section>

<?php while($candidate = mysqli_fetch_assoc($candidate_set)) { ?>
<div class="modal-window" data-modal="popup-<?php echo $candidate['id'] ?>" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated vote-comment-modal" data-animation="zoomIn" data-duration="700" style="top:10px !important;">
        <span class="close-btn icon icon-office-52"></span>

        <h5 class="align-center"><span class="highlight"><?php echo $candidate['name'] ?></span></h5>
        
        <div class="row">
            <div class="col-sm-12 comment-box" id="<?php echo $candidate['id'] ?>_comments">
                <div class="text-center text-rose" style="margin:25px 0;">There was an error loading this feed.  Please try again later.</div>
            </div>
        </div>
        <div class="row" id="<?php echo $candidate['id'] ?>_textarea" style="margin-top:10px;">
           <form action="/data?form=voteComment&id=<?php echo $candidate['id'] ?>" method="post" modal-close="false" form-reset="true" date-note="vote_comment" data-user="<?php echo $candidate['id'] ?>">
                <div class="col-sm-7 col-sm-offset-1 comment_input">
                    <textarea name="comment" rows="3"></textarea>
                </div>
                <div class="col-sm-3">
                    <input type="submit" name="submit" class="btn btn-sm" value="Send">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
   /* var interval = null;
    var time = 1;
    $("#popup_<?php echo $candidate['id']; ?>").click(function(){
        xml_call("<?php echo $candidate['id'] ?>");
        var time = 1;
        setTimeout(function(){$(".modal-box").css("top", "25px");},100);
        interval = setInterval(update_<?php echo $candidate['id']; ?>, 5000);
    });
    function update_<?php echo $candidate['id']; ?>(){
        xml_call("<?php echo $candidate['id'] ?>");
        if(time == 120){
            window.location = "/vote";
        }
        console.log(time);
        time++
    }*/
</script>
<?php } ?>
<?php include("../includes/layouts/footer.php") ?>
<script type="text/javascript">
    
function xml_call(feed_id){
    $(".modal-box").css("top", "25px");
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            myFunction(this);
        }
    };
    xhttp.open("GET", "/comments/" + feed_id + ".xml", true);
    xhttp.send();

    function myFunction(xml) {
        var comment, name, img, id, body, date, i, txt, xmlDoc; 
        xmlDoc = xml.responseXML;
        txt = "";
        comment = xmlDoc.getElementsByTagName("comment");
        for (i = 0; i < comment.length; i++) {
            name = comment[i].getElementsByTagName("name");
            img = comment[i].getElementsByTagName("image");
            id = comment[i].getElementsByTagName("id");
            body = comment[i].getElementsByTagName("body");
            date = comment[i].getElementsByTagName("date");
            
            var timestamp = date[0].childNodes[0].nodeValue;
            var current_timestamp = new Date();
            var date = new Date(timestamp*1000);
            
            //set Day
            var month = date.getMonth() + 1;
            var day = date.getDate();
            var year = date.getFullYear();
            var formattedDay = month + "/" + day + "/" + year;
            
            var hours = date.getHours();
            var minutes = "0" + date.getMinutes();
            var formattedTime = hours + ':' + minutes.substr(-2);
            txt += "<div class=\"row comment-row\">";
            txt += "<div class=\"col-sm-2 text-center slip\">";
            txt += "<img src=\"";
            txt += img[0].childNodes[0].nodeValue;
            txt += "\" height=\"50px\" />";
            txt += "</div>";
            txt += "<div class=\"col-sm-10 comment\">";
            txt += "<div class=\"name\">";
            txt += name[0].childNodes[0].nodeValue;
            txt += " - <span class=\"date\">";
            txt += formattedDay + " " + formattedTime;
            txt += "</span></div>";
            txt += body[0].childNodes[0].nodeValue;
            txt += "</div>";
            txt += "</div>";
        }
        document.getElementById(feed_id + "_comments").innerHTML = txt;
    }
}
</script>
</body>

</html>
