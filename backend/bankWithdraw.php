Spruce Rescind<?php 
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
        $bankName = mysqli_real_escape_string($conn, $_POST["bankname"]);
        $accountNumber = mysqli_real_escape_string($conn, $_POST["accountnumber"]);
        $swift = mysqli_real_escape_string($conn, $_POST["swift"]);
        $iban = mysqli_real_escape_string($conn, $_POST["iban"]);
        $description = mysqli_real_escape_string($conn, $_POST["description"]);

        if ($balance>=$amount) {
            //Creating Query and Inserting Data
            $sql = "INSERT INTO bank_withdraw(amount, bank_name, account_number, swift, iban, description, user_id) VALUES('$amount', '$bankName', '$accountNumber', '$swift', '$iban', '$description', $id)";

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
            header{
                background-color: white;
                padding: 20px;
                text-align: center;
                color: #444;
            }
            #form-container{
                padding: 10%;
                margin-bottom: 10%;
            }
            form{
                background-color: white;
                color: #444;
                padding: 20px;
                border-radius: 5px;
                margin-bottom: 10%;
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
                width: 80%;
            }
            #amnt-p, #bank-p, #acnt-p, #swift-p, #iban-p, #note-p{
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
                text-align: center;
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        <header>
            <h2>BANK TRANSFER</h2>
        </header>
        <div id="form-container">
            <form action="bankWithdraw.php" method="post">
                <div class="errors"><?php echo $errors["connection"] ?></div>
                <div class="with-con">
                    <p class="sect-name">Amount</p>
                    <p id="amnt-p">$<input type="number" placeholder="0.00" required name="amount"></p>
                </div>
                <div class="with-con">
                    <p class="sect-name">Bank Name</p>
                    <p id="bank-p"><input type="text" placeholder="Enter Bank Name" required name="bankname"></p>
                </div>
                <div class="with-con">
                    <p class="sect-name">Account number</p>
                    <p id="acnt-p"><input type="number" placeholder="Account Number" required name="accountnumber"></p>
                </div>
                <div class="with-con">
                    <p class="sect-name">SWIFT CODE</p>
                    <p id="swift-p"><input type="text" placeholder="Input Swift Code" required name="swift"></p>
                </div>
                <div class="with-con">
                    <p class="sect-name">IBAN</p>
                    <p id="iban-p"><input type="text" placeholder="Iban" required name="iban"></p>
                </div>
                <div class="with-con">
                    <p class="sect-name">Add a note</p>
                    <p id="note-p"><input type="text" placeholder="add a note as description" required name="description"></p>
                </div>
    
                <div id="submit">
                    <input type="submit" value="NEXT" id="submit-btn" name="submit">
                </div>
            </form>
        </div>
        <footer>
            <p>Copyright © Spruce Rescind 2023. All Rights Reserved</p>
        </footer>
    </body>
</html>