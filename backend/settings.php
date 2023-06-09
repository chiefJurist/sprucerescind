<?php 
    //CONNECT TO DATABASE
    include("config/connect.php");

    //START SESSION
    session_start();

    //PREVENT UNAUTHORIZED ACCESS
    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
        exit();
    }
    
    //Store the data in a varible
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $country = $_SESSION['country'];
    $balance = $_SESSION['balance'];
    $accountNumber = $_SESSION['account_number'];
    $cardPin = $_SESSION['card_pin'];

    //FOR LOGGING OUT
    if (isset($_POST["logout"])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Spruce Rescind</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
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
                font-family: Arial, Helvetica, sans-serif;
            }
            /*HEADER*/
            header{
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 25px;
                background-color: white;
                color: #444;
            }
            a{
                color: blueviolet;
                cursor: pointer;
                text-decoration: none;
                font-size: large;
                font-weight: 900;
            }
            #notification>button{
                background-color: white;
                color: blueviolet;
                cursor: pointer;
                padding: 10px;
                border: none;
                outline: none;
            }
            /*BODY*/
            #body{
                padding: 10%;
                margin-bottom: 5rem;
            }
            #user-info{
                background-color: white;
                color: #444;
                padding: 20px;
                border-radius: 10px;
            }
            .subject{
                font-size: small;
            }
            #user-info>h3, #user-info>p{
                padding: 10px;
                border-bottom: 1px solid #444;
            }
            #password-change, #pin-change, #email-change{
                text-align: center;
                margin-bottom: 2rem;
            }
            #password-change>button, #pin-change>button, #email-change>button{
                border: none;
                outline: none;
                border-radius: 5px;
                padding: 10px 20px;
                background-color: blueviolet;
                min-width: 50%;
            }
            #password-change>button>a, #pin-change>button>a, #email-change>button>a{
                font-size: medium;
                font-weight: 500;
                color: white;
            }
            #logout{
                text-align: center;
                margin-top: 5% 0%;
            }
            #logout>button{
                padding: 10px;
                background-color: blueviolet;
                color: rgb(255, 248, 255);
                border: none;
                outline: none;
                border-radius: 5px;
                width: 50%;
            }
            #sec-part{
                background-color: white;
                padding: 40px 0px;
                margin-top: 10%;
                border-radius: 10px;
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
            .expand{
                font-size: 2rem;
            }
        </style>
    </head>
    <body>
        <header>
            <div id="back">
                <p>
                    <a href="dashboard.php">
                        <ion-icon name="arrow-back-outline" class="expand"></ion-icon>
                    </a>
                </p>
            </div>
            <div id="title"><h2>SETTINGS</h2></div>
            <div id="notification">
                <button>
                    <a href="notification.php">
                        <ion-icon name="notifications-outline" class="expand"></ion-icon>
                    </a>
                </button>
            </div>
        </header>

        <div id="body">
            <div id="user-icon"></div>
            <div id="user-info">
                <h3 id="user-name">
                    <span class="subject">User Name: </span><br> <?php echo $name?>
                </h3>
                <p id="user-email">
                    <span class="subject">Email Address: </span><br> <?php echo $email?>
                </p>
                <p id="account-number">
                    <span class="subject">Account Number: </span><br> <?php echo $accountNumber?>
                </p>
                <p id="user-address">
                    <span class="subject">Country of Origin:</span><br> <?php echo $country?>
                </p>
                <p id="card-pin">
                    <span class="subject">Card Pin: </span><br> <?php echo $cardPin?>
                </p>
            </div>

            <form action="settings.php" method="post">
                <div id="sec-part">
                    <div id="password-change">
                        <button><a href="password.php">Change Password</a></button>
                    </div>
                    <div id="email-change">
                        <button><a href="email.php">Change Email</a></button>
                    </div>
                    <div id="pin-change">
                        <button><a href="card.php">Purchase Card</a></button>
                    </div>
                    <div id="logout">
                        <button name="logout">LOG OUT</button>
                    </div>
                </div>
            </form>
        </div>       

        <footer>
            <p>Copyright © Spruce Rescind 2023. All Rights Reserved</p>
        </footer>
    </body>
</html>