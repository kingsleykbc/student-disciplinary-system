<?php 
require_once('connect.php'); 

session_start();
echo $_SESSION['matric'];
if(empty($_SESSION['matric'])){
    header("Location: login.php");
}
if(isset($_SESSION['matric'])){
    $matric = $_SESSION['matric'];
    $stmt = "SELECT * FROM t_Students WHERE s_matric ='$matric'";
    $res = mysqli_query($dbc, $stmt);
    if ($res){
        while($row = mysqli_fetch_array($res)){
            $id = $row['s_ID'];
            $name = $row['s_Firstname']." ".$row['s_Lastname'];
            $matric = $row['s_Matric'];
            if ($row['s_MeritPoints'] > 30){
                $merit = '<span class="himerit">'.$row['s_MeritPoints'].' Merit Points</span>';
            }else{
                $merit = '<span class="lowmerit">'.$row['s_MeritPoints'].' Merit Points Left</span>';
            }
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
    <link rel="stylesheet" href="_css/style.css">
    <title>Dashboard</title>
</head>
<body>
    <header>
        <a class="on" href="view.php">View Issues</a>
        <a href="post.php">Appeal</a>
        
    </header>
    <div class="page">
    <?php
        echo '<div class="citi"><div>'.$name.'</div><div>'.$matric.'</div><div>'.$merit.'</div> </div>';
        $query = "SELECT * FROM t_Issues WHERE s_ID =".$id;

        $response = @mysqli_query($dbc,$query);
        if($response){
            if (mysqli_num_rows($response) <= 0){
                   echo '<div class="good">You Have no issues with the school </div>';
            }else{
                while($row = mysqli_fetch_array($response)){
                    echo '<div class="issue">';
                    echo '<div class="stats">';
                    echo '<div class="stat">'.$row['i_Category'].'</div> <div class="stat">'.$row['i_Severity'].'</div>';
                    echo '</div>';
                    echo '<div class="iTitle">'.$row['i_Offense'].'</div>';
                    echo '<div class="iDetails">'.$row['i_Details'].'</div>';
                    echo '<div class="iPunishment">'.$row['i_Recommendation'].'</div>';
                    echo '</div>';
                }
            }
        }else{
            echo "Cannot Get Issues at this time ".mysqli_error($dbc);
        }
    ?>
    </div>
</body>
</html>