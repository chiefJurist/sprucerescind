<?php 
    //Include database connection
    include("config/connect.php");

    //Setting the fields as they will load
    $email = $name = $password = $password2 = $country = "";

    //SETTING THE ERRORS ARRAY 
    $errors = ["email" => "", "name" => "", "password" => "", "country" => "", "accWarn" => ""];

    //CHECKING IF THE FORMS HAVE BEEN SUBMITTED
    if (isset($_POST["register"])) {

        //Check if the email is valid
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Please provide a valid email address";
        }

        //Check if the full name is valid
        $name = $_POST["name"];
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $errors["name"] = "Your name should contain only letters and spaces";
        }

        //Check if the passwords match
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        if ($password != $password2) {
            $errors["password"] = "Passwords do not match";
        }

        //Check if the password is strong
        if (strlen($password) < 6) {
            $errors["password"] = "Password should be at least 6 characters";
        }

        //check if the country of origin is valid
        $country = $_POST["country"];
        if (!preg_match('/^[a-zA-Z\s]+$/', $country)) {
            $errors["country"] = "Input your Country using English Language";
        }

        // check if the user already has an account
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $errors["accWarn"] = "You already have an account";
        }


        //FOR REDIRECTING AND DATABASE MANIPULATION
        if (!array_filter($errors)) {
            //create account number
            $account = rand(2135467089, 2153467098);

            //Setting the account balance
            $balance = 0;

            //Protecting the users input
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $hash = mysqli_real_escape_string($conn, $hashed);
            $country = mysqli_real_escape_string($conn, $_POST['country']);

            //Create SQL
            $sql = "INSERT INTO users(name, email, password, country, balance, account_number) VALUES('$name', '$email', '$hash', '$country', '$balance', '$account')";

            //Redirecting
            if (mysqli_query($conn, $sql)) {
                //success
                header("Location: login.php");
            }
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Spruce Rescind</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Get started and get the best banking experience">
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
            #register{
                width: 100%;
                height: 100%;
                padding: 20px;
                color: #444;
            }
            #log-in-link{
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
            label{
                font-size: small;
            }
            #warning{
                color: red;
                text-align: center;
            }
            #terms{
                padding-top: 20px;
            }
            #reg-btn-div{
                padding-top: 70px;
                text-align: center;
                width: 100%;
            }
            #reg-btn{
                width: 80%;
                padding: 10px 0;
                border: none;
                outline: none;
                background-color: #444;
                color: white;
                border-radius: 5px;
            }
            #reg-btn:hover{
                background-color: grey;
            }
            .errors{
                color: red;
                font-size: small;
            }
        </style>
    </head>
    <body>
        <div id="register">
            <p id="log-in-link">(Have an account?)<a href="login.php">Log In</a></p>
            <h2>Register Now</h2>
            <p>Create an account</p>
            <div class="errors"><?php echo $errors["accWarn"] ?></div>
            <form action="register.php" method="POST">
                <div class="input-field">
                    <label class="in-label">Full Name</label><br>
                    <input type="text" placeholder="Your full name" class="in-input" name="name" value="<?php echo $name ?>">
                </div>
                <div class="errors"><?php echo $errors["name"] ?></div>

                <div class="input-field">
                    <label class="in-label">E-mail</label><br>
                    <input type="email" name="email" id="email" class="in-input" placeholder="Your Email" required value="<?php echo $email ?>">
                </div>
                <div class="errors"><?php echo $errors["email"] ?></div>

                <div class="input-field">
                    <label class="in-label">Password</label><br>
                    <input type="password" name="password" id="password" placeholder="Input New Password" class="in-input" required value="<?php echo $password ?>">
                </div>
                <div class="errors"><?php echo $errors["password"] ?></div>

                <div class="input-field">
                    <label class="in-label">Password Again</label><br>
                    <input type="password" name="password2" id="password" placeholder="Input password again" class="in-input" required value="<?php echo $password2 ?>">
                </div>
                <div class="errors"><?php echo $errors["password"] ?></div>

                <div class="input-field">
                    <label class="in-label">Country Of origin</label>
                    <input type="text" placeholder="Your Country Of Origin" required class="in-input" name="country" value="<?php echo $country ?>">
                </div>
                <div class="errors"><?php echo $errors["country"] ?></div>

                <div id="terms">
                    <input type="radio" name="radio" id="radio">
                    I accept the <a href="#">terms and conditions</a>
                </div>

                <div id="reg-btn-div">
                    <input type="submit" value="Register" name="register" id="reg-btn">
                </div>
            </form>
        </div>
    </body>
</html>