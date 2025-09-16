<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/auth/logo2.jpg') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign Up</title>
    <link rel="stylesheet" href="{{ asset('/css/home/allStyle.css') }}" />
    <link href="{{ asset('/css/static/footer.css') }}" rel="stylesheet" />


    <link href="{{ asset('/css/third-party/fontawesome/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/third-party/fontawesome/css/fontawesome.css') }}" rel="stylesheet" />
    <script src="{{ asset('/js/thirdparty/fontawesome/all.min.js') }}"></script>

    <!-- jquery -->
    <script src="{{ asset('/js/thirdparty/jquery/jquery3.7.1.min.js') }}"></script>

    <!-- bootstrap -->
    <link href="{{ asset('/css/third-party/boostrap5.2.3/css/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('/js/thirdparty/bootstrap-5.2.3/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/thirdparty/bootstrap-5.2.3/js/bootstrap.min.js') }}"></script>

    <!-- Notiflix -->
    <link href="{{ asset('/css/third-party/notiflix.css') }}" rel="stylesheet" />
    <script src="{{ asset('/js/thirdparty/notiflix/notiflix.js') }}"></script>

    <!-- Recaptcha -->
    <!-- <script src="https://www.google.com/recaptcha/api.js?render=6LcFhcYpAAAAAEemPgNIC2i9j85yrBj2BiUxyYme"></script> -->

    <style>
        @font-face {
            font-family: 'League Spartan';
            src: url('/public/fonts/LeagueSpartan-Regular.woff2') format('woff2'),
                url('/public/fonts/LeagueSpartan-Light.woff') format('woff');
            font-style: normal;
        }

        * {
            font-family: 'League Spartan', sans-serif !important;
        }

        body {
            background: linear-gradient(270deg, rgba(51, 148, 189, 0.13) -6.11%, rgba(255, 255, 255, 0.34) 35.2%, rgba(247, 149, 27, 0.13) 102.53%);
            overflow-x: hidden;
            height: 100vh;
            font-family: 'League Spartan', sans-serif;
        }


        .float-up {
            top: -20px;
            transition: all 0.2s ease-in 0s;
            left: 5%;
            position: absolute;
            font-size: 15px;
            color: #f16521;
            background-color: #ffffff;
            font-family: 'League Spartan', sans-serif;
        }

        .floating-label {
            position: absolute;
            font-size: 17px;
            top: 6px;
            left: 11%;
            background-color: none;
            font-family: 'League Spartan', sans-serif !important;
        }

        .floating-input {
            border-radius: 2px !important;
            border: 1px solid !important;
            padding-left: 50px;
            height: 55px;
            font-size: 19px !important;
            font-family: 'League Spartan', sans-serif !important;
        }

        .icon {
            position: absolute;
            width: 20px;
            height: 20px;
            opacity: .7;
            margin-left: 24px;
            margin-top: -3px;
        }




        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        input:focus~label,
        input:valid~label {
            top: -12px;
            font-size: 15px;

        }

        #register-button {

            height: 55px !important;
            flex-shrink: 0;
            border-radius: 1.22px;
            border: 1px solid #2FB2F4;
            background-color: #2FB2F4;
            color: white;
            font-family: 'League Spartan', sans-serif !important;
            font-size: 21px !important;
            border-radius: 12px !important;
        }

        #register-button:hover {
            background-color: transparent !important;
            border-color: #2FB2F4;
            color: #2FB2F4 !important;
        }

        .help_text {
            font-size: 17px;
        }



        @media (max-width: 980px) {

            #logo {
                width: 300px;
                height: auto;
            }

            #col_2 {
                width: 100% !important;
            }

            body {
                overflow-y: scroll;
                overflow-x: hidden;
                background-color: none !important;
            }

            .floating-input {
                width: 100% !important;
            }


            #checkbox_input {
                width: 10px !important;
                height: 10px !important;

            }

            .icon_hidden {
                display: none !important;
            }

            .icon_display {
                display: block !important;
            }



            body {
                overflow-y: scroll !important;
            }

            #form-back-img {
                position: absolute;
                display: block !important;
                opacity: .6;

            }

            #image_container {
                position: absolute;
                object-fit: contain;

                width: 100%;

            }

            #register-button {
                height: 50px;
                width: 100% !important;
                flex-shrink: 0;
                border-radius: 12.156px;
                border: 1.216px solid #2FB2F4;
                background-color: #2FB2F4;
                color: white;
                font-family: Inter;
                font-size: 21px;
            }

            #form-container {

                position: relative;


            }

            .floating-label {
                left: 6%;
            }

            #image_container img {
                opacity: .3;
                width: 100%;
                object-fit: cover;
                height: 600px;
            }


            #register-button {
                width: 100% !important;
                font-size: 18px !important;
                padding: 0px 20px !important;
            }
        }


        @media (max-width:580px) {


            #register-button {
                width: 100% !important;
            }

            .floating-input {
                width: 100% !important;
            }

            .floating-label {
                left: 14%;
                top: 12% !important;
            }

            #logo {
                width: 200px !important;
                height: 80px !important;
                margin-top: 2px !important;
            }

        }


        @media (max-width:430px) {
            .text-black {
                font-size: 32px !important;
                margin-top: 25px !important;
                margin-bottom: 10px !important;
            }

            .help_text {
                font-size: 14px;
            }



            .recaptcha {
                margin-left: 0% !important;
            }




        }

        @media (max-width: 390px) {

            option {
                width: 60%;
            }

            .form-check {
                margin-left: 2% !important;
            }

            #logo {
                width: 240px !important;
                height: 80px !important;
            }


        }



        @media (max-width:360px) {


            #register-button {
                width: fit-content !important;
                font-size: 14px !important;
            }
        }
    </style>

    <style>
        .footer-bottom-sec .social-icon-colm ul li a {
            color: #ffffff !important;
        }

        .social-icon-colm ul li a:hover {
            color: #f16521 !important;
        }

        @media(max-width:580px) {
            .footer-bottom-sec .copyright-colm p {
                font-size: 12px !important;
            }

            .footer-bottom-sec .social-icon-colm ul li a {
                font-size: 22px !important;
            }
        }

        @media (max-width:360px) {
            .social-icon-colm i {
                width: 20px !important;
                height: 20px !important;
            }

            .icons {
                height: 20px !important;
                width: 20px !important;
            }

            .copyright-colm p {
                font-size: 8px !important;
            }
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.floating-input').each(function() {
                const input = $(this);
                const label = $('#' + input.attr('id') + '-label');

                input.css('border-color', '#f16521');

                input.focus(function() {
                    label.removeClass('floating-label');
                    label.addClass('float-up');
                });

                input.blur(function() {
                    if (input.val() === '') {
                        label.addClass('floating-label');
                        label.removeClass('float-up');
                    }
                });
            });
        });

        $(document).ready(function() {
            const passwordInput = $('#password');
            const c_passwordInput = $('#confirm_password');
            const showPasswordCheckbox = $('#showPasswordCheckbox');

            showPasswordCheckbox.change(function() {
                const isChecked = showPasswordCheckbox.prop('checked');
                passwordInput.attr('type', isChecked ? 'text' : 'password');
            });
            showPasswordCheckbox.change(function() {
                const isChecked = showPasswordCheckbox.prop('checked');
                c_passwordInput.attr('type', isChecked ? 'text' : 'password');
            });
        });
    </script>
</head>

<body>



    <section style="width: 100%;" id="signup">
        <div class="d-flex" style="width: 100%;">
            <!-- <div class="col-lg-7  col-md-12  col-12 d-flex justify-content-center " id="image_container">
                <img src="{{asset('/assets/auth/signup-banner2.jpg')}}" alt="pic" id="image" class="img-fluid" style="max-width:100%;" />
            </div> -->

            <div class="col-lg-12 col-md-12 col-12 d-flex justify-content-center" id="form-container">
                <div style="width: 70%;padding:50px;" class="justify-content-center" id="col_2">
                    <div class="d-flex justify-content-center align-items-center ">
                        <a href="/">
                            <img src="{{ asset('/assets/auth/med-logo.png') }}" style="height: 200px; width: 200px;" id="logo" />
                        </a>
                    </div>
                    <h3 class="text-black " style=" color: #000; font-family: Inter;font-size: 40.809px; font-style: normal; font-weight: 400;
                        line-height: normal;  text-align: center; margin-top: 5px; margin-bottom: 5px;">Join With Us</h3>

                    <form id="register-form" class="justify-content-center" style="justify-content: center; padding: 20px;">
                        <!-- <form method="POST" action="{{ route('register') }}"> -->
                        @csrf
                        <!-- firstm & last name div -->
                        <div class="row mb-1">
                            <div class="col-6">
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    <div class="form-floating is-invalid">
                                        <input type="text" class="form-control is-invalid" id="firstname" name="firstname" placeholder="First Name" required>
                                        <label for="firstname">First Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    <div class="form-floating ">
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                                        <label for="lastname">Last Name</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- email & phone div -->
                        <div class="row mb-1">
                            <div class="col-6">
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    <div class="form-floating is-invalid">
                                        <input type="text" class="form-control is-invalid" id="email" name="email" placeholder="Email" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fa fa-mobile"></i></span>
                                    <div class="form-floating ">
                                        <input type="text" class="form-control" id="mobile" name="mobile" onkeydown="return event.keyCode !== 69" placeholder="Mobile">
                                        <label for="mobile">Mobile</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- address 1 -->
                        <div class="row mb-1">
                            <div class="col-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fa fa-location-dot"></i></span>
                                    <div class="form-floating ">
                                        <input type="text" class="form-control " id="address_line_1" name="address_line_1" placeholder="address_line_1">
                                        <label for="address_line_1">Address Line 1</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- address 2 -->
                        <div class="row mb-1">
                            <div class="col-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fa fa-location-dot"></i></span>
                                    <div class="form-floating ">
                                        <input type="text" class="form-control " id="address_line_2" name="address_line_2" placeholder="address_line_2">
                                        <label for="address_line_2">Address Line 2</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- city state -->
                        <div class="row mb-1">
                            <div class="col-6">
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fa fa-location-dot"></i></span>
                                    <div class="form-floating ">
                                        <input type="text" class="form-control " id="city" name="city" placeholder="city">
                                        <label for="city">City</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fa fa-location-dot"></i></span>
                                    <div class="form-floating ">
                                        <input type="text" class="form-control" id="state" name="state" placeholder="state">
                                        <label for="state">State</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- zip country-->
                        <div class="row mb-1">
                            <div class="col-6">
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fa fa-location-dot"></i></span>
                                    <div class="form-floating ">
                                        <input type="text" class="form-control " id="zip" name="zip" placeholder="zip">
                                        <label for="zip">Zip</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fa fa-location-dot"></i></span>
                                    <div class="form-floating ">
                                        <input type="text" class="form-control" id="country" name="country" placeholder="country">
                                        <label for="country">Country</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- password confirm password -->
                        <div class="row mb-1">
                            <div class="col-6">
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    <div class="form-floating is-invalid">
                                        <input type="password" class="form-control is-invalid" id="password" name="password" placeholder="password" required>
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="input-group has-validation">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    <div class="form-floating ">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="confirm_password">
                                        <label for="confirm_password">Confirm Password</label>
                                    </div>
                                </div>
                            </div>
                        </div>






                        <div class="form-check mb-" style="display:flex;width:fit-content">
                            <input autocomplete="off" class="form-check-input" type="checkbox" id="showPasswordCheckbox">
                            <label class="form-check-label" for="showPasswordCheckbox" style="margin-left:8px">
                                Show Password
                            </label>
                        </div>

                        <div class="justify-content-center error-parent">
                            <div class="alert alert-danger" id="warningExisting" style="font-size: 13px;background-color:transparent;border: none;color: red;justify-content: center;display:none">
                                <h6>Email Already exists, you can login <a href="/">here</a></h6>
                            </div>
                        </div>

                        <div class="d-flex sm-justify-content-center mt-3" style="justify-content: center;">
                            <button id="register-button" type="submit" class="btn btn-lg go-home-btn w-100">
                                <span id="loading-spinner" class="spinner-border spinner-border-sm d-none" role="status" style="margin-right: 10px;" aria-hidden="true"></span> Register
                            </button>
                        </div>
                        <div class="form-group row justify-content-start mt-3 ">
                            <p class="text-center mt-2" class='help_text'> Already have an account ?
                                <a href="/">
                                    <span style="color: #f16521; cursor: pointer;">Login</span>
                                </a>
                            </p>

                        </div>


                    </form>


                </div>
            </div>
        </div>



    </section>

</body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#register-form').on('submit', function(e) {
            e.preventDefault();

            let formData = {
                firstname: $('#firstname').val(),
                lastname: $('#lastname').val(),
                email: $('#email').val(),
                mobile: $('#mobile').val(),
                address_line_1: $('#address_line_1').val(),
                address_line_2: $('#address_line_2').val(),
                city: $('#city').val(),
                state: $('#state').val(),
                zip: $('#zip').val(),
                country: $('#country').val(),
                password: $('#password').val(),
                password_confirmation: $('#confirm_password').val(),
                _token: $('input[name="_token"]').val()
            };

            $('#register-button').prop('disabled', true);
            $('#loading-spinner').removeClass('d-none');

            $.ajax({
                type: 'POST',
                url: '{{ route("user-register") }}',
                data: formData,
                success: function(response) {
                    $('#loading-spinner').addClass('d-none');
                    $('#register-button').prop('disabled', false);
                    if (response.status === 'success') {
                        alert('Registration successful!');
                        window.location.href = '/';
                    }
                },
                error: function(xhr) {
                    $('#loading-spinner').addClass('d-none');
                    $('#register-button').prop('disabled', false);
                    let errors = xhr.responseJSON.errors;
                    if (errors && errors.email) {
                        $('#warningExisting').show();
                    } else {
                        alert('Please check the form for errors.');
                    }
                }
            });
        });

        // Show Password Toggle
        $('#showPasswordCheckbox').on('change', function() {
            let type = $(this).is(':checked') ? 'text' : 'password';
            $('#password, #confirm_password').attr('type', type);
        });
    });
</script>


</html>