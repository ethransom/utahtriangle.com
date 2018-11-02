<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php") ?>
<?php
    $page_title = $_SERVER["REDIRECT_STATUS"] . " ERROR";
    
    $title = "";
    $description = "";
    $sub_description = "";
    $icon = "";
    $color= "#75b93f";
    switch($_SERVER["REDIRECT_STATUS"]){
        case 400:
            $title = "400";
            $description = "Bad Request";
            $sub_description = "The request can not be processed due to bad syntax";
            $icon = "glyphicon glyphicon-warning-sign";
            $color = "#e3a72b";
        break;

        case 401:
            $title = "401";
            $description = "Unauthorized";
            $sub_description = "The request has failed authentication";
            $icon = "glyphicon glyphicon-ban-circle";
            $color = "#B8332A";
        break;

        case 403:
            $title = "403";
            $description = "Forbidden";
            $sub_description = "The server refuses to response to the request";
            $icon = "glyphicon glyphicon-ban-circle";
            $color = "#B8332A";
        break;

        case 404:
            $title = "404";
            $description = "Oh dear, we seem to have led you astray";
            $sub_description = "Let's get back on track...";
            $icon = "icon icon-compass";
        break;

        case 500:
            $title = "500";
            $description = "Sorry about this, something's gone wrong.";
            $sub_description = "We're working to fix this ASAP.";
            $icon = "icon icon-hourglass icon-large";
            $color = "#e3a72b";
        break;

        case 502:
            $title = "502";
            $description = "Bad Gateway";
            $sub_description = "The server was acting as a proxy and received a bad request.";
            $icon = "glyphicon glyphicon-random";
            $color = "#e3a72b";
        break;

        case 504:
            $title = "504";
            $description = "Gateway Timeout";
            $sub_description = "The server was acting as a proxy and the request timed out.";
            $icon = "glyphicon glyphicon-time";
            $color = "#e3a72b";
        break;
            
        default:
            redirect_to('/');
    }
?>
<?php include("../includes/layouts/header.php") ?>
<style>
    .btn-submit{
        border: 2px solid white !important;
        background-color: #fff !important;
        color: #000 !important;
    }
    .bg-primary {
        background-color: <?php echo $color ?> !important;
    }
    .error-page span{
        display: inline-block;
        font-size: 80px;
        margin-bottom: 24px;
    }
    .error-secion {
        margin: 150px 0;
    }
</style>
<?php include("../includes/layouts/nav.php") ?>
        
		<div class="main-container">
			<section class="error-secion">
          
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<h1 class="text-rose" style="font-size:150px"><?php echo $title ?></h1>
							<h1><strong><?php echo $description ?></strong><br><?php echo $sub_description ?></h1>
							<a href="/" class="btn">Take Me Home</a>
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</section>
		</div>
<?php include("../includes/layouts/footer.php") ?>
</body>
</html>