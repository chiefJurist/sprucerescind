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
    $gender = $_SESSION['gender'];
    $dob = $_SESSION['dob'];
    $phone = $_SESSION['phone_number'];
    $nin = $_SESSION['nin'];

    //FOR LOGGING OUT
    if (isset($_POST["logout"])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }


    //FOR THE IMAGE UPLOAD
    $errors = "";
    $src = "";

    //If submitted
    if (isset($_POST["image"]) && isset($_FILES['camIcon']) && !empty($_FILES['camIcon']['name'])) {
        echo "<pre>" ;
        print_r($_FILES['camIcon']);
        echo "</pre>";
        
        $img_name = $_FILES['camIcon']['name'];
        $img_size = $_FILES['camIcon']['size'];
        $tmp_name = $_FILES['camIcon']['tmp_name'];
        $error = $_FILES['camIcon']['error'];

        if ($error === 0) {
            if ($img_size > 2000000) {
                $errors = "Sorry your file is too large";
            }else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true). "." .$img_ex_lc;
                    $img_upload_path = "uploads/".$new_img_name;

                    move_uploaded_file($tmp_name, $img_upload_path);

                    //Insert into database
                    $sql = "INSERT INTO images(image_url, user_id) VALUES('$new_img_name', $id)";
                    if (mysqli_query($conn, $sql)) {
                        # Success.
                        header("Location: dashboard.php");
                    }
                }else {
                    $errors = "You cannot upload image of this format";
                }
            }
        }else {
            $errors= "An unknown error occured";
        }
    }

    //Getting the image
    $sql = "SELECT * FROM images WHERE user_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $images = mysqli_fetch_assoc($result);
    
    $src = $images['image_url'];

    //free result from memory
    mysqli_free_result($result);

    //close connection and exit
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
            #edit-div button{
                color: white;
                background-color: blueviolet;
                border: none;
                outline: none;
                padding: 10px;
                font-size: large;
                border-radius: 5px;
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
            
            /*IMAGE PART */
            #img-pos{
                display: flex;
                justify-content: center;
                height: 30vh;
            }
            #img-div{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                border-radius: 50%;
                border: 2px solid blueviolet;
                width: 200px;
                height: 200px;
                background-color: rgb(255, 248, 255);
                overflow: hidden;
                margin-top: 30px;
            }
            #img-div>img{
                width: 200px;   
            }
            #cam-div{
                text-align: center;
            }
            /* Hide the default file input button */
            #camIcon {
            display: none;
            }
            /* Style the custom button */
            .custom-file-button {
            display: inline-block;
            border: none;
            cursor: pointer;
            margin-left: 150px;
            margin-top: -50px;
            background-color: rgb(255, 248, 255);
            }
            .camera{
                font-size: 3rem;
                color: blueviolet;
            }
            #image{
                background-color: blueviolet;
                color: white;
                border: none;
                outline: none;
                border-radius: 50%;
                padding: 20px 2px;
                font-weight: bold;
            }
            .errors{
                text-align: center;
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
            <div id="title"><h2>SETTINGS</h2></div>
            <div id="edit-div">
                <a href="editProfile.php">
                    <button>Edit Profile</button>
                </a>
            </div>
        </header>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data" id="cam-form">
           <div id="img-pos">
                <div id="img-div">
                    <img src="<?php echo'uploads/'.$src ?>" alt="">
                </div>
           </div>
           <div id="cam-div">
                <label for="camIcon" class="custom-file-button"><span><ion-icon name="camera-outline" class="camera"></ion-icon></span></label>
                <input type="file" name="camIcon" id="camIcon">
                <input type="submit" value="UPDATE" name="image" id="image">
                <div class="errors"><?php echo $errors ?></div>
           </div>
        </form>

        <div id="body">
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
                <p id="nin">
                    <span class="subject">National Identification Number: </span><br> <?php echo $nin?>
                </p>
                <p id="gender">
                    <span class="subject">Gender: </span><br> <?php echo $gender?>
                </p>
                <p id="dob">
                    <span class="subject">Date of Birth: </span><br> <?php echo $dob?>
                </p>
                <p id="phone">
                    <span class="subject">Phone Number: </span><br> <?php echo $phone?>
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