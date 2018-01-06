<?php 
require_once('_php/connect.php'); 

session_start();
echo $_SESSION['username'];
if(empty($_SESSION['username'])){
    header("Location: login.php");
}
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $stmt = "SELECT * FROM t_Admins WHERE a_username ='$username'";
    $res = mysqli_query($dbc, $stmt);
    if ($res){
        while($row = mysqli_fetch_array($res)){
            $aid = $row['a_ID'];
            $name = $row['a_Firstname']." ".$row['a_Lastname'];
            $role = $row['a_Role'];
        }
    }else{
        $name = "Not working".mysqli_error($db);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    <link rel="stylesheet" href="_css/style.css">
</head>
<body>
    <div class="debug" id="aid"><?php echo $aid?></div>
    <header>
         <div class="Logo">
             <img src="_images/logo.png" alt="Logo" width="225px">
         </div>
         <div class="search">
             <input id="searchStudents" type="search" placeholder="Search Students">
         </div>
         <div id="logs" class="Logs">
             Logs
         </div>
         <div class="Logout">
             Logout
         </div>
    </header>
    <aside>
       <div class="admin">
           <img src="_images/avatar.png" alt="Admin" width="55px">
           <span><?php echo $name ?></span>
       </div>
       <div class="sect">
          <img src="_images/icon_role.png" width="32px">
          <?php echo substr($role,0,20)."... " ?>
       </div>
       <div class="opts">
          <div id="allS" class="active">All</div>
          <div id="issueI">Issues</div>
       </div>
       <div class="sect">
          <img src="_images/icon_edit.png" width="32px">
          Edit Profile
       </div>
       <div class="sect">
          <img src="_images/icon_add.png" width="32px">
          Add Student
       </div>
       <div class="sect">
          <img src="_images/icon_add.png" width="32px">
          Statistics
       </div>
       <div class="sect">
          <img src="_images/excel.png" width="32px">
          Create .xcls file
       </div>
       <div class="filter">
          Filters
       </div>
    </aside>
    <div id="page1" class="page">
       <?php
          $query = "SELECT * FROM t_Students ORDER BY s_Lastname ASC";
          $response = @mysqli_query($dbc,$query);
          if($response){
          while($row = mysqli_fetch_array($response)){
              $issues = countIssues($dbc, $row['s_ID']);
              echo "<a href='view.php?Id=".$row['s_ID']."&aId=".$aid."' class='readM'>";
              echo '<div class="student">';
              if ($issues > 0){
                 echo '<img src="_images/avatari.png">';
              }else{
                 echo '<img src="_images/avatar.png">';
              }              
              echo '<div>'.$row['s_Lastname']." ".$row['s_Firstname']." ".$row['s_Middlename'].'</div>';
              echo '<div class="matric">'.$row['s_Matric'].'</div>';
              echo '<img src="_images/icon_go.png">';
              echo '</div></a>';
              echo '<div class="debug">'.$issues.'</div>';
          }
        }
       ?>
    </div>
    <div id="viewLogs">
        <?php
          $queryLog = "SELECT * FROM t_Logs ORDER BY l_Time DESC";
          $getLog = @mysqli_query($dbc,$queryLog);
          if($getLog){
          while($row = mysqli_fetch_array($getLog)){
              echo "<div class='log'>";
              echo "<div>".$row['l_Message']."</div>";
              echo "<div>".$row['l_Time']."</div>";
              echo "</div>";
          }
        }
       ?>
    </div>
    <script src="_js/jquery.min.js"></script>
    <script src="_js/script.js"></script>
</body>
</html>
<?php
function countIssues($dbc,$sid){
     $queryIssues = "SELECT * FROM t_Issues WHERE s_ID =".$sid;
     $getIssues = mysqli_query($dbc,$queryIssues);
     if ($getIssues){
         return mysqli_num_rows($getIssues);
     }else{
         return "issues not found".mysqli_error($dbc);
     }
}

?>
