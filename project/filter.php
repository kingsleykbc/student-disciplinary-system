<?php
require_once('_php/connect.php');
$ind = trim($_POST["ind"]);

$query = "SELECT * FROM t_students ORDER BY s_Lastname ASC";
$result = mysqli_query($dbc, $query);
if ($ind == 1){

    if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $issues = countIssues($dbc, $row['s_ID']);
            if($issues > 0){
                $issues = countIssues($dbc, $row['s_ID']);
                echo "<a href='view.php?Id=".$row['s_ID']."&aId=".$_POST["aid"]."' class='readM'>";
                echo '<div class="student">';        
                echo '<img src="_images/avatari.png">';           
                echo '<div>'.$row['s_Lastname']." ".$row['s_Firstname']." ".$row['s_Middlename'].'</div>';
                echo '<div class="matric">'.$row['s_Matric'].'</div>';
                echo '<img src="_images/icon_go.png">';
                echo '</div></a>';
                echo '<div class="debug">'.$issues.'</div>';    
            }
        }
    }else{
        echo "<div class='nf'>".$txt. " not found </div>";
    }

}else{
        while($row = mysqli_fetch_array($result)){
        $issues = countIssues($dbc, $row['s_ID']);
        echo "<a href='view.php?Id=".$row['s_ID']."&aId=".$_POST["aid"]."' class='readM'>";
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
