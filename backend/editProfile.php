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
    $errors = ["nin"=>"", "phone"=>"", "gender"=>"", "dob"=>""];

    //IF THE FORM HAS BEEN SUBMITTED
    if (isset($_POST["submit"])) {
        //Validate the phone number
        $phone = $_POST["phone"];
        if (empty($phone)) {
            $errors["phone"] = "Please input a valid phone number";
        }else{
            if (!preg_match('/^(?:\+\d{1,3}\s?)?(?:\(\d{1,3}\)\s?)?(?:\d{1,4}\s?-?){1,5}\d{1,4}$/', $phone)) {
                $errors["phone"] = "Please input a valid phone number";
            }
        }

        //Validating NIN
        $nin = $_POST["nin"];
        if (empty($nin)) {
            $errors["nin"] = "Please input your national identity card number";
        }else{
            if (!preg_match('/^[a-zA-Z0-9]+$/', $nin)) {
                $errors["nin"] = "Your National Identity number should contain only letters and numbers";
            }
        }

        //Validating DOB
        $dob = $_POST["dob"];
        if (empty($dob)) {
            $errors["dob"] = "Please input your date of birth";
        }

        //Validating gender
        $gender = $_POST["gender"];
        if (empty($gender)) {
            $errors["gender"] = "Please input your gender";
        }


        //DATABASE MANIPULATION
        if (!array_filter($errors)) {
            //Protecting the users input
            $dob = mysqli_real_escape_string($conn, $_POST['dob']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $nin = mysqli_real_escape_string($conn, $_POST['nin']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);

            //Inserting to database
            $sql = "UPDATE users SET nin='$nin', dob='$dob', phone_number='$phone', gender='$gender' WHERE id=$id";


            if (mysqli_query($conn, $sql)) {
                # Success.
                header("Location: settings.php");
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
                color: #444;
            }
            #body{
                padding: 7rem 10%;
            }
            form{
                background-color: white;
                padding: 20px;
                border-radius: 10px;
            }
            .gen-con{
                padding-top: 20px;
            }
            .sect-name{
                font-weight: bold;
            }
            input{
                font-size: large;
                border: none;
                outline: none;
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
            <form action="editProfile.php" method="post">
                <div class="gen-con">
                    <p class="sect-name">National Identity Number</p>
                    <p class="input-p"><input type="text" name="nin" placeholder="Enter ID card number"></p>
                    <div class="errors"><?php echo $errors["nin"] ?></div>
                </div>

                <div class="gen-con">
                    <p class="sect-name">Phone Number</p>
                    <p class="input-p"><input type="tel" name="phone" placeholder="Input your phone number"></p>
                    <div class="errors"><?php echo $errors["phone"] ?></div>
                </div>

                <div class="gen-con">
                    <p class="sect-name">Date of Birth</p>
                    <p class="input-p"><input type="date" name="dob"></p>
                    <div class="errors"><?php echo $errors["dob"] ?></div>
                </div>

                <div class="gen-con">
                    <p class="sect-name">Gender</p>
                    <p class="input-p">
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">female
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">male 
                    </p>
                    <div class="errors"><?php echo $errors["gender"] ?></div>
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