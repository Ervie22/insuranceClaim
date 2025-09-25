<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS CDN -->
    <link href="{{ asset('/assets/auth/claimease.jpg') }}" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #e0f7fa 0%, #e8f5e9 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 128, 128, 0.1);
            width: 100%;
            max-width: 420px;
            overflow: hidden;
            animation: fadeIn 0.5s ease-out;
            border: 1px solid #e0f2f1;
        }

        .login-header {
            background: linear-gradient(to right, #4fc3f7, #4db6ac);
            color: white;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }

        .login-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, #0288d1, #00796b);
        }

        .login-header h1 {
            font-size: 28px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .login-header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .medical-icon {
            font-size: 40px;
            margin-bottom: 10px;
            color: #e1f5fe;
        }

        .login-body {
            padding: 30px;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #00695c;
            font-size: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid #b2dfdb;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: #fafafa;
        }

        .input-group input:focus {
            border-color: #4db6ac;
            outline: none;
            box-shadow: 0 0 0 2px rgba(77, 182, 172, 0.2);
            background-color: white;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 40px;
            color: #4db6ac;
            font-size: 18px;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 40px;
            cursor: pointer;
            color: #80cbc4;
        }

        .login-btn {
            background: linear-gradient(to right, #0288d1, #0097a7);
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            letter-spacing: 0.5px;
        }

        .login-btn:hover {
            background: linear-gradient(to right, #0277bd, #00838f);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 131, 143, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .security-notice {
            background-color: #e0f2f1;
            border-left: 4px solid #4db6ac;
            padding: 12px;
            margin-top: 25px;
            border-radius: 4px;
            font-size: 13px;
            color: #00695c;
            display: flex;
            align-items: center;
        }

        .security-notice i {
            color: #0288d1;
            margin-right: 10px;
            font-size: 16px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e0f2f1;
            font-size: 12px;
            color: #80cbc4;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .login-container {
                max-width: 100%;
            }

            .login-body {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>


    <div class="login-container">
        <div class="login-header">
            <div class="medical-icon">
                <img src="{{ asset('/assets/auth/claimease.jpg') }}" style="height: 75px; width: 150px;" alt="logo">
            </div>

        </div>

        <div class="login-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <label for="username">Username</label>
                    <i class="fas fa-user input-icon"></i>
                    <input type="email" name="email" placeholder="admin@gmail.com" id="email" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" placeholder="Enter your password" required>
                    <span class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>Login
                </button>

                <!-- <div class="security-notice">
                    <i class="fas fa-lock"></i>
                    <span>Secure access to medical insurance data. All activities are logged for compliance.</span>
                </div> -->
            </form>

            <!-- <div class="footer">
                <p>© 2023 Covenant Medical Insurance. Authorized use only.</p>
            </div> -->
        </div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });

        // Form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Simple validation
            if (username && password) {
                // Show loading state
                const loginBtn = document.querySelector('.login-btn');
                loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Authenticating...';
                loginBtn.disabled = true;

                // Simulate authentication process
                setTimeout(() => {
                    alert('Authentication successful! Redirecting to dashboard...');
                    // In a real application, you would redirect to the dashboard
                    // window.location.href = 'dashboard.html';

                    // Reset button
                    loginBtn.innerHTML = '<i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>Login';
                    loginBtn.disabled = false;
                }, 1500);
            } else {
                alert('Please fill in all fields');
            }
        });

        // Add focus effects to inputs
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.input-icon').style.color = '#0288d1';
            });

            input.addEventListener('blur', function() {
                this.parentElement.querySelector('.input-icon').style.color = '#4db6ac';
            });
        });
    </script>
</body>

</html>