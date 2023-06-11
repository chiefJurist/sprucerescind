<?php 
    //CONNECT TO DATABASE
    include("config/connect.php");

    //START SESSION
    session_start();
    
    //CHECK GET REQUEST ID PARAMETER
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //MAKE SQL
        $sql = "SELECT * FROM transactions WHERE id = $id";

        //GET THE QUERY RESULT
        $result = mysqli_query($conn, $sql);

        //FETCH THE RESULT IN ARRAY FORMAT
        $transaction = mysqli_fetch_assoc($result);

        //free result from memory
        mysqli_free_result($result);

        //close connection
        mysqli_close($conn);
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
                width: 100%;
                height: 100%;
                color: #444;
            }

            /*Header*/
            header{
                display: flex;
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
            .expand{
                font-size: 2rem;
            }
            #back{
                flex-basis: 10%;
            }
            #title{
                flex-basis: 90%;
                text-align: center;
                margin-right: 5%;
            }

            /*Body div*/
            #logo-div{
                text-align: center;
                margin: 5% 0;
            }
            #logo-div>p{
                font-size: x-large;
            }
            .expand2{
                font-size: 3rem;
                color: blueviolet;
            }
            #body{
                padding: 0 10%;
                margin-bottom: 7rem;
            }
            form{
                background-color: white;
                padding: 40px 15px;
                border-radius: 10px;
            }
            .gen-con{
                padding-top: 20px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-bottom: 1px solid #444;
                font-size: small;
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
                font-weight: bolder;
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
            /*Transaction Status*/
            .green{
                color: green;
            }
            .yellow{
                color: rgb(170, 170, 0);
            }
            .red{
                color: red;
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
            <div id="title"><h2>Transaction Details</h2></div>
        </header>

        <div id="body">
            <div id="logo-div">
                <ion-icon name="arrow-forward-circle-outline"  class="expand2"></ion-icon>
                <p><?php echo htmlspecialchars(strtolower($transaction['type']) . ' ' . strtolower($transaction['status'])); ?></p>
            </div>

            <form action="editProfile.php" method="post">
                <div class="gen-con">
                    <p class="sect-name">Type</p>
                    <p class="input-p"><?php echo htmlspecialchars(strtoupper($transaction['type'])); ?></p>
                </div>

                <div class="gen-con">
                    <p class="sect-name">Status</p>
                    <p class="input-p" id="status"><?php echo htmlspecialchars(strtolower($transaction['status'])); ?></p>
                </div>

                <div class="gen-con">
                    <p class="sect-name">Time</p>
                    <p class="input-p"><?php echo htmlspecialchars(strtoupper($transaction['created_at'])); ?></p>
                </div>

                <div class="gen-con">
                    <p class="sect-name">Amount</p>
                    <p class="input-p">$<?php echo htmlspecialchars(strtoupper($transaction['amount'])); ?></p>
                </div>
            </form>
            <script>
                const element = document.getElementById("status");
                if (element.innerHTML == "pending") {
                    element.classList.add("yellow");
                }else if (element.innerHTML == "success") {
                    element.classList.remove("yellow");
                    element.classList.add("green");
                }else if (element.innerHTML == "failed") {
                    element.classList.remove("yellow");
                    element.classList.add("red");
                }
            </script>
        </div>

        <footer>
            <p>Copyright © Spruce Rescind 2023. All Rights Reserved</p>
        </footer>
    </body>
</html>