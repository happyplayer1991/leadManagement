/**
 * Created by raviteja on 1/7/18.
 */

(function(){

        // -- start --- Floating Action Button Code
        $(".fab,.backdrop").click(function(){
            if($(".backdrop").is(":visible")){
                $(".backdrop").fadeOut(125);
                $(".fab.child")
                    .stop()
                    .animate({
                        bottom  : $("#masterfab").css("bottom"),
                        opacity : 0
                    },125,function(){
                        $(this).hide();
                    });
            }else{
                $(".backdrop").fadeIn(125);
                $(".fab.child").each(function(){
                    $(this)
                        .stop()
                        .show()
                        .animate({
                            bottom  : (parseInt($("#masterfab").css("bottom")) + parseInt($("#masterfab").outerHeight()) + 70 * $(this).data("subitem") - $(".fab.child").outerHeight()) + "px",
                            opacity : 1
                        },125);
                });
            }
        });
        // -- end --- Floating Action Button Code


    $(document).ready(function () {

         $(document).on('click','#modal_fade,#modal_fade1',function (event) {
            core.modalView();
         });

        $(document).on('submit','#submit_form',function (event) {
            core.submitForm();
        });

        $('#lead_form').submit(function(){
            if($('#customer_name').val() == ''){
                toastr.error('', "Please fill name field");
                return false;
            }
        });

        $('#registerForm').submit(function(){

            if($('#company_name').val() == ''){
                toastr.error('', "Please fill company field");
                return false;
            }
            if($('#name').val() == ''){
                toastr.error('', "Please fill name field");
                return false;
            }
            if($('#email').val() == ''){
                toastr.error('', "Please fill email field");
                return false;
            }
            var value = $('#email').val();
            var valid = validateEmail(value);
            if (!valid) {
                toastr.error('',"Please enter a valid email");
                return false;
            }
            if($('#work_number').val() == ''){
                toastr.error('', "Please fill office number field");
                return false;
            }
            var pattern = /^\s*(?:\+?(\d{1,3}))?[- (]*(\d{3})[- )]*(\d{3})[- ]*(\d{4})(?: *[x/#]{1}(\d+))?\s*$/;
            var value = $('#work_number').val();
            var valid1=pattern.test(value);
            if (!valid1) {
                toastr.error('', 'Please enter a valid mobile number');
                return false;
            }
            if($('#password').val() == ''){
                toastr.error('', "Please fill password field");
                return false;
            }
            if($('#password_confirmation').val() == ''){
                toastr.error('', "Please fill confirm password field");
                return false;
            }

            if($('#password').val() != $('#password_confirmation').val()){
                toastr.error('', "Password and Confirm password are to be same");
                return false;
            }

        });


        $(document).on('change', '.lead_status', function(){

            var lead_status = $(".lead_status").val();
            if(lead_status == "Drop"){
                $('#display_status').show();
                $('#display_comment').show();
            }else{
                $('#display_status').hide();
                $('#display_comment').hide();
            }

        });



        $(document).on('change', '.activity', function(){

            //alert();

            var activity = $(".activity").val();
            //alert(activity);
            if(activity == "Call" || activity == "Meet"){
                $('.time').show();
            }else{
                $('.time').hide();
            }

        });


        $(document).on('click','#add_product', function() {

            var data = $('#product_add_form').serialize();

            $.ajax({
                url: "products/storeData",
                type: 'POST',
                data: data,
                // data: ajax_data ,
                success: function (response) {

                    console.log(response);

                    if(response != ''){
                        var messages = "Product Added Successfully";
                        toastr.success('',messages);
                        location.reload();
                    }


                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });

        });

        $(document).on('click','#edit_product', function(){

            var data = $('#product_edit_form').serialize();

            $.ajax({
                url: "products/updateProductData",
                type: 'POST',
                data: data,
                // data: ajax_data ,
                success: function (response) {

                    console.log(response);

                    if(response != ''){
                        var messages = "Product Edited Successfully";
                        toastr.success('',messages);
                        location.reload();
                    }


                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });


        $(document).on('click', '#add_lead', function () {

            var name = $('#customer_name').val();
            var personal_number = $('#mobile_num').val();
            var mobile_number = $('#secondary_number').val();
            var email = $('#cust_email').val();

            var data = $('#lead_form').serialize();

            if($('#customer_name').val() == ''){
                toastr.error('', "Please fill name field");
                return false;
            }
            var pattern = /^\s*(?:\+?(\d{1,3}))?[- (]*(\d{3})[- )]*(\d{3})[- ]*(\d{4})(?: *[x/#]{1}(\d+))?\s*$/;
            var valid1=pattern.test(personal_number);
            if (!valid1) {
                toastr.error('', 'Please enter a valid mobile number');
                return false;
            }

            var value = $('#cust_email').val();
            var valid = validateEmail(value);
            if (!valid) {
                toastr.error('',"Please enter a valid email");
                return false;
            }
            $.ajax({
                url: "leads",
                type: 'POST',
                data: data,
                // data: ajax_data ,
                success: function (response) {

                    console.log(response);

                    if(response == "existMail"){
                        //alert();
                        var messages = "Lead already exists with this e-mail address.";
                        toastr.error('', messages);
                    }else if (response == "existPhone"){
                        var messages = "Lead already exists with this phone Number.";
                        toastr.error('', messages);
                    }else if (response == "emptyPhone"){
                        var messages = "Please enter Mobile number";
                        toastr.error('', messages);


                    }else if (response == "emptyMail"){
                        var messages = "Please enter Email Address";
                        toastr.error('', messages);

                    }else if (response == "emptyName"){
                        var messages = "Please enter Name";
                        toastr.error('', messages);
                    }else{
                        console.log(response);
                        var messages = "Lead Added Successfully";
                        $('#create_client').hide();
                        toastr.success('', messages);
                        location.reload();

                    }


                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });


        $(document).on('click', '#convert_oppurtunity', function(){
            var id = $('#convert_lead_id').val();
            var status = $('#convert_lead_status').val();

            var data = {id:id,status:status};

            $.ajax({
                url: "leads/convertToOppurtunity",
                type: 'POST',
                data: data,
                // data: ajax_data ,
                success: function (response) {
                    console.log(response);
                    var messages = "sucess";
                    $('#lead_oppurtunity').remove();
                    toastr.success('', messages);
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });

        });



        $(document).on('click', '#drop_lead', function(){

            // alert('You are requesting to drop this lead. Are you Sure?');

            var status = $('.status').val();
            var comment = $('#remarks').val();

            var data = $('#status_form').serialize();

            if(comment == ""){
                var messages = "Kindly specify why you want to drop the lead";
                toastr.error('', messages);
            }else{

                var confirmation = confirm('You are requesting to drop this lead. Are you Sure?');
                //alert(confirmation);
                console.log(confirmation);

                if(confirmation == true){


                    console.log(data);

                    $.ajax({
                        url: "leads/dropLead",
                        type: 'PATCH',
                        data: data,
                        // data: ajax_data ,
                        success: function (response) {
                            console.log(response);
                            var id = response;
                            var messages = "Lead dropped sucessfully";
                            $('#drop_client').remove();
                            $('.leadId'+id).remove();
                            toastr.success('', messages);
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }else if(confirmation == false){
                    $('#client_drop_modal').modal('hide');
                    //  $('#client_drop_modal').remove();
                }else{
                    $('#client_drop_modal').modal('hide');
                }

            }




        });

        $(document).on('click', '#edit_lead', function () {




            var name = $('#customer_name').val();
            var personal_number = $('#mobile_num').val();
            var mobile_number = $('#secondary_number').val();
            var email = $('#cust_email').val();
            var id = $('#customer_id').val();

            var data = $('#lead_edit_form').serialize();

            console.log(data);
            var phone = $("#mobile_num").val();
            var pattern = /^\s*(?:\+?(\d{1,3}))?[- (]*(\d{3})[- )]*(\d{3})[- ]*(\d{4})(?: *[x/#]{1}(\d+))?\s*$/;
            var valid1=pattern.test(phone);
            if (!valid1) {
                toastr.error('', 'Please enter a valid mobile number');
                return false;
            }


            var value = $('#cust_email').val();
            var valid = validateEmail(value);
            if (!valid) {
                toastr.error('',"Please enter a valid email");
                return false;
            }



            var val4 = $('#company_website').val();
            var regex1 = /^(https?:\/\/)?[a-z0-9-]*\.?[a-z0-9-]+\.[a-z0-9-]+(\/[^<>]*)?$/;
            var isValid3 = regex1.test(val4);
            if (!isValid3) {
                toastr.error('', 'Please enter a valid company website');
                return false;
            }
            $.ajax({
                url: "leads/" + id,
                type: 'PATCH',
                data: data,
                // data: ajax_data ,
                success: function (response) {
                    console.log(response);
                    if(response == "comment"){
                        var messages = "Please fill the comment field";
                        toastr.error('', messages);
                    }else{
                        var messages = "updated sucessfully";
                        $('#edit_client').hide();
                        toastr.success('', messages);
                        location.reload();
                    }

                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });

        });

        $(document).on('click', '#add_lead_activity', function () {

            var data = $('#activity_form').serialize();

            $.ajax({
                url: "activities",
                type: 'POST',
                data: data,

                success: function (response) {
                    console.log(response);
                    if(response == "details"){
                        var messages = "Please enter the details.";
                        toastr.error('', messages);
                    }else{
                        var messages = "Activity Successfully Added";
                        $('#add_activity').remove();
                        toastr.success('', messages);
                        location.reload();
                    }

                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('#edit-user').submit(function () {

            var name=$.trim($('#name').val());
            if (name === '') {
                toastr.error('', 'Name field is empty.');
                return false;
            }
            var adrs=$.trim($('#address').val());
            if (adrs === '') {
                toastr.error('', 'Address field is empty.');
                return false;
            }
            var mobile=$.trim($('#personal_number').val());
            if (mobile === '') {
                toastr.error('', 'Mobile field is empty.');
                return false;
            }
            var pattern = /^\s*(?:\+?(\d{1,3}))?[- (]*(\d{3})[- )]*(\d{3})[- ]*(\d{4})(?: *[x/#]{1}(\d+))?\s*$/;
            var valid1=pattern.test(mobile);
            if (!valid1) {
                toastr.error('', 'Please enter a valid mobile number');
                return false;
            }

            var mail=$.trim($('#mail').val());
            if (mail === '') {
                toastr.error('', 'Mail field is empty.');
                return false;
            }
            var valid = validateEmail(mail);
            if (!valid) {
                toastr.error('',"Please enter a valid email");
                return false;
            }
        });


        $('#frm').submit(function () {

            var name=$.trim($('#name').val());
            if (name === '') {
                toastr.error('', 'Name field is empty.');
                return false;
            }
            var adrs=$.trim($('#address').val());
            if (adrs === '') {
                toastr.error('', 'Address field is empty.');
                return false;
            }
            var mobile=$.trim($('#personal_number').val());
            if (mobile === '') {
                toastr.error('', 'Mobile field is empty.');
                return false;
            }
            var pattern = /^\s*(?:\+?(\d{1,3}))?[- (]*(\d{3})[- )]*(\d{3})[- ]*(\d{4})(?: *[x/#]{1}(\d+))?\s*$/;
            var valid1=pattern.test(mobile);
            if (!valid1) {
                toastr.error('', 'Please enter a valid mobile number');
                return false;
            }
            var pswd=$.trim($('#password').val());
            if (pswd === '') {
                toastr.error('', 'Password field is empty.');
                return false;
            }
            var confirmpswd=$.trim($('#confirm_password').val());
            if (confirmpswd === '') {
                toastr.error('', 'Confirm password field is empty.');
                return false;
            }
            if(confirmpswd!=pswd){
                toastr.error('', ' confirm passowrd should be same as password');
                return false;
            }
            var mail=$.trim($('#mail').val());
            if (mail === '') {
                toastr.error('', 'Mail field is empty.');
                return false;
            }
            var valid = validateEmail('#mail');
            if (!valid) {
                toastr.error('',"Please enter a valid email");
                return false;
            }
        });

    });

    $(document).on('click',".tr_clone_add",function(){
        var tr = $(this).parents('.tr_clone');
        var clone = tr.clone();
        $(clone).find(':text').val('');
        tr.find('.tr_clone_add').addClass('tr_clone_minus').removeClass('tr_clone_add');
        tr.find('.glyphicon-plus').addClass('glyphicon-minus').removeClass('glyphicon-plus');
         core.calculatetotal();
        $(this).parents('.tr_clone').after(clone);


    });

    $(document).on('click',".tr_clone_minus",function(){
        $(this).parents('.tr_clone').remove();
        core.calculatetotal();
    });

    $(document).on('keyup',"#price",function () {
         core.calculatetotal();
    });

    $(document).on('change','#lead_id' , function(){
        var address = $(this).find(':selected').data('address');
        $('#lead_address').val(address);
    });
//alert();
})();