<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="//code.tidio.co/wkz2mp6tlkdssyyhfkf7hxvde5fxcxoi.js" async></script>
        <title>smart-remit</title>
        <link rel="shortcut icon" href="img/web-logo.png">
        <meta name="description" content="Our goal is to help our companies and user's maintain and achieve best position team work occurings">
        <meta name="keywords" content="banks, dollar, naira, paypal">
        <style>
            /*GENERAL*/
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: sans-serif;
            }

            /*HEADER*/
            #smart-remit-logo{
                width: 40px;
                height: 40px;
                background-color: green;
                color: green;
                transform: rotate(50deg);
                border-radius: 3px;
                border: 3px outset rgb(31, 192, 31);
                position: relative;
                z-index: 2;
            }
            #smart-remit-logo2{
                width: 40px;
                height: 40px;
                background-color: greenyellow;
                color: greenyellow;
                transform: rotate(50deg);
                border-radius: 3px;
                border: 3px outset rgb(196, 255, 106);
                position: relative;
                z-index: 1;
                margin-top: -16px;
            }

            #header{
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
                width: 100%;
                border-bottom: 1px solid grey;
                background-color: grey;
                position: fixed;
            }

            #company-name{
                color: green;
                font-size: xx-large;
                font-weight: bolder;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            #menu-icon-btn{
                color: green;
                font-size: 3rem;
                background-color: grey;
                outline: none;
                border: none;
                text-decoration: none;
            }
            #menu{
                display: flex;
                justify-content: space-between;
                color: white;
                flex-basis: 70%;
                font-size: small;
            }
            .menu-nav > a{
                text-decoration: none;
                color: white;
            }
            .menu-nav > a:hover{
               color: blueviolet;
            }
            .menu-nav{
                cursor: pointer;
            }

            /*HOME*/
            #home{
                padding-top: 250px;
                padding-bottom: 150px;
                background-color: #444;
                color: white;
                text-align: center;
                font-size: xx-large;
                display: flex;
                justify-content: space-around;
                align-items: center;
                width: 100%;
            }
            #home-template{
                flex-basis: 70%;
            }
            #gt-div, #lt-div{
                flex-basis: 10%;
            }
            #details-top{
                padding-top: 30px;
            }
            #services{
                margin-top: 50px;
                background-color: white;
                padding: 20px;
                font-size: medium;
                font-weight: bold;
                border-radius: 5px;
                border: none;
                padding: none;
            }
            #services:hover{
                background-color: aquamarine;
            }
            #serv-link{
                text-decoration: none;
                color: #444;
            }

            #lt-btn, #gt-btn{
                background-color: blueviolet;
                font-size: 4rem;
                border: none;
                outline: none;
                padding: 15px;
                color: grey;
                cursor: pointer;
                border-radius: 10px;
            }
            #lt-btn:hover, #gt-btn:hover{
                background-color: greenyellow;
            }
            #lt-btn:active, #gt-btn:active{
                background-color: green;
            }

            /*ABOUT BANK OPTIONS*/
            #about{
                width: 100%;
                text-align: center;
            }
            #bank-options{
                background-color: rgb(212, 212, 212);
                padding: 7rem .1rem;
            }
            #bank-options>h1{
                color: grey;
                font-size: xx-large;
            }
            #bank-options>p{
                color: grey;
                padding-top: 10px;
            }
            #options {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                grid-row-gap: 3rem;
                grid-column-gap: 2rem;
                margin-top: 2rem;
            }
            #options .box {
                background-color: #eee;
                border: 5px solid #eee;
                border-radius: 3px;
            }
            #options .box:hover{
                background-color: greenyellow;
            }
            #options .box a {
                display: inline-block;
                cursor: pointer;
                text-decoration: none;
            }
            #options .box a p {
                padding: 1.5rem;
                font-size: 1.4rem;
                font-weight: 700;
                text-align: center;
                color: grey;
            }
            .code {
                color: #eee;
                transition: .5s all ease;
                font-size: 1.6rem;
            }
            #options .box:hover .code {
                color: green;
            }
            .small{
                font-size: medium;
            }
            .btn {
                text-decoration: none;
                font-weight: bold;
                color: grey;
                margin-top: 4rem;
                text-align: center;
                display: inline-block;
                padding: .6rem 1.5rem;
                border-radius: 3px;
                background-color: white;
                transition: all .5s ease-in-out;
            }
            
            .btn:hover {
                background-color: greenyellow;
            }


            /*ABOUT BENEFITS*/
            #benefits{
                background-color: whitesmoke;
                width: 100%;
                padding: 70px;
            }
            #benefits>h1{
                color: #444;
                font-size: 3rem;
            }
            #benefits>p{
                color: #444;
                margin-top: 30px;
                font-size: x-large;
                margin-bottom: 30px;
            }
            #ben-container{
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
            }
            .up{
                border-top: 2px solid green;
            }
            .left{
                border-left: 2px solid green;
            }
            .right{
                border-right: 2px solid green;
            }
            .ben-img{
                width: 70px;
                margin-top: 25px;
            }
            .ben-head{
                color: grey;
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                padding-top: 20px;
                padding-bottom: 20px;
            }
            .ben-det{
                color: grey;
                padding-bottom: 25px;
            }
            .ben-div{
                flex-basis: 30%;
            }



            /*ABOUT REQUESTS*/
            #requests{
                padding: 100px 50px;
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
            }
            #left-req{
                width: 100%;
                flex-basis: 40%;
            }
            #right-req{
                width: 100%;
                flex-basis: 50%;
            }
            .req-container-1, .req-container-2{
                display: flex;
                justify-content: space-between;
            }
            .req-div{
                flex-basis: 45%;
                width: 100%;
                text-align: start;
            }
            #right-req>h2{
                font-size: 3rem;
                font-family: 'Trebuchet MS';
                color: #444;
            }
            #right-req>p{
                font-size: x-large;
                font-family: 'Trebuchet MS';
                color: #444;
                padding-top: 40px;
                padding-bottom: 40px;
            }
            .req-icon{
                font-size: 3rem;
                color: green;
            }
            .req-det{
                font-size: large;
                font-weight: bold;
                padding-bottom: 25px;
            }
            .arr{
                transition: .5s all ease;
                font-size: 1.6rem;
                color: white;
                font-family: 'Trebuchet MS';
                font-weight: 900;
            }
            .req-div:hover .arr{
                color: green;
            }
            #req-img{
                width: 550px;
            }
            #req-faqs{
                background-color: #444;
                color: white;
                border: none;
                outline: none;
                font-size: large;
                padding: 14px 7px;
            }
            #req-faqs:hover{
                background-color: green;
                color: greenyellow;
                padding: 19px 11px;
            }



            /*CARD*/
            #card-img{
                width: 100%;
            }
            #card{
                display: flex;
                justify-content: space-between;
                padding: 70px 50px;
                background-color: whitesmoke;
            }
            #card-img-div{
                flex-basis: 45%;
            }
            #card-container{
                flex-basis: 50%;
                text-align: left;
            }
            #card-head{
                font-size: 3rem;
                color: #444;
                font-family: Arial, Helvetica, sans-serif;
            }
            #card-det{
                font-size: large;
                color: #444;
                font-family: Arial, Helvetica, sans-serif;
                padding-top: 30px;
            }
            #card-container>h3{
                padding-top: 55px;
                padding-bottom: 20px;
            }
            #card-email{
                font-size: large;
                font-family: Arial, Helvetica, sans-serif;
                padding: 13px;
                border: 1px solid grey;
                outline: none;
                width: 400px;
                color: #444;
            }
            #card-apply{
                font-size: large;
                font-family: Arial, Helvetica, sans-serif;
                padding: 13px;
                border: none;
                outline: none;
                background-color: white;
                color: gray;
                cursor: pointer;
            }
            #card-apply:hover{
                background-color: greenyellow;
                padding: 15px;
                transition: transform .5s;
                transform: translateX(-8px);
            }


            /*NEWS*/
            #news{
                background-color: rgb(212, 212, 212);
                padding: 70px 50px;
            }
            #news-title-container{
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            #news-title{
                flex-basis: 50%;
                text-align: left;
            }
            #more-news{
                flex-basis: 45%;
                text-align: right;
            }
            #news-header{
                color: #444;
                font-size: 3rem;
                font-family: Arial, Helvetica, sans-serif;
            }
            #news-det{
                color: #444;
                font-size: large;
                font-family: Arial, Helvetica, sans-serif;
                padding-top: 20px;
            }
            #more-news-btn{
                padding: 20px 30px;
                color: white;
                background-color: #444;
                font-family: Arial, Helvetica, sans-serif;
                font-size: large;
                border: none;
                outline: none;
                border-radius: 4px;
                cursor: pointer;
            }
            #more-news-btn:hover{
                background-color: greenyellow;
                color: green;
                transform: translateY(-8px);
            }
            #news-container{
                padding-top: 25px;
                display: flex;
                justify-content: space-between;
            }
            .main-news{
                flex-basis: auto;
            }
            .main-news:hover{
                opacity: 0.5;
                transform: translateY(15px);
            }
            .news-img{
                width: 100%;
                cursor: pointer;
            }
            .complete-news{
                background-color: white;
                width: 100%;
                margin-top: -10px;
                padding: 20px;
                text-align: start;
                color: #444;
                font-family: Arial, Helvetica, sans-serif;
            }
            .complete-news>h2{
                cursor: pointer;
            }
            .expand{
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 10px;
            }
            .green{
                color: green;
            }
            .read-more, .news-time, .news-comment{
                font-weight: 700;
                color: rgb(154, 154, 154);
                cursor: pointer;
            }


            /*GET IN TOUCH*/
            #contact{
                padding: 100px 70px;
                background-color: whitesmoke;
                font-family: Arial, Helvetica, sans-serif;
                color: #444;
            }
            #contact>form{
                background-color: white;
                display: flex;
                justify-content: space-between;
                padding: 50px 50px;
            }
            .contact-container{
                display: flex;
                align-items: center;
                margin-bottom: 80px;
            }
            .con-icon{
                margin-right: 10px;
                font-size: xx-large;
            }
            .message-input{
                border: 1px solid grey;
                outline: none;
                padding: 15px 5px;
                width: 400px;
            }
            .message-det{
                margin-bottom: 20px;
            }
            #customer-message>button{
                padding: 10px 20px;
                background-color: #444;
                border: none;
                outline: none;
                border-radius: 5px;
            }
            #customer-message>button>a{
                text-decoration: none;
                color: white;
            }


            /*FOOTER*/
            footer{
                display: flex;
                justify-content: space-between;
                padding: 30px 10px;
                align-items: center;
                background-color: rgb(160, 158, 158);
            }
            #footer-left{
                flex-basis: 60%;
                display: flex;
                justify-content: space-around;
                width: 100%;
            }
            #footer-right{
                flex-basis: 20%;
            }
            .footer-logo{
                margin-right: 20px;
                font-size: x-large;
            }




            /*SMART PHONES*/
            @media (max-width: 600px){

                /*HEADER*/
                #smart-remit-logo{
                    width: 30px;
                    height: 30px;
                }
                #smart-remit-logo2{
                    width: 30px;
                    height: 30px;
                }
                #menu{
                    display: flex;
                    justify-content: space-between;
                    color: white;
                    flex-basis: 80%;
                    font-size: xx-small;
                }
                .menu-nav{
                    cursor: pointer;
                }
                .menu-nav > a:hover{
                    color: blueviolet;
                }


                /*HOME*/
                #home-template>h1{
                    font-size: x-large;
                }
                #home-template>p{
                    font-size: medium;
                }
                #lt-btn, #gt-btn{
                    font-size: large;
                    padding: 5px 10px;
                }
                


                /*ABOUT OPTIONS*/
                #about #options {
                    grid-template-columns: repeat(1, 1fr);
                }

                /*ABOUT BENEFITS*/
                #ben-container{
                    display: flow-root;
                    align-items: center;
                    justify-content: center;
                    padding-left: 10px;
                    padding-right: 10px;
                }
                .up, .right, .left{
                    border: none;
                }
                #benefits>h1{
                    color: #444;
                    font-size:x-large;
                }

                /*ABOUT REQUESTS*/
                #requests{
                    padding: 100px 10px;
                    display: flow-root;
                    padding: 50px 20px;
                }
                #req-img{
                    width: 100%                                         ;
                }
                #right-req>h2{
                    font-size: x-large;
                    padding-top: 30px;
                    text-align: start;
                }
                #right-req>p{
                    font-size: medium;
                    text-align: left;
                }
                .req-det{
                    font-size: x-small;
                }

                /*CARDS*/
                #card{
                    display: flow-root;
                    padding: 50px 10px;
                    text-align: start;
                    width: 100%;
                }
                #card-email{
                    width: 200px;
                }
                #card-img{
                    width: 90%;
                }
                #card-head{
                    font-size: 1.5rem;
                }
                #card-det{
                    font-size: medium;
                }

                /*NEWS*/
                #news{
                    padding: 70px 10px;
                }
                #news-title-container{
                    display: flow-root;
                }
                #news-header{
                    font-size: 2rem;
                }
                #more-news-btn{
                    padding: 10px 15px;
                    margin-top: 10px;
                }
                #news-container{
                    display: flow-root;
                }
                .main-news{
                    padding-top: 15px;
                }
                .complete-news>h2{
                    font-size: small;
                }
                .read-more, .news-time, .news-comment{
                    font-size: xx-small;
                    font-weight: 400;
                }
                /*GET IN TOUCH*/
                #contact{
                    padding: 100px 10px;
                }
                #contact>form{
                    background-color: white;
                    display: flow-root;
                }
                .contact-det>h2{
                    font-size: medium;
                }
                #contact>form{
                    padding: 50px 10px;
                }
                .message-input{
                    width: 97%;
                }

                /*FOOTER*/
                footer{
                    display: flow-root;
                    font-size: xx-small;
                    padding: 15px 10px;
                }
                #left-p{
                    flex-basis: 23%;
                }
                #footer-left{
                    padding-bottom: 20px;
                }
            }
        </style>
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </head>
    <body>
        <!--HEADER-->
        <header id="header">
            <div class="logo" id="logo">
                <div id="smart-remit-logo">a</div>
                <div id="smart-remit-logo2">a</div>
            </div>
            <nav id="menu">
                <div id="home-nav" class="menu-nav"><a href="#home">HOME</a></div>
                <div id="about-nav" class="menu-nav"><a href="#about">ABOUT</a></div>
                <div id="card-nav" class="menu-nav"><a href="#card">CARD</a></div>
                <div id="news-nav" class="menu-nav"><a href="#news">NEWS</a></div>
                <div id="contact-nav" class="menu-nav"><a href="#contact">CONTACT</a></div>
                <div id="login-nav" class="menu-nav"><a href="backend/login.php">LOGIN</a></div>
                <div id="register-nav" class="menu-nav"><a href="backend/register.php">REGISTER</a></div>
            </nav>
        </header>

        <!--HOME-->
        <section id="home">
            <div id="lt-div"><button id="lt-btn" @click="secondChange">&lt;</button></div>

            <div id="home-template">
                <h1>{{topic}}</h1>
                <h1>{{topic2}}</h1>
                <p id="details-top">{{details}}</p>
                <p id="details-bottom">{{details2}}</p>
                <button id="services"><a href="backend/register.php" target="_self" id="serv-link">{{button}}</a></button>
            </div>

            <div id="gt-div"><button id="gt-btn" @click="firstChange">&gt;</button></div>
        </section>
        <script>
            const app = Vue.createApp({
                data(){
                    return{
                        topic: "Convenient",
                        topic2: "Banking Options",
                        details: "On the other hand, we denounce with rigtheous indignation",
                        details2: "and dislike men who are so beguilded",
                        button: "Our Services",
                    }
                },
                methods: {
                    firstChange(){
                        if (this.topic == "Convenient") {
                            this.topic = "Make Yourself";
                            this.topic2 = "Richer and Smarter";
                            this.button = "Start Your Investment";
                        }else if (this.topic == "Make Yourself") {
                            this.topic = "Make A Pay";
                            this.topic2 = "Anyone And Anywhere";
                            this.button = "Make Payment";
                        }else{
                            this.topic = "Convenient";
                            this.topic2 = "Banking Options";
                            this.button = "Our Services";
                        }
                    },
                    secondChange(){
                        if (this.topic == "Make A Pay") {
                            this.topic = "Make Yourself";
                            this.topic2 = "Richer and Smarter";
                            this.button = "Start Your Investment";
                        }else if (this.topic == "Convenient") {
                            this.topic = "Make A Pay";
                            this.topic2 = "Anyone And Anywhere";
                            this.button = "Make Payment";
                        }else{
                            this.topic = "Convenient";
                            this.topic2 = "Banking Options";
                            this.button = "Our Services";
                        }
                    }
                }
            })
            app.mount('#home')
        </script>
        

        <!--ABOUT-->
        <section id="about">
            <!--about bank options-->
            <div id="bank-options">
                <h1>Let's Think Of Saving Money</h1>
                <p>Convenient banking options for you</p>
                <div id="options">
                    <div class="box">
                        <a target="_blank" href="backend/register.php" target="_self">
                          <img src="img/savings.jpg" alt="project-img" class="project-img">
                          <p class="background">
                            <span class="code">&lt;</span>
                            Savings Account
                            <span class="code">/&gt;</span><br><br>
                            <span class="small">Open account now and earn upto 8%</span>
                          </p>
                        </a>
                    </div>
                    <div class="box">
                        <a target="_blank" href="backend/register.php" target="_self">
                          <img src="img/current.jpg" alt="project-img" class="project-img">
                          <p class="background">
                            <span class="code">&lt;</span>
                            Current Account
                            <span class="code">/&gt;</span><br><br>
                            <span class="small">Open account now and earn upto 5%</span>
                          </p>
                        </a>
                    </div>
                    <div class="box">
                        <a target="_blank" href="backend/register.php" target="_self">
                          <img src="img/fixed deposit.jpg" alt="project-img" class="project-img">
                          <p class="background">
                            <span class="code">&lt;</span>
                            Fixed Deposit Account
                            <span class="code">/&gt;</span><br><br>
                            <span class="small">Open account now and earn upto 10%</span>
                          </p>
                        </a>
                    </div>
                </div>
                <a href="backend/register.php" target="_self" class="btn">Show More</a>
            </div>

            <!--about benefits-->
            <div id="benefits">
                <h1>Benefits For Account Holders</h1>
                <p>We help businesses and customers achieve more</p>
                <div id="ben-container">
                    <div class="ben-div">
                        <img src="img/ben1.png" alt="ben1" class="ben-img">
                        <h2 class="ben-head">Earn Interest up to 7%</h2>
                        <p class="ben-det">Holds these matters principles selection <br> right some rejects.</p>
                    </div>
                    <div class="ben-div left right">
                        <img src="img/ben2.png" alt="ben2" class="ben-img">
                        <h2 class="ben-head">Free Email Alerts</h2>
                        <p class="ben-det">Business will frequently occur that pleasure <br> have to be repudiated.</p>
                    </div>
                    <div class="ben-div">
                        <img src="img/ben3.png" alt="ben3" class="ben-img">
                        <h2 class="ben-head">Discounts on Locker</h2>
                        <p class="ben-det">The wise man therefore always holds these <br> principle of selection.</p>
                    </div>
                    <div class="ben-div up">
                        <img src="img/ben4.png" alt="ben4" class="ben-img">
                        <h2 class="ben-head">International Debit Cards</h2>
                        <p class="ben-det">The wise man therefore always holds these <br> principle of selection.</p>
                    </div>
                    <div class="ben-div up left right">
                        <img src="img/ben5.png" alt="ben5" class="ben-img">
                        <h2 class="ben-head">Provides Safety</h2>
                        <p class="ben-det">Holds these matters principles selection <br> right some rejects.

                        </p>
                    </div>
                    <div class="ben-div up">
                        <img src="img/ben6.png" alt="ben6" class="ben-img">
                        <h2 class="ben-head">Paperless Banking</h2>
                        <p class="ben-det">Business will frequently occur that pleasure <br> have to be repudiated.</p>
                    </div>
                </div>
            </div>

            <!--about requests-->
            <div id="requests">
                <div id="left-req">
                    <img src="img/request.jpg" alt="request" id="req-img">
                </div>
                <div id="right-req">
                    <h2>Online Emergency <br> Service Requests All In <br>One Place</h2>
                    <p>
                        Desire that they cannot foresee the pain & trouble that 
                        are bound too ensue <br> equal blame belongs through shrinking.
                    </p>
                    <div class="req-container-1">
                        <div class="req-div">
                            <div class="req-icon-div"><ion-icon name="card-outline" class="req-icon"></ion-icon></div>
                            <p class="req-det">
                                Credit & Debit Card Related
                                <span class="arr">&rarr;</span>
                            </p>
                        </div>
                        <div class="req-div">
                            <div class="req-icon-div"><ion-icon name="earth-outline" class="req-icon"></ion-icon></div>
                            <p class="req-det">
                                Online & Internet Banking
                                <span class="arr">&rarr;</span>
                            </p>
                        </div>
                    </div>
                    <div class="req-container-2">
                        <div class="req-div">
                            <div class="req-icon-div"><ion-icon name="wallet-outline" class="req-icon"></ion-icon></div>
                            <p class="req-det">
                                Account Details Change
                                <span class="arr">&rarr;</span>
                            </p>
                        </div>
                        <div class="req-div">
                            <div class="req-icon-div"><ion-icon name="cash-outline" class="req-icon"></ion-icon></div>
                            <p class="req-det">
                                Cheque Book / DD  Related
                                <span class="arr">&rarr;</span>
                            </p>
                        </div>
                    </div>
                    <button id="req-faqs">Customer FAQ's</button>
                </div>
            </div>
        </section>

        <!--CARD-->
        <section id="card">
            <div id="card-img-div"><img src="img/card.png" alt="card" id="card-img"></div>
            <div id="card-container">
                <h2 id="card-head">Personalize Your <br> Card And Stand Out <br>From Crowd</h2>
                <p id="card-det">
                    Desire that they cannot foresee the pain & trouble that are bound <br>
                    too ensue equal blame belongs through shrinking.
                </p>
                <h3>Apply For Credit Card</h3>
                <input type="email" name="card-email" id="card-email" placeholder="Email Address"><br><br>
                <input type="submit" value="APPLY NOW" id="card-apply">
            </div>
        </section>

        <!--NEWS-->
        <section id="news">
            <div id="news-title-container">
                <div id="news-title">
                    <h2 id="news-header">Latest From News Room</h2>
                    <p id="news-det">Our blog post provides you all the updates & guides.</p>
                </div>
                <div id="more-news">
                    <button id="more-news-btn">View All Posts</button>
                </div>
            </div>
            <div id="news-container">
                <div class="main-news">
                    <img src="img/news-1.jpg" alt="news1" class="news-img">
                    <div class="complete-news">
                        <h2>How Non-US Citizens Can Open <br> A Bank Account &rarrb;</h2>
                        <div class="expand">
                            <div class="read-more"><span class="green">&rarr;</span> Read More</div>
                            <div class="news-time">
                                <ion-icon name="time-outline" class="green"></ion-icon> 6 Mins Read
                            </div>
                            <div class="news-comment">
                                <ion-icon name="chatbox-ellipses-outline" class="green"></ion-icon> 10 Comments
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-news">
                    <img src="img/news-2.jpg" alt="news-2" class="news-img">
                    <div class="complete-news">
                        <h2>Board Approves Capital Raise Of <br> Rs. 2000 Crores &rarrb;</h2>
                        <div class="expand">
                            <div class="read-more"><span class="green">&rarr;</span> Read More</div>
                            <div class="news-time">
                                <ion-icon name="time-outline" class="green"></ion-icon> 6 Mins Read
                            </div>
                            <div class="news-comment">
                                <ion-icon name="chatbox-ellipses-outline" class="green"></ion-icon> 10 Comments
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--GET IN TOUCH-->
        <section id="contact">
            <form action="" method="post">
                <div id="diff-contacts">
                    <div class="contact-container">
                        <div class="contact-icon"><ion-icon name="location-outline" class="con-icon"></ion-icon></div>
                        <div class="contact-det">
                            <p>Corporate Office</p>
                            <h2>Austurgata 88, Höfn, The Republic of Iceland.</h2>
                        </div>
                    </div>
                    <div class="contact-container">
                        <div class="contact-icon"><ion-icon name="time-outline" class="con-icon"></ion-icon></div>
                        <div class="contact-det">
                            <p>Office Hours</p>
                            <h2>Mon-Fri: 24/7</h2>
                        </div>
                    </div>
                    <div class="contact-container">
                        <div class="contact-icon"><ion-icon name="call-outline" class="con-icon"></ion-icon></div>
                        <div class="contact-det">
                            <p>Front Desk</p>
                            <h2>451 9539<br>admin@smart-remit.com</h2>
                        </div>
                    </div>
                </div>

                <div id="message">
                    <div class="message-det">
                        NAME <br> <input type="text" placeholder="Your Name Please" class="message-input">
                    </div>
                    <div class="message-det">
                        EMAIL ADDRESS <br> <input type="email" name="email" class="message-input">
                    </div>
                    <div class="message-det">
                        PHONE NUMBER <br> <input type="text" class="message-input">
                    </div>
                    <div class="message-det">
                        SUBJECT <br><input type="text" placeholder="SUBJECT" class="message-input">
                    </div>
                    <div class="message-det">
                        MESSAGE <br> <textarea name="" id="" cols="30" rows="5" class="message-input"></textarea>
                        <div id="customer-message">
                            <button><a href="backend/register.php">SUBMIT</a></button>
                        </div>
                    </div>
                </div>
            </form>
        </section>


        <!--FOOTER-->
        <footer>
            <div id="footer-left">
                <div class="left-p">Disclaimer</div>
                <div class="left-p">Privacy Policy</div>
                <div class="left-p">Terms & Conditions</div>
                <div class="left-p">Online Security Tips</div>
            </div>
            <div id="footer-right">
                <ion-icon name="logo-instagram" class="footer-logo"></ion-icon>
                <ion-icon name="logo-facebook" class="footer-logo"></ion-icon>
                <ion-icon name="logo-youtube" class="footer-logo"></ion-icon>
            </div>
        </footer>
    </body>
</html>