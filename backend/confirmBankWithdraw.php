<?php 
    //CONNECT TO DATABASE
    include("config/connect.php");

    //START SESSION
    session_start();

    //Setting Errors Array
    $errors = ["connection" => ""];

    //Store the data in a varible
    $id = $_SESSION['id'];
    $cardPin = $_SESSION['card_pin'];
    $balance = $_SESSION['balance'];
    $amount = $_SESSION['withdrawalAmount'];

    //PREVENT UNAUTHORIZED ACCESS
    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
        exit();
    }

    //WHEN THE REQUEST IS CANCELED
    if (isset($_POST["cancel"])) {
        header("Locationdashboard.php");
    }

    //WHEN THE USER SUBMITS THE FORM
    if (isset($_POST["continue"])) {
        //Check the balance
        if ($balance>= $amount) {
            //check if the pin is 4 digits
            $pin = $_POST["pin"];
            if ($cardPin != $pin) {
                $errors["connection"]= "Invalid PIN, Contact Support";
            }else{
                //check if the pin matches
                $pin = $_POST["pin"];
                //create sql and save data
                $sql2 = "INSERT INTO transactions(type, status, amount, user_id) VALUES('withdrawal', 'pending', $amount, $id)";

                //SAVE TO DATABASE AND CHECK
                if (mysqli_query($conn, $sql2)) {
                    //success
                    header('Location: dashboard.php');
                }
            }
        }else{
            $errors["connection"] ="Insufficient Balance";
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
            }
            #body{
                margin-bottom: 30%;
                padding: 30px;
            }
            form{
                background-color: white;
                color: #444;
            }
            #receipt{
                padding: 25px;
                border-bottom: 1px solid #444;
                font-weight: bold;
            }
            #instruction{
                text-align: center;
                padding: 15px;
            }
            #input-div{
                padding: 20px 0px;
                text-align: center;
            }
            #input{
                width: 30%;
                padding: 10px;
                text-align: center;
                outline: none;
                border: 1px solid #444;
                border-radius: 5px;
            }
            #action{
                padding: 20px;
                display: flex;
                justify-content: space-between;
            }
            #continue{
                background-color: #444;
                color: white;
                width: 6rem;
                padding: 10px;
                outline: none;
                border: 1px solid #444;
                border-radius: 5px;
            }
            #cancel{
                width: 6rem;
                padding: 10px;
                outline: none;
                border: 1px solid rgb(255, 248, 255);
                border-radius: 5px;
                color: blueviolet;
                background-color: rgb(255, 248, 255);
                font-weight: 700;
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
                font-size: large;
                text-align: center;
                padding-top: 20px;
            }
            #img-div{
                text-align: center;
            }
            #img-div>img{
                width: 300px;
            }
        </style>
    </head>
    <body>
        <div id="body">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div id="receipt">Receipt#</div>
                <div id="img-div">
                    <img src="mastercard.png" alt="card">
                </div>
                <div class="errors"><?php echo $errors["connection"] ?></div>
                <div id="instruction">Enter your virtual card pin to complete transaction</div>
                <div id="input-div"><input type="password" name="pin" id="input" maxlength="4" required></div>
                <div id="action">
                    <input type="submit" value="Continue" id="continue" name="continue">
                    <a href="dasboard.php">
                        <input type="button" value="Cancel" id="cancel" name="cancel">
                    </a>
                </div>
            </form>
        </div>

        <footer>
            <p>Copyright © Spruce Rescind 2023. All Rights Reserved</p>
        </footer>
    </body>
</html>