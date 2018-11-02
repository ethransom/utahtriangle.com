$(document).ready(function () {
    $.datepicker.setDefaults({
        
    });
    $(".datepicker").datepicker();
    
    $("#toast-container").delay(3000).fadeOut();
    
    $(".intOnly").on("keyup", function(){
        var i = this;
        if (i.value.length > 0) {
            i.value = i.value.replace(/[^\d\.]+/g, '');
        }
    });
    
    $(".alumni_members_btn").click(function () {
        $(".alumni_members .alumni_title").slideDown("slow");
        $(".alumni_members div").fadeIn();
        $(".alumni_members_btn_div").slideUp("slow");
    });

    $("#phone").on("keyup", function () {
        var i = this;
        var new_i = "";
        var num = "";
        if (i.value.length > 0) {
            new_i = i.value.replace(/[^\d]+/g, '');
            if (new_i.length > 0) {
                var split = new_i.match(/.{1,3}/g);
                if (new_i.length < 3) {
                    num = "(" + split[0];
                } else if (new_i.length == 3) {
                    num = "(" + split[0] + ") ";
                } else if (new_i.length < 6) {
                    num = "(" + split[0] + ") " + split[1];
                } else if (new_i.length == 6) {
                    num = "(" + split[0] + ") " + split[1] + "-";
                } else if (new_i.length <= 9) {
                    num = "(" + split[0] + ") " + split[1] + "-" + split[2];
                } else if (new_i.length == 10) {
                    num = "(" + split[0] + ") " + split[1] + "-" + split[2] + split[3];
                } else {
                    var last = split[3].match(/.{1,1}/g);
                    num = "(" + split[0] + ") " + split[1] + "-" + split[2] + last[0];
                }
                i.value = num;
            } else {
                i.value = "";
            }
        }
    });

    $(".phone").on("keyup", function () {
        var i = this;
        var new_i = "";
        var num = "";
        if (i.value.length > 0) {
            new_i = i.value.replace(/[^\d]+/g, '');
            if (new_i.length > 0) {
                var split = new_i.match(/.{1,3}/g);
                if (new_i.length < 3) {
                    num = "(" + split[0];
                } else if (new_i.length == 3) {
                    num = "(" + split[0] + ") ";
                } else if (new_i.length < 6) {
                    num = "(" + split[0] + ") " + split[1];
                } else if (new_i.length == 6) {
                    num = "(" + split[0] + ") " + split[1] + "-";
                } else if (new_i.length <= 9) {
                    num = "(" + split[0] + ") " + split[1] + "-" + split[2];
                } else if (new_i.length == 10) {
                    num = "(" + split[0] + ") " + split[1] + "-" + split[2] + split[3];
                } else {
                    var last = split[3].match(/.{1,1}/g);
                    num = "(" + split[0] + ") " + split[1] + "-" + split[2] + last[0];
                }
                i.value = num;
            } else {
                i.value = "";
            }
        }
    });

    $(".money").on("keyup", function () {
        var i = this;
        var new_i = "";
        var num = "";
        if (i.value.length > 0) {
            new_i = i.value.replace(/[^\d\.]+/g, '');
            if (new_i.length > 0) {
                num = "$" + new_i;
                i.value = num;
            } else {
                i.value = "";
            }
        }
    });
    
    $(".donate-pg0-next").click(function(){
        $(".donate-pg0").css("right", "100%");
        $(".donate-pg1").css("right", "6%");
    });
    
    $(".donate-pg1-next").click(function(){
        $(".donate-pg1").css("right", "100%");
        $(".donate-pg2").css("right", "6%");
    });
    
    $(".donate-type").click(function(){
        $("#donate_budget").val($(this).text());
        if($(this).text() == "Other"){
            $(".budget-other").show();
        } else {
            $(".budget-other").hide();
        }
        $(".donate-pg1").css("right", "100%");
        $(".donate-pg2").css("right", "6%");
        $(".donate-type").removeClass("btn-green");
        $(this).addClass("btn-green");
        $(".donate-pg1-next").show();
    });
    
    $(".donate-pg2-back").click(function(){
        $(".donate-pg1").css("right", "6%");
        $(".donate-pg2").css("right", "-100%");
    });
    
    $(".donate-pg2-next").click(function(){
        $(".donate-pg2").css("right", "100%");
        $(".donate-pg3").css("right", "6%");
    });
    
    $(".donate-pg3-back").click(function(){
        $(".donate-pg2").css("right", "6%");
        $(".donate-pg3").css("right", "-100%");
    });
    
    $(".donate-pg3-next").click(function(){
        
    });
    
    $(".donate-amount-type").click(function(){
        $(".donate-pg3").css("right", "100%");
        $(".donate-pg4").css("right", "6%");
    });
    
    $(".donate-pg4-back").click(function(){
        $(".donate-pg3").css("right", "6%");
        $(".donate-pg4").css("right", "-100%");
    });
    
    $(".donate-signin").click(function(){
        $(".donate-pg4").css("right", "100%");
        $(".donate-pg5").css("right", "6%");
    });
    
    $(".donate-pg5-back").click(function(){
        $(".donate-pg4").css("right", "6%");
        $(".donate-pg5").css("right", "-100%");
    });
    
    
    $(".donate-amount").click(function(){
        if($(this).text() !== "Other"){
            $("#donate_amount").val($(this).text());
        }
        $(".donate-amount").removeClass("btn-green");
        $(this).addClass("btn-green");
        $(".donate-amount-other-div").slideUp();
        $(".donate-type-div").slideDown();
    });
    
    $(".donate-type-yes").click(function(){
        if(document.getElementById("donate_amount").value == ""){
            $("#donate_amount").addClass("error");
            $("#donate_amount_error").show();
        } else {
            $("#donate_amount").removeClass("error");
            $("#donate_amount_error").hide();
            $("#donate_recurring").val("yes");
            $(".donate-type-no").removeClass("btn-green");
            $(this).addClass("btn-green");
            $(".donate-recurring-div").slideDown();
            $(".donate-pg3-next").hide();
        }
    });
    
    $(".donate-type-no").click(function(){
        if(document.getElementById("donate_amount").value == ""){
            $("#donate_amount").addClass("error");
            $("#donate_amount_error").show();
        } else {
            $("#donate_amount").removeClass("error");
            $("#donate_amount_error").hide();
            $("#donate_recurring").val("no");
            $(".donate-type-yes").removeClass("btn-green");
            $(this).addClass("btn-green");
            $(".donate-recurring-div").slideUp();
            $(".donate-pg2").css("right", "100%");
            $(".donate-pg3").css("right", "6%");
            $(".donate-pg3-next").show();
        }
    });
    
    $(".donate-recurring-type").click(function(){
        $(".donate-recurring-type").removeClass("btn-green");
        $(this).addClass("btn-green");
        $("#donate_recurring_type").val($(this).text());
        $(".recurring_number-div").slideDown();
        $(".donate-pg3-next").show();
    });
    
    
    $(".donate-amount-other").click(function(){
        $(".donate-amount-other-div").slideDown();
    });
    
    
    $(".donate-affiliate-triangle").click(function(){
        $(".chapter").show();
    });
    
    $(".donate-affiliate-utah").click(function(){
        $(".chapter").hide();
    });
    
    $(".donate-affiliate-none").click(function(){
        $(".chapter").hide();
    });
    
    $(".donate-type-other").click(function(){
        $(".budget").show();
    });
    
    $(".donate-type-budget").click(function(){
        $(".budget").hide();
    });
    
    $(".btn-add-candidates").click(function(){
        var description_show = $("#description_show").val();
        var picture_show = $("#picture_show").val();
        var x = Number($("#input_count").val()) + 1;
        for(i=0; i<5; i++){
            $("<input type=\"text\" id=\"candiate_name_" + x + "\" class=\"candidate\" placeholder=\"John Smith\" onkeyup=\"people_loop();\" maxlength=\"50\"><textarea id=\"candiate_desc_" + x + "\" class=\"canidate-description\" style=\"display:" + description_show + ";\" onkeyup=\"people_loop();\" maxlength=\"1000\"></textarea><input type=\"text\" id=\"candiate_pic_" + x + "\" class=\"canidate-picture\" placeholder=\"http://site.com/image.jpg\" style=\"display:" + picture_show + "\" onkeyup=\"people_loop();\" maxlength=\"250\"><hr />").insertBefore( $(this) );
            x++;
        }
        $("#input_count").val(x);
    });
    
    $(".groups a").click(function(){
        $(this).toggleClass("active");
        var name = $(this).attr("data-name");
        if($("#" + name).val() == "true"){
            $("#" + name).val("false");
        } else {
            $("#" + name).val("true")
        }
    });
    
    $(".add-minus").click(function(){
        alert("good");
        var id = $(this).attr("data-id"),
            type = $(this).attr("data-type"),
            num = Number($("#can-data").val());
        if(type == "add"){
            $("<div class=\"can" + num +"\"><input type=\"text\" class=\"candidate\" data-id=\"" + num +"\"> <a class=\"add-minus\" data-id=\"" + num +"\" data-type=\"minus\"><span class=\"fa fa-minus-circle\"></span></a> <a class=\"add-minus\" data-id=\"" + num +"\" data-type=\"add\"><span class=\"fa fa-plus-circle\"></span></a></div>").insertAfter( $(".can" + id) );
            num++
            $("#can-data").val(num);
        }
    });
    
    $("#checkout_with_paypal").click(function(){
        var valid = true;
        
        if(document.getElementById("donate_name").value == ""){
            $("#donate_name").addClass("error");
            $("#donate_name_error").show();
            valid = false;
        } else {
            $("#donate_name").removeClass("error");
            $("#donate_name_error").hide();
        }
        
        if(document.getElementById("donate_email").value == ""){
            $("#donate_email").addClass("error");
            $("#donate_email_error").show();
            valid = false;
        } else {
            $("#donate_email").removeClass("error");
            $("#donate_email_error").hide();
            if(document.getElementById("donate_email").value !== "NA"){
                var value = document.getElementById("donate_email").value,
                    reg = value.match(/.+@.+(\.).+/g);
                if(reg == null){
                    $("#donate_email").addClass("error");
                    $("#donate_email_reg_error").show();
                    valid = false;
                } else {
                    $("#donate_email").removeClass("error");
                    $("#donate_email_reg_error").hide();
                }
            }
        }
        
        if(document.getElementById("donate_budget").value == "Other"){
            if(document.getElementById("donate_budget_other").value == ""){
                $("#donate_budget_other").addClass("error");
                $("#donate_budget_other_error").show();
                valid = false;
            }
        }
        
        if(valid == true){
            var amount = document.getElementById("donate_amount");
            if(amount.value.length>0){
                amount.value = amount.value.replace(/[^\d\.]+/g, '');
            }
            $(".process-overlay").show();
            $(".proccessing").show();
            document.donate.submit(document.donate.action = "/data?form=donate&type=checkout_with_paypal");
        }
        
    });
    
    $(".deny").click(function(){
        var id = $(this).attr("data-id");
        var formID = $(this).attr("form-id");
        $(".form_" + formID + " ." + id).removeClass("approve-box");
        $(".form_" + formID + " ." + id).addClass("deny-box");
        $(".form_" + formID + " ." + id + " .deny").addClass("outline-deny");
        $(".form_" + formID + " ." + id + " .approve").removeClass("outline-approve");
        $(".form_" + formID + " ." + id + " .deny").removeClass("text-rose");
        $(".form_" + formID + " ." + id + " .approve").addClass("text-green");
        
        //Input Update
        $("#input_" + formID + "_" + id).val(id + "-0");
        binary_order_update(formID)
    });
    
    $(".approve").click(function(){
        var id = $(this).attr("data-id");
        var formID = $(this).attr("form-id");
        $(".form_" + formID + " ." + id).removeClass("deny-box");
        $(".form_" + formID + " ." + id).addClass("approve-box");
        $(".form_" + formID + " ." + id + " .approve").addClass("outline-approve");
        $(".form_" + formID + " ." + id + " .deny").removeClass("outline-deny");
        $(".form_" + formID + " ." + id + " .approve").removeClass("text-green");
        $(".form_" + formID + " ." + id + " .deny").addClass("text-rose");
        
        //Input Update
        $("#input_" + formID + "_" + id).val(id + "-1");
        binary_order_update(formID)
    });
});

function binary_order_update(formID){
    var order = "";
    $(".form_" + formID + " .input_candidate").each(function(){
        if(order == ""){
            order = this.value;
        } else {
            order = order + "," + this.value;
        }
    });
    $("#list_form_id_" + formID).val(order);
}

function rangeUpdate(input) {
    if(document.getElementById("donate_recurring_type").value == "Monthly"){
        var years = input / 12,
            year = Math.floor(years),
            months = (years - year) * 12,
            month = Math.round(months);
        if(input >= 12){
            var yearPlural = "s";
            if(year == 1){ var yearPlural = ""; }
            document.querySelector('#range_text').value = input + " months (" + year + " year" + yearPlural + ")";
            if(month > 0){
                var yearPlural = "s",
                    monthPlural = "s";
                if(year == 1){ var yearPlural = ""; }
                if(month == 1){ var monthPlural = ""; }
                document.querySelector('#range_text').value = input + " months (" + year + " year" + yearPlural + " " + month + " month" + monthPlural + ")";
            }
        } else {
            document.querySelector('#range_text').value = input + " months";
        }
    } else {
        document.querySelector('#range_text').value = input + " years";
    }
    if(input == 1){
        document.querySelector('#range_text').value = "Indefinite";
    }
}

function electionRangeUpdate(input) {
    document.querySelector('#election_range_text').value = input + "%";
}
    
function donate(value){
    if(value == "Triangle Active Member" || value == "Triangle Alumni Member"){
        $(".donate_chapter").show();
    } else {
        $(".donate_chapter").hide();
    }
}