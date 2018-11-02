<?php require_once("../includes/session.php"); ?>
<?php // require_once("../includes/db_connection.php"); ?>
<?php // require_once("../includes/functions.php") ?>
<?php    
    /*$CM_primary = find_CM_by_ID(1);
    $CM_link = find_CM_by_ID(2);
    $CM_popup_title = find_CM_by_ID(3);
    $CM_popup_body = find_CM_by_ID(4);*/

    // $num = UniqueRandomNumbersWithinRange(1,14,13);
    $num = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14);

?>
<?php include_once("../includes/layouts/header.php"); ?>

<body>
    <!--<div class="preloader-mask">
        <div class="preloader"></div>
    </div>-->

    <section id="hero" class="hero-section bg1 bg-cover light-text">
        <div class="heading-block centered-block align-center">
            <div class="container">
                <h5 class="heading-alt" style="margin-bottom: 8px;margin-top:50px;">Hello, welcome to</h5>
                <div style="margin-bottom:100px;"><img src="assets/img/logo-light.png" alt="UtahTriangle" style="max-height:100px;"></div>
            </div>
        </div>
        </div>
    </section>

<?php include_once("../includes/layouts/nav.php"); ?>
   
    <section id="about" class="section align-center">
        <div class="container">
            <img src="assets/img/logo-deltaT.png" height="50">
            <h3>Triangle Fraternity</h3>
            <p class="text-alt">In order to have a better world, <span class="highlight">we must first have a world of better men</span>.<br> -Herb Scobie minn32</p>
            <br />
            <br />

            <div class="tabs-wrapper tabs-horizontal">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#horizontal_tab1" data-toggle="tab">
                            <h6 class="heading-alt"><span class="fa fa-group"></span> General Info</h6>
                        </a>
                    </li>
                    <li>
                        <a href="#horizontal_tab2" data-toggle="tab">
                            <h6 class="heading-alt"><span class="fa fa-rocket"></span> Utah Triangle</h6>
                        </a>
                    </li>
                    <li>
                        <a href="#horizontal_tab3" data-toggle="tab">
                            <h6 class="heading-alt"><span class="fa fa-bullhorn"></span> Greek Life</h6>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="horizontal_tab1" class="tab-pane fade active in">
                        <div class="col-sm-5 img-column">
                            <img src="assets/img/bid-dinner-members_371x412.jpg" alt="" class="img-responsive" />
                        </div>
                        <div class="col-sm-7 align-left">
                            <h6>About Triangle Fraternity</h6>
                            <p>All Triangle Fraternity brothers strive to be leaders in the campus, local community, and their chosen fields of studies. In order to do so our brothers and volunteers are aware of our mission statement and objectives. Triangle’s purpose is as follows:</p>
                            <p style="font-style:italic;font-weight:500" class="highlight">The purpose of Triangle shall be to maintain a fraternity of engineers, architects and scientists. It shall carry out its purpose by establishing chapters that develop balanced men who cultivate high moral character, foster lifelong friendships, and live their lives with integrity.</p>
                            <p><strong>The objectives of Triangle Fraternity are as follows:</strong></p>
                            <ul class="about-list">
                                <li>To help develop the highest standards of personal integrity and character,</li>
                                <li>To foster and provide an intellectual, mature environment for its members through individual and group effort and through the mutual companionship of men with similar professional interests and goals,</li>
                                <li>To foster and provide the broadening experience of fraternity living with its social and moral challenges and responsibilities for the individual and the chapter,</li>
                                <li>To recognize and support the objectives and goals of the alma mater and those of the community through responsible participation and action,</li>
                                <li>To help bridge the gap between undergraduate study and the vocation of the individual in industry, the academic world or government,</li>
                                <li>To foster and maintain a bond of fraternal brotherhood through a continuing program of activity for the alumni, and</li>
                                <li>To bring into focus the elements of planned progress for the betterment of mankind</li>
                            </ul>
                            <p>Learn more about our purpose, history, awards, and our national orinization <a href="http://triangle.org/about/" target="_blank">here</a>.</p>
                        </div>
                    </div>

                    <div id="horizontal_tab2" class="tab-pane fade">
                        <div class="col-sm-7 align-right">
                            <h6>About Utah Triangle Chapter</h6>
                            <p><span class="highlight">Founded:</span> August 2013</p>
                            <p><span class="highlight">Installed:</span>  April 25, 2015</p>
                            <p>The idea to start a Utah Chapter was first suggested to Utah alumni brother Jeff Thomas utah14 from Colorado State Chapter brother Tyler Green csu11. Jeff began to work with National Headquarters to begin the colonization process along with Shane Shoemaker utah14 and Rex Knickerbocker utah14. Initial colony members shared an interest in the outdoors, which lead to many of the recruitment events taking place in the mountains and parks around campus. In October of 2013, the Utah Colony of Triangle petitioned to become a member of the Inter-fraternal Council at the University of Utah and was accepted. The Utah colony continued to grow both in numbers and structure. In the winter of 2015 the formally submitted their petition to charter Triangle Fraternity’s National Council.</p>
                        </div>

                        <div class="col-sm-5 img-column">
                            <img src="assets/img/couch-sled_371x412.jpg" alt="" class="img-responsive" />
                        </div>
                    </div>

                    <div id="horizontal_tab3" class="tab-pane fade">
                        <div class="col-sm-5 img-column">
                            <img src="assets/img/greek-life_371x412.jpg" alt="" class="img-responsive" />
                        </div>
                        <div class="col-sm-7 align-left">
                            <h6>About Greek Life</h6>
                            <p>Most colleges have fraternity and sorority houses on campus. Collectively, these groups are called the “Greek system,” because each house is named after two or three letters of the Greek alphabet. There are social Greek organizations, as well as those dedicated to a particular profession, such as medicine, law, engineering, or journalism.</p>
                            <p>A lot of what you’ve heard about fraternities and sororities is true. There are plenty of “Animal House” antics going on. But frats and sororities aren’t just about all-night keggers and random hook-ups. Greek organizations do a lot of community service: they raise money for charities, volunteer in soup kitchens and for other community organizations, and organize food drives on campus. These events are great résumé builders, and employers see participation in Greek organizations as a plus. Among other things, it means that you have some measure of discipline and that you managed to maintain decent grades in college despite your extracurricular commitments.</p>
                            <p><strong>Reasons to Go Greek</strong></p>
                            <ul class="about-list">
                                <li>Lower dropout rate than non-Greek students</li>
                                <li>Instant community, which is crucial during your first year</li>
                                <li>Leadership opportunities, which will serve you well later in life</li>
                                <li>Community service that will add credits to your résumé</li>
                                <li>Support structure, which helps students when they are going through hard times</li>
                                <li>Tutoring and academic support</li>
                                <li>Parties, parties, parties!</li>
                                <li>Intramural sports</li>
                                <li>Nice houses</li>
                                <li>Networking opportunities after graduation</li>
                            </ul>
                            <p>Learn more about The University of Utah's Greek System <a href="http://fraternityandsororitylife.utah.edu/" target="_blank">here</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="counters" class="section align-center overlay bg-cover bg5 light-text">
        <div class="container">

            <div class="row counters-wrapper">
                <div class="col-sm-3">
                    <div class="counter-block counter-block-no-border">
                        <div class="counter-box">
                            <div class="counter-content">
                                <span class="count" data-from="0" data-to="27000">0</span>

                                <p class="title">Triangle members initiated worldwide</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="counter-block counter-block-no-border">
                        <div class="counter-box">
                            <div class="counter-content">
                                <span class="count" data-from="0" data-to="18000">0</span>

                                <p class="title">Triangle members living today<br>&nbsp;</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="counter-block counter-block-no-border">
                        <div class="counter-box">
                            <div class="counter-content">
                                <span class="count" data-from="0" data-to="33">0</span>

                                <p class="title">active Utah Triangle members</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="counter-block counter-block-no-border">
                        <div class="counter-box">
                            <div class="counter-content">
                                <span class="count" data-from="0" data-to="14">0</span>

                                <p class="title">alumni Utah Triangle members</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="recruitment" class="section align-center">
        <div class="container">
            <span class="icon section-icon icon-documents-bookmarks-12"></span>
            <h3>Recruitment</h3>
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 align-center" style="margin-bottom:10px;">
                    <p><?php if($CM_primary['recruitment'] == ""){ echo "<i class=\"fa fa-space-shuttle\" style=\"color:#51545b;font-size:60px;\"></i>"; } else { echo $CM_primary['recruitment']; } ?></p>
                    <?php echo $CM_link['recruitment']; ?>
                </div>
            </div>
            <div class="gallery masonry">
                <span class="masonry-item">
					<a href="#" class="gallery-thumb-link" data-modal-link="gallery-1">
						<img src="assets/img/gallery/gallery<?php echo $num[0]; ?>-thumb.png" alt="">
					</a>

					<div class="modal-window" data-modal="gallery-1">
						<div class="modal-box medium animated" data-animation="zoomIn" data-duration="700">
							<span class="close-btn icon icon-office-52"></span>
                            <h5 class="heading-alt">Gallery image 1</h5>
                            <br/>

                            <img src="assets/img/gallery/gallery<?php echo $num[0]; ?>.png" class="full-width-img" alt="gallery1">
                        </div>
                    </div>
                </span>

        <span class="masonry-item">
					<a href="#" class="gallery-thumb-link" data-modal-link="gallery-2">
						<img src="assets/img/gallery/gallery<?php echo $num[1]; ?>-thumb.png" alt="">
					</a>

					<div class="modal-window" data-modal="gallery-2">
						<div class="modal-box medium animated" data-animation="zoomIn" data-duration="700">
							<span class="close-btn icon icon-office-52"></span>

        <h5 class="heading-alt">Gallery image 2</h5>
        <br/>

        <img src="assets/img/gallery/gallery<?php echo $num[1]; ?>.png" class="full-width-img" alt="gallery1">
        </div>
        </div>
        </span>
        <span class="masonry-item">
					<a href="#" class="gallery-thumb-link" data-modal-link="gallery-3">
						<img src="assets/img/gallery/gallery<?php echo $num[2]; ?>-thumb.png" alt="">
					</a>

					<div class="modal-window" data-modal="gallery-3">
						<div class="modal-box medium animated" data-animation="zoomIn" data-duration="700">
							<span class="close-btn icon icon-office-52"></span>

        <h5 class="heading-alt">Gallery image 3</h5>
        <br/>

        <img src="assets/img/gallery/gallery<?php echo $num[2]; ?>.png" class="full-width-img" alt="gallery1">
        </div>
        </div>
        </span>

        <span class="masonry-item">
					<a href="#" class="gallery-thumb-link" data-modal-link="gallery-4">
						<img src="assets/img/gallery/gallery<?php echo $num[3]; ?>-thumb.png" alt="">
					</a>

					<div class="modal-window" data-modal="gallery-4">
						<div class="modal-box medium animated" data-animation="zoomIn" data-duration="700">
							<span class="close-btn icon icon-office-52"></span>

        <h5 class="heading-alt">Gallery image 4</h5>
        <br/>

        <img src="assets/img/gallery/gallery<?php echo $num[3]; ?>.png" class="full-width-img" alt="gallery1">
        </div>
        </div>
        </span>
        <span class="masonry-item">
					<a href="#" class="gallery-thumb-link" data-modal-link="gallery-5">
						<img src="assets/img/gallery/gallery<?php echo $num[4]; ?>-thumb.png" alt="">
					</a>

					<div class="modal-window" data-modal="gallery-5">
						<div class="modal-box medium animated" data-animation="zoomIn" data-duration="700">
							<span class="close-btn icon icon-office-52"></span>

        <h5 class="heading-alt">Gallery image 5</h5>
        <br/>

        <img src="assets/img/gallery/gallery<?php echo $num[4]; ?>.png" class="full-width-img" alt="gallery1">
        </div>
        </div>
        </span>

        <span class="masonry-item">
					<a href="#" class="gallery-thumb-link" data-modal-link="gallery-6">
						<img src="assets/img/gallery/gallery<?php echo $num[5]; ?>-thumb.png" alt="">
					</a>

					<div class="modal-window" data-modal="gallery-6">
						<div class="modal-box medium animated" data-animation="zoomIn" data-duration="700">
							<span class="close-btn icon icon-office-52"></span>

        <h5 class="heading-alt">Gallery image 6</h5>
        <br/>

        <img src="assets/img/gallery/gallery<?php echo $num[5]; ?>.png" class="full-width-img" alt="gallery1">
        </div>
        </div>
        </span>
        <span class="masonry-item">
					<a href="#" class="gallery-thumb-link" data-modal-link="gallery-7">
						<img src="assets/img/gallery/gallery<?php echo $num[6]; ?>-thumb.png" alt="">
					</a>

					<div class="modal-window" data-modal="gallery-7">
						<div class="modal-box medium animated" data-animation="zoomIn" data-duration="700">
							<span class="close-btn icon icon-office-52"></span>

        <h5 class="heading-alt">Gallery image 7</h5>
        <br/>

        <img src="assets/img/gallery/gallery<?php echo $num[6]; ?>.png" class="full-width-img" alt="gallery1">
        </div>
        </div>
        </span>

        <span class="masonry-item">
					<a href="#" class="gallery-thumb-link" data-modal-link="gallery-8">
						<img src="assets/img/gallery/gallery<?php echo $num[7]; ?>-thumb.png" alt="">
					</a>

					<div class="modal-window" data-modal="gallery-8">
						<div class="modal-box medium animated" data-animation="zoomIn" data-duration="700">
							<span class="close-btn icon icon-office-52"></span>

        <h5 class="heading-alt">Gallery image 8</h5>
        <br/>

        <img src="assets/img/gallery/gallery<?php echo $num[7]; ?>.png" class="full-width-img" alt="gallery1">
        </div>
        </div>
        </span>

        <span class="masonry-item">
					<a href="#" class="gallery-thumb-link" data-modal-link="gallery-9">
						<img src="assets/img/gallery/gallery<?php echo $num[8]; ?>-thumb.png" alt="">
					</a>

					<div class="modal-window" data-modal="gallery-9">
						<div class="modal-box medium animated" data-animation="zoomIn" data-duration="700">
							<span class="close-btn icon icon-office-52"></span>

        <h5 class="heading-alt">Gallery image 9</h5>
        <br/>

        <img src="assets/img/gallery/gallery<?php echo $num[8]; ?>.png" class="full-width-img" alt="gallery1">
        </div>
        </div>
        </span>
        <span class="masonry-item">
					<a href="#" class="gallery-thumb-link" data-modal-link="gallery-10">
						<img src="assets/img/gallery/gallery<?php echo $num[9]; ?>-thumb.png" alt="">
					</a>

					<div class="modal-window" data-modal="gallery-10">
						<div class="modal-box medium animated" data-animation="zoomIn" data-duration="700">
							<span class="close-btn icon icon-office-52"></span>

        <h5 class="heading-alt">Gallery image 10</h5>
        <br/>

        <img src="assets/img/gallery/gallery<?php echo $num[9]; ?>.png" class="full-width-img" alt="gallery1">
        </div>
        </div>
        </span>

        <span class="masonry-item">
					<a href="#" class="gallery-thumb-link" data-modal-link="gallery-11">
						<img src="assets/img/gallery/gallery<?php echo $num[10]; ?>-thumb.png" alt="">
					</a>

					<div class="modal-window" data-modal="gallery-11">
						<div class="modal-box medium animated" data-animation="zoomIn" data-duration="700">
							<span class="close-btn icon icon-office-52"></span>

        <h5 class="heading-alt">Gallery image 11</h5>
        <br/>

        <img src="assets/img/gallery/gallery<?php echo $num[10]; ?>.png" class="full-width-img" alt="gallery1">
        </div>
        </div>
        </span>

        <span class="masonry-item">
					<a href="#" class="gallery-thumb-link" data-modal-link="gallery-12">
						<img src="assets/img/gallery/gallery<?php echo $num[11]; ?>-thumb.png" alt="">
					</a>

					<div class="modal-window" data-modal="gallery-12">
						<div class="modal-box medium animated" data-animation="zoomIn" data-duration="700">
							<span class="close-btn icon icon-office-52"></span>

        <h5 class="heading-alt">Gallery image 12</h5>
        <br/>

        <img src="assets/img/gallery/gallery<?php echo $num[11]; ?>.png" class="full-width-img" alt="gallery1">
        </div>
        </div>
        </span>
        </div>

        <div class="col-sm-12" style="margin-top:25px;">
            <a data-modal-link="email-brother" class="btn btn-outline-clr btn-md">Rush Triangle</a>
        </div>
        </div>
    </section>

    <section id="boards" class="section align-center">
        <div class="container">
            <span class="icon section-icon icon-office-21"></span>
            <h3>Boards</h3>
            <p class="text-alt">Stay involved, <span class="highlight">keep up-to-date</span></p>
            <br/>
            <br/>

            <div class="row">
                <div class="col-sm-4">
                    <div class="package-column">
                        <h6 class="package-title">President</h6>
                        <br>
                        <p><?php if($CM_primary['president'] == ""){ echo "<i class=\"fa fa-space-shuttle\" style=\"color:#51545b;font-size:60px;\"></i>"; } else { echo $CM_primary['president']; } ?></p>
                        <?php 
                            if(!empty($CM_popup_title['president']) && !empty($CM_popup_body['president'])){
                                echo "<p><a href='#' data-modal-link='popup-president'>".$CM_popup_title['president']."</a>";
                            }
                        ?>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="package-column">
                        <h6 class="package-title">Vice President</h6>
                        <br>
                        <p><?php if($CM_primary['vicePresident'] == ""){ echo "<i class=\"fa fa-space-shuttle\" style=\"color:#51545b;font-size:60px;\"></i>"; } else { echo $CM_primary['vicePresident']; } ?></p>
                        <?php 
                            if(!empty($CM_popup_title['vicePresident']) && !empty($CM_popup_body['vicePresident'])){
                                echo "<p><a href='#' data-modal-link='popup-vicePresident'>".$CM_popup_title['vicePresident']."</a>";
                            }
                        ?>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="package-column">
                        <h6 class="package-title">Brotherhood</h6>
                        <br>
                        <p><?php if($CM_primary['brotherhood'] == ""){ echo "<i class=\"fa fa-space-shuttle\" style=\"color:#51545b;font-size:60px;\"></i>"; } else { echo $CM_primary['brotherhood']; } ?></p>
                        <?php 
                            if(!empty($CM_popup_title['brotherhood']) && !empty($CM_popup_body['brotherhood'])){
                                echo "<p><a href='#' data-modal-link='popup-brotherhood'>".$CM_popup_title['brotherhood']."</a>";
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top:15px;">
                <div class="col-sm-4">
                    <div class="package-column">
                        <h6 class="package-title">Administration</h6>
                        <br>
                        <p><?php if($CM_primary['administration'] == ""){ echo "<i class=\"fa fa-space-shuttle\" style=\"color:#51545b;font-size:60px;\"></i>"; } else { echo $CM_primary['administration']; } ?></p>
                        <?php 
                            if(!empty($CM_popup_title['administration']) && !empty($CM_popup_body['administration'])){
                                echo "<p><a href='#' data-modal-link='popup-administration'>".$CM_popup_title['administration']."</a>";
                            }
                        ?>
                    </div>
                </div>
                
                <div class="col-sm-4">
                    <div class="package-column">
                        <h6 class="package-title">Treasury</h6>
                        <p><?php if($CM_primary['treasury'] == ""){ echo "<i class=\"fa fa-space-shuttle\" style=\"color:#51545b;font-size:60px;\"></i>"; } else { echo $CM_primary['treasury']; } ?></p>
                        <?php 
                            if(!empty($CM_popup_title['treasury']) && !empty($CM_popup_body['treasury'])){
                                echo "<p><a href='#' data-modal-link='popup-treasury'>".$CM_popup_title['treasury']."</a>";
                            }
                        ?>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="package-column">
                        <h6 class="package-title">External Affairs</h6>
                        <p><?php if($CM_primary['externalAffairs'] == ""){ echo "<i class=\"fa fa-space-shuttle\" style=\"color:#51545b;font-size:60px;\"></i>"; } else { echo $CM_primary['externalAffairs']; } ?></p>   
                        <?php 
                            if(!empty($CM_popup_title['externalAffairs']) && !empty($CM_popup_body['externalAffairs'])){
                                echo "<p><a href='#' data-modal-link='popup-externalAffairs'>".$CM_popup_title['externalAffairs']."</a>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="sign_up" class="section bg-cover overlay bg4 light-text align-center">
        <div class="container">
            <h2><span class="highlight">Newsletter</span> Sign Up</h2>
            <small>No Spam - Only latest news and activity updates</small><br>
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <form id="subscribe_main" action="/data?form=newsletter" method="post" class="form row newsletter-form" form-reset="true" form-title="newsletter">
                    <fieldset class="col-sm-8">
                        <input id="NewsletterEmail" name="NewsletterEmail" type="email" placeholder="email@email.com">
                    </fieldset>
                    <fieldset class="col-sm-4">
                        <input type="submit" name="submit" value="submit" class="btn btn-sm btn-outline-clr">
                    </fieldset>
                    <div class="response"></div>
                </form>
            </div>
        </div>
    </section>

    <section id="speakers" class="section align-center brothers">
        <div class="container">
            <span class="icon section-icon icon-faces-users-04"></span>
            <h3>Members</h3>
            <p class="text-alt">Meet our <span class="highlight">brothers</span></p>
            <br />
            <br />

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/zachZ.jpg" alt="Zach Z" class="img-responsive"></div>
                    <h3 class="name">Zach</h3>
                    <p class="text-alt"><small>Utah Triangle President</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/nikoT.jpg" alt="Niko T" class="img-responsive"></div>
                    <h3 class="name">Niko</h3>
                    <p class="text-alt"><small>Vice President</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/harelyA.jpg" alt="Harley A" class="img-responsive"></div>
                    <h3 class="name">Harley</h3>
                    <p class="text-alt"><small>Vp of Administration</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/ryanC.png" alt="Ryan C" class="img-responsive"></div>
                    <h3 class="name">Ryan</h3>
                    <p class="text-alt"><small>VP of Treasury</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/samB.png" alt="Sam B" class="img-responsive"></div>
                    <h3 class="name">Sam</h3>
                    <p class="text-alt"><small>VP of External Affairs</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/jimS.png" alt="Jim S" class="img-responsive"></div>
                    <h3 class="name">Jim</h3>
                    <p class="text-alt"><small>VP of Internal Affairs</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/cameronA.png" alt="Cameron A" class="img-responsive"></div>
                    <h3 class="name">Cameron</h3>
                    <p class="text-alt"><small>VP of Recruitment</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/adamK.jpg" alt="Adam K" class="img-responsive"></div>
                    <h3 class="name">Adam</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/alikN.jpg" alt="Alik N" class="img-responsive"></div>
                    <h3 class="name">Alik</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/austinR.jpg" alt="Austin R" class="img-responsive"></div>
                    <h3 class="name">Austin</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/brandonW.jpg" alt="Brandon W" class="img-responsive"></div>
                    <h3 class="name">Brandon</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/chaseM.jpg" alt="Chase M" class="img-responsive"></div>
                    <h3 class="name">Chase</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/colinD.jpg" alt="Colin D" class="img-responsive"></div>
                    <h3 class="name">Colin</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/dakotaJ.jpg" alt="Dakota J" class="img-responsive"></div>
                    <h3 class="name">Dakota</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/dannyF.jpg" alt="Danny F" class="img-responsive"></div>
                    <h3 class="name">Danny</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/dylanW.jpg" alt="Dylan W" class="img-responsive"></div>
                    <h3 class="name">Dylan</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/dyllonG.jpg" alt="Dyllon G" class="img-responsive"></div>
                    <h3 class="name">Dyllon</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/ericT.jpg" alt="Eric T" class="img-responsive"></div>
                    <h3 class="name">Eric</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/erikS.jpg" alt="Erik S" class="img-responsive"></div>
                    <h3 class="name">Erik</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/ethanR.jpg" alt="Ethan R" class="img-responsive"></div>
                    <h3 class="name">Ethan</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/harryH.jpg" alt="Harry H" class="img-responsive"></div>
                    <h3 class="name">Harry</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/jamesC.jpg" alt="James C" class="img-responsive"></div>
                    <h3 class="name">James</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/blank.png" alt="Josh M" class="img-responsive"></div>
                    <h3 class="name">Josh</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/kohlS.jpg" alt="Kohl S" class="img-responsive"></div>
                    <h3 class="name">Kohl</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/markP.jpg" alt="Mark P" class="img-responsive"></div>
                    <h3 class="name">Mark</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/nickM.jpg" alt="Nick M" class="img-responsive"></div>
                    <h3 class="name">Nick</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/rileyW.jpg" alt="Riley W" class="img-responsive"></div>
                    <h3 class="name">Riley</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/ryanD.jpg" alt="Ryan D" class="img-responsive"></div>
                    <h3 class="name">Ryan</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/samA.jpg" alt="Sam A" class="img-responsive"></div>
                    <h3 class="name">Sam</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/samC.jpg" alt="Sam C" class="img-responsive"></div>
                    <h3 class="name">Sam</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/tayloeB.jpg" alt="Tayloe B" class="img-responsive"></div>
                    <h3 class="name">Tayloe</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/teakL.jpg" alt="Teak L" class="img-responsive"></div>
                    <h3 class="name">Teak</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="speaker">
                    <div class="photo-wrapper rounded"><img src="assets/img/members/zachB.jpg" alt="Zach B" class="img-responsive"></div>
                    <h3 class="name">Zach</h3>
                    <p class="text-alt"><small>&nbsp;</small></p>
                    </ul>
                </div>
            </div>

            <div class="col-sm-12 alumni_members_btn_div">
                <a class="btn btn-outline-clr btn-md alumni_members_btn">View Alumni Brothers</a>
            </div>

            <div id="alumni_members" class="alumni_members">
                <div class="col-sm-12 alumni_title">
                    <h3>Alumni Members</h3>
                    <br>
                    <br>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/blank.png" alt="John Doe" class="img-responsive"></div>
                        <h3 class="name">Jeff Thomas</h3>
                        <p class="text-alt"><small>Utah Triangle Founder<br>
                            Alumni Advisor</small></p>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/blank.png" alt="John Doe" class="img-responsive"></div>
                        <h3 class="name">Sheyne Anderson</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/blank.png" alt="John Doe" class="img-responsive"></div>
                        <h3 class="name">Alex Bailey</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>
                <!--<div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/blank.png" alt="John Doe" class="img-responsive"></div>
                        <h3 class="name">Alvaro Bonilla</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>-->
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/blank.png" alt="John Doe" class="img-responsive"></div>
                        <h3 class="name">Brian Flach</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/blank.png" alt="John Doe" class="img-responsive"></div>
                        <h3 class="name">Jared Gabaldon</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/austinG.jpg" alt="Austin Gamblin" class="img-responsive"></div>
                        <h3 class="name">Austin Gamblin</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/blank.png" alt="John Doe" class="img-responsive"></div>
                        <h3 class="name">Joseph Illingworth</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/blank.png" alt="John Doe" class="img-responsive"></div>
                        <h3 class="name">Rex Knickerbocker</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/blank.png" alt="John Doe" class="img-responsive"></div>
                        <h3 class="name">Shane Shoemaker</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/trevorT.jpg" alt="Trevor Teerlink" class="img-responsive"></div>
                        <h3 class="name">Trevor Teerlink</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/samD.jpg" alt="Samuel Davidson" class="img-responsive"></div>
                        <h3 class="name">Samuel Davidson</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/joshF.jpg" alt="Joshua Friesen" class="img-responsive"></div>
                        <h3 class="name">Joshua	Friesen</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/randyJ.jpg" alt="Randall Jones" class="img-responsive"></div>
                        <h3 class="name">Randall Jones</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6">
                    <div class="speaker">
                        <div class="photo-wrapper rounded"><img src="assets/img/members/daveT.jpg" alt="Dave Templeman" class="img-responsive"></div>
                        <h3 class="name">Dave Templeman</h3>
                        <p class="text-alt"><small><br><br></small></p>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 align-center">
                <br>
                <br>
            </div>

        </div>
    </section>

    <section id="contacts">
        <div class="contacts-wrapper">
            <div >
                <div id="map"></div>
                <div class="container contacts-on-map-container">
                    <div class="contacts-on-map">
                        <h3>Location</h3>
                        <ul class="list">
                            <li><i class="fa fa-map-marker"></i>1474 Federal Way, Salt Lake City, UT 84102</li>
                            <li><i class="fa fa-envelope"></i><a href="mailto:info@utahtriangle.com">info@utahtriangle.com</a></li>
                            <li><i class="fa fa-envelope"></i><a href="mailto:recruitment@utahtriangle.com">recruitment@utahtriangle.com</a></li>
                            <li><i class="fa fa-envelope"></i><a href="mailto:president@utahtriangle.com">president@utahtriangle.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    </section>

<?php include_once("../includes/layouts/footer.php"); ?>
<div class="modal-window" data-modal="popup-president" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight"><?php echo $CM_popup_title['president']; ?></span></h5>
        <p><?php echo $CM_popup_body['president']; ?></p>
    </div>
</div>

<div class="modal-window" data-modal="popup-vicePresident" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight"><?php echo $CM_popup_title['vicePresident']; ?></span></h5>
        <p><?php echo $CM_popup_body['vicePresident']; ?></p>
    </div>
</div>

<div class="modal-window" data-modal="popup-brotherhood" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight"><?php echo $CM_popup_title['brotherhood']; ?></span></h5>
        <p><?php echo $CM_popup_body['brotherhood']; ?></p>
    </div>
</div>

<div class="modal-window" data-modal="popup-administration" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight"><?php echo $CM_popup_title['administration']; ?></span></h5>
        <p><?php echo $CM_popup_body['administration']; ?></p>
    </div>
</div>

<div class="modal-window" data-modal="popup-treasury" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight"><?php echo $CM_popup_title['treasury']; ?></span></h5>
        <p><?php echo $CM_popup_body['treasury']; ?></p>
    </div>
</div>

<div class="modal-window" data-modal="popup-externalAffairs" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>
        <h5 class="align-center"><span class="highlight"><?php echo $CM_popup_title['externalAffairs']; ?></span></h5>
        <p><?php echo $CM_popup_body['externalAffairs']; ?></p>
    </div>
</div>
<script src="/assets/js/map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSuf_tF5xCktVeyqxatDVU80ubns6hUag&callback=initMap" async defer></script>
</body>

</html>
