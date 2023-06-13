<?php
    //CONNECT TO DATABASE
    include("config/connect.php");

    //Setting The Errors Array
    $errors = [ "otp" => ""];


    //CREATING VARIABLES TO STORE THE INPUTS
    $otp =  "";


    //IF THE PASSWORD CHANGE BUTTON IS CLICKED
    //Get the values from the previous page
    session_start();
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $otpCode = $_SESSION['otpCode'];
    
    if (isset($_POST['submit'])) {
        //Giving otp values
        $otp = $_POST["otp"];

        //Validate OTP
        if ($otp != $otpCode) {
            $errors["otp"] = "Incorrect OTP";
        }else {
            //Save To Database And Redirect If There Is No Error
            //hash the password
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $hash = mysqli_real_escape_string($conn, $hashed);
            
            $sql = " UPDATE users SET password='$hash' WHERE email='$email'";
            if (mysqli_query($conn, $sql)) {
                //success
                header("Location: login.php");
            }
            
            //free result from memory
            mysqli_free_result($result);

            //close connection and exit
            mysqli_close($conn);
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
            <p>INPUT YOUR OTP TO RESET YOUR PASSWORD</p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="input-field">
                    <label class="in-label">Input OTP</label><br>
                    <input type="password" name="otp" placeholder="Input OTP code" class="in-input" maxlength="5">
                </div>
                <div class="errors"><?php echo $errors['otp'] ?></div>

                <div id="btn-div">
                    <input type="submit" name="submit" value="CHANGE PASSWORD" class="btn">
                </div>
            </form>
        </div>
    </body>
</html>