/**
 * Created by raviteja on 1/7/18.
 */

var utils = (function(globalvars){

    var validate  = {

        Email : function(){
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(elementValue);
        }


    }

    return validate;

})();
