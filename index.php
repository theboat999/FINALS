<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Signup</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container <?php echo isset($_GET['signup']) ? 'right-panel-active' : ''; ?>" id="container">
        <div class="form-container sign-up-container">
            <form action="signup.php" method="POST">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><img src="Images/facebook.png" alt="Facebook"></a>
                    <a href="#" class="social"><img src="Images/google.jpg" alt="Google"></a>
                    <a href="#" class="social"><img src="Images/linkedin.webp" alt="LinkedIn"></a>
                </div>
                <span>or create a username for registration</span>
                <input type="text" placeholder="Name" name="name" required />
                <input type="text" placeholder="Username" name="username" required />
                <input type="password" placeholder="Password" name="password" required />
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="login.php" method="POST">
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><img src="Images/facebook.png" alt="Facebook"></a>
                    <a href="#" class="social"><img src="Images/google.jpg" alt="Google"></a>
                    <a href="#" class="social"><img src="Images/linkedin.webp" alt="LinkedIn"></a>
                </div>
                <span>or use your account</span>
                <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
                    <p style="color: red;">Invalid username or password</p>
                <?php endif; ?>
                <input type="text" placeholder="Username" name="username" required />
                <input type="password" placeholder="Password" name="password" required />
                <a href="#">Forgot your password?</a>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <a href="?"><button class="ghost" id="signIn">Sign In</button></a>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <a href="?signup=true"><button class="ghost" id="signUp">Sign Up</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
