<?php 
require_once('_php/connect.php'); 

session_start();
if(empty($_SESSION['username'])){
    header("Location: login.php");
}
if(!empty($_GET['Id'])){
    $_SESSION['Id'] = $_GET['Id'];
    $_SESSION['aId'] = $_GET['aId'];
}else{
    echo "cannot find";
}

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $stmt = "SELECT * FROM t_Admins WHERE a_username ='$username'";
    $res = mysqli_query($dbc, $stmt);
    if ($res){
        while($row = mysqli_fetch_array($res)){
            $name = $row['a_Firstname']." ".$row['a_Lastname'];
            $role = $row['a_Role'];
        }
    }else{
        $name = "Not working".mysqli_error($db);
    }
}
$aid = $_GET['aId'];
$query = "SELECT * FROM t_Students WHERE s_ID =".$_GET['Id'];
$queryIssues = "SELECT * FROM t_Issues WHERE s_ID =".$_GET['Id']." ORDER BY i_ID DESC";
$queryPleas = "SELECT * FROM t_Pleas WHERE s_ID =".$_GET['Id'];


$result = mysqli_query($dbc,$query);
if ($result){
    while($row = mysqli_fetch_array($result)){
        $id = $row['s_ID'];
        $sFirstname = $row['s_Firstname'];
        $sMiddlename = $row['s_Middlename'];
        $sLastname = $row['s_Lastname'];
        $noun = $sFirstname."'s Points";
        $level = $row['s_Level'];
        $matric = $row['s_Matric'];
        $points = $row['s_MeritPoints'];
        $course = $row['s_CourseOfStudy'];     
        $room = $row['s_Room'];
        $address = $row['s_Address'];
        $phoneNumber = $row['s_PhoneNumber'];
        
        $queryHall = "SELECT h_Name FROM t_halls WHERE h_ID =".$row['h_ID'];
        $getIssues = mysqli_query($dbc,$queryIssues);
        $getPleas = mysqli_query($dbc,$queryPleas);
        $getHall = mysqli_query($dbc,$queryHall);

        if($getHall){
            while($row = mysqli_fetch_array($getHall)){
               $hall = $row['h_Name'];
            }
        }else{
            echo 'Not working'.mysqli_error($dbc);  
        }
    }
}else{
    echo 'Not working'.mysqli_error($dbc);
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
    <div id="sid" class="debug"><?php echo $id; ?></div>
    <div id="aid" class="debug"><?php echo $aid; ?></div>
    <header>
         <div class="Logo">
             <img src="_images/logo.png" alt="Logo" width="225px">
         </div>
         <div class="search">
             <input type="search" placeholder="Search Students">
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
       <div class="sect">
          <img src="_images/icon_edit.png" width="32px">
          Edit Profile
       </div>

       <div class="sect mer">
          <img src="_images/icon_add.png" width="32px">
          <?php echo $noun ?>
       </div>
       <input type="number" name="" id="getMatric" value="<?php echo $points ?>"> 
       <input id="saveMatric" type="button" value="save">
       <hr>
       <div class="filter" id="addIssue">
          Add Issue
       </div>
    </aside>
    <div class="page">
        <div id="content">
        <div class="left">
            <div class="top">
                <div><img src="_images/avatar.png"></div>
                <div>
                    <div style="font-size:1.15em"><?php echo $sLastname." ".$sFirstname." <span style='opacity:0.53'>".$sMiddlename."</span>" ?></div>
                    <div style="opacity:0.5; margin-top:10px;"><?php echo $matric ?></div>
                </div>
            </div>
            <div class="view">
                <div class="menu">
                    <div class="act" id="showIssues">Issues</div>
                    <div id="showPleas" >Pleas</div>
                </div>
                <div id="pageStuff">
                    <div id="issues">
                        <?php
                        if($getIssues){
                            if (mysqli_num_rows($getIssues) > 0 ){
                             while($row = mysqli_fetch_array($getIssues)){ ?>
                             <div class="issue">
                                  <div class="action"> 
                                      <div class="opts2">
                                          <div class="cat"><?php echo $row['i_Category']?></div>
                                          <div class="cat"><?php echo $row['i_Severity']?></div>
                                          <div onclick="edit(<?php echo $row['i_ID'] ?>)" class="edit"><img src="_images/icon_edit2.png" width="30px"></div>
                                      </div>
                                      <?php echo $row['i_Details'];?>
                                  </div> 
                                  <div class="punishment">
                                      <?php echo $row['i_Recommendation'] ?>
                                      <div class="from">
                                            <span>by</span>
                                            <?php echo admin($dbc,$row['a_ID']);?>
                                      </div>
                                  </div>
                             </div>    
                        <?php }
                            }else{
                                echo '<div class="clean"><img src="_images/icon_clean.png"> No Issues </div>';
                            }
                        }else{
                            echo "Cannot Get Issues".mysqli_error($dbc);
                        }
                        ?>
                    </div>
                    <div id="pleas">
                        <?php
                            if($getPleas){
                                while($row = mysqli_fetch_array($getPleas)){
                                    echo "<div class='plea'>";
                                    echo "<div class='ptitle'>".$row['p_Title']."</div>";
                                    echo "<div class='pContent'>".$row['p_Content']."</div>";
                                    echo "</div>";
                                }
                            }else{
                                echo "Cannot get Issues".mysqli_error($dbc);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
             <div class="title">Bio</div>
             <div class="details">
                  <div class="det">
                      <img src="_images/icon_edit.png">
                      <?php echo $sLastname." ".$sFirstname." ".$sMiddlename?>
                  </div>
                  <div class="det">
                      <img src="_images/icon_edit.png">
                      <?php echo $course?>
                  </div>
                  <div class="det">
                      <img src="_images/icon_edit.png">
                      <?php echo $level?>
                  </div>
                  <div class="det">
                      <img src="_images/icon_edit.png">
                      <?php echo $hall?>
                  </div>
                  <div class="det">
                      <img src="_images/icon_edit.png">
                      <?php echo $room?>
                  </div>
                  <div class="det">
                      <img src="_images/icon_edit.png">
                      <?php echo $phoneNumber?>
                  </div>
                  <div class="det">
                      <img src="_images/icon_edit.png">
                      <?php echo $address?>
                  </div>
             </div>
        </div>
        </div>
    </div>
    <!--Lightboxes-->
    <div class="backdrop"></div>
    <div class="box"> 
         <form method="POST" id="addStudent">
             <input type="text" id="offenseT" name="offenseT" placeholder="Title of Offense">
             <select name="severity" id="severity">
                 <option>Very Serious</option>
                 <option>Serious</option>
                 <option>Negligible</option>
                 <option>Minor</option>
                 <option>Very Minor</option>
             </select>
             <select name="category" id="category">
                 <option>Theft</option>
                 <option>Exit Violation</option>
                 <option>Hall Irregularities</option>
                 <option>Possession of Prohibited Items</option>
                 <option>Substance Abuse</option>
                 <option>Sexual Immoralities</option>
                 <option>Insurbodination</option>
                 <option>Fraud</option>
                 <option>Illegal accomodation</option>
                 <option> Others.. </option>
             </select>
             <textarea placeholder="Details of the offense" name="offense" id="offense"></textarea>
             <textarea placeholder="Recommendation" name="punishment" id="punishment"></textarea>
             <div id="error"></div>
             <input type="button" id="submit" name="submit" value="Add">
         </form>
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
        }else{
              echo mysqli_error($dbc);
          }
       ?>
    </div>
    <script src="_js/jquery.min.js"></script>
    <script src="_js/script.js"></script>
</body>
</html>

<?php
function admin($dbc,$id){
   $query = "SELECT * FROM t_admins WHERE a_ID = ".$id;
   $getAdmin = mysqli_query($dbc,$query);
   $name = "";
   if ($getAdmin){
       while($row = mysqli_fetch_array($getAdmin)){
          return $row['a_Lastname']." ".$row['a_Firstname'];
       }
   }else{
       return "Cannot Retreive Admin";
   }
}

?>