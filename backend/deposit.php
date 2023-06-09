<?php 
    //CONNECT TO DATABASE
    include("config/connect.php");

    //START SESSION
    session_start();

    //Setting Errors Array
    $errors = ["connection" => ""];

    //Store the data in a varible
    $id = $_SESSION['id'];

    //PREVENT UNAUTHORIZED ACCESS
    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
        exit();
    }

    //IF THE FORM HAS BEEN SUBMITTED
    if (isset($_POST["submit"])) {
        //Escaping potential threats
        $amount = mysqli_real_escape_string($conn, $_POST["amount"]);

        //Creating Query and inserting data
        $sql = "INSERT INTO transactions(type, status, amount, user_id) VALUES('deposit', 'pending', $amount, $id)";

        //Save to database and redirect
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: dashboard.php');
        }else{
            //error
            $errors["connection"] = 'query error: ' .mysqli_error($conn);
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>smart-remit</title>
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
            #confirm-deposit{
                background-color: rgb(255, 234, 255);
                padding: 200px 20px;
                width: 100%;
                height: 100%;
                position: fixed;
            }
            form{
                background-color: white;
                padding: 40px 20px;
                border-radius: 5px;
                text-align: center;
            }
            #dep-alert{
                background-color: green;
                color: white;
                border-radius: 5px;
                padding: 10px 10px;
                text-align: center;
            }
            #add-info{
                color: #444;
                padding: 20px 0px;
                text-align: center;
            }
            #address{
                padding: 10px 0px;
                border: none;
                outline: none;
                border: 1px solid #444;
                border-radius: 5px;
                font-size: x-small;
            }
            .amount{
                margin-top: 10px;
                font-size: large;
                padding: 5px;
                text-align: start;
                border-bottom: 1px solid #444;
            }
            #amount-input{
                border: none;
                outline: none;
                font-size: large;
            }
            #confirm-btn{
                margin-top: 60px;
                padding: 10px;
                color: white;
                background-color: #444;
                font-weight: 700;
                width: 80%;
                border: none;
                outline: none;
                border-radius: 5px;
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
            }
        </style>
    </head>
    <body>
        <div id="confirm-deposit">
            <form action="deposit.php" method="post">
                <div id="dep-alert">Copy Your BEP20/ ERC 2O Wallet address below</div>
                <div id="add-info">Wallet Address (ERC20 / BEP20)</div>
                <p id="address">0xa785FA5B1Bb83209fd4Dfd79CEf3595c82ce4a56</p>
                <p class="amount">
                    $<input type="number" name="amount" id="amount-input" placeholder="0.00" required>
                </p>
                <input type="submit" value="Confirm" id="confirm-btn" name="submit">
                <div class="errors"><?php echo $errors["connection"] ?></div>
            </form>
        </div>
        <footer>
            <p>Copyright © Smart-remit 2023. All Rights Reserved</p>
        </footer>
    </body>
</html>