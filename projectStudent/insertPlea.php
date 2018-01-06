<?php
require_once('connect.php');

if (isset($_POST["media"])){
    $file = addslashes(file_get_contents($_POST["media"]["tmp_name"]));
}else{
    //echo "No file uploaded";
}
$heading = trim($_POST["headline"]);
$content = trim($_POST["content"]);
$sid = trim($_POST["sid"]);

$query = "
    INSERT INTO t_Pleas (p_Content,p_Title,s_ID,p_ID)
    VALUES (?,?,?,NULL)";

$stmt = mysqli_prepare($dbc,$query);

if ($stmt){
    mysqli_stmt_bind_param($stmt,"ssi",$content,$heading,$sid);

    mysqli_stmt_execute($stmt);

    $affectedRows = mysqli_stmt_affected_rows($stmt);
    if($affectedRows == 1){
        echo '<div class="succ">
                <div>Plea Sent </div>
                <a href="admins.php">VIEW PLEAS</a>
            </div>';

        mysqli_stmt_close($stmt);
        mysqli_close($dbc);
    }else{
        echo 'There were some issues';
        echo mysqli_error($dbc);
        mysqli_close($dbc);
    }
}else{
        echo "somthing went wrong </br>";
        echo mysqli_error($dbc);
}  

?>