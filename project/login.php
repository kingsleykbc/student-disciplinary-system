<?php
  session_start();
  require_once('_php/connect.php'); 

  if (isset($_POST['username'])) {
      $name = trim($_POST['username']);
      $pass = trim($_POST['password']);
      $_SESSION['username'] = "";
      $query = "SELECT * FROM t_Admins WHERE a_username ='$name' AND a_password='$pass'";
      $link = mysqli_query($dbc,$query);
      if (!$link){
          echo mysqli_error($dbc);
      }
      if(mysqli_num_rows($link) > 0 ){
          $_SESSION['username'] = $name;
          header("Location: page.php");
      }
      
  }  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
    <style>
       *{
           margin:0; padding:0; font-family:Arial, Helvetica; box-sizing:border-box; font-size:100%;
       }

       form{
          margin: 9% auto;
          box-shadow: 0 2px 3px rgba(0,0,0,0.15);
          max-width:750px;
          min-height:300px;
          background:#fff;
          border-radius:5px;
          padding:30px;
       }
       img{
           display:block;
           margin:auto;
       }
       input{
           display:block;
           margin:35px auto;
           border:2px solid #fff;
           padding:15px;
           border-radius: 5px;
           background:#fae7ed;
           width:80%;
       }
       input:focus{
           border-color:#DF255D;
       }
       input[type="submit"]{
           color:#fff;
           background:#E8636C;
           padding:20px;
           margin:45px auto;
       }
       .List{
          background:rgba(0,0,0,0.5);
          color:white;
          border-top-left-radius:5px;
          border-top-right-radius:5px;
          display:none;
       }
       .List div{
           padding:25px;
           border-bottom:1px solid rgba(0,0,0,0.3);
       }
       .hover{
          position:fixed;
          bottom:35px;
          left:35px;
          width:20%;
       }
       .hover:hover .List{
           display:block;
           transition: all 0.5s ;
       }
       .foot:hover{
           border-top-left-radius:0;
           border-top-right-radius:0;
       }
       .foot{
           background:rgba(0,0,0,0.3);
           color:#fff;
           border-radius:5px;
           padding:25px;
           text-align:center;
       }
    </style>
</head>
<body style="background:#ece3e3 url(_images/backdrop.png) 50% 50% no-repeat; background-size: cover;">
    <form method="POST" action="login.php">
         <img src="_images/logo.png" alt="Logo" width="200px">
         <input type="text" name="username"  id="" placeholder="Username">
         <input type="password" name="password" id="" placeholder="Password">
         <input type="submit" value="LOGIN">
         <div id="message" style="color:red; text-align:center;">
        <?php
            if (isset($_POST['username']) && $link){
            if (mysqli_num_rows($link) <= 0 ){
                echo "Invalid username or password";
            }}
        ?>
         </div>
    </form>
    <div class="hover">
         <div class="List">
              <div>Anyabuike Kingsley - 15/2067</div>
              <div>Awodire Oluwatosin - </div>
              <div>Anyawu Jessica - </div>
              <div>Avwunu Ogheneyome - </div>
              <div>Aribabu Ibrahim</div>
              <div>Anyawu Jessica - </div>
              <div>Avwunu Ogheneyome - </div>
              <div>Aribabu Ibrahim</div>
         </div>
         <div class="foot">
               COSC 405 Group Project
         </div>
    </div>
</body>
</html>