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

    //IF FORM HAS BEEN SUBMITTED
    if (isset($_POST["activate"])) {

        //Check if the pin is standard
        $pin = $_POST["pin"];
        $pinLength = strlen($pin);

        if ($pinLength != 4 ) {
           $error = "Input four digit pin";
        }

        //escaping potential threats
        $pin = mysqli_real_escape_string($conn, $_POST["pin"]);

        //creating query and insert into the database
        $sql = "INSERT INTO card(submitted_pin, user_id) VALUES($pin, $id)";

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
            body{
                background-color: rgb(255, 248, 255);
                color: #444;
            }
            header{
                background-color: white;
                padding: 30px 10px;
                text-align: center;
            }
            #body{
                padding: 10%;
                margin-bottom: 15%;
            }
            form{
                padding: 20px;
                background-color: white;
                color: #444;
                border-radius: 5px;
            }
            #dep-alert{
                background-color: green;
                padding: 20px 10px;
                color: white;
                text-align: center;
                border-radius: 10px;
                font-size: small;
            }
            .card-con{
                padding-top: 30px;
            }
            .sect-name{
                font-weight: bold;
                padding-bottom: 10px;
            }
            input, select{
                font-size: large;
                border: none;
                outline: none;
                width: 95%;
                color: #444;
            }
            .sect-p{
                padding-bottom: 5px;
                border-bottom: 1px solid #444;
            }
            #submit{
                margin-top: 50px;
                text-align: center;
            }
            #submit-btn{
                padding: 10px;
                border-radius: 5px;
                background-color: #444;
                color: white;
                border: none;
                outline: none;
                width: 50%;
            }
            .direction{
                background-color: blueviolet;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                color: white;
                margin-top: 5%;
            }
            #address{
                padding: 10px 0px;
                border: none;
                outline: none;
                border: 1px solid #444;
                border-radius: 5px;
                font-size: xx-small;
                text-align: center;
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
        <header>
            <h3>Get Online Virtual Dollar Card</h3>
        </header>

        <div id="body">
            <form action="card.php" method="post">
                <div id="dep-alert">
                    You are to send $5,000, once payment has been made, card purchase order will be proccessed.
                    Once completed, you will receive your card information in the settings dashboard
                </div>
                <div class="card-con">
                    <p class="sect-name">Amount</p>
                    <p class="sect-p" id="input">$ 5,000</p>
                </div>

                <div class="card-con">
                    <p id="address">0xa785FA5B1Bb83209fd4Dfd79CEf3595c82ce4a56</p>
                </div>

                <div class="card-con">
                    <p class="sect-name">New Card PIN</p>
                    <p class="sect-p"><input type="number" placeholder="Input Your Prefered 4 digit PIN" required name="pin"></p>
                </div>
                <div class="errors"><?php echo $errors["connection"] ?></div>

                <div class="card-con">
                    <p class="sect-name">Payment Option</p>
                    <p class="sect-p">
                        <select id="pay-options" required>
                            <option value="">select</option>
                            <option value="">CRYPTO BANK DEPOSIT</option>
                        </select>
                    </p>
                </div>

                <div id="submit">
                    <input type="submit" value="ACTIVATE" id="submit-btn" name="activate">
                </div>
            </form>

            <div class="direction">Go to settings to view pin if you have one</div>
        </div>

        <footer>
            <p>Copyright © Smart-remit 2023. All Rights Reserved</p>
        </footer>
    </body>
</html>