(function($) {
    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    let logo_img = readCookie("logo_img");
    let logo_color = readCookie("logo_color");
    if (logo_img != null) {
        $('.modal-customized .logo img').attr('src', 'images/logo/' + logo_img);
        $('.modal-customized .logo img').show();
    }
    if (logo_color != null) {
        $('.modal-customized .modal-header .header').css('background', logo_color);
        $('.modal-customized .footer button[type="submit"]').css('background-color', logo_color);
    }
    // Add smooth scrolling to all links in navbar
    $(".navbar a,a.btn-appoint, .quick-info li a, .overlay-detail a").on('click', function(event) {

        var hash = this.hash;
        if (hash) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 900, function() {
                window.location.hash = hash;
            });
        }

    });

    $(".navbar-collapse a").on('click', function() {
        $(".navbar-collapse.collapse").removeClass('in');
    });

    //jQuery to collapse the navbar on scroll
    $(window).scroll(function() {
        if ($(".navbar-default").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
        } else {
            $(".navbar-fixed-top").removeClass("top-nav-collapse");
        }
    });

    $('.modal .btn[data-toggle="modal"]').on('click', function() {
        $('.modal').modal('hide');
    });

    let to_default;

    function showAlert(message, obj) {
        obj.find('.alert').removeClass('in').next().css("padding-top", "0");
        obj.find('.alert');
        clearTimeout(to_default);
        obj.find('.alert').html(message).next().animate({
            "padding-top" : "40"
        }, 1000, function() {
        });
        obj.find('.alert').addClass('in');
        to_default = setTimeout(function(){
            obj.find('.alert').removeClass('in').next().animate({
                "padding-top" : "0"
            }, 1000, function() {
                obj.find('.alert').removeClass('alert-success').addClass('alert-danger');
                obj.find('button[type="submit"]').removeAttr('disabled');
            });
        }, 5000);
    }

    $('.modal-customized input').on('keydown', function (evt) {
        if (evt.keyCode == 13) {
            if($(this).closest('.input-group').next().length == 0)
                $(this).closest('.modal-body').find('button[type="submit"]').click();
            else
                $(this).closest('.input-group').next().find('input').focus();
        }
    });

    $('#signin_modal button[type="submit"]').on('click', function () {
        var email = $('#signin_modal input[name="email"]').val();
        var pwd = $('#signin_modal input[name="password"]').val();

        if (!validateEmail(email)) {
            showAlert("Please enter a valid email", $('#signin_modal'));
            return false;
        }
        if(pwd.length < 5) {
            showAlert("Password must include at least 5 chars.", $('#signin_modal'));
            return false;
        }
        var that = this;
        $(this).find('.fa.fa-sign-in').removeClass('fa-sign-in').addClass('fa-spin fa-circle-o-notch');
        $.ajax({
            url: "/login",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                email: email,
                password: pwd
            },
            success: function (resp) {
                if (resp['result'] == 'success') {
                    let d = new Date();
                    d.setTime(d.getTime() + (30*24*60*60*1000));
                    let expires = "expires=" + d.toUTCString();
                    document.cookie = "logo_img=" + resp['logo_img'] + "; " + expires;
                    document.cookie = "logo_color=" + resp['logo_color'] + "; " + expires;
                    location.href = "/dashboard";
                } else {
                    $(that).find('.fa.fa-spin').removeClass('fa-spin fa-circle-o-notch').addClass('fa-sign-in');
                    showAlert(resp['result'], $('#signin_modal'));
                }
            },
            error: function () {
                $(that).find('.fa.fa-spin').removeClass('fa-spin fa-circle-o-notch').addClass('fa-sign-in');
                showAlert('Internal Server Error.', $('#signin_modal'));
            }
        });
    });
    $('#signup_modal button[type="submit"]').on('click', function () {
        var name = $('#signup_modal input[name="name"]').val();
        var company = $('#signup_modal input[name="company_name"]').val();
        var email = $('#signup_modal input[name="email"]').val();
        var phone = $('#signup_modal input[name="work_number"]').val();
        var pwd = $('#signup_modal input[name="password"]').val();
        var pwd_confirm = $('#signup_modal input[name="password_confirmation"]').val();

        if (name == '') {
            showAlert("Please enter a valid name.", $('#signup_modal'));
            return false;
        }
        var pattern = /[^a-zA-Z\d]/;
        if (company == '' || pattern.test(company)) {
            showAlert("Please enter a valid company name", $('#signup_modal'));
            return false;
        }

        if (!validateEmail(email)) {
            showAlert("Please enter a valid email", $('#signup_modal'));
            return false;
        }

        var pattern = /^\s*(?:\+?(\d{1,3}))?[- (]*(\d{3})[- )]*(\d{3})[- ]*(\d{4})(?: *[x/#]{1}(\d+))?\s*$/;
        if (!pattern.test(phone)) {
            showAlert("Please enter a valid mobile number", $('#signup_modal'));
            return false;
        }

        if (pwd.length < 5) {
            showAlert("Password must include at least 5 chars.", $('#signup_modal'));
            return false;
        }
        if (pwd != pwd_confirm) {
            showAlert("Password does not match.", $('#signup_modal'));
            return false;
        }
        var that = this;
        $(this).find('.fa.fa-check').removeClass('fa-sign-in').addClass('fa-spin fa-circle-o-notch');
        $.ajax({
            url: "/register",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: name,
                company_name: company,
                email: email,
                work_number: phone,
                password: pwd
            },
            success: function (resp) {
                $(that).find('.fa.fa-spin').removeClass('fa-spin fa-circle-o-notch').addClass('fa-check');
                if (resp == 'success') {
                    $('#signup_modal').modal('hide');
                    $('#signup_modal input').val('');
                    $('#signin_modal').modal('show');
                    $('#signin_modal .alert').removeClass('alert-danger').addClass('alert-success');
                    showAlert('New user created successfully.', $('#signin_modal'));
                }
                else {
                    showAlert(resp, $('#signup_modal'));
                }
            },
            error: function () {
                $(that).find('.fa.fa-spin').removeClass('fa-spin fa-circle-o-notch').addClass('fa-check');
                showAlert('Internal Server Error.', $('#signup_modal'));
            }
        });
    })
})(jQuery);