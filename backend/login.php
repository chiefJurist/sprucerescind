<?php 
    //CONNECT TO DATABASE
    include("config/connect.php");

    //START THE SESSION
    session_start();

    //Setting the errors array
    $errors = ["invalid"=>"", "none"=>"", "wrongOtp"=>""];



    //IF THE LOGIN FORM IS SUBMITTED
    if (isset($_POST['login'])) {
        // get the email and password from the form
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // check if the email exists in the database
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // email exists, check if password is correct
            $userdata = mysqli_fetch_assoc($result);
            if (password_verify($password, $userdata['password'])) {
                // password is correct, send email
                $to = $email;
                $subject = "ACCOUNT LOG IN NOTIFICATION";
                $message = "A user just accessed your account now, contact us at admin@smart-remit.com if this action was not authorized by you";
                $header = "From: admin@sprucerescind.com \r\n";
                mail($to, $subject, $message, $header);

                //create a session for all the imported data
                $_SESSION['id'] = $userdata["id"];
                $_SESSION['email'] = $userdata["email"];
                $_SESSION['name'] = $userdata["name"];
                $_SESSION['country'] = $userdata["country"];
                $_SESSION['balance'] = $userdata["balance"];
                $_SESSION['account_number'] = $userdata["account_number"];
                $_SESSION['card_pin'] = $userdata["card_pin"];
                $_SESSION['gender'] = $userdata["gender"];
                $_SESSION['dob'] = $userdata["dob"];
                $_SESSION['phone_number'] = $userdata["phone_number"];
                $_SESSION['nin'] = $userdata["nin"];

                //redirect to the dashboard page
                header("Location: dashboard.php"); // replace with the actual dashboard page URL

                //free result from memory
                mysqli_free_result($result2);

                //close connection and exit
                mysqli_close($conn);
                exit();
                
            } else {
                // invalid password
                $errors["invalid"] = "Invalid password";
            }
        } else {
            // email does not exist
            $errors["none"]= "You don't have an account";
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
            }
            #password-link{
                text-align: start;
            }
            #log-in{
                background-color: rgb(255, 248, 255);
                width: 100%;
                height: 100%;
                padding: 20px;
                color: #444;
            }
            #reg-link{
                text-align: end;
            }
            a{
                text-decoration: none;
            }
            h2{
                margin-top: 50px;
                margin-bottom: 20px;
                text-align: center;
            }
            p{
                text-align: center;
                font-weight: bold;
            }
            form{
                background-color: white;
                margin-top: 30px;
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
            #log-btn-div{
                padding-top: 70px;
                text-align: center;
                width: 100%;
            }
            #log-btn{
                width: 80%;
                padding: 10px 0;
                border: none;
                outline: none;
                background-color: #444;
                color: white;
                border-radius: 5px;
            }
            #log-btn:hover{
                background-color: grey;
            }
            .errors{
                color: red;
                font-size: small;
            }
        </style>
    </head>
    <body>
        <div id="log-in">
            <p id="password-link"><a href="forgotPassword.php">Forgot Password</a></p>
            <p id="reg-link">(Don't have an account?)<a href="register.php">Register</a></p>
            <h2>Log in</h2>
            <p>Fill the form to log in</p>
            <form action="login.php" method="post">
                <div class="input-field">
                    <label class="in-label">E-mail</label><br>
                    <input type="email" name="email" id="email" class="in-input" placeholder="Your Email" required>
                </div>

                <div class="input-field">
                    <label class="in-label">Password</label><br>
                    <input type="password" name="password" id="password" required placeholder="Input Password" class="in-input">
                </div>
                <div class="errors"><?php echo $errors["invalid"] ?></div>
                <div class="errors"><?php echo $errors["none"] ?></div>

                <div id="log-btn-div">
                    <input type="submit" value="Log In" name="login" id="log-btn">
                </div>
            </form>
        </div>
    </body>
</html>