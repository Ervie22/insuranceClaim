<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register</title>
    <link href="{{ asset('assets/auth/favicon.ico') }}" rel="icon">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(to right, #7769F2, #8657F5);
            /* height: 100vh; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        label.form-label {
            text-align: left !important;
            display: block;
        }

        .register-card {
            background: white;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            max-width: 1000px;
            width: 100%;
            text-align: center;
        }

        .register-card img {
            width: 60px;
            margin-bottom: 1rem;
        }

        .register-card h2 {
            font-weight: bold;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .btn-login {
            background-color: #4D3DF6;
            color: white;
            font-weight: 600;
            border-radius: 0.5rem;
        }

        .btn-login:hover {
            background-color: #3b2be1;
        }

        .login-links a {
            font-size: 0.9rem;
            margin: 0 0.5rem;
            text-decoration: none;
        }

        .login-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body style="min-height:100vh; display:flex; justify-content:center; align-items:center;">

    <div class="register-card " style="width:50%; max-width:700px;">
        <img src="{{ asset('/assets/auth/med-logo.png') }}" style="height: 150px; width: 150px; " alt="logo">
        <h4>Register</h4>
        <p>Please enter details below.</p>

        <form id="register-form" method="POST" action="">
            @csrf
            <div class="row mb-1 text-center mx-auto" style="width:70%">
                <div class="col-12">
                    <label for="firstname" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
                </div>
            </div>
            <div class="row mb-1 text-center mx-auto" style="width:70%">
                <div class="col-12">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <div class="text-danger error-message" id="email-error"></div>
                </div>
            </div>
            <!-- Password Field -->
            <div class="row mb-1 text-center mx-auto" style="width:70%">
                <div class="col-12">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control password-input" id="password" name="password" placeholder="Password" required>
                    <div class="text-danger error-message" id="password-error"></div>
                </div>
            </div>

            <!-- Confirm Password Field + Eye Icon -->
            <div class="row mb-1 text-center mx-auto" style="width:70%">
                <div class="col-10">
                    <label for="confirm_password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control password-input" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    <div class="text-danger error-message" id="confirm-password-error"></div>
                </div>
                <div class="col-2 d-flex align-items-end">
                    <i class="fa fa-eye toggle-password" style="cursor:pointer; font-size: 20px;"></i>
                </div>
            </div>
            @php
            // Generate random numbers
            $num1 = rand(1, 10);
            $num2 = rand(1, 10);
            session(['captcha_answer' => $num1 + $num2]);
            @endphp
            <div class="row mb-1 text-center mx-auto" style="width:70%">
                <div class="text-start mb-3">
                    <label class="form-label">What is {{ $num1 }} + {{ $num2 }}?</label>
                    <input class="form-control" type="text" onchange="checkCaptcha('{{ $num1 }}','{{ $num2 }}')" name="captcha_answer" id="captcha_answer" placeholder="Enter answer" required>
                </div>
                <div id="captcha-error" style="color: red; display: none; font-size: 13px;">Wrong answer, try again</div>
            </div>



            <button type="button" id="saveButton" onclick="saveSignup()" class="btn btn-login w-25 mb-3">Register</button>
            <div id="signup-error" style="color: blue; display: none; font-size: 13px;">Sign Up In Progress</div>
        </form>


        <div class="login-links">
            <a href="/">Already registerered? Please login here</a>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        var num1 = <?php echo $num1; ?>;
        var num2 = <?php echo $num2; ?>;
        var correctAnswer = num1 + num2;

        $('#captcha_answer').on('input', function() {
            var userAnswer = parseInt($(this).val());

            if (userAnswer === correctAnswer) {
                $('#saveButton').show();
                $('#captcha-error').hide();
            } else {
                $('#saveButton').hide();
                $('#captcha-error').show();
            }
        });
    });
</script>
<script>
    function saveSignup() {
        let valid = true;

        // Clear previous errors
        $('.error-message').text('');

        const email = $('#email').val().trim();
        const password = $('#password').val();
        const confirmPassword = $('#confirm_password').val();

        // Email format validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            $('#email-error').text('Please enter a valid email.');
            valid = false;
        }

        if (password.length < 8) {
            $('#password-error').text('Password must be at least 8 characters.');
            valid = false;
        }

        if (password !== confirmPassword) {
            $('#confirm-password-error').text('Passwords do not match.');
            valid = false;
        }

        if (!valid) return;

        let formData = new FormData($('#register-form')[0]);

        $.ajax({
            type: 'POST',
            url: '{{ route("save-signup") }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response == 1) {
                    alert('Registration successful! Verification email sent successfully!');
                    window.location.href = '/';
                } else if (response == 2) {
                    alert('Registration successful! But verification email failed.');
                    window.location.href = '/';
                } else {
                    alert(response);
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                if (errors && errors.email) {
                    alert(errors.email[0]);
                } else {
                    alert('Please check the form for errors.');
                }
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('.toggle-password').on('click', function() {
            $('.password-input').each(function() {
                const type = $(this).attr('type') === 'password' ? 'text' : 'password';
                $(this).attr('type', type);
            });
            $(this).toggleClass('fa-eye fa-eye-slash');
        });
    });
</script>
<!-- <script>
    $(document).ready(function() {
        // function saveSignup() {
        //     let valid = true;

        //     // Clear previous errors
        //     $('.error-message').text('');

        //     const email = $('#email').val().trim();
        //     const password = $('#password').val();
        //     const confirmPassword = $('#confirm_password').val();

        //     // Email format validation
        //     const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        //     if (!emailRegex.test(email)) {
        //         $('#email-error').text('Please enter a valid email.');
        //         valid = false;
        //     }

        //     // Password length check
        //     if (password.length < 8) {
        //         $('#password-error').text('Password must be at least 8 characters.');
        //         valid = false;
        //     }

        //     // Password match check
        //     if (password !== confirmPassword) {
        //         $('#confirm-password-error').text('Passwords do not match.');
        //         valid = false;
        //     }
        //     let formData = new FormData($('#register-form')[0]);
        //     $.ajax({
        //         type: 'POST',
        //         url: '{{ route("save-signup") }}',
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         success: function(response) {
        //             if (response === 1) {
        //                 alert('Registration successful! Verification email sent successful!');
        //                 window.location.href = '/';
        //             }
        //             if (response === 2) {
        //                 alert('Registration successful! Verification email sent failed');
        //                 window.location.href = '/';
        //             }
        //         },
        //         error: function(xhr) {
        //             let errors = xhr.responseJSON.errors;
        //             if (errors && errors.email) {
        //                 $('#warningExisting').show();
        //             } else {
        //                 alert('Please check the form for errors.');
        //             }
        //         }
        //     });
        // }


        // Show Password Toggle
        $('#showPasswordCheckbox').on('change', function() {
            let type = $(this).is(':checked') ? 'text' : 'password';
            $('#password, #confirm_password').attr('type', type);
        });
    });
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
</script> -->

</html>