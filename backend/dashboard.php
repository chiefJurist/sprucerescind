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

    //ERRORS ARRAY
    $errors = ["error"=>""];

    //FOR TRANSACTION HISTORY
    //writing query
    $sql = "SELECT * FROM transactions WHERE user_id = $id ORDER BY created_at DESC";

    //Get the query result
    $result = mysqli_query($conn, $sql);

    //Fetch the result in array format
    $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);



    //IF THE DEPOSIT BUTTON IS CLICKED
    if (isset($_POST["deposit"])) {
        header("Location: deposit.php");
    }

    //IF THE TRANSFER BUTTON IS CLICKED
    if (isset($_POST["transfer"])) {
        $recipientNumber = mysqli_real_escape_string($conn, $_POST["recipientnumber"]);
        $recipientAmount = mysqli_real_escape_string($conn, $_POST["recipientamount"]);

        if ($balance > $recipientAmount) {
            $errors["error"] = "Insufficient balance";
        }

        if (!array_filter($errors)) {
            //make query and insert data
            $sql2 = "INSERT INTO transactions(type, status, amount, user_id) VALUES('transfer','pending', '$recipientAmount', $id)";

            //check and redirect
            if (mysqli_query($conn, $sql2)) {
                //Save data to transfer table for more info
                $sql3 = "INSERT INTO transfer(amount, account, user_id) VALUES('$recipientAmount', '$recipientNumber', $id)";

                if ( mysqli_query($conn, $sql3)) {
                    //success
                    header('Location: dashboard.php');
                }
            }
        }
    }


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
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="//code.tidio.co/wkz2mp6tlkdssyyhfkf7hxvde5fxcxoi.js" async></script>
        <script>
            function menu() {
                var element = document.getElementById("menu");
                element.classList.remove("hide");
                element.classList.add("un-hide");
            }
            function unmenu() {
                var element = document.getElementById("menu");
                element.classList.remove("un-hide");
                element.classList.add("hide");
            }
            function depositPop() {
                var element = document.getElementById("deposit-pop");
                element.classList.remove("hide");
                element.classList.add("un-hide-2");
            }
            function unDepositPop() {
                var element = document.getElementById("deposit-pop");
                element.classList.remove("un-hide-2");
                element.classList.add("hide");
            }
            function withdrawPop() {
                var element = document.getElementById("withdraw-pop");
                element.classList.remove("hide");
                element.classList.add("un-hide-3");
            }
            function unWithdrawPop() {
                var element = document.getElementById("withdraw-pop");
                element.classList.remove("un-hide-3");
                element.classList.add("hide");
            }
            function transferPop() {
                var element = document.getElementById("transfer-pop");
                element.classList.remove("hide");
                element.classList.add("un-hide-4");
            }
            function unTransferPop() {
                var element = document.getElementById("transfer-pop");
                element.classList.remove("un-hide-4");
                element.classList.add("hide");
            }
            function hideBalance() {
                const element = document.getElementById("balanceH2");
                if (element.innerHTML != "*******") {
                    element.innerHTML = "*******" ;
                    element.classList.add('enlarge');
                }else{
                    element.innerHTML = "$<?php echo number_format($balance, 2) ?> USD";
                    element.classList.remove('enlarge');
                }
            }
            function hideBalance2() {
                const element = document.getElementById("balanceH22");
                if (element.innerHTML != "*******") {
                    element.innerHTML = "*******" ;
                    element.classList.add('enlarge');
                }else{
                    element.innerHTML = "$<?php echo number_format($balance, 2) ?> USD";
                    element.classList.remove('enlarge');
                }
            }
        </script>
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, Helvetica, sans-serif;
            }
            .enlarge{
                font-size: 3rem;
            }
            body{
                background-color: rgb(255, 248, 255);
                color: #444;
            }
            button{
                cursor: pointer;
                background-color: white;
                color: blueviolet;
                outline: none;
                border: none;
            }
            a{
                text-decoration: none;
                color: black;
            }
            header{
                background-color: white;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
            }
            #smart-remit{
                color: blueviolet;
                font-size: xx-large;
                font-weight: bold;
            }
            .purple{
                color: blueviolet;
            }
            .header-icon>button{
                font-size: xx-large;
            }
            #body{
                padding: 60px 20px;
                margin-bottom: 10%;
            }
            #control{
                background-color: white;
                padding: 25px;
                border-radius: 10px;
            }
            #bal-add{
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-bottom: 20px;
                border-bottom: 1px solid #444;
            }
            #add>button{
                font-size: xx-large;
                color: #444;
                background-color: rgb(255, 248, 255);
                padding: 15px;
                border-radius: 5px;
            }
            #activities{
                padding: 40px 20px;
                display: flex;
                justify-content: space-between;
            }
            .act{
                text-align: center;
            }
            .act>p{
                font-size: small;
                font-weight: bold;
                padding-top: 5px;
            }
            #withdraw-btn{
                background-color: blueviolet;
                border-radius: 5px;
                padding: 10px;
                font-weight: 900;
            }
            #withdraw-btn-text{
                color: rgb(255, 248, 255);
                font-size: 2rem;
            }
            #send-btn{
                background-color: blueviolet;
                border-radius: 5px;
                padding: 10px;
                font-weight: 900;
            }
            #send-btn-text{
                color: rgb(255, 248, 255);
                font-size: 2rem;
            }
            #exchange-btn{
                background-color: blueviolet;
                border-radius: 5px;
                padding: 10px;
                font-weight: 900;
            }
            #exchange-btn-text{
                color: rgb(255, 248, 255);
                font-size: 2rem;
            }
            #body>h2{
                margin-top: 60px;
                margin-bottom: 20px;
            }
            #transactions{
                background-color: white;
                padding: 25px;
                border-radius: 10px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 10px;
            }
            #status{
                font-size: large;
            }
            #type{
                font-size: small;
            }
            #amount{
                font-weight: bold;
            }
            footer{
                background-color: white;
                width: 100%;
                height: 11%;
                padding: 15px 5px;
                top: 89%;
                position: fixed;
                text-align: center;
                font-weight: bold;
                font-size: small;
            }
            #foot-icons{
                display: flex;
                justify-content: space-around;
                align-items: center;
                padding: 6px;
            }
            .icon-bold{
                font-size: 1.5rem;
                color: black;
            }
            .icon-des{
                color: #444;
                font-weight: bold;
            }

            /*FOR THE MENU POP-UP*/
            #menu{
                width: 70%;
                height: 100%;
                position: fixed;
                color: black;
                background-color: white;
            }
            #menu-top-head{
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 10px;
            }
            #cancel-menu{
                text-align: end;
                padding: 10px;
            }
            #cancel-menu>button{
                font-size: x-large;
            }
            #user-name{
                color: #444;
                padding: 0px 10px;
            }
            #user-account-number{
                color: #444;
                padding: 0px 10px;
            }
            #menu-head{
                background-color: blueviolet;
                padding: 15px;
            }
            #menu-head>p{
                color: white;
            }
            #menu-head>h2{
                margin-top: 20px;
                margin-bottom: 25px;
            }
            #actions-cont{
                display: flex;
                align-items: center;
                justify-content: space-between;
                text-align: center;
            }
            .actions>button{
                border: none;
                outline: none;
                padding: 10px 12px;
                border-radius: 50%;
                font-weight: bold;
                color: white;
                background-color: rgb(190, 121, 255);
            }
            .actions>p{
                color: white;
                font-size: small;
                padding-top: 3px;
            }
            .menu-nav{
                display: flex;
                align-items: center;
                padding: 15px;
            }
            .menu-nav:hover{
                background-color: rgb(237, 221, 251);
            }
            .nav-icon{
                flex-basis: 20%;
            }
            .nav-text{
                flex-basis: 75%;
            }
            .nav-icon>button{
                border: none;
                outline: none;
                padding: 8px 10px;
                border-radius: 50%;
                color: white;
                background-color: blueviolet;
            }
            .un-hide{
                top: 0%;
            }
            .hide{
                top: 100%;
            }
            .icon-bold2{
                font-size: large;
            }

            /*FOR THE DEPOSIT POP-UP*/
            #deposit-pop{
                background-color: white;
                width: 100%;
                height: 60%;
                position: fixed;
                color: #444;
            }
            #cancel-deposit{
                text-align: end;
                font-size: x-large;
                cursor: pointer;
                color: blueviolet;
                padding: 10px 20px;
            }
            #deposit-form>p{
                font-size: large;
                text-align: center;
                border-bottom: 1px solid #444;
            }
            #coin-type{
                padding: 25px;
            }
            #dep-select{
                width: 100%;
                padding: 10px 0px;
                border: none;
                outline: none;
                border-bottom: 1px solid #444;
                font-size: large;
            }
            #coin-amount{
                padding: 0px 25px 25px;
            }
            #amount-input-div{
                width: 100%;
                padding: 10px 0px;
                border: none;
                outline: none;
                border-bottom: 1px solid #444;
                font-size: large;
            }
            #amount-input{
                border: none;
                outline: none;
                font-size: large;
            }
            #deposit-btn-div{
                padding: 15px 25px;
            }
            #deposit-btn{
                padding: 10px;
                width: 100%;
                border: none;
                outline: none;
                background-color: #444;
                color: white;
                border-radius: 5px;
                font-weight: bold;
            }
            .un-hide-2{
                top: 40%;
            }

            /*WITHDRAW POP-UP*/
            #withdraw-pop{
                background-color: white;
                width: 100%;
                height: 60%;
                position: fixed;
                color: #444;
                text-align: center;
            }
            #withdraw-cancel{
                text-align: end;
                padding: 20px;
                padding-bottom: 0;
            }
            #withdraw-cancel>button{
                font-size: x-large;
            }
            #with-pop-head{
                font-size: large;
                padding-bottom: 15px;
                border-bottom: 1px solid black;
            }
            .withdraw-type-div{
                margin-top: 20px;
            }
            .withdraw-type-btn{
                background-color: #444;
                color: white;
                padding: 15px;
                border-radius: 5px;
                width: 80%;
                font-weight: bold;
            }
            .un-hide-3{
                top: 50%;
            }

            /*TRANSFER POP-UP*/
            #transfer-pop{
                background-color: white;
                width: 100%;
                height: 60%;
                position: fixed;
                color: #444;
                text-align: center;
            }
            .un-hide-4{
                top: 40%;
            }
            #transfer-cancel{
                text-align: end;
                padding: 20px;
                padding-bottom: 0;
            }
            #transfer-cancel>button{
                font-size: x-large;
            }
            #trans-pop-head{
                font-size: large;
                padding-bottom: 15px;
                border-bottom: 1px solid black;
            }
            form{
                color: #444;
                padding: 20px;
            }
            .trans-con{
                padding-top: 20px;
                text-align: start;
                padding-left: 10%;
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
                width: 90%;
            }
            #trans-pop-submit{
                margin-top: 30px;
                text-align: center;
            }
            #trans-pop-submit-btn{
                padding: 10px;
                border-radius: 5px;
                background-color: #444;
                color: white;
            }
            .errors{
                color: red;
                font-size: small;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header onclick="unDepositPop(), unTransferPop(), unWithdrawPop()">
            <div class="header-icon"><button onclick="menu()">&#8801</button></div>
            <div class="header-icon" id="smart-remit">Spruce Rescind</div>
            <div class="header-icon"><button><a href="settings.php" class="purple"><ion-icon name="settings-outline"></ion-icon></a></button></div>
        </header>
        <section id="body" onclick="unmenu()">
            <div id="control">
                <div id="bal-add">
                    <div id="bal">
                        <p>Total Balance</p>
                        <h2 id="balanceH2" onclick="hideBalance()">$<?php echo number_format($balance, 2) ?> USD</h2>
                    </div>
                    <div id="add">
                        <button onclick="depositPop()"><ion-icon name="add-outline"></ion-icon></button>
                    </div>
                </div>
                <div id="activities">
                    <div class="act">
                        <button id="withdraw-btn" onclick="withdrawPop()"><ion-icon name="arrow-down-outline" id="withdraw-btn-text"></ion-icon></button>
                        <p>Withdraw</p>
                    </div>
                    <div class="act">
                        <button id="send-btn" onclick="transferPop()"><ion-icon name="arrow-forward-outline" id="send-btn-text"></ion-icon></button>
                        <p>Send</p>
                    </div>
                    <div class="act">
                        <button id="exchange-btn"><ion-icon name="arrow-up-outline" id="exchange-btn-text"></ion-icon></button>
                        <p>Exchange</p>
                    </div>
                </div>
            </div>
            <h2>Transactions</h2>
            <?php foreach ($transactions as $transaction) {?>
                <a href="details.php?id=<?php echo $transaction['id']?>">
                    <div id="transactions">
                            <div>
                                <span id="status"><?php echo $transaction["status"] ?></span><br>
                                <span id="type"><?php echo $transaction["type"] ?></span>
                            </div>
                            <div id="amount">$<?php echo $transaction["amount"] ?></div>
                    </div>
                </a>
            <?php }?>
        </section>
        <footer onclick="unmenu()">
            <div id="foot-icons">
                <div class="icons-div">
                    <button>
                        <a href="dashboard.php">
                            <ion-icon name="home-outline" class="icon-bold"></ion-icon>
                            <span class="icon-des">HOME</span>
                        </a>
                    </button>
                </div>
                <div class="icons-div">
                    <button onclick="depositPop()">
                        <ion-icon name="add-outline"class="icon-bold"></ion-icon><br>
                        <span class="icon-des">DEPOSIT</span>
                    </button>
                </div>
                <div class="icons-div">
                    <button onclick="withdrawPop()">
                        <ion-icon name="arrow-down-outline"class="icon-bold"></ion-icon>
                        <span class="icon-des">WITHDRAW</span>
                    </button>
                </div>
                <div class="icons-div">
                    <button onclick="transferPop()">
                        <ion-icon name="arrow-forward-outline"class="icon-bold"></ion-icon>
                        <span class="icon-des">TRANSFER</span>
                    </button>
                </div>
                <div class="icons-div">
                    <button>
                        <a href="settings.php">
                            <ion-icon name="settings-outline" class="icon-bold"></ion-icon>
                            <span class="icon-des">SETTINGS</span>
                        </a>
                    </button>
                </div>
            </div>
        </footer>


        <!--MENU POP-UP-->
        <div id="menu" class="hide">
           <div id="menu-top-head">
               <div class="menu-top-head-left">
                   <h4 id="user-name"><?php echo $name ?></h4>
                   <p id="user-account-number"><?php echo $accountNumber ?></p>
               </div>
               <div class="menu-top-head-right">
                    <p id="cancel-menu"><button onclick="unmenu()">X</button></p>
               </div>
           </div>
            <div id="menu-head">
                <p>Balance</p>
                <h2 id="balanceH22" onclick="hideBalance2()">$<?php echo number_format($balance, 2) ?></h2>
                <div id="actions-cont">
                    <div class="actions">
                        <button id="menu-dep-btn" onclick="depositPop(), unmenu()">+</button>
                        <p>Deposit</p>
                    </div>
                    <div class="actions">
                        <button id="menu-wit-btn" onclick="withdrawPop(), unmenu()">
                            <ion-icon name="arrow-down-outline"></ion-icon>
                        </button>
                        <p>Withdraw</p>
                    </div>
                    <div class="actions">
                        <button id="menu-trans-btn"onclick="transferPop(), unmenu()">
                            <ion-icon name="arrow-forward-outline"></ion-icon>
                        </button>
                        <p>Transfer</p>
                    </div>
                </div>
            </div>

            <div class="menu-nav" onclick="unmenu()">
                <div class="nav-icon">
                    <button>
                        <ion-icon name="home-outline" class="icon-bold2"></ion-icon>
                    </button>
                </div>
                <div class="nav-text">Overview</div>
            </div>
            <a href="accountStatement.php">
                <div class="menu-nav">
                    <div class="nav-icon">
                        <button>
                            <ion-icon name="apps-outline" class="icon-bold2"></ion-icon>
                        </button>
                    </div>
                    <div class="nav-text">Account Statement</div>
                </div>       
            </a>
            <a href="notification.php">
                <div class="menu-nav">
                    <div class="nav-icon">
                        <button>
                            <ion-icon name="notifications-outline" class="icon-bold2"></ion-icon>
                        </button>
                    </div>
                    <div class="nav-text">Notifications</div>
                </div>  
            </a>
            <a href="card.php">
                <div class="menu-nav">
                    <div class="nav-icon">
                        <button>
                            <ion-icon name="card-outline" class="icon-bold2"></ion-icon>
                        </button>
                    </div>
                    <div class="nav-text">My Card</div>
                </div>
            </a>
            <a href="settings.php">
                <div class="menu-nav">
                    <div class="nav-icon">
                        <button>
                            <ion-icon name="settings-outline" class="icon-bold2"></ion-icon>
                        </button>
                        </div>
                    <div class="nav-text">Settings</div>
                </div>
            </a>
        </div>

        <!--DEPOSIT POP-UP-->
        <div id="deposit-pop" class="hide">
            <div id="cancel-deposit" onclick="unDepositPop()">X</div>
            <form action="dashboard.php" id="deposit-form" method="post">
                <p>Add Fund</p>
                <div id="coin-type">
                    <p>From</p>
                    <select name="dep-select" id="dep-select">
                        <option value="">Crypto Bank Transfer (USDT)</option>
                        <option value="">Crypto Bank Transfer (BUSD)</option>
                    </select>
                </div>
                <div id="coin-amount">
                    <p>Enter Amount</p>
                    <div id="amount-input-div">
                        <span id="dollar">$</span>
                        <input type="text" required id="amount-input" name="amount">
                    </div>
                </div>
                <div id="deposit-btn-div">
                    <input type="submit" value="DEPOSIT" id="deposit-btn" name="deposit">
                </div>
            </form>
        </div>

        <!--WITHDRAW POP-UP-->
        <div id="withdraw-pop" class="hide">
            <p id="withdraw-cancel"><button  onclick="unWithdrawPop()">X</button></p>
            <p id="with-pop-head">Withdraw Money</p>
            <a href="bankWithdraw.php">
                <div class="withdraw-type-div">
                    <button class="withdraw-type-btn">BANK TRANSFER</button>
                </div>
            </a>
            <a href="bankWithdraw.php">
                <div class="withdraw-type-div">
                    <button class="withdraw-type-btn">BUSINESS TRANSFER</button>
                </div>
            </a>
            <a href="cryptoWithdraw.php">
                <div class="withdraw-type-div">
                    <button class="withdraw-type-btn">CRYPTO BANK TRANSFER</button>
                </div>
            </a>
        </div>

        <!--TRANSFER POP-UP-->
       <form action="dashboard.php" method="post">
            <div id="transfer-pop" class="hide">
                <p id="transfer-cancel"><button onclick="unTransferPop()">X</button></p>
                <p id="trans-pop-head">Transfer</p>
                <div class="trans-con">
                    <p class="sect-name">Enter account</p>
                    <p class="sect-p"><input type="number" placeholder="Recepients Account" name="recipientnumber"></p>
                </div>
                <div class="trans-con">
                    <p class="sect-name">Enter Amount</p>
                    <p class="sect-p">$<input type="number" placeholder="0.00" name="recipientamount"></p>
                </div>
                <div class="errors"><?php echo $errors["error"] ?></div>
                <div class="trans-con">
                    <p class="sect-name">Add a note</p>
                    <p class="sect-p"><input type="text" placeholder="Add a note or description"></p>
                </div>

                <div id="trans-pop-submit">
                    <input type="submit" value="TRANSFER" id="trans-pop-submit-btn" name="transfer">
                </div>
            </div>
       </form>
    </body>
</html>