<?php 
    //CONNECT TO DATABASE
    include("config/connect.php");

    //START SESSION
    session_start();

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

    //FOR TRANSACTION HISTORY
    //writing query
    $sql = "SELECT * FROM transactions WHERE user_id = $id";

    //Get the query result
    $result = mysqli_query($conn, $sql);

    //Fetch the result in array format
    $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free result from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);
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
                color: #444;
            }
            header{
                background-color: white;
                text-align: center;
                padding: 20px 0;
            }
            #body{
                padding: 30px;
                color: #444;
            }
            .statementContainer{
                background-color: white;
                padding: 20px;
                border-radius: 6px;
                margin-top: 5%;
                display: flex;
                justify-content: space-between;
            }
            #type{
                color: blueviolet;
            }
            #time{
                color: red;
            }
            #amount{
                font-weight: 600;
            }
            #status{
                color: green;
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
        </style>
    </head>
    <body>
        <header>
            <h2>Transactions</h2>
        </header>
        <div id="body">
            <?php foreach ($transactions as $transaction) {?>
                <div class="statementContainer">
                    <div>
                        <h3 id="type"><?php echo $transaction["type"] ?></h3><br>
                        <p id="time"><?php echo $transaction["created_at"] ?></p>
                    </div>
                    <div>
                        <p id="amount">$<?php echo $transaction["amount"] ?></p><br>
                        <p id="status"><?php echo $transaction["status"] ?></p>
                    </div>
                </div>
            <?php }?>
        </div>
        <footer>
            <p>Copyright © Spruce Rescind 2023. All Rights Reserved</p>
        </footer>
    </body>
</html>