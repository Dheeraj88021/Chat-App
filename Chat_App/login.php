<?php
    include"db.php";
    session_start();

    if(isset($_POST["name"]) && isset($_POST["phone"])){
       
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $q = "SELECT * FROM `users` WHERE uname = '$name' && phone = '$phone'";
        if($rq = mysqli_query($db,$q)){

            if(mysqli_num_rows($rq) == 1){

                $_SESSION["username"] = $name;
                $_SESSION["phone"] = $phone;
              
                header("location:indexfirst.php");
            }
            else{
                $q = "SELECT * FROM `users` WHERE phone = '$phone'";
                if($rq = mysqli_query($db,$q)){
                    if(mysqli_num_rows($rq) == 1){
                        echo "<script> alert ($phone +' Is already taken By another person')</script>";
                    }else{
                        $q = "INSERT INTO `users`(`uname`, `phone`) VALUES ('$name','$phone')";
                        if($rq = mysqli_query($db,$q)){
                            $q = "SELECT * FROM `users` WHERE uname = '$name' && phone = '$phone'";
                            if($rq = mysqli_query($db,$q)){
                                if(mysqli_num_rows($rq) == 1){
                                    
                                    $_SESSION["username"] = $name;
                                    $_SESSION["phone"] = $phone;
                                    header("location:indexfirst.php");
                    
                                }
                            }
                        }
                    }
                }
            }
        }
    }

?>

<html>
    <titile></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
            integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" 
                crossorigin="anonymous" referrerpolicy="no-referrer" />

    <head>
        <style>
            
            *{
                margin:0;
                padding: 0;
                box-sizing: border-box;
                font-family: consolas;
            }
            body{
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                overflow: hidden;
                background: #cfd1e1;
            }
            .container{
                display: flex;
                justify-content: center;
                align-items: center;

            }
            .container .box{
                position: relative;
                width:400px;
                height: 480px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .container .box::before{    
                content: '';
                position: absolute;
                top:0;
                left:0;
                width: 25px;
                height: 100%;
                background: linear-gradient(#fff,#fff,#e3e3e3);
                filter: blur(1px);
                z-index: 1;
            }

            .container .box::after{    
                content: '';
                position: absolute;
                top:1;
                right:-1px;
                width: 25px;
                height: 100%;
                background: #9d9d9d;
                filter: blur(1px);
                z-index: 1;
            }
            .container .box .shadow{
                position: absolute;
                width: 100%;
                height: 100%;
                background: #eee;
            }
            .container .box .shadow::before{
                content: '';
                position: absolute;
                top: 0;
                left: calc(100% + 96px);
                width: 120%;
                height: 240%;
                background: linear-gradient(rgba(0,0,0,0.075),transparent);
                transform: skewX(45deg);
                
            }
            .container .box .shadow::after{
                content: '';
                position: absolute;
                bottom: -200%;
                left: calc(100% + 80px);
                width: 100%;
                height: 200%;
                background: linear-gradient(rgba(0,0,0,0.075),transparent);
                transform: skewX(45deg);
                
            }

            .cover{
                position: absolute;
                top:0;
                left: -100px;
                width: 100px;
                height: 100px;
                background: #cfd1e1;
                z-index: 10;
            }
            .content{
                position: relative;
                width: 100%;
                height: 100%;
                background: linear-gradient(#dbdae1,#a3aaba);
                box-shadow: 5px 5px 5px rgba(0,0,0,0.1),
                15px 15px 15px rgba(0,0,0,0.1),
                20px 10px 20px rgba(0,0,0,0.1),
                50px 50px 80px rgba(0,0,0,0.25),
                inset 3px 3px 2px #fff;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .content .form{
                position: relative;
                width: 260px;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }
            .logo{
                width: 70PX;
                height: 70px;
                background: #444;
                color: #fff;
                font-size: 1.75em;
                margin-bottom: 10px;
                justify-content: center;
                align-items: center;
                display: flex;
                border-radius: 50%;
            }
            .content .form h2{
                font-size: 2em;
                color: #444;
                margin-bottom: 20px;
            }
            .content .form  .input{
                position: relative;
                width: 100%;
                margin-top: 30px;
            }
            .content .form .input input{
                position: relative;
                width: 100%;
                color: #444;
                padding: 10px 0 10px 25px;
                font-size: 1.25em;
                background: transparent;
                box-shadow: none;
                border: none;
                border-bottom: 3px solid #444;
                outline: none;
            }

            .content .form .input i{
                position: absolute;
                left: 0;
                bottom: 15px;
                font-size: 1.25em;
                color: #444;                
            }
            .content .form .input span{
                position: absolute;
                left: 0;
                padding: 10px 0 10px 25px;
                font-size: 1.25em;
                pointer-events: none;
                color: #444;
                transition: 0.5s;
            }
            .content .form .input input:focus ~ span,
            .content .form .input input:focus ~ span{
                transform: translateY(-20px);
                font-size: 0.9em;
                background: #444;
                color: #fff;
                padding: 2px 4px;
            }
            .content .form .input input[type="submit"]{
                background: #444;
                color: #fff;
                cursor: pointer;
                padding: 10px;
            }

            .content .form .input input[type="submit"]:hover{
                background-color: #333;
            }

        </style>
    </head>
    <body>


    <div class="container">
    <div class="box">
        <div class="cover"></div>
        <div class="shadow"></div>
            <div class="content">
                <div class="form">
                <form action="" method="post">
                    <h3 class="logo"><i class="fa-solid fa-key"></i></h3>
                        <h2>ChatRoom</h2>
                            <div class="input">
                                <input type="text"  name="name" required>
                                <i class="fa-solid fa-user"></i>
                                <span>UserName</span>
                            </div>
                            
                            <div class="input">
                                <input type="number"  min="999999999" max="9999999999" name="phone" required>
                                <i class="fa-solid fa-lock"></i>
                                <span>Phone No</span>
                            </div>
                            
                            <div class="input">
                                <input type="submit" value="Login">
                            </div>
                </form>
                </div>
            </div>
    </div>
 </div>
</body>
</html>