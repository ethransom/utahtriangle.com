<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php login_check() ?>
<?php
    
    $vote_set = find_all_votes();
    $user_set = find_all_users();
    $candidate_set = find_all_candidates();
    $comments = false;
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
    
    /* Comment Box */
    .comment-textarea {
        min-height: 32px;
        max-height: 150px;
        height: 32px;
        margin-bottom: 2px;
        border: grey solid 1px;
    }
    
    .comment-box{
        padding: 5px;
        padding-top: 0;
        border: grey solid 1px;
        margin: 5px 0;
        background-color: #fff;
        max-height: 150px;
        overflow-y: scroll;
        overflow-x: hidden;
    }
    
    .comment {
        font-size: 12px;
        text-align: left;
        padding-right: 15px;
    }
    
    .comment .name{
        font-size: 10px;
        position: absolute;
        top: -15px;
        min-width: 500px;
    }
    .comment-box .row{
        margin-top: 20px;
    }
    
    .no-comment {
        margin: 5px;
        margin-top: 10px;
        font-size: 14px;
    }
    
    .name {
        color: #51545b;
        font-size: 24px;
        margin: 0;
        font-weight: normal;
        letter-spacing: normal;
    }
    
    h5 {
        font-size: 36px;
    }
    
    h6 {
        color: #51545b;
        font-size: 14px;
    }
    
    hr {
        margin: 0;
        margin-bottom: 5px;
    }
    
    .results td {
        padding: 5px;
    }
    
    .results label.result {
        font-size: 14px;
    }

    .results label.name {
        font-size: 14px;
    }
    
    .comment-box::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    .comment-box::-webkit-scrollbar
    {
        width: 12px;
        background-color: #F5F5F5;
    }

    .comment-box::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #8a1538;
    }

</style>
<script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="https://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
<?php include("../includes/layouts/nav.php") ?>
<section class="section">
    <div class="container">
      <div class="col-sm-12 align-center">
          <h1 style="margin-bottom:0;" class="text-grey">Election Center</h1>
          <!--<hr>
          <div style="font-size:50px"><i class="fa fa-warning"></i></div>
          <p class="text-yellow"><strong>Notice:</strong> The election system does not currently support touch screens.  <br>Please use a system with a cursor.</p>-->
          <hr style="margin:0;margin-bottom:50px;">
      </div>
       <?php
            $i = 0;
            $col_count = 1;
            while($vote = mysqli_fetch_assoc($vote_set)) {
                if($col_count == 4){
                    $col_count = 1;
                }
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
        ?>
        <?php if($col_count == 1){ ?>
        <div class="row">
        <?php } ?>
        <div class="col-md-4 col-sm-6 align-center" style="margin-bottom:25px;">
            <h5 class="align-center"><span class="highlight"><?php echo $vote['title']; ?></span></h5>
            <?php if(isset($vote['result']) && !empty($vote['result'])){ ?>
            <div class="voted">
                <h5 class="text-rose" style="margin:0">Election Closed</h5>
                <?php if($vote['type'] == 1){ ?>
                <h5 style="font-size:18px;margin:0;"><span class="text-grey">Winner:</span> <span class="text-green"> Results Hidden<?php // $candidate = find_candidate_by_id($vote['result']); echo $candidate['name']; ?></span></h5>
                <?php } else { ?>
                <table class="results" width="100%" style="margin-top:10px;">
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
                <?php } ?>
            </div>
            <!--<h5 style="font-size:15px;margin:0;line-height:0" class="text-grey">Participants</h5>
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
                    echo "<div class=\"col-sm-12\">{$users['name']} (<span class=\"text-{$temp_voted_color}\">{$temp_voted}</span>)</div>";
                }
            }
            mysqli_data_seek($user_set, 0);
            ?>-->
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
                    echo "<div class=\"col-sm-12\">{$users['name']} (<span class=\"text-{$temp_voted_color}\">{$temp_voted}</span>)</div>";
                }
            } mysqli_data_seek($user_set, 0);
            ?>
            <?php } else { ?>
            <div id="div_form_id_<?php echo $vote['id']; ?>">
                <p style="margin-bottom:5px;"><?php echo $vote['body']; ?></p>
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
            <?php if($vote['type'] == -1){ ?>
            <p class="text-rose">Voting is currently closed.</p>
            <?php } ?>
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
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="name"><?php echo $candidate['name']; ?></h5>
                            <?php if(!empty($candidate['picture']) || !empty($candidate['description'])){ ?>
                            <hr />
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                      <?php if(!empty($candidate['picture'])){ ?>
                       <div class="col-md-4<?php if(empty($candidate['description'])){ echo " col-md-offset-4"; } ?>">
                            <div class='picture'><a href='<?php echo $candidate['picture']; ?>' target='_blank'><img src='<?php echo $candidate['picture']; ?>' width='75px' /></a></div>
                       </div>
                       <?php } ?>
                      <?php if(!empty($candidate['description'])){ ?>
                       <div class="col-md-<?php if(empty($candidate['picture'])){ echo "12 text-center"; } else { echo "8 text-left"; } ?> description">
                           <?php echo $candidate['description']; ?>
                       </div>
                       <?php } ?>
                    </div>
                    <!--<a style="text-decoration: none;" id="popup_<?php echo $candidate['id']; ?>" data-modal-link="popup-<?php echo $candidate['id']; ?>"><i class="fa fa-comments-o"></i></a>-->
                    <input type="hidden" class="input_candidate" id="input_<?php echo $vote['id']; ?>_<?php echo $id ?>" value="<?php echo $candidate['id'] ?>-">
                    <?php if($vote['comments'] == 1){ $comments = true; ?>
                    <hr />
                    <h6 style="margin:0;margin-top:5px">Comments</h6>
                    <div class="comment-box" id="comment_box_<?php echo $candidate['id'] ?>">
                       <?php 
                        $comment_set = find_all_comments($candidate['id']);
                        $comment = mysqli_fetch_assoc($comment_set);
                        mysqli_data_seek($comment_set, 0);
                        if(!empty($comment)){
                            while($comment = mysqli_fetch_assoc($comment_set)) {
                                $temp_user = get_user_by_google_id($comment['user_id']);
                            ?>
                            <div class="row">
                                <div class="col-xs-2"><img src="<?php echo $temp_user['img'] ?>"></div>
                                <div class="col-xs-10 comment"><div class="name"><?php echo $temp_user['name'] ?> - <?php echo $comment['date'] ?></div><?php echo $comment['comment'] ?></div>
                            </div>
                            <?php } mysqli_data_seek($comment_set, 0); ?>
                        <?php } else { ?>
                            <p class="no-comment text-yellow">No Comments</p>
                        <?php } ?>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            var objDiv = document.getElementById("comment_box_<?php echo $candidate['id'] ?>");
                            objDiv.scrollTop = objDiv.scrollHeight;
                        });
                    </script>
                    <textarea name="comment" class="comment-textarea" id="comment_<?php echo $candidate['id']; ?>"></textarea>
                    <div class="text-right"><a class="btn btn-xs comment-post" data-candidate="<?php echo $candidate['id']; ?>">Post</a></div>
                    <?php } ?>
                    
                    <?php if($vote['type'] == 0){ ?>
                    <hr>
                    <a class="btn btn-xs deny text-rose" data-id="<?php echo $id ?>" form-id="<?php echo $vote['id']; ?>">Oppose</a><a class="btn btn-xs approve text-green" data-id="<?php echo $id ?>" form-id="<?php echo $vote['id']; ?>">Accept</a>
                    <?php } ?>
                </div>
                <?php } ?>
                <input type="hidden" name="order" id="list_form_id_<?php echo $vote['id']; ?>" />
                <input type="hidden" name="formType" value="binary"/>
                <br>
                <?php if($vote['type'] == 0){ ?>
                <input type="submit" name="submit" value="Submit Votes" class="btn" />
                <?php } ?>
                </div>
            </form>
        </div>
            
            <?php } } ?>
            
        </div>
        <?php }?>
    
        <?php if($col_count == 3){ ?>
        </div><!-- END OF COL COUNT -->
        <?php } ?>

        <?php $i++; $col_count++; } ?>
            
      <?php if($i < 1){ ?>
      <div class="col-sm-12 text-center">
          <span class="fa fa-check-square-o text-grey" style="font-size:150px;"></span>
          <h5 class="text-grey">No Elections Open</h5>
      </div>
      <?php } ?>
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

<?php if($comments == true){ ?>
<div class="refresh-box text-center" onclick="location.reload();"><i class="fa fa-refresh"></i> Refresh Comments</div>
<?php } ?>

<?php } ?>
<?php include("../includes/layouts/footer.php") ?>
<script src="/assets/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript">
    
    $("textarea").on("focus", function(){
        $(this).animate({
            height: "150px"
          }, 500, function() {
            // Animation complete.
          });
    });
    
    $("textarea").on("blur", function(){
        $(this).animate({
            height: "32px"
          }, 500, function() {
            // Animation complete.
          });
    });
    
    $(".comment-post").click(function(){
        var id = $(this).attr("data-candidate"),
            comment = $("#comment_" + id).val();
        $.post("/data",
        {
            dataID: "voteComment",
            id: id,
            comment: comment
        },
        function(data, status){
            window.location = "";
        });
    });
</script>
</body>

</html>
