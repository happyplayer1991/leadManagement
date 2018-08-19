/**
 * Created by raviteja on 1/7/18.
 */
var core = (function () {

    var crmmethods = {

        modalView : function (event){

            event.preventDefault();
            var data = $(this).serialize();
            var action = $(this).attr('action');
             $.ajax({
                url: action,
                type: 'GET',
                success: function (response) {
                    console.log(response);
                    $('#modal_window').html(response);
                    $('#create_modal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });

        },
        submitForm : function (event){
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
                    if(data.error != ""){
                        toastr.error('', data.error);
                    }else{
                         $('#create_modal').modal('hide');
                         $('#ajaxContent').html(data.html);
                         $('#ajaxContent1').html(data.html);
                         $('#loader').hide(); 
                         toastr.success('',data.message);
                    }
                    
                 }else{
                     toastr.success('','Activity successfully Added');
                      $('#create_modal').modal('hide');
                 }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        },
        calculatetotal : function (){
            var sum = 0;
            //console.log("here");

            $('table tr td #price').each(function(){
                sum += parseInt($(this).val());
                console.log(sum);
                //alert(sum);

            });

            //alert(sum);
            // $('.sum').html(sum);
            $('#total_value').val(sum);
            $('#sum_total').html(sum);

            // var tax  = 14.5;
            // var amountTax = (sum * tax) / 100;
            // var amountTotal = parseFloat(sum) + parseFloat(amountTax);
            // $('#vat_tax').html(amountTax);
            // $('#grand_total').html(amountTotal);

        },

        addProduct: function (){

            $.ajax({
                url: "products/create",
                type: 'GET',
                success: function (response) {
                    console.log(response);
                    $('#modal_window').html(response);
                    $('#product_create_modal').modal('show');
                    //$('.navbar').append(response);
                    // $(document).find('.navbar .pop-over');//.css('top', (button_position_add.top + 28)).css('left', (button_position_add.left - 600));
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });

        },

        editProduct: function (id){

            var data = {id: id};

            $.ajax({
                url: "products/edit",
                type: 'GET',
                data:data,
                success: function (response) {
                    console.log(response);
                    $('#modal_window').html(response);
                    $('#product_edit_modal').modal('show');
                    //$('.navbar').append(response);
                    // $(document).find('.navbar .pop-over');//.css('top', (button_position_add.top + 28)).css('left', (button_position_add.left - 600));
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });

        },
        addLead: function (button) {
            $('.pop-over').remove();

            $.ajax({
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
        },
        editLead: function (id, button) {


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
        },

        viewLead: function (id, button) {
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
        },
        dropLead: function (id, button) {


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
        },

        leadOppurtunity: function (id,button,status){


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


        },
        addActivity: function (id, button, url=null) {


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
        },
        activity_status: function (id,obj,url = null){
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
        },

        assign_users: function (id,obj){

            var user_id = $(obj).val();

            var data = {user_id:user_id};
            //alert(id);
            $.ajax({
                url: 'clients/assign_user/'+id,
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
        },

        addQuotations: function (id,button){
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

    }

    return crmmethods;

})();
