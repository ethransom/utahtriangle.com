    <header class="header header-black">
        <div class="header-wrapper">
            <div class="container">
                <div class="col-sm-2 col-xs-12 navigation-header">
                    <a href="index" class="logo">
                        <img src="assets/img/logo-light.png" alt="UtahTriangle" width="162" height="17" class="retina-hide">
                        <img src="assets/img/logo-light.png" alt="UtahTriangle" width="162" height="17" class="retina-show">
                    </a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-controls="navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="col-sm-10 col-xs-12 navigation-container">
                    <div id="navigation" class="navbar-collapse collapse">
                        <ul class="navigation-list pull-left light-text">
                            <li class="navigation-item"><a href="/index#about" class="navigation-link">About Us</a></li>
                            <li class="navigation-item dropdown">
                                <a href="/index#recruitment" class="navigation-link">Recruitment</a>
                                <ul class="dropdown-menu">
                                    <li class="navigation-item"><a href="#" data-modal-link="email-brother" class="navigation-link">Become a Brother</a></li>
                                </ul>
                            </li>
                            <li class="navigation-item"><a href="/index#boards" class="navigation-link">Boards</a></li>
                            <li class="navigation-item"><a href="/index#speakers" class="navigation-link">Members</a></li>
                            <li class="navigation-item"><a href="/index#contacts" class="navigation-link">Contact Us</a></li>
                            <li class="navigation-item"><a href="#" data-modal-link="popup-donate" class="navigation-link">Donate</a></li>
                        </ul>
                        
                        
                        <?php if(isset($_SESSION['google_id']) && !empty($_SESSION['google_id'])){ ?>
                        <ul class="navigation-list pull-right light-text">
                            <li class="navigation-item dropdown">
                                <a class="navigation-link dropdown-toggle avatar text-yellow" data-toggle="dropdown"><?php echo $_SESSION['name']; ?> <img src="<?php echo $_SESSION['profile_image_url']; ?>"></a>
                                <?php
                                    $user = get_user_by_google_id($_SESSION['google_id']);
                                    if($user['access'] == 0){ $status = "Non-affiliated"; }
                                    if($user['access'] == 3){ $status = "Utah Alumni Member"; }
                                    if($user['access'] == 1){ $status = "PNM"; }
                                    if($user['access'] == 2.1){ $status = "Triangle Alumni Member"; }
                                    if($user['access'] == 2.2){ $status = "Triangle Active Member"; }
                                    if($user['access'] == 5){ $status = "New Member"; }
                                    if($user['access'] == 6){ $status = "Utah Active Member"; }
                                    if($user['access'] == 9){ $status = "Site Admin"; }
                                ?>
                                <ul class="dropdown-menu">
                                    <li class="navigation-item text-center"><a class="status">Member Status: <span class="text-yellow"><?php echo $status ?></span></a></li>
                                    <?php if($user['access'] == 9){ ?><li class="navigation-item"><a href="/admin" class="navigation-link">Admin</a></li> <?php } ?>
                                    <?php if($user['access'] >= 5){ ?><li class="navigation-item"><a href="/member" class="navigation-link">Member Dashboard</a></li> <?php } ?>
                                    <?php if($user['access'] >= 6){ ?><li class="navigation-item"><a href="/vote" class="navigation-link">Elections</a></li> <?php } ?>
                                    <li class="navigation-item"><a href="/donations" class="navigation-link">Donations</a></li>
                                   <!-- <?php if($user['access'] < 9){ ?><li class="navigation-item"><a href="#member-change" data-modal-link="popup-member" class="navigation-link">Request Membership Change</a></li> <?php } ?>-->
                                    <li class="navigation-item"><a href="/google?logout" class="navigation-link">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        <?php } ?>

                        <?php if(!isset($_SESSION['google_id']) || empty($_SESSION['google_id'])){ ?>
                        <!--<a href="#" data-modal-link="email-brother" class="pull-right buy-btn">Become a Brother</a>-->
                        <a href="google?page=index" class="pull-right google-btn" style="margin: 17px 0 0;"><div></div></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </header>