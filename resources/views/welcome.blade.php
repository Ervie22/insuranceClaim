<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/auth/logo2.jpg') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in to Med * A-EYE</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            font-family: 'League Spartan', sans-serif;
        }

        .float-up {
            top: -20px;
            transition: all 0.2s ease-in 0s;
            left: 4%;
            position: absolute;
            font-size: 15px;
            color: #f16521;
            background-color: #ffffff;
            font-family: 'League Spartan', sans-serif !important;
        }

        .floating-label {
            position: absolute;
            font-size: 17px;
            top: 6px;
            left: 10%;
            background-color: none;
            font-family: 'League Spartan', sans-serif !important;
        }

        .floating-input {
            border-radius: 2px !important;
            border: 1px solid !important;
            width: 500px;
            padding-left: 50px;
            height: 55px;
            font-size: 19px !important;
            font-family: 'League Spartan', sans-serif !important;
        }


        input:focus {
            border: 1px solid rgb(241, 101, 33) !important;
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
            font-size: 12px;

        }

        input {
            font-family: 'Inter', sans-serif !important;
        }

        #login-go {
            width: 500px !important;
            height: 55px !important;
            flex-shrink: 0;
            border-radius: 12px !important;
            border: 1.216px solid #2FB2F4;
            background-color: #2FB2F4;
            color: white;
            font-size: 21px !important;
            font-family: 'League Spartan', sans-serif !important;
        }

        #login-go:hover {
            background-color: transparent !important;
            border-color: #2FB2F4 !important;
            color: #2FB2F4 !important;
            font-family: 'League Spartan', sans-serif !important;
        }

        .icon_hidden {
            display: none;
        }

        .icon_display {
            display: block;
        }

        #signup_link {
            font-size: 15px;
        }

        #form_container {
            padding: 10px;
        }



        @media only screen and (max-width: 980px) {

            #logo {
                width: 300px;
                height: auto;
            }

            #col_2 {
                width: 100% !important;
            }

            body {
                overflow-y: scroll;
            }

            #register_btn {
                display: flex;
                justify-content: center;
                margin-bottom: 10px;
            }

            #image_container {
                position: absolute;
                object-fit: contain;
                top: 20%;
            }

            #image_container img {
                opacity: .3;
                width: 100%;
                object-fit: cover;
                height: 600px;
            }

            #form_container {
                position: relative;

            }

            .text-black {
                font-size: 26px;
                margin-top: 10px !important;
            }

            .icon {
                position: absolute;
                margin: 17px;
                width: fit-content;
                opacity: .7;
            }

            #login-go {
                height: 50px;
                width: 100% !important;
                flex-shrink: 0;
                border-radius: 12.156px;
                border: 1.216px solid #2FB2F4;
                background-color: #2FB2F4;
                color: white;
                font-family: 'League Spartan', sans-serif !important;
                font-size: 21px;
            }

            .help_text {
                font-size: 15px !important;
            }

            .floating-label {
                left: 6%;
            }


        }

        @media (max-width:580px) {
            .floating-label {
                left: 12%;
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

            #form_container img {
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width:360px) {
            .floating-label {
                position: absolute;
                font-size: 17px;
                top: 4px;
                left: 18%;
                background-color: none;
            }

            #logo {
                width: 240px !important;
                height: 80px !important;
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
            const passwordInput = $('#password');
            const showPasswordCheck = $('#showPasswordIcon');

            showPasswordCheck.on('click', function() {
                const isChecked = passwordInput.attr('type') === 'password';
                passwordInput.attr('type', isChecked ? 'text' : 'password');

                showPasswordCheck.toggleClass('blue-icon', isChecked);
            });

        });
    </script>

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
    </script>

    <script>
        $(document).ready(function() {
            const passwordInput = $('#password');
            const showPasswordCheckbox = $('#showPasswordCheckbox');

            showPasswordCheckbox.change(function() {
                const isChecked = showPasswordCheckbox.prop('checked');
                passwordInput.attr('type', isChecked ? 'text' : 'password');
            });
        });
    </script>

    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const loginButton = document.getElementById('login-go');
        //     const loadingSpinner = document.getElementById('loading-spinner');
        //     const errorParent = document.querySelector('.error-parent');
        //     const errorElement = document.getElementById('error');
        //     const rememberCheckbox = document.querySelector('#remember');

        //     loginButton.addEventListener('click', function() {
        //         errorElement.innerText = '';

        //         const email = document.querySelector('#email').value;
        //         const password = document.querySelector('#password').value;
        //         const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        //         if (!email || !password) {
        //             showError('Please Enter Email and Password.');
        //             return;
        //         }

        //         let remember_me = false;

        //         const formData = new FormData();

        //         formData.append('email', email);
        //         formData.append('password', password);
        //         formData.append('remember', false);

        //         disableInputs();

        //         grecaptcha.ready(function() {
        //             grecaptcha.execute('6LcFhcYpAAAAAEemPgNIC2i9j85yrBj2BiUxyYme', {
        //                 action: 'submit'
        //             }).then(function(token) {
        //                 formData.append('gResponse', token);
        //                 try {
        //                     if (token) {
        //                         $.ajax({
        //                             type: 'POST',
        //                             url: '/login/user',
        //                             data: formData,
        //                             contentType: false,
        //                             processData: false,
        //                             headers: {
        //                                 'X-CSRF-TOKEN': csrfToken
        //                             },
        //                             success: function(data) {
        //                                 enableInputs();
        //                                 loginButton.disabled = false;
        //                                 loadingSpinner.classList.add('d-none');
        //                                 if (data.status === 200) {
        //                                     Notiflix.Notify.success(data.message, {
        //                                         timeout: 8500,
        //                                         position: 'right-bottom',
        //                                     });

        //                                     const urlParams = new URLSearchParams(window.location.search);
        //                                     const redirectURI = urlParams.get('Redirect-Uri');

        //                                     if (redirectURI) {
        //                                         window.location.href = redirectURI;
        //                                     } else {
        //                                         window.location.href = '/';
        //                                     }
        //                                 } else if (data.error) {
        //                                     showError(data.error);
        //                                 }
        //                             },
        //                             error: function(xhr) {
        //                                 enableInputs();
        //                                 loginButton.disabled = false;
        //                                 loadingSpinner.classList.add('d-none');

        //                                 if (xhr.responseJSON && xhr.responseJSON.error) {
        //                                     console.log('error');
        //                                 } else {
        //                                     showError('An error occurred.');
        //                                 }
        //                             }
        //                         });
        //                     } else {
        //                         showError('Captcha verification failed!');
        //                     }
        //                 } catch (error) {
        //                     console.error('Error:', error.message);
        //                 }
        //             });
        //         });
        //     });


        //     function showError(message) {
        //         window.scroll(0, 0);
        //         errorParent.classList.add('d-flex');
        //         let display_error = errorElement.textContent = message;

        //         console.log(display_error)
        //     }

        //     function disableInputs() {
        //         const inputs = document.querySelectorAll('input');
        //         for (const input of inputs) {
        //             input.disabled = true;
        //         }
        //         loadingSpinner.classList.remove('d-none');
        //     }

        //     function enableInputs() {
        //         const inputs = document.querySelectorAll('input');
        //         for (const input of inputs) {
        //             input.disabled = false;
        //         }
        //     }
        // });
    </script>

</head>

<body>
    <section id="login" style="height: 100vh;">
        <div class="d-flex" style="width: 100%;">
            <div class="col-lg-7  col-md-12 col-12 d-flex justify-content-center" id="image_container">
                <img src="{{asset('/assets/auth/banner5.jpg')}}" alt="pic" id="image" class="img-fluid" style="max-width:100%;height:100%;" />
            </div>

            <div class="col-lg-4 col-md-12 col-12 d-flex justify-content-center" id="form_container">
                <div style="padding:20px" class="justify-content-center" id="col_2">
                    <div class="d-flex justify-content-center">
                        <a href="/">
                            <img src="{{ asset('/assets/auth/med-logo.png') }}" style="height: 300px; width: 300px;   " id="logo" />
                        </a>
                    </div>

                    <h3 class="text-black " style=" color: #000; font-family: Inter;font-size: 40.809px; font-style: normal; font-weight: 400;
            line-height: normal;  text-align: center; margin-top: 75px; margin-bottom :60px;">Login</h3>

                    <form id="login-form" class="justify-content-center" style="justify-content: center; padding: 5px;">

                        <div class="justify-content-center error-parent" style="display: none;">
                            <div class="alert alert-danger" id="error" style="font-size: 13px;background-color:transparent;border: none;display:none;color: red;display: flex;justify-content: center;"></div>
                        </div>

                        <div class="form-outline mb-3 mt-4" style="position: relative;">
                            <div class=" d-flex " style="align-items: center;">
                                <i class="fa fa-envelope icon" id="email-icon"></i>
                                <input required type="email" id="email" name="email" class="floating-input" style="border: 1px solid #000; font-size: 19px; font-family: Inter;" autocomplete="off" />
                            </div>
                            <label class="form-label floating-label mt-2" id="email-label" for="email">Email address..</label>
                        </div>

                        <div class="form-outline mb-3 mt-4" style="position: relative;">
                            <div class="d-flex">
                                <i class="fa fa-lock icon" id="password-icon" style="margin-top: 14px;"></i>
                                <input required type="password" id="password" name="password" class="floating-input" style="border: 1px solid #000" autocomplete="off" />
                            </div>
                            <label class="form-label floating-label mt-2" id="password-label" for="password">Password..</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check mb-" style="display:flex;width:fit-content">
                                <input autocomplete="off" class="form-check-input" type="checkbox" id="showPasswordCheckbox">
                                <label class="form-check-label" for="showPasswordCheckbox" style="margin-left:8px;display:flex;align-items:center;font-size:15px;">
                                    Show Password
                                </label>
                            </div>
                            <!-- <a href="/forget-password" class="text-body" style="text-decoration: none;">Forgot password?</a> -->
                        </div>



                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-lg m-auto floating-input" style="width:160px; padding-left: 2rem; padding-right: 2rem;background-color:#31AEF0;color:#ffffff; "> <span id="loading-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" style="margin-right: 10px;"></span>Login</button>
                            <!-- <p class="small fw-bold mt-3 pt-1 mb-0 text-center" id="signup_link">Don't have an account? <a href="/register" id="signup-link" class="link-danger">Create  Account with us!</a></p> -->
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
    // $('#login-form').submit(function(e) {
    //     e.preventDefault();
    //     alert('hi');
    //     let formData = new FormData(this);
    //     $.ajax({
    //         type: 'POST',
    //         url: '{{route("user-login")}}',
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         dataType: 'json',
    //         success: function(data) {
    //             if(data == 1){
    //                 window.location.href = "/admin-dashboard";
    //             }
    //             if(data == 2){
    //                 window.location.href = "/consumer-dashboard";
    //             }
    //             if(data == 3){

    //             }
    //             if(data == 4){

    //             }
    //         },
    //         error: function(data) {
    //             console.log(data);
    //         }
    //     });
    // });
</script>

</html>