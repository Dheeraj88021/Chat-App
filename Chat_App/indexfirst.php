<?php
session_start();
    if(isset($_SESSION["username"]) && isset($_SESSION["phone"])){

    
?>

<html>
    <head>
        <style>
            *{
                margin:0;
                padding:0;
            }
            body{
                    height:70%;
                    background: linear-gradient(#800080 0%,#E90207 46%,#ff8c00 100%);
                    place-content:center;
                    display:grid;
            }
            .glass{
                position: absolute;
                top:0;
                left:0;
                width:100%;
                height: 100%;
                overflow:hidden;
            }
            .glass li{
                position: absolute;
                display:block;
                list-style:none;
                width:20px;
                height:20px;
                background:rgba(255,255,255,0.1);
                border:1px solid rgba(255,255,255,0.18);
                animation:spin 5s linear infinite;
                bottom:-150px;
            }
            .glass li:nth-child(1){
                left:35%;
                width:150px;
                height:150px;
                animation-delay:0s;
            }

            
            .glass li:nth-child(2){
                left:10%;
                width:20px;
                height:20px;
                animation-delay:2s;
                animation-duration:12s;
            }
            
            .glass li:nth-child(3){
                left:70%;
                width:20px;
                height:20px;
                animation-delay:4s;
            }
            
            .glass li:nth-child(4){
                left:40%;
                width:60px;
                height:60px;
                animation-delay:0s;
                animation-duration:18s;
            }
            
            .glass li:nth-child(5){
                left:65%;
                width:20px;
                height:20px;
                animation-delay:0s;
            }
            
            .glass li:nth-child(6){
                left:75%;
                width:110px;
                height:110px;
                animation-delay:3s;
            }
            
            .glass li:nth-child(7){
                left:35%;
                width:150px;
                height:150px;
                animation-delay:7s;
            }
            
            .glass li:nth-child(8){
                left:50%;
                width:25px;
                height:25px;
                animation-delay:15s;
                animation-duration:45s;
            }
            
            .glass li:nth-child(9){
                left:20%;
                width:15px;
                height:15px;
                animation-delay:2s;
                animation-duration:36s;
            }
            
            .glass li:nth-child(10){
                left:85%;
                width:150px;
                height:150px;
                animation-delay:0s;
                animation-duration:11s;
            }
            @keyframes spin{
                0%{
                    transform:translateY(10) rotate(10deg);
                    opacity:1;
                    border-radius:0;
                }
                100%{
                    transform:translateY(-1000px)rotate(720deg);
                    opacity:10;
                    border-radius:5%;
                }
            }
            .chat{
                background-image: linear-gradient(rgba(155,155,155),rgba(129,59,239));
                padding:1.7rem;    
                width:63%;
                position: relative;
                top:15%;
                left:9%;
                border-radius:30px 0 30px 0;
            }
            .chat h2{
                font-weight:bold;
                color:cyan;
                margin-top:8px;
                font-family:cursive;
                text-align:center;
                font-size:2.2rem;
            }
            .msgg{
                width:410px;
                height:405px;
                border-top:2.3px solid #f0e68c;
                border-bottom:2.3px solid #f0e68c;
                margin:1rem auto;
                padding:1rem 0;
                display:flex;
                flex-direction:column;
                overflow-y:scroll;
            }
            ::-webkit-scrollbar {
                   width: 1px;
            }
            .input_msg{
                border-radius: 18px 18px 0 19px;
                border-top: 10;
                display:flex;
                justify-content:space-between;
            }
            
            input{
                width:70%;
                height:10%;
                padding:0.7rem 1.3rem;
                border-radius:15px 18px 0 19px;
                font-size:1.3rem;
            }
            .input_msg button{
                background-color:#171747;
                color:white;
                border:none;
                padding:0.6rem 1.2rem;
                cursor:pointer;
                font-size:1.3rem;
                border-radius:15px 18px 0 19px;
            }
            .msgg p{
                background-color:rgb(194,192,192);
                padding:0.4rem 1rem;
                width:fit-content;
                margin-bottom:1rem;
                border-radius:1px 18px 0 18px;
                
            }
            .msgg p span{
                display:block;
                font-weight:bold;
                opacity:0.5;
            }
            .msgg .send{
                background-color:rgba(89,255,89);
                align-self:end;
            }
          
        </style>
    </head>
    <body>
        <div class="bg">
            <ul class="glass">
                <li></li>  
                <li></li> 
                <li></li> 
                <li></li>  
                <li></li> 
                <li></li> 
                <li></li>  
                <li></li> 
                <li></li> 
                <li></li>
            </ul>
        </div>
    
        <div class="chat">
            <h2>Welcome To Chat Application <span> <?=$_SESSION["username"]?></span> </h2>
            <div class="msgg">
            
        </div>
            <div class="input_msg">
                    <input id="input_msg" placeholder="Type your message..."></input>
                <button onclick = "update()">Send</button>
            </div>
        </div>
        <script>

            let msgdiv = document.querySelector(".msgg");
    setInterval(() => {
            fetch("ReadMsg.php").then(r=>{
                if(r.ok){
                    return r.text();
                }
            }
        ).then(d=>{
                msgdiv.innerHTML=d;
            }
        )
    },500);




            window.onkeydown = (e)=>{
                if(e.key == "Enter"){
                    update()
                }
            }
            function update(){
                let msg = input_msg.value; 
                input_msg.value = "";
                fetch(`AddMsg.php?msg=${msg}`).then(r=>{
                    if(r.ok){
                        return r.text();
                    }
                }  
            ).then(d=>{
                console.log("msg has addd");
                msgdiv.scrollTop = (msgdiv.scrollHeight - msgdiv.clientHeight);
            }
           )
        }

        </script>
    </body>
</html>

<?php
    }else{
        header("location: login.php");
    }

?>




