<section class="footer">
    <div class="container">

        <div class="col-md-4">
            <div class="widget about-widget">
                <h6 class="widget-head">Message From the <span class="highlight">President</span></h6>
                <?php $CM_primary = find_CM_by_ID(1); ?>
                <p class="text-alt"><small><?php echo $CM_primary['presidentNote']; ?></small></p>
            </div>
        </div>

        <div class="col-md-4 col-lg-3 col-lg-offset-1">
            <div class="widget contact-widget">
                <h6 class="widget-head"><span class="fa fa-external-link"></span> Useful Links</h6>
                <ul>
                    <li><a href="http://triangle.org/" target="_blank">Triangle Fraternity</a></li>
                    <li><a href="http://www.triangleef.org/" target="_blank">Triangle Fraternity Education Foundation</a></li>
                    <li><a href="https://www.utah.edu/" target="_blank">The University of Utah</a></li>
                    <li><a href="http://fraternityandsororitylife.utah.edu/" target="_blank">The University of Utah Greek Life</a></li>
                    <li><a href="http://nicindy.org/" target="_blank">North-American Interfraternity Conference</a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-4 col-lg-3 col-lg-offset-1">
            <div class="widget instagram-widget">
                <h6 class="widget-head"><a href="https://www.instagram.com/utahtriangle/" target="_blank"><span class="fa fa-instagram"></span></a> Photo feed</h6>

                <ul class="instagram-list">
                    <li><a href="https://www.instagram.com/p/BPB2yDtgSqM/?taken-by=utahtriangle" target="_blank"><img src="https://instagram.fmkc1-1.fna.fbcdn.net/t51.2885-15/s640x640/sh0.08/e35/c0.32.699.699/15803820_2208935325997759_6711825314210643968_n.jpg" alt="photo" /></a></li>
                    <li><a href="https://www.instagram.com/p/BAeL-n7KvT6/?taken-by=utahtriangle" target="_blank"><img src="https://instagram.fmkc1-1.fna.fbcdn.net/t51.2885-15/s640x640/sh0.08/e35/c0.112.900.900/12534532_139890686387662_981047077_n.jpg" alt="photo" /></a></li>
                    <li><a href="https://www.instagram.com/p/z8r-sBKvRS/?taken-by=utahtriangle" target="_blank"><img src="https://instagram.fmkc1-1.fna.fbcdn.net/t51.2885-15/e15/11023166_731723050274502_459837399_n.jpg" alt="photo" /></a></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="footer-base">
        <div class="container">

            <div class="col-md-12 align-right">
                <ul class="socials-nav align-right">
                    <li class="socials-nav-item"><a href="https://www.facebook.com/utahtriangle/" target="_blank"><span class="fa fa-facebook"></span></a></li>
                    <li class="socials-nav-item"><a href="https://www.instagram.com/utahtriangle/" target="_blank"><span class="fa fa-instagram"></span></a></li>
                    <li class="socials-nav-item"><a href="https://twitter.com/utahtriangle" target="_blank"><span class="fa fa-twitter"></span></a></li>
                </ul>

                <p class="text-alt"><small><a href="privacy">Privacy Policy</a> | ©2017 Triangle Fraternity - Utah</small></p>
            </div>

        </div>
    </div>
</section>

<div class="modal-window" data-modal="email-brother" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>

        <h5 class="align-center"><span class="highlight">Become a Brother</span></h5>

        <form class="form registration-form align-center" action="form_data" method="post" modal-close="true" form-reset="true" form-title="brother">

            <div class="col-sm-12">
                <p>Fill out the following form and we will contact you with additional information about how you can get involved with Triangle.</p>
            </div>

            <fieldset class="col-sm-12">
                <label for="first_name">First Name</label>
                <input id="first_name" name="first_name" type="text" placeholder="John">
            </fieldset>

            <fieldset class="col-sm-12">
                <label for="last_name">Last Name</label>
                <input id="last_name" name="last_name" type="text" placeholder="Smith">
            </fieldset>

            <fieldset class="col-sm-12">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="john.smith@mail.com">
            </fieldset>

            <fieldset class="col-sm-12">
                <label for="phone">Phone Number</label>
                <input id="phone" name="phone" type="text" placeholder="(555) 555-5555">
            </fieldset>

            <fieldset class="col-sm-12">
                <label for="major">Field of Study (Major)</label>
                <input id="major" name="major" type="text" placeholder="Architecture">
            </fieldset>

            <fieldset class="col-sm-12">
                <label for="major">Academic Level</label>
                <select name="academic_level">
                    <option value="">- select -</option>
                    <option value="Freshman">Freshman</option>
                    <option value="Sophmore">Sophmore</option>
                    <option value="Junior">Junior</option>
                    <option value="Senior">Senior</option>
                </select>
            </fieldset>

            <fieldset class="col-sm-12">
                <input id="privacy" name="privacy" type="checkbox">
                <label for="privacy">I am currently enrolled (or plan on being enrolled in the upcoming <?php $month = date('m'); if($month >= 1 && $month <= 5){ echo "Summer/Fall"; } else if($month >= 6 && $month <= 8){ echo "Fall"; } else if($month >= 9 && $month <= 12){ echo "Spring"; }; ?> semster) as a student at <a href="http://utah.edu" target="_blank">The University of Utah</a></label>
                <br />
                <br />
            </fieldset>

            <fieldset class="col-sm-12">
                <div class="g-recaptcha" data-sitekey="6LdnvigUAAAAAFdUfgjI8IMik5uWNQ-AxRNxPhnu"></div>
                <br />
            </fieldset>

            <input type="submit" name="brother" value="submit" class="btn">
            <br>
            <br>
            <div class="col-sm-12">If you have any questions please contact <a href="mailto:recruitment@utahtriangle.com?subject=Website: Become a Brother Form">recruitment@utahtriangle.com</a></div>
        </form>

    </div>
</div>

<div class="modal-window" data-modal="popup-donate" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated donate-box" data-animation="zoomIn" data-duration="700">
        <form class="form donate-form align-center" name="donate" id="form_donate" action="" method="post" modal-close="true" form-reset="true">
        <span class="close-btn icon icon-office-52"></span>

        <h5 class="align-center"><span class="highlight">Donate</span></h5>
       <?php if(isset($_SESSION['google_id']) && !empty($_SESSION['google_id'])){ ?>
        <div class="donate-account text-center">
           <div class="col-sm-4">
                <?php
                    $split = explode("?", $_SESSION['profile_image_url']);
                    $photo = $split[0]."?sz=250";
                ?>
                <img src="<?php echo $photo; ?>" />
                <h6><?php echo $_SESSION['name'] ?></h6>
                <h6><small><?php echo $_SESSION['email'] ?></small></h6>
            </div>
            <div class="col-sm-8">
                <h6>Donation History</h6>
                <a href="/donations">Manage Donations</a>
                <div class="donations-container">
                    <table width="100%">
                        <tr>
                            <th>Date</th>
                            <th>Budget</th>
                            <th>Type</th>
                            <th>Amount</th>
                        </tr>
                        <?php
                            $donate_set = find_all_donations();
                            while($donate = mysqli_fetch_assoc($donate_set)) {
                                if($donate['budget'] == 1){ $budget = "Scholoships"; }
                                if($donate['budget'] == 2){ $budget = "Chapter House"; }
                                if($donate['budget'] == 3){ $budget = "Recruitment"; }
                                if($donate['budget'] == 4){ $budget = "Brotherhood"; }
                                if($donate['budget'] == 5){ $budget = "Philanthropy"; }
                                if($donate['budget'] == 0){ $budget = "Genral Donations"; }
                                if($donate['budget'] == 999){ $budget = "Other"; }

                                if($donate['recurring_type'] == 0){ $type = "One-time"; }
                                if($donate['recurring_type'] == 1){ $type = "Monthly"; }
                                if($donate['recurring_type'] == 2){ $type = "Annually"; }

                                if($donate['user_id'] == $_SESSION['google_id']){
                        ?>
                        <tr>
                            <td><?php
                                    $date = explode(" ", $donate['date']);
                                    echo htmlentities($date[0]); ?></td>
                            <td><?php echo $budget ?></td>
                            <td><?php echo $type ?></td>
                            <td>$<?php echo htmlentities($donate['amount']); ?>.00</td>
                        </tr>
                        <?php }} ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="donate-slide">
        <?php } else { ?>
        <p>Utah Triangle is supported by friends/brothers like you. Every penny dontated to Utah Triangle is carefully budgeted and managed to make sure all proceeds go towards developing balanced men who cultivate high moral character, foster lifelong friendships, and live their lives with integrity.</p>

        <p>We want to make sure your contribution is being used in the way you want it ot be used. Please answer a few questions to help us best manage your donation.</p>
            <div class="donate-slide">
               <style>
                .donate-pg1 {
                    position: absolute;
                    right: -100%;
                    transition: .5s;
                }
                </style>
                <div class="col-sm-12 donate-btns donate-pg0">
                    <h6>Sign In</h6>
                    <p>By signing in you can manage your future donations, set donation preferences and have access to additional Utah Triangle content.</p>
                    <a href="google?page=index#donate"><img src="/assets/img/google/btn_google_signin_light_pressed_web@2x.png" height="50px"></a>
                    <h6><small>or</small></h6>
                    <a class="btn btn-sm donate-pg0-next">Donate as a Guest</a>
                </div>
            <?php } ?>
                <div class="col-sm-12 donate-btns donate-pg1">
                    <h5>New Donation</h5>
                    <h6>Where would you like your donation to go?</h6>
                    <h6><small>Triangle Fraternity (National Organization)</small></h6>
                    <a class="btn btn-sm btn-red" href="https://triangle.secure.force.com/pmtx/dn8n__SiteDonation?id=a1tF0000001Acex" target="_blank">Scholoships (Triangle Education Foundation)</a>
                    <a class="btn btn-sm btn-red" href="https://triangle.secure.force.com/pmtx/dn8n__SiteDonation?id=a1tF0000001Acex" target="_blank">Genral Donations</a>
                    <h6><small>Utah Triangle Fraternity</small></h6>
                    <a class="btn btn-sm donate-type donate-type-budget">Scholoships</a>
                    <a class="btn btn-sm donate-type donate-type-budget">Chapter House</a>
                    <a class="btn btn-sm donate-type donate-type-budget">Recruitment</a>
                    <a class="btn btn-sm donate-type donate-type-budget">Brotherhood</a>
                    <a class="btn btn-sm donate-type donate-type-budget">Philanthropy</a>
                    <a class="btn btn-sm donate-type donate-type-budget">Genral Donations</a>
                    <a class="btn btn-sm donate-type donate-type-other">Other</a>
                    <input type="hidden" name="donate_budget" id="donate_budget" tabindex="-1">
                    <a class="donate-pg1-next" style="display:none">next &rArr;</a>
                </div>
                <div class="col-sm-12 donate-btns donate-pg2">
                    <h6>Donation Amount</h6>
                    <a class="btn btn-sm donate-amount">$250</a>
                    <a class="btn btn-sm donate-amount">$100</a>
                    <a class="btn btn-sm donate-amount">$50</a>
                    <a class="btn btn-sm donate-amount">$25</a>
                    <a class="btn btn-sm donate-amount">$10</a>
                    <a class="btn btn-sm donate-amount donate-amount-other">Other</a>
                    <div class="donate-amount-other-div text-center" style="display:none;">
                        <label for="donate_amount">Amount</label>
                        <input name="donate_amount" id="donate_amount" type="text" class="money" placeholder="$250.00" tabindex="-1">
                        <label id="donate_amount_error" class="error" for="donate_amount" style="display:none;position: relative;margin-top: -14px;text-align: left;">Please enter your donation amount.</label>
                    </div>
                    <div class="donate-type-div text-center" style="display:none;">
                        <h6><small>Would you like to make this a recurring donation?</small></h6>
                        <a class="btn btn-sm donate-type-yes" style="width:auto">Yes</a>
                        <a class="btn btn-sm donate-type-no" style="width:auto">No</a>
                        <input type="hidden" name="donate_recurring" id="donate_recurring" tabindex="-1">
                    </div>
                    <div class="donate-recurring-div text-center" style="display:none;">
                        <h6><small>Cycle</small></h6>
                        <a class="btn btn-sm donate-recurring-type" style="width:auto">Monthly</a>
                        <a class="btn btn-sm donate-recurring-type" style="width:auto">Annually</a>
                        <input type="hidden" name="donate_recurring_type" id="donate_recurring_type" value="" tabindex="-1">
                        <div class="recurring_number-div" style="display:none;">
                            <label for="donate_recurring_number">Number of recurring donations (optional):</label>
                            <input type="range" name="donate_recurring_number" id="recurring_number" min="1" max="120" step="1" oninput="rangeUpdate(value)" value="1" tabindex="-1">
                            <output for="month_payments" id="range_text" class="text-left">Indefinite</output>
                            <a class="btn btn-sm donate-pg2-next" style="width:auto">Next</a>
                        </div>
                    </div>
                    <a class="donate-pg2-back">&lArr; back</a> &nbsp;&nbsp; <a class="donate-pg2-next" style="display:none">next &rArr;</a>
                </div>
                <div class="col-sm-12 donate-btns donate-pg3">
                    <h6>Additional Information</h6>
                    <fieldset class="col-sm-12">
                        <label for="donate_name">Name</label>
                        <input name="donate_name" id="donate_name" type="text" placeholder="John Smith" value="<?php if(isset($_SESSION['name']) && !empty($_SESSION['name'])){ echo $_SESSION['name']; } ?>" tabindex="-1">
                        <label id="donate_name_error" class="error" for="donate_name" style="display:none;position: relative;margin-top: -14px;text-align: left;">Please enter your name.  If you'd like this to be an anonymous donation, please enter "NA" into this field.</label>
                    </fieldset>

                    <fieldset class="col-sm-12">
                        <label for="donate_email">Email</label>
                        <input name="donate_email" id="donate_email" type="text" placeholder="john.smith@mail.com" value="<?php if(isset($_SESSION['email']) && !empty($_SESSION['email'])){ echo $_SESSION['email']; } ?>" tabindex="-1">
                        <label id="donate_email_error" class="error" for="donate_email" style="display:none;position: relative;margin-top: -14px;text-align: left;">Please enter your email address.  If you'd like this to be an anonymous donation, please enter "NA" into this field <span class="text-rose text-bold">(Note: If you do not list an email address you will not receive a receipt)</span>.</label>
                        <label id="donate_email_reg_error" class="error" style="display:none;position: relative;margin-top: -14px;text-align: left;">Please enter a valid email address.  If you'd like this to be an anonymous donation, please enter "NA" into this field <span class="text-rose text-bold">(Note: If you do not list an email address you will not receive a receipt)</span>.</label>
                    </fieldset>
                   
                    <?php
                    
                    if(isset($_SESSION['google_id']) && !empty($_SESSION['google_id'])){
                        $user = get_user_by_google_id($_SESSION['google_id']);
                    } else {
                        $user['access'] = 0;
                        $user['chapter'] = "";
                    }
                    
                    ?>
                    
                    <fieldset class="col-sm-12 chapter">
                        <label for="donate_affiliation">What is your affiliation with Utah Triangle?</label>
                        <select name="doante_affiliation" id="donate_affiliation" tabindex="-1">
                               <option data-type="affiliation" value="Non-affiliated"<?php if($user['access'] == 0){ echo " selected"; } ?>>Non-affiliated</option>
                               <option data-type="affiliation" value="Triangle Alumni Member"<?php if($user['access'] == 2.1){ echo " selected"; } ?>>Triangle Alumni Member</option>
                               <option data-type="affiliation" value="Triangle Active Member"<?php if($user['access'] == 2.2){ echo " selected"; } ?>>Triangle Active Member</option>
                               <option data-type="affiliation" value="PNM"<?php if($user['access'] == 1){ echo " selected"; } ?>>PNM</option>
                               <option data-type="affiliation" value="Pledge"<?php if($user['access'] == 5){ echo " selected"; } ?>>Pledge</option>
                               <option data-type="affiliation" value="Utah Active Member"<?php if($user['access'] == 6 || $user['access'] == 9){ echo " selected"; } ?>>Active Member</option>
                               <option data-type="affiliation" value="Utah Alumni Member"<?php if($user['access'] == 3){ echo " selected"; } ?>>Alumni Member</option>
                        </select>
                    </fieldset>
                   
                    <fieldset class="col-sm-12 chapter donate_chapter" style="display:none">
                        <label for="donate_chapter">Initiated Chapter</label>
                        <select name="donate_chater" id="donate_chapter" tabindex="-1">
                            <option value="">- select -</option>
                            <option value="Akron">Akron</option>
                            <option value="Arizona">Arizona</option>
                            <option value="Arizona State">Arizona State</option>
                            <option value="Armour">Armour</option>
                            <option value="Cal Poly Pomona">Cal Poly Pomona</option>
                            <option value="California">California</option>
                            <option value="Carnegie Mellon">Carnegie Mellon</option>
                            <option value="Charlotte">Charlotte</option>
                            <option value="Cincinnati">Cincinnati</option>
                            <option value="Clarkson">Clarkson</option>
                            <option value="Clemson">Clemson</option>
                            <option value="Colorado">Colorado</option>
                            <option value="Colorado State">Colorado State</option>
                            <option value="Connecticut">Connecticut</option>
                            <option value="Cornell">Cornell</option>
                            <option value="Florida">Florida</option>
                            <option value="Florida Atlantic">Florida Atlantic</option>
                            <option value="Georgia Tech">Georgia Tech</option>
                            <option value="Houston">Houston</option>
                            <option value="Illinois">Illinois</option>
                            <option value="Iowa">Iowa</option>
                            <option value="Iowa State">Iowa State</option>
                            <option value="Kansas">Kansas</option>
                            <option value="Kansas State">Kansas State</option>
                            <option value="Kentucky">Kentucky</option>
                            <option value="Louisville">Louisville</option>
                            <option value="Mankato State">Mankato State</option>
                            <option value="Marquette">Marquette</option>
                            <option value="Maryland">Maryland</option>
                            <option value="Michigan">Michigan</option>
                            <option value="Michigan State">Michigan State</option>
                            <option value="Michigan Tech">Michigan Tech</option>
                            <option value="Minnesota">Minnesota</option>
                            <option value="Mississippi State">Mississippi State</option>
                            <option value="Missouri">Missouri</option>
                            <option value="Missouri Mines">Missouri Mines</option>
                            <option value="MSOE">MSOE</option>
                            <option value="Nebraska">Nebraska</option>
                            <option value="NJIT">NJIT</option>
                            <option value="Northern Illinois">Northern Illinois</option>
                            <option value="Northwestern">Northwestern</option>
                            <option value="Ohio State">Ohio State</option>
                            <option value="Oklahoma">Oklahoma</option>
                            <option value="Oklahoma State">Oklahoma State</option>
                            <option value="Oregon State">Oregon State</option>
                            <option value="Penn State">Penn State</option>
                            <option value="Penn State Behrend">Penn State Behrend</option>
                            <option value="Pittsburgh">Pittsburgh</option>
                            <option value="Purdue">Purdue</option>
                            <option value="RIT">RIT</option>
                            <option value="Rose Tech">Rose Tech</option>
                            <option value="South Dakota Mines">South Dakota Mines</option>
                            <option value="Southern Illinois">Southern Illinois</option>
                            <option value="Tennessee Tech">Tennessee Tech</option>
                            <option value="Texas A&amp;M">Texas A&amp;M</option>
                            <option value="Toledo">Toledo</option>
                            <option value="Tri-State">Tri-State</option>
                            <option value="UC Irvine">UC Irvine</option>
                            <option value="UC San Diego">UC San Diego</option>
                            <option value="UCLA">UCLA</option>
                            <option value="UMBC">UMBC</option>
                            <option value="UTA">UTA</option>
                            <option value="Utah">Utah</option>
                            <option value="UWM">UWM</option>
                            <option value="Virginia Commonwealth">Virginia Commonwealth</option>
                            <option value="VPI">VPI</option>
                            <option value="Wisconsin">Wisconsin</option>
                            <option value="Wright State">Wright State</option>
                        </select>
                        <script type="text/javascript">
                            for(var i = 0;i < document.getElementById("donate_chapter").length;i++){
                                if(document.getElementById("donate_chapter").options[i].value == "<?php echo $user["chapter"]; ?>" ){
                                    document.getElementById("donate_chapter").selectedIndex = i;
                                }
                            }
                        </script>
                    </fieldset>

                    <fieldset class="col-sm-12 budget-other" style="display:none">
                        <label for="donate_budget_other">How would you like your donation to be used?</label>
                        <input name="donate_budget_other" id="donate_budget_other" type="text" placeholder="" tabindex="-1">
                        <label id="donate_budget_other_error" class="error" for="donate_budget_other" style="display:none;position: relative;margin-top: -14px;text-align: left;">Please indicate how you would like your donation to be used.</label>
                    </fieldset>

                    <fieldset class="col-sm-12">
                        <label for="budget">Comments</label>
                        <textarea width="100%" name="comments" tabindex="-1"></textarea>
                    </fieldset>
                    
                    <div class="col-sm-12">
                        <a id="checkout_with_paypal"><img src="/assets/img/donate.en_.png" height="50px" /></a>
                    </div>
                    <br>
                    <a class="donate-pg3-back">&lArr; back</a>
                </div>
                <div class="col-sm-12 donate-btns donate-pg4">
                    <h6>Payment Informaiton</h6>
                    <fieldset class="col-sm-12">
                        <label for="card_name">Name on Card</label>
                        <input name="card_name" type="text" placeholder="" value="" tabindex="-1">
                    </fieldset>
                    <fieldset class="col-sm-12">
                        <label for="card_type">Card Type</label>
                        <select name="card_type" tabindex="-1">
                            <option value=""> - Select - </option>
                            <option value="Visa">Visa</option>
                            <option value="Master Card">Master Card</option>
                            <option value="Discover Card">Discover Card</option>
                            <option value="American Express">American Express</option>
                        </select>
                    </fieldset>
                    <fieldset class="col-sm-12">
                        <label for="card_number">Card Number</label>
                        <input name="card_number" type="text" placeholder="" value="" tabindex="-1">
                    </fieldset>
                    <fieldset class="col-sm-12">
                        <label for="e_date">Experation Date</label>
                        <input name="e_date" type="text" placeholder="" value="" tabindex="-1">
                    </fieldset>
                    <fieldset class="col-sm-12">
                        <label for="cvv">CVV Number</label>
                        <input name="cvv" type="text" placeholder="" value="" tabindex="-1">
                    </fieldset>
                    <div class="col-sm-12 break text-center"><h6>- or -</h6></div>
                </div>
                <div class="col-sm-12 donate-btns donate-pg6">
                    <h6>Donation Review</h6>
                    <h6><small>Donation Information</small></h6>
                    <label>Budget:</label> <span id="donate_review_budget"></span>
                    <label>Affiliation:</label> <span id="donate_review_affiliate"></span>
                    <label>Donation Amount:</label> <span id="donate_review_amount"></span>
                    <h6><small>Additional Information</small></h6>
                    <label>Name:</label> <span id="donate_review_name"></span>
                    <label>Email:</label> <span id="donate_review_email"></span>
                    <label>Initiated Chapter:</label> <span id="donate_review_chapter"></span>
                    <label>Comments:</label> <span id="donate_review_comments"></span>
                </div>
            </div>
        </form>
    </div>
        <div class="paypal-secure text-right">
            <img src="/assets/img/pay-secu.png" height="50px">
        </div>
</div>

<div class="modal-window" data-modal="popup-member" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box small animated" data-animation="zoomIn" data-duration="700">
        <span class="close-btn icon icon-office-52"></span>

        <h5 class="align-center"><span class="highlight">Request Membership Change</span></h5>

        <form class="form donate-form align-center" action="data_donate" method="post">
            <div class="donate-slide">
                <div class="col-sm-12 donate-btns donate-pg1">
                    <h6>What is your affiliation with Utah Triangle?</h6>
                    <a class="btn btn-sm">Non-affiliated</a>
                    <a class="btn btn-sm">Active Member</a>
                    <a class="btn btn-sm">Alumni Member</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal-window" data-modal="0" style="background-color: rgba(2, 2, 2, 0.85);">
    <div class="modal-box iframe-box iframe-video">
        <span class="close-btn icon icon-office-52"></span>

        <iframe src="https://www.youtube.com/embed/goH-Pv1w6xo?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
    </div>
</div>

<!--[if lt IE 9]>
		<script type="text/javascript" src="assets/js/jquery-1.11.3.min.js?ver=1"></script>
	<![endif]-->
<!--[if (gte IE 9) | (!IE)]><!-->
<script type="text/javascript" src="assets/js/jquery-2.1.4.min.js?ver=1"></script>
<!--<![endif]-->

<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/assets/js/toastr.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.appear.js"></script>
<script type="text/javascript" src="/assets/js/jquery.plugin.js"></script>
<script type="text/javascript" src="/assets/js/jquery.countTo.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/assets/js/datepair.js"></script>
<script type="text/javascript" src="/assets/js/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="/assets/js/modal-box.js"></script>
<script type="text/javascript" src="/assets/js/ventcamp.js"></script>
<script type="text/javascript" src="/assets/js/script.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
