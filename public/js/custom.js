$( function() {
$('.fc-day').on('click', function(e){
    e.preventDefault();
    var data = $(this).data('date');
    $.ajax({
        url: "calendar/create",
        type: 'GET',
        data: {date:data},
        success: function (data,response) {
            $('#modal_window').html(data);
            $(document).find('#create_modal').modal('show');
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });

  } );

});

if (Notification.permission !== "granted")
    Notification.requestPermission();

jQuery(document).on('submit','#currency-form',function(currentObject) {
    currentObject.preventDefault();
    if (confirm("Currency once selected cannot be changed..!")) {
        // alert('ok');
        $.ajax({
        url: "/currency",
        type: 'POST',
        data: jQuery(this).serialize(),
        success: function (response) {
            location.reload();
        }
        });
    } else {
        location.reload();
    }
});

function addNotes(id) {

    var data = {id:id};
    $.ajax({
        url: "/addNotes/" +id,
        type: 'GET',
        data: data,
        success: function (response) {
            // alert('ok');
            console.log(response);
            $('#modal_window').html(response);
            $('#newModel').modal('show');

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}


function emailAddress(id) {

    var data = {id:id};
    $.ajax({
        url: "/emailAddress/" +id,
        type: 'GET',
        data: data,
        success: function (response) {
            // alert('ok');
            console.log(response);
            $('#modal_window').html(response);
            $('#justModal').modal('show');

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function sms(id) {

    var data = {id:id};
    $.ajax({
        url: "/sms/" +id,
        type: 'GET',
        data: data,
        success: function (response) {
            // alert('ok');
            console.log(response);
            $('#modal_window').html(response);
            $('#justModal').modal('show');

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}
function email(id) {

    var data = {id:id};
    $.ajax({
        url: "/email/" +id,
        type: 'GET',
        data: data,
        success: function (response) {
            // alert('ok');
            console.log(response);
            $('#modal_window').html(response);
            $('#justModal').modal('show');

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

// $('#addNotes').on('click',function (e) {
//    // e.preventDefault();
//     var data = {type:"popOver"};
//     $.ajax({
//         url: "addNotes",
//         type: 'GET',
//         data:data,
//         success: function (response) {
//
//             $('#modal_window').html(response);
//             $('#addNotes').modal('show');
//
//         },
//         error: function (xhr, status, error) {
//             console.log(xhr.responseText);
//         }
//     });
// });

$(document).on('click','#paypalbutton',function(){
    var data = {type:"popOver"};
    $.ajax({
        url: "paypalform",
        type: 'GET',
        data:data,
        success: function (response) {

            $('#modal_window').html(response);
            $('#create_modal').modal('show');

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
});



function leadCount(id) {
    var data = {id:id};
    $.ajax({
        url: "intrestedlead/" +id,
        type: 'GET',
        data: data,
        success: function (response) {
            console.log(response);
            $('#modal_window').html(response);
            $('#intrest_lead').modal('show');
            // alert('ok');
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function quoteCount(id) {
    var data = {id:id};
    $.ajax({
        url: "intrestedquote/" +id,
        type: 'GET',
        data: data,
        success: function (response) {
            console.log(response);
            $('#modal_window').html(response);
            $('#intrest_quote').modal('show');
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function invoiceCount(id) {
    var data = {id:id};
    $.ajax({
        url: "intrestedinvoice/" +id,
        type: 'GET',
        data: data,
        success: function (response) {
            console.log(response);
            $('#modal_window').html(response);
            $('#intrest_invoice').modal('show');
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function dragToWon(id,status) {
   var data = {id:id,status:status};
   $.ajax({
        // url: ""+id;
   });
}

function dragToQuote(id,status){
    var data = {id:id,status:status};
    $.ajax({
        // url: 'leads/quote',
        // type: 'GET',
        // data: data,
        // success: function (response) {
        //     $('#modal_window').html(response);
        //     $('#create_modal').modal('show');
        // },
        // error: function (xhr, status, error) {
        //     console.log(xhr.responseText);
        // }

        url: "/addQuotation/"+id,
        type: 'GET',
        data: data,
        success: function (response) {
            window.location = "/addQuotation/"+id;
        }
    });
}

function dragToOpportunity(id,status){

    var data = {id:id,status:status};
    $.ajax({
        url: 'leads/opportunity',
        type: 'POST',
        data : data,
        success: function (response) {
            $('#ajaxContent').html(response);
            toastr.success('','Lead Moved to opportunity');
            location.reload();
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });

}




// Accordion:
$("body").click(function() {
    $(".overlay").toggle(); // show/hide the overlay
});

$(document).on('click',".tr_clone_add",function(){
    //alert();
    var tr = $(this).parents('.tr_clone');
    var clone = tr.clone();
    $(clone).find(':text').val('');
    tr.find('.tr_clone_add').addClass('tr_clone_minus').removeClass('tr_clone_add');
    tr.find('.glyphicon-plus').addClass('glyphicon-minus').removeClass('glyphicon-plus');
    calculatetotal();
    $(this).parents('.tr_clone').after(clone);


});


//sowjitha for addquotations.

$(document).on('change','#lead_id' , function(){
    var address = $(this).find(':selected').data('address');
    $('#lead_address').val(address);
});

//sowjitha for quotation_items

// $(document).on('change','.quote_products',function(){
//     alert();
// });



$(document).on('change','.quote_products',function(){
    var data_description = $(this).find(':selected').data('description');
    var data_price = $(this).find(':selected').data('price');
    var product_name = $(this).find(':selected').data('product');
    var tr = $(this).parents('.tr_clone');
    $(tr).find('.product_name').val(product_name);
    var description = $(tr).find('.description').val(data_description);
    var price = $(tr).find('.price').val(data_price);
    var quantity = $(tr).find('.quantity').val('1');

    var line_total = $(tr).find('.line_total').html(data_price*1);
    $(tr).find('.line_total').val(data_price*1);
    $(tr).find('.tr_clone_minus').show();

    if($('#currency').val() != ''){

        var address = $('#currency').find(':selected').data('symbol');
        $(tr).find('.symbol').html(address);
    }else{

    }

    var trClone = $('#quotation_items_table tr:last td:first').find('select').val();
    calculatetotal();
    if(trClone == ""){

    }else{

        var clone = tr.clone();
        $(clone).find(':text,textarea').val('');
        $(clone).find('.price').val('');
        $(clone).find('.quantity').val('');
        $(clone).find('.line_total').html('');
        $(clone).find('.symbol').html('');
        $(clone).find('.tr_clone_minus').hide();
        $(this).parents('.tr_clone').after(clone);

    }
});

$(document).on('click',".tr_clone_minus",function(){

    $(this).parents('.tr_clone').remove();
    calculatetotal();
});

$(document).on('keyup',".price,.quantity,#quote_discount",function () {
    var tr = $(this).parents('.tr_clone');
    var price = $(tr).find('.price').val();
    var quantity = $(tr).find('.quantity').val();
    var line_total = $(tr).find('.line_total').html(price*quantity);
    $(tr).find('.line_total').val(price*quantity);
    calculatetotal();
});

$(document).on('keyup','#payed',function(){
    
    var gross_price = parseInt($("#gross_price").html());
    var paid_amount= document.getElementById("payed").value;
    //alert(paid_amount);
    // gross_price = gross_price-paid_amount;
    // //alert(gross_price);
    // var total=gross_price-paid_amount-parseInt($(this).val());
    // alert(total);


    //alert(paid_amount);
    //gross_price = gross_price-paid_amount;
    //alert(gross_price);
    console.log(gross_price);
    //console.log(total);
    $('#due').val(gross_price - parseInt($(this).val()));
    //$('#due').val();

    // var paid_amount= parseInt($("#payed").html());
    // $('#due').val(paid_amount-parseInt($(this).val()));
});

$(document).on('change','#currency',function(){
    var address = $('#currency').find(':selected').data('symbol');
    $('.symbol').html(address);
});

$(document).on('change','#tax',function(){
    //Pick the rate from drop down tax
    var tax_rate = $(this).find(':selected').data('rate');
    if($(this).val() != ""){
        //Pick the rate from quote discount fields
        var discountRate =$('#quote_discount').val();
        //Pick the total price which sum of all items 
        var total_price = $('#total_price').html();
        //alert(total_price);
        //Calculate discount amount by using discrount rate and total price

        var discount_amount = (total_price * discountRate)/100;
        //Substract the discount value from the total price
        var gross = total_price - discount_amount;
        $('#gross').html(amount);
        $('.gross').val(amount);
        var gross_price = total_price - discount_amount;
        //Calculate applicable tax rates on the gross price
        var final_tax= (gross_price*tax_rate)/100;
        // final_tax = final_tax.toFixed(2);
        $('#quote_tax').html(final_tax);
        $('.quote_tax').val(final_tax);
        // var tax_rate = parseFloat( $('.quote_tax').val());
        //Calucate the final price including taxes
        var amount = final_tax + gross_price;
        amount = Number.parseFloat(amount).toFixed(2);

        $('#gross_price').html(amount);
        $('.gross_price').val(amount);
    }else{
        $('#quote_tax').html(0);
        calculatetotal();
    }

});

function calculatetotal(){
    var sum = 0;

    $('table tr td .line_total').each(function(){
        var data = $(this).html();
        //alert(data);
        //sum=0;
        //sum += Number(data);
        sum += Number(data);
        //alert(sum);
        
        //alert(sum);
        //console.log(data);
        console.log(sum);
        //alert(sum);

    });
  //alert(sum/2);
    var address = $('#currency').find(':selected').data('symbol');
    $('.symbol').html(address);
    $('#total_price').html(sum/2);
    $('.total_price').val(sum/2);
     //alert(data);
    var discount =$('#quote_discount').val();
    if(discount == ''){
        $('#gross_price').html(sum/2);
        $('.gross_price').val(sum/2);
    }else{
        var discount_rate = ($('#total_price').html() * discount)/100;
        $('#discount_rate').html(discount_rate);
        $('#gross_price').html($('#total_price').html()-discount_rate);
        $('.gross_price').val($('#total_price').html()-discount_rate);
    }



}




var validateEmail = function(elementValue) {
    var emailPattern =/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return emailPattern.test(elementValue);
}
function returnLead(id){

    var data = {id:id};

    $.ajax({
        url: "leads/returnLead/" + id,
        type: 'POST',
        data: data,
        success: function (response) {
            console.log(response);
            location.reload();
            // alert('ok');
            // $('#modal_window').html(response);
            // $('#notification_modal').modal('show');
            //$('.navbar').append(response);
            // $(document).find('.navbar .pop-over');//.css('top', (button_position_add.top + 28)).css('left', (button_position_add.left - 600));
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });

}


function notifications(){
    $.ajax({
        url: "notifications",
        type: 'GET',
        success: function (response) {
            console.log(response);
            // alert(response);
            $('#modal_window').html(response);
            $('#notification_modal').modal('show');
            //$('.navbar').append(response);
            // $(document).find('.navbar .pop-over');//.css('top', (button_position_add.top + 28)).css('left', (button_position_add.left - 600));
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

$(document).ready(function () {
/*
    var numInput = document.querySelector('input');

    // Listen for input event on numInput.
    numInput.addEventListener('input', function(){
    // Let's match only digits.
    var num = this.value.match(/^\d+$/);
        if (num === null) {
            // If we have no match, value will be empty.
            this.value = "";
        }
    }, false)*/

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
        var valid = validateEmail(mail);
        if (!valid) {
            toastr.error('',"Please enter a valid email");
            return false;
        }
    });
    // $('#submit_frm').submit(function () {
    //     if($('#taxname').val() == ''){
    //         toastr.error('', "Please fill name filels");
    //         return false;
    //     }
    //     if($('#taxrate').val() == ''){
    //         toastr.error('', "Please fill rate field");
    //         return false;
    //     }
    //
    // });
    //
});


$(window).ready(function () {

    //this ajax is to show create pop-over baed on action.

    $(document).on('click','#modal_fade,#modal_fade1',function (event) {
        event.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: 'GET',
            success: function (response) {
                console.log(response);
                $('#modal_window').html(response);
                $('#ajax_modal').modal('show');
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    $(document).on('click','#paypal_form',function(){
        // alert();
        var amount = $('#paypal_val').val();
        //var action = $(this).attr('action');
        var data = $('#post_paypal').serialize();
        // alert();
        $.ajax({
            url: "subscription",
            type: 'POST',
            data: data,
            success: function (data) {
                // alert();

            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }

        });

    });

    // $(document).on('submit','#paypal_form',function(){
    //     //alert();
    //     event.preventDefault();
    //     $(this).submit();



    // });

    $(document).on('submit','#registerForm',function (event) {


    });

    // This is for Post data for add and edit form.

    $(document).on('submit','#notes_form',function (event) {


        $('#loader').show();
        event.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            success: function (data) {
                if (data) {
                    if (data.error && data.error != "") {
                        toastr.error('', data.error);
                    } else {
                        $('#newModel').modal('hide');
                        $('#notescontent').empty();
                        $('#notescontent').html(data);
                        $('#loader').hide();
                        toastr.success('', 'Note added successfully');


                    }

                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }

        });
    });


    $(document).on('submit','#inv_form',function (event) {


        $('#loader').show();
        event.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            success: function (data) {
                if (data) {
                    if (data.error && data.error != "") {
                        toastr.error('', data.error);
                    } else {
                        $('#justModal').modal('hide');
                        $('#notescontent').empty();
                        $('#notescontent').html(data);
                        $('#loader').hide();
                        toastr.success('', 'Email sent Successfully');


                    }

                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }

        });
    });

    $(document).on('submit','#ld_form',function (event) {


        $('#loader').show();
        event.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            success: function (data) {
                if (data) {
                    if (data.error && data.error != "") {
                        toastr.error('', data.error);
                    } else {
                        $('#justModal').modal('hide');
                        $('#notescontent').empty();
                        $('#notescontent').html(data);
                        $('#loader').hide();
                        toastr.success('', 'Sms sent Successfully');


                    }

                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }

        });
    });
    $(document).on('submit','#email_form',function (event) {


        $('#loader').show();
        event.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            success: function (data) {
                if (data) {
                    if (data.error && data.error != "") {
                        toastr.error('', data.error);
                    } else {
                        $('#justModal').modal('hide');
                        $('#notescontent').empty();
                        $('#notescontent').html(data);
                        $('#loader').hide();
                        toastr.success('', 'email sent Successfully');


                    }

                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }

        });
    });
    $(document).on('submit','#submit_form',function (event) {


        $('#loader').show();
        event.preventDefault();
        var data = $(this).serialize();
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            success: function (data) {
                if(data != ""){
                    if(data.error && data.error != ""){
                        toastr.error('', data.error);
                    }else{
                         $('#create_modal').modal('hide');
                         $('#newModel').modal('hide');
                         $('#ajaxContent').html(data.html);
                         $('#ajaxContent-product').html(data.html);
                         $('#ajaxContent1').html(data.html);
                         $('#loader').hide(); 
                         toastr.success('',data.message);
                         location.reload();
                    }
                    
                 }else{
                     toastr.success('','Activity successfully Added');
                      $('#create_modal').modal('hide');
                      
                 }

            },
            error: function (xhr, status, error){
                console.log(xhr.responseText);
            }

        });

        if($('#leadname1').val() === ''){
            toastr.error('', "Please fill name fileld");
            return false;
        }
        if($('#activitytype').val() == ''){
            toastr.error('', "Please fill Activity Type field");
            return false;
        }

        if($('#taxname').val() == ''){
            toastr.error('', "Please fill name fileld");
            return false;
        }
        if($('#taxrate').val() == ''){
            toastr.error('', "Please fill rate field");
            return false;
        }

        if($('#product_name').val() == ''){
            toastr.error('', "Please fill product name fileld");
            return false;
        }
        if($('#price').val() == ''){
            toastr.error('', "Please fill price field");
            return false;
        }

    });

    /*
    *   This is for search functionality based on filter form ID
    *   Controller is search Controller
    *
    */
    $('#filterForm-activity').submit(function (event) {
        $('#loader').hide();
        event.preventDefault();
        var data = $('#filterForm-activity').serialize();
        var action = $('#filterForm-activity').attr('action');
        $.ajax({
            type: "GET",
            url: action,
            data: data,
            success: function (data) {
                $('#ajaxContent-activity').html(data);
                $('#loader').hide();
            }
        }, "html");


    });

    $(document).on('click','#act a',function (event) {
        var data = $('#filterForm-activity :input[id!="page_no"]').serialize();
        var action = $(this).attr('href');
        if(action.indexOf('activities')== -1){
            event.preventDefault();
            $('#loader').show();
            $.ajax({
                type: "GET",
                url: action,
                data: data,
                success: function (data) {
                    $('#ajaxContent-activity').html(data);
                    $('#loader').hide();
                }
            }, "html");
        }
    });

    $('#filterForm-contact').submit(function (event) {
        $('#loader').show();
        event.preventDefault();
        var data = $('#filterForm-contact').serialize();
        var action = $('#filterForm-contact').attr('action');
        $.ajax({
            type: "GET",
            url: action,
            data: data,
            success: function (data) {
                $('#ajaxContent-contact').html(data);
                $('#loader').hide();
            }
        }, "html");


    });
    $(document).on('click','#cntct a',function (event) {
        var data = $('#filterForm-contact :input[id!="page_no"]').serialize();
        var action = $(this).attr('href');
        if(action.indexOf('leads')== -1){
            event.preventDefault();
            $('#loader').show();
            $.ajax({
                type: "GET",
                url: action,
                data: data,
                success: function (data) {
                    $('#ajaxContent-contact').html(data);
                    $('#loader').hide();
                }
            }, "html");
        }
    });

    $('#filterForm-allleads').submit(function (event) {
        $('#loader').show();
        event.preventDefault();
        var data = $('#filterForm-allleads').serialize();
        var action = $('#filterForm-allleads').attr('action');
        $.ajax({
            type: "GET",
            url: action,
            data: data,
            success: function (data) {
                $('#ajaxContent-allleads').html(data);
                $('#loader').hide();
            }
        }, "html");
    });
    $(document).on('click','#led a',function (event) {
        var data = $('#filterForm-allleads :input[id!="page_no"]').serialize();
        var action = $(this).attr('href');
        if(action.indexOf('leads')== -1){
            event.preventDefault();
            $('#loader').show();
            $.ajax({
                type: "GET",
                url: action,
                data: data,
                success: function (data) {
                    $('#ajaxContent-allleads').html(data);
                    $('#loader').hide();
                }
            }, "html");
        }
    });

    $('#filterForm-customers').submit(function (event) {
        $('#loader').show();
        event.preventDefault();
        var data = $('#filterForm-customers').serialize();
        var action = $('#filterForm-customers').attr('action');
        $.ajax({
            type: "GET",
            url: action,
            data: data,
            success: function (data) {
                $('#ajaxContent-customers').html(data);
                $('#loader').hide();
            }
        }, "html");
    });
    $(document).on('click','#cust a',function (event) {
        var data = $('#filterForm-customers :input[id!="page_no"]').serialize();
        var action = $(this).attr('href');
        if(action.indexOf('leads')== -1){
            event.preventDefault();
            $('#loader').show();
            $.ajax({
                type: "GET",
                url: action,
                data: data,
                success: function (data) {
                    $('#ajaxContent-customers').html(data);
                    $('#loader').hide();
                }
            }, "html");
        }
    });

});

$('#filterForm-quote').submit(function (event) {
        $('#loader').show();
        event.preventDefault();
        var data = $('#filterForm-quote').serialize();
        var action = $('#filterForm-quote').attr('action');
        $.ajax({
            type: "GET",
            url: action,
            data: data,
            success: function (data) {
                $('#ajaxContent-quote').html(data);
                $('#loader').hide();
            }
        }, "html");


    });

    $(document).on('click','#quota a',function (event) {
        var data = $('#filterForm-quote :input[id!="page_no"]').serialize();
        var action = $(this).attr('href');
        if(action.indexOf('quotations')== -1){
            event.preventDefault();
            $('#loader').show();
            $.ajax({
                type: "GET",
                url: action,
                data: data,
                success: function (data) {
                    $('#ajaxContent-quote').html(data);
                    $('#loader').hide();
                }
            }, "html");
        }
    });

    $('#filterForm-invoice').submit(function (event) {
        $('#loader').show();
        event.preventDefault();
        var data = $('#filterForm-invoice').serialize();
        var action = $('#filterForm-invoice').attr('action');
        $.ajax({
            type: "GET",
            url: action,
            data: data,
            success: function (data) {
                $('#ajaxContent-invoice').html(data);
                $('#loader').hide();
            }
        }, "html");


    });

    $(document).on('click','#inv a',function (event) {
        var data = $('#filterForm-invoice :input[id!="page_no"]').serialize();
        var action = $(this).attr('href');
        if(action.indexOf('invoices')== -1){
            event.preventDefault();
            $('#loader').show();
            $.ajax({
                type: "GET",
                url: action,
                data: data,
                success: function (data) {
                    $('#ajaxContent-invoice').html(data);
                    $('#loader').hide();
                }
            }, "html");
        }
    });

$(document).ready(function() {
    $("time.timeago").timeago();
    jQuery.timeago.settings.allowFuture = true;
    $('.morebtn').tooltip();

    // $(".comment").shorten();
    //
    // $(".comment-small").shorten({showChars: 10});


    function close_accordion_section() {


        $('.accordion .accordion-section-title').removeClass('active');
        $('.accordion .accordion-section-content').slideUp(300).removeClass('open');
        $('.accordion .accordion-section-content1').slideUp(300).removeClass('open');
    }
    $('.accordion-section-title').click(function(e) {
        // Grab current anchor value
        var currentAttrValue = $(this).attr('href');

        if($(e.target).is('.active')) {
            close_accordion_section();
        }else {
            close_accordion_section();

            // Add active class to section title
            $(this).addClass('active');
            // Open up the hidden content panel
            $('.accordion ' + currentAttrValue).slideDown(300).addClass('open');
        }

        e.preventDefault();
    });
});




function addProduct(){

    $.ajax({
        url: "products/create",
        type: 'GET',
        success: function (response) {
            console.log(response);
            $('#modal_window1').html(response);
            $('#product_create_modal').modal('show');
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });

}



function editProduct(id){

    var data = {id: id};

    $.ajax({
        url: "products/edit",
        type: 'GET',
        data:data,
        success: function (response) {
            console.log(response);
            $('#modal_window1').html(response);
            $('#product_edit_modal').modal('show');

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });

}


function addLead(button) {
    $('.pop-over').remove();

    $.ajax({   
    // alert('ok');     
        url: "leads/create",
        type: 'GET',
        success: function (response) {
            console.log(response);
            $('#modal_window').html(response);
            $('#client_create_modal').modal('show');
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function activity_status(id,obj,url = null){
    var id = id;
    //alert(id);
    var status = $(obj).val();
    //alert(url);

    var data = {status:status};

    // if(url == 'details'){
    //     url = "activities/follow_up/"+id;
    // }else{
    //     url = "activities/follow_up/"+id;
    // }

    url = "activities/follow_up/"+id;

    //alert(url);

    $.ajax({
        url: url,
        type: 'POST',
        data:data,
        success: function (response) {
            console.log(response);
            if(response == "success"){
                var messages = "Activity Completed Successfully";
                toastr.success('', messages);
                location.reload();
            }

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function assign_users(id,obj){

    var user_id = $(obj).val();

    var data = {user_id:user_id};
    //alert(id);
    $.ajax({
        url: 'leads/assign_user/'+id,
        type: 'POST',
        data:data,
        success: function (response) {
            console.log(response);
            if(response != ""){
                var messages = "User Assigned Successfully";
                toastr.success('', messages);
                location.reload();
            }

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}


$(document).ready(function () {

    $('#lead_form').submit(function(){
        if($('#customer_name').val() == ''){
            toastr.error('', "Please fill name field");
            return false;
        }
    });

    $('#registerForm').submit(function(event){



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

        event.preventDefault();
        var data=$(this).serialize();
        var action=$(this).attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            success: function (data) {
                if(data == "email"){
                    toastr.error('',"Email Already Exist");

                }
                else if(data=="mobile"){
                    toastr.error('',"Mobile Number already exist");
                }else{
                    toastr.success('','Registered successfully');

                    location.href = '/login';
                }

            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });

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
        var email = $('#cust_email').val();
        var data = $(this).closest('form').serialize();
        var action = $(this).closest('form').attr('action');

        if(name === ''){
            toastr.error('', "Please fill name field");
            return false;
        }
        if(personal_number === ''){
            toastr.error('', "Please fill Mobile Number");
            return false;
        }
        var pattern = /^\s*(?:\+?(\d{1,3}))?[- (]*(\d{3})[- )]*(\d{3})[- ]*(\d{4})(?: *[x/#]{1}(\d+))?\s*$/;
        if (!pattern.test(personal_number)) {
            toastr.error('', 'Please enter a valid mobile number');
            return false;
        }
        if(email === ''){
            toastr.error('', "Please fill Email Address");
            return false;
        }

        if (!validateEmail(email)) {
            toastr.error('',"Please enter a valid email");
            return false;
        }

        var that = this;
        $.ajax({
            url: action,
            type: 'POST',
            data: data,
            success: function (resp) {
                if(resp['result'] === 'success'){
                    $(that).closest('form')[0].reset();
                    toastr.success('', resp['msg']);
                    if ($('#create_lead_modal').length > 0)
                        $('#create_lead_modal').modal('hide');
                }
                else
                    toastr.error('', resp['msg']);
                return false;
            },
            error: function (xhr, status, error) {
                toastr.error('', 'Internal Sever Error.');
                console.log(xhr.responseText);
                return false;
            }
        });
        return false;
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
        var reason=$('.reason').val();

        var data = $('#drop_form').serialize();

        if(reason == ''){
            toastr.error('', "Please select the Reason why you want to drop the lead");
            return false;
        }

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

                        toastr.success('', messages);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }else if(confirmation == false){
                $('#create_modal').modal('hide');
                //  $('#client_drop_modal').remove();
            }else{
                $('#create_modal').modal('hide');
            }

        }




    });


});


function dropLead(id, button) {


    var data = {id: id};
    $.ajax({
        url: "leads/drop",
        type: 'GET',
        data: data,
        // data: ajax_data ,
        success: function (response) {
            console.log(response);
            $('#modal_window').html(response);
            $('#client_drop_modal').modal('show');
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}



function leadOppurtunity(id,button,status){


    var data = {id:id,status:status};

    $.ajax({
        url: "leads/oppurtunity",
        type: 'GET',
        data: data,
        success: function (response) {
            $('#modal_window').html(response);
            $('#lead_oppurtunity_modal').modal('show');

            // $('.card-deck').append(response);
            // $(document).find('.card-deck .pop-over').css('top', (button_position.top - button_position.top)).css('left', align_left);
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });


}

function editLead(id, button) {


    $.ajax({
        url: "leads/" + id + "/edit",
        type: 'GET',
        success: function (response) {
            $('#modal_window').html(response);
            $('#client_edit_modal').modal('show');
//            $('.card-deck').append(response);
//            $(document).find('.card-deck .pop-over').css('top', (button_position.top - button_position.top)).css('left', align_left);
//
//           $('#allleads').append(response);
//            $(document).find('#allleads .pop-over').css('top', (button_position.top - button_position.top)).css('left', align_left);

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function viewLead(id, button) {
    //alert(id);
    $('.pop-over').remove();
    console.log(button);

    var button_position = $(button).position();

    var left_align = 248 - button_position.top;
    var align_left = left_align + button_position.top

    console.log(button_position.left);
    console.log(button_position.top);


    $.ajax({
        url: "clients/" + id + "/view",
        type: 'GET',

        success: function (response) {
            $('#modal_window').html(response);
            $('#client_view_modal').modal('show');
            // $('#allleads').append(response);
            // $(document).find('.accordion-group .pop-over').css('top', (button_position.top - button_position.top)).css('left', align_left);
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}
$(document).on('click', '.close_pop_over', function () {
    $('.pop-over').remove();
});




function addActivity(id, button, url = null) {


    var data = {id: id};


    url = "activities/create";

    $.ajax({
        url: url,
        type: 'GET',
        data: data,
        success: function (response) {
            console.log(response);
            $('#modal_window').html(response);
            //alert();
            $('#activity_create_modal').modal('show');
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function addQuotations(id,button){
    // alert(id);
    var data = {id:id};

    var url = '/quotations/create';

    $.ajax({
        url: url,
        type: 'GET',
        data: data,
        success: function (response) {
            console.log(response);
            $('#modal_window').html(response);
            //alert();
            $('#quotations_create_modal').modal('show');
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });


}






$(document).ready(function () {


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
});



$(document).ready(function () {
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


        // var val4 = $('#company_website').val();
        // var regex1 = /^(https?:\/\/)?[a-z0-9-]*\.?[a-z0-9-]+\.[a-z0-9-]+(\/[^<>]*)?$/;
        // var isValid3 = regex1.test(val4);
        // if (!isValid3) {
        //     toastr.error('', 'Please enter a valid company website');
        //     return false;
        // }
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



});




$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    $(".sidebar-brand").toggleClass("shownone");
});

$(document).ready( function() {
    $('.dropdown-toggle').dropdown();
});

$('.dropdown.keep-open').on({
    "shown.bs.dropdown": function() { this.closable = false; },
    "click":             function() { this.closable = true; },
    "hide.bs.dropdown":  function() { return this.closable; }
});


$("#collapse1").click(function() {

    $(".box-body1").toggleClass("hide");
});

$(function () {
    $('.panel-collapse').collapse('show');
    $("#collapse1").click(function(){
        $("#toggler1").toggleClass("fa fa-minus fa fa-plus")
    });
    $("#collapse2").click(function(){
        $("#toggler2").toggleClass("fa fa-minus fa fa-plus")
    });
    $("#collapse3").click(function(){
        $("#toggler3").toggleClass("fa fa-minus fa fa-plus")
    });
    $("#collapse4").click(function(){
        $("#toggler4").toggleClass("fa fa-minus fa fa-plus")
    });
    var active = false;

    $('#collapse-init').click(function () {
        if (active) {
            active = false;
            $('.panel-collapse').collapse('show');
            $('.panel-title').attr('data-toggle', '');
            $(this).text('Hide all');
        } else {
            active = true;
            $('.panel-collapse').collapse('hide');
            $('.panel-title').attr('data-toggle', 'collapse');
            $(this).text('Show All');
        }
    });

    $('#accordion').on('show.bs.collapse', function () {
        if (active) $('#accordion .in').collapse('hide');
    });

});





$(function(){
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

});


// $(document).on('submit', '.activity_form', function () {
//
//     if($('#leadname1').val() == ''){
//         toastr.error('', "Please fill date field");
//         return false;
//     }
//
//     if($('#activitytype').val() == ''){
//         toastr.error('', "Please fill Lead name field");
//         return false;
//     }
//
// });
$(document).on('submit', '#lead_form', function () {

    if($('#date').val() == ''){
        toastr.error('', "Please fill date field");
        return false;
    }

    if($('#lead_id').val() == ''){
        toastr.error('', "Please fill Lead name field");
        return false;
    }
    if($('#lead_address').val() == ''){
        toastr.error('', "Please fill address field");
        return false;
    }
    if($('#currency').val() == ''){
        toastr.error('', "Please fill Currency field");
        return false;
    }
});
$(document).on('submit', '#invoice_form', function () {
    if($('#date1').val() == ''){
        toastr.error('', "Please fill invoice date field");
        return false;
    }

    if($('#date').val() == ''){
        toastr.error('', "Please fill quotation date field");
        return false;
    }

    if($('#lead_id').val() == ''){
        toastr.error('', "Please fill Lead name field");
        return false;
    }
    if($('#lead_address').val() == ''){
        toastr.error('', "Please fill address field");
        return false;
    }
    if($('#currency').val() == ''){
        toastr.error('', "Please fill Currency field");
        return false;
    }
});
$(document).on('click', '#reject', function () {
    if($('#comment1').val()== ''){
        toastr.error('', "Please provide the reason for rejection in Comment field");
        return false;
    }
});
$(document).on('submit', '.quote-form', function () {

    if($('#date').val() == ''){
        toastr.error('', "Please fill date field");
        return false;
    }

    if($('#lead_id').val() == ''){
        toastr.error('', "Please fill Lead name field");
        return false;
    }
    if($('#lead_address').val() == ''){
        toastr.error('', "Please fill address field");
        return false;
    }
    if($('#currency').val() == ''){
        toastr.error('', "Please fill Currency field");
        return false;
    }

});



$('#characterLeft').text('255 characters left');
$(document).on('keyup','#product_description',function () {
    var max = 255;
    var len = $(this).val().length;
    if (len >= max) {
        $('#characterLeft').text(' you have reached the limit');
    } else {
        var ch = max - len;
        $('#characterLeft').text(ch + ' characters left');
    }
});
$("#reset").on("click", function () {
    $('#my_select option').prop('selected', function() {
        return this.defaultSelected;
    });
});
$(document).on('click','#publish',function() {
    if($('#announce').val() == ''){
        toastr.error('', "Please fill Announce field");
        return false;
    }

});
$('#logo_img').on('change', function () {
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.logo-preview img').show();
            $('.logo-preview img').attr('src', e.target.result);
            $('.logo-preview img').load();
        };

        reader.readAsDataURL(this.files[0]);
    }
});