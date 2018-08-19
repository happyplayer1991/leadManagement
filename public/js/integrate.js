

function include(filename, onload) {
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.src = filename;
    script.type = 'text/javascript';
    script.onload = script.onreadystatechange = function() {
        if (script.readyState) {
            if (script.readyState === 'complete' || script.readyState === 'loaded') {
                script.onreadystatechange = null;                                                  
                onload();
            }
        } 
        else {
            onload();          
        }
    };
    head.appendChild(script);
}
include('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', function() {
    include('https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js',function(){
       callback();
    });
   
});
function callback(){
  $(function() {


  if($.cookie('name') == ''){
    var unique_id = Math.round(new Date().getTime() + (Math.random() * 100));
  }else{
	  var unique_id = Math.round(new Date().getTime() + (Math.random() * 100)); 
  }

 var company_id = jQuery('#integrate').attr('data-company-id');
 var user_id = jQuery('#integrate').attr('data-user-id');

  $.cookie('name', unique_id);

  console.log($.cookie('name'));
  
  var sessionid = $.cookie('name');
  
  $(document).on("blur","input,textarea",function(e){

    var data = $(this).val();       
    var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
    //var phone_number = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/i;
    var user_name = /^[A-Za-z ]+$/i;
    var lead_num = '';
      if(pattern.test(data)){
        var email_data = data;
      }

      // if(phone_number.test(data)){
      //   var phone_data = data;
      // }

      if(user_name.test(data)) {
        var name_data = data;
      }   

      if(jQuery(this).prop("tagName") == 'textarea') {
        var message_data = data;
      }
    var ajax_data = {session_id:sessionid, email: email_data, name: name_data, message : message_data, company_id:company_id, user_id:user_id, lead_number:lead_num};

      $.ajax({
              url: "https://dev.opalcrm.com/ajax",
              type: 'GET',
              data: ajax_data ,
              success: function (response) {
                 console.log(response);
              },
              error: function(xhr, status, error) {
                   console.log(xhr.responseText);
              }
      }); 
    
  });
  
});
}








