<?php 
    //CONNECT TO DATABASE
    include("config/connect.php");

    //START SESSION
    session_start();

    //Setting Errors Array
    $errors = ["connection" => ""];

    //Store the data in a varible
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $country = $_SESSION['country'];
    $balance = $_SESSION['balance'];
    $accountNumber = $_SESSION['account_number'];
    $cardPin = $_SESSION['card_pin'];

    //PREVENT UNAUTHORIZED ACCESS
    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
        exit();
    }
 
    //WHEN THE  FORM IS SUBMITTED
    if (isset($_POST["submit"])) {
        //Escaping potential threats
        $amount = mysqli_real_escape_string($conn, $_POST["amount"]);
        $wallet = mysqli_real_escape_string($conn, $_POST["wallet"]);

        if ($balance>$amount) {
            //Creating Query and Inserting Data
            $sql = "INSERT INTO crypto_withdraw(amount, wallet_address, user_id) VALUES('$amount', '$wallet', $id)";

            //Save to database and redirect
            if (mysqli_query($conn, $sql)) {
                //success
                header('Location: confirmBankWithdraw.php');
            }else{
                //error
                $errors["connection"] = 'query error: ' .mysqli_error($conn);
            }
        }else{
            $errors["connection"] = "Insufficient Balance";
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
            body{
                background-color: rgb(255, 248, 255);
            }
            header{
                padding: 20px;
                background-color: white;
                text-align: center;
            }
            #body{
                padding: 10%;
            }
            form{
                background-color: white;
                color: #444;
                padding: 20px;
                border-radius: 5px;
            }
            .with-con{
                padding-top: 20px;
            }
            .sect-name{
                font-weight: bold;
            }
            input{
                font-size: large;
                border: none;
                outline: none;
                width: 85%;
            }
            .sect-p{
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
                font-size: large;
                padding-top: 10px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header>
            <h2>Crypto Withdraw</h2>
        </header>

        <div id="body">
            <form action="cryptoWithdraw.php" method="post">
                <div class="with-con">
                    <p class="sect-name">Amount</p>
                    <p class="sect-p">$<input type="number" placeholder="0.00" required name="amount"></p>
                </div>
                <div class="with-con">
                    <p class="sect-name">Wallet Address</p>
                    <p class="sect-p"><input type="text" placeholder="ERC-20 or BEP-20 Address" required name="wallet"></p>
                </div>
                <div class="with-con">
                    <p class="sect-name">Add a Note</p>
                    <p class="sect-p"><input type="text" placeholder="Add a Note as Description" required name="description"></p>
                </div>

                <div id="submit">
                    <input type="submit" value="NEXT" id="submit-btn" name="submit">
                </div>
                <div class="errors"><?php echo $errors["connection"] ?></div>
            </form>
        </div>

        <footer>
            <p>Copyright © Smart-remit 2023. All Rights Reserved</p>
        </footer>
    </body>
</html>