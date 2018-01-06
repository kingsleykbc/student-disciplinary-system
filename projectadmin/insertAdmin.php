<?php
require_once('connect.php');

if (isset($_POST["image"])){
    $file = addslashes(file_get_contents($_POST["image"]["tmp_name"]));
}else{
    //echo "No file uploaded";
}
$title = trim($_POST["title"]);
$firstname = trim($_POST["firstname"]);
$lastname = trim($_POST["lastname"]);
$hall = trim($_POST["hall"]);
$role = trim($_POST["role"]);
$phoneNo = trim($_POST["phoneNo"]);
$username = trim($_POST["username"]);
$password = trim($_POST["password"]);

if ($result = @mysqli_query($dbc,"SELECT a_username FROM t_admins WHERE a_username = '".$username."'")){
$rows = mysqli_num_rows($result);

if ($rows > 0){
    echo "<div class='err type'>The username ".$username." is already taken</div>";
}else{
    $query = "
        INSERT INTO t_admins (a_Picture,a_Title, a_Firstname, 
        a_Lastname,a_PhoneNumber,a_Role,a_username,a_password,h_ID,a_ID)
        VALUES (?,?,?,?,?,?,?,?,?,NULL)";

    $stmt = mysqli_prepare($dbc,$query);

    if ($stmt){
        mysqli_stmt_bind_param($stmt,"bsssssssi",$file,$title,$firstname,
        $lastname,$phoneNo,$role,$username,$password,$hall);

        mysqli_stmt_execute($stmt);

        $affectedRows = mysqli_stmt_affected_rows($stmt);
        if($affectedRows == 1){
            echo '<div class="succ">
                    <div>'.$firstname.' was successfully Added </div>
                    <a href="admins.php">VIEW ADMINS </a>
                </div>';

            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }else{
            echo 'There were some issues';
            mysqli_close($dbc);
        }
    }else{
         echo "somthing went wrong </br>";
         echo mysqli_error($dbc);
    }  
}
}else{
      echo "an error occured";
      echo mysqli_error($dbc);
}
?>