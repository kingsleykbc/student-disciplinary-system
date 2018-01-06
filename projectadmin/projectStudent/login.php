<?php
  session_start();
  require_once('connect.php'); 

  if (isset($_POST['matric'])) {
      $matric = trim($_POST['matric']);
      $_SESSION['matric'] = "";
      $query = "SELECT * FROM t_Students WHERE s_Matric  ='$matric'";
      $link = mysqli_query($dbc,$query);
      if (!$link){
          echo mysqli_error($dbc);
      }
      if(mysqli_num_rows($link) > 0 ){
          $_SESSION['matric'] = $matric;
          header("Location: view.php");
      }else{
          echo "<script>alert('Invalid Matric Number')</script>";
      }
      
  }  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 100%;
            box-sizing: border-box;
            outline: none;
        }
        form{
            max-width: 700px;
            margin:7% auto;
            box-shadow: 0 1px 2px rgba(0,0,0,0.2);
            padding:50px;
            background: white;
            border-radius: 5px;
        }
        input{
            display: block;
            margin:50px auto;
            width:100%;
            max-width:500px;
            background: rgba(0,0,0,0.05);
            border:none;
            border-radius: 5px;
            padding:17px;
        }
        input[type="submit"]{
            background:#E8636C;
            color:#fff;
            font-weight: bold;
        }
    </style>
</head>
<body style="text-align:center; background:#eeeeee;">
    <form action="login.php" method="post">
        <input type="text" name="matric" placeholder="Matric Number" maxlength="7">
        <input type="submit" value="LOGIN">
    </form>
</body>
</html>