<?php
    //CONNECT TO DATABASE
    include("config/connect.php");

    //Setting The Errors Array
    $errors = ["account" => "", "email" => "", "password" => ""];


    //CREATING VARIABLES TO STORE THE INPUTS
    $email = $password = $password2 = "";



    //IF THE OTP is requested
    if (isset($_POST["request"])) {
        //Giving email and password values
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

        //Validate the email
        if (empty($email)) {
            $errors['email'] = "Please input your email";
            return;
        }else {
            // check if the user already has an account
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) < 1) {
                $errors["account"] = "You do not have an account";
                return;
            }
        }

        //Validate The Password
        if (empty($password) || empty($password2)) {
            $errors['password'] = "Please input your new password";
            return;
        }elseif ($password != $password2) {
            $errors['password'] = "Passwords do not match";
        }elseif (strlen($password)< 6) {
            $errors["password"] = "Password must be at least 6 characters";
        }

        //Send OTP if there is no error
        if (!array_filter($errors)) {
            $otpCode = rand(00000, 99999);
            $to = $email;
            $subject = "PASSWORD RESET NOTIFICATION";
            $message = "Your one time password for reseting your password is $otpCode . Please contact support if this action was not initiated by you";
            $header = "From: admin@sprucerescind.com \r\n";
            mail($to, $subject, $message, $header);
            
            // Store the email and password in the session
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['otpCode'] = $otpCode;

            //The redirect url
            $redirectURL = "otp.php?otpCode=$otpCode&email=";

            header("Location: $redirectURL");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Spruce Rescind</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Login to back to your banking account">
        <script></script>
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, Helvetica, sans-serif;
            }
            body{
                background-color: rgb(255, 248, 255);
                color: #444;
            }
            p{
                text-align: center;
                font-weight: bold;
                margin-top: 50px;
            }
            form{
                background-color: white;
                margin: 70px 0;
                border-radius: 10px;
                padding: 30px 20px;
            }
            .in-input{
                border: none;
                outline: none;
                width: 100%;
                color: #444;
            }
            .input-field{
                border-bottom: 1px solid grey;
                padding-bottom: 5px;
                padding-top: 10px;
            }
            #warning{
                color: red;
                text-align: center;
            }
            #btn-div, #btn-div2{
                padding: 10px 0 70px 0;
                text-align: center;
                width: 100%;
            }
            .btn{
                width: 80%;
                padding: 10px 0;
                border: none;
                outline: none;
                background-color: #444;
                color: white;
                border-radius: 5px;
            }
            .btn:hover{
                background-color: grey;
            }
            .errors{
                color: red;
            }
            .done{
                color: green;
            }
        </style>
    </head>
    <body>
        <div id="log-in">
            <p>FILL THE FORM TO RESET YOUR PASSWORD</p>
            <form action="forgotPassword.php" method="post">
                <div class="errors"><?php echo $errors['account'] ?></div>
                <div class="input-field">
                    <label class="in-label">E-mail</label><br>
                    <input type="email" name="email" class="in-input" placeholder="Your Email" value="<?php echo $email ?>" required>
                </div>
                <div class="errors"><?php echo $errors['email'] ?></div>

                <div class="input-field">
                    <label class="in-label">New Password</label><br>
                    <input type="password" name="password" required placeholder="Input New Password" class="in-input" value="<?php echo $password ?>">
                </div>
                <div class="errors"><?php echo $errors['password'] ?></div>

                <div class="input-field">
                    <label class="in-label">Confirm New Password</label><br>
                    <input type="password" name="password2" required placeholder="Input New Password Again" class="in-input" value="<?php echo $password2 ?>">
                </div>
                <div class="errors"><?php echo $errors['password'] ?></div>

                <div id="btn-div2">
                    <input type="submit" value="REQUEST OTP" name="request" class="btn">
                </div>
            </form>
        </div>
    </body>
</html>