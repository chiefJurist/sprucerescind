<?php 

    //CONNECT TO DATABASE
    include("config/connect.php");

    //START SESSION
    session_start();

    //Store the data in a varible
    $id = $_SESSION['id'];

    //PREVENT UNAUTHORIZED ACCESS
    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
        exit();
    }

    //Setting The Errors Array
    $errors = ["old" => "", "new" => ""];

    //IF THE FOR HAS BEEN SUBMITTED
    if (isset($_POST["submit"])) {
        //Check if the new passwords match
        $password2 = $_POST["password2"];
        $password3 = $_POST["password3"];
        if ($password2 != $password3) {
            $errors["new"] = "Passwords do not match";
        }
        //Check if the new password is strong
        if (strlen($password2) < 6) {
            $errors["new"] = "Passwords must be at least 6 characters";
        }

        //DATABASE MANIPULATION
        if (!array_filter($errors)) {
            //hash the password
            $hashed = password_hash($password2, PASSWORD_DEFAULT);
            $hash = mysqli_real_escape_string($conn, $hashed);
            
            //Inserting to database
            $sql = " UPDATE users SET password='$hash' WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                # Success.
                header("Location: settings.php");
            }else{
                $errors["new"] = "crosscheck your input";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Spruce Rescind</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="//code.tidio.co/wkz2mp6tlkdssyyhfkf7hxvde5fxcxoi.js" async></script>
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
                width: 100%;
                height: 100%;
            }
            #body{
                padding: 7rem 10%;
            }
            form{
                background-color: white;
                padding: 20px;
                border-radius: 10px;
            }
            .password-con{
                padding-top: 20px;
            }
            .sect-name{
                font-weight: bold;
            }
            input{
                font-size: large;
                border: none;
                outline: none;
                width: 80%;
            }
            .input-p{
                padding-bottom: 5px;
                border-bottom: 1px solid #444;
            }
            #submit{
                margin-top: 30px;
                text-align: center;
            }
            #submit-btn{
                padding: 10px;
                border-radius: 5px;
                background-color: #444;
                color: white;
            }
            footer{
                width: 100%;
                height: 10%;
                padding: 10px 5px;
                top: 90%;
                position: fixed;
                background-color: white;
                text-align: center;
                font-weight: bold;
                font-size: small;
            }
            .errors{
                color: red;
                font-size: small;
                font-family: Arial, Helvetica, sans-serif;
            }
        </style>
    </head>
    <body>
        <div id="body">
            <form action="password.php" method="post">
                <div class="password-con">
                    <p class="sect-name">New Password</p>
                    <p class="input-p"><input type="text" name="password2" placeholder="Enter New Password" required></p>
                    <div class="errors"><?php echo $errors["new"] ?></div>
                </div>

                <div class="password-con">
                    <p class="sect-name">New Password Again</p>
                    <p class="input-p"><input type="text" name="password3" placeholder="Re-enter New Password" required></p>
                    <div class="errors"><?php echo $errors["new"] ?></div>
                </div>

                <div id="submit">
                    <input type="submit" value="CONFIRM" id="submit-btn" name="submit">
                </div>
            </form>
        </div>

        <footer>
            <p>Copyright © Spruce Rescind 2023. All Rights Reserved</p>
        </footer>
    </body>
</html>