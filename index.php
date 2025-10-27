<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Delius&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <title>TravelTrack</title>
    </head>

    <body class="index">        
        <main>
            <div class="login_box" id="login_box">
                <h1>Welcome, Fellow traveler!!</h1>
                <form action="login.php" method="post">
                    <div class="textbox">
                        <input type="text" placeholder="Username" name="username" required>
                    </div>
                    <div class="textbox">
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="forgot_password">
                        <a href="#" onclick="toggleForm('changePassword')">Forgot password?</a>
                    </div>
                    <button type="submit" class="button">Login</button>
                </form>
                <p class="toggle_link">New to the travelling world? <a href="#" onclick="toggleForm('signup')">Sign Up</a></p>
            </div>

            <div class="signup_box" id="signup_box" style="display: none;">
                <h1>Welcome aboard!</h1>
                <form action="signup.php" method="post">
                    <div class="textbox_signup">
                        <input type="text" placeholder="*Username" name="username" required>
                    </div>
                    <div class="textbox_signup">
                        <input type="text" placeholder="*First Name" name="firstname" required>
                    </div>
                    <div class="textbox_signup">
                        <input type="text" placeholder="Last Name" name="lastname"> 
                    </div>
                    <div class="textbox_signup">
                        <input type="email" placeholder="*Email" name="email" required>
                    </div>
                    <div class="textbox_signup">
                        <input type="password" placeholder="*Password" name="password" required>
                    </div>
                    <div class="textbox_signup">
                        <input type="text" placeholder="*Choose a favourite word" name="favword" required>
                    </div>
                    <button type="submit" class="button">Sign Up</button>
                </form>
                <p class="toggle_link">Already had some adventure? <a href="#" onclick="toggleForm('login')">Login</a></p>
            </div>
            <div class="change_password_box" id="change_password_box" style="display: none;">
                <h1>Change Password</h1>
                <form action="change_password.php" method="post">
                    <div class="textbox">
                        <input type="text" placeholder="*Username" name="username" required>
                    </div>
                    <div class="textbox">
                        <input type="text" placeholder="*Favourite Word" name="favword" required>
                    </div>
                    <div class="textbox">
                        <input type="password" placeholder="Create a New Password" name="new_password" required>
                    </div>
                    <button type="submit" class="button">Change Password</button>
                </form>
            </div>
        </main>

        <script>
            function toggleForm(formType) {
                var loginBox = document.getElementById('login_box');
                var signupBox = document.getElementById('signup_box');
                var changePasswordBox = document.getElementById('change_password_box');

                loginBox.style.display = 'none';
                signupBox.style.display = 'none';
                changePasswordBox.style.display = 'none';

                if (formType === 'login') {
                    loginBox.style.display = 'block';
                } else if (formType === 'signup') {
                    signupBox.style.display = 'block';
                } else if (formType === 'changePassword') {
                    changePasswordBox.style.display = 'block';
                }
            }
        </script>
    </body>
</html>